<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;

use \PayPal\Api\Payer;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Api\PaymentExecution;
use \PayPal\Exception\PayPalConnectionException;

use Carbon\Carbon;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {/*
        $payPalConfig = config('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);*/
    }

    public function processPayment(Request $request)
    {
      \MercadoPago\SDK::setAccessToken("TEST-7514513084559246-010717-6941ff530eeac4f7c1a99439fab255e4-787422277");

      $payment = new \MercadoPago\Payment();
      $payment->transaction_amount = (float)$request['transactionAmount'];
      $payment->token = $request['token'];
      $payment->description = $request['description'];
      $payment->installments = (int)$request['installments'];
      $payment->payment_method_id = $request['paymentMethodId'];
      $payment->issuer_id = (int)$request['issuer'];
  
      $payer = new \MercadoPago\Payer();
      $payer->email = $request['cardholderEmail'];
      $payer->identification = array(
          "type" => $request['identificationType'],
          "number" => $request['identificationNumber']
      );
      $payer->first_name = $request['cardholderName'];
      $payment->payer = $payer;
  
      $payment->save();
  
      $response = array(
          'status' => $payment->status,
          'status_detail' => $payment->status_detail,
          'id' => $payment->id
      );
      echo json_encode($response);
      
    }

    public function payWithMp()
    {
        $title = '';
        $precio = 0;
        $cant = 0;
        foreach (Auth::user()->courses as $key => $cur) {
          if ($cur->pivot->type == 'test') {
            $cant++;
            $title .= $cur->nombre.' - ';
            $precio += $cur->info == null?1989:$cur->info->getPrecio('AR');
            if ($cant == 3) {
              $precio = $precio*0.33;
            }
          }
        }

        $pref = ['items' => [
                              ['title'=> $title,
                                'quantity'=> 1,
                                'category_id' => 'others',
                                'unit_price' => $precio,
                              ],
                          ],
                  "back_urls"=>[ 
                            "success"=> url("/back-mp/".Auth::id()."/".$precio),
                            "failure"=> url("/back-mp/".Auth::id()),
                            "pending"=> url("/back-mp/".Auth::id()),
                          ],
                  "auto_return"=> "approved",
                  ];
        
        $preference = \MP::create_preference($pref);
      
        return redirect('https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id='.$preference['response']['id']);
    }

    public function payWithPayPal()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $title = '';
        $precio = 0;
        $cant = 0;
        foreach (Auth::user()->courses as $key => $cur) {
          if ($cur->pivot->type == 'test') {
            $cant++;
            $title .= $cur->nombre.' - ';
            $precio += $cur->info == null?23:$cur->info->getPrecio('SD');//LE CLAVE SD PORQ SI NO ES AR YA SIRVE PARA TENER EL VALOR USD
            if ($cant == 3) {
              $precio = $precio*0.33;
            }
          }
        }

        $amount = new Amount();
        $amount->setTotal($precio);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($title);

        $callbackUrl = url('/paypal/status/');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData(); //HACER UNA VISTA DE RROR POR SI PASA ALGO Y COMENTAR LA WEA
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            //El pago a través de PayPal no se pudo realizar
            return redirect()->route('User.show',['id'=> Auth::id()]);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            //El pago a través de PayPal se ha ralizado correctamente
            Auth::user()->tipo_pago = 'pp-automatico';
            Auth::user()->save();

            $venta = \App\Venta::firstOrNew(['alumno'=> Auth::id()]);
            $venta->estado = 'cerrada';
            if ($venta->vendedor == null) {
              $venta->vendedor = 2;
            }
            $venta->fecha = Carbon::now();
            $venta->save();

            foreach (Auth::user()->courses as $course) {
              if ($course->pivot->type == 'test') {
                $course->pivot->type = 'pp-automatico';
                $course->pivot->save();
              }
            }

            return redirect()->route('User.show',['id'=> Auth::id()])->with('mp','approved');
        }

        //El pago a través de PayPal no se pudo realizar
        return redirect()->route('User.show',['id'=> Auth::id()]);
    }

    public function backMp($id, Request $request, $precio = null)
    {
        if ($request->preference_id) {
          switch ($request->status) {
            case 'approved':

              $hoy = Carbon::now();

              $user = \App\User::find($id);
              $user->tipo_pago = 'mp-automatico';
              $user->save();

              foreach ($user->courses as $course) {
                if ($course->pivot->type == 'test') {
                  $course->pivot->type = 'mp-automatico';
                  $course->pivot->save();
                }
              }

              $venta = \App\Venta::firstOrNew(['alumno'=> $user->id]);
              $venta->estado = 'cerrada';
              if ($venta->vendedor == null) {
                $venta->vendedor = 2;
              }
              $venta->fecha = $hoy;
              $venta->save();

              $infoFac = \App\InfoFac::firstOrNew(['user_id' => $user->id]);
          
              $infoFac->cant_cuotas = 1;
              $infoFac->monto_cuota = $precio;
              $infoFac->fecha_sig_cobro = $hoy;
              $infoFac->cobrable = 0;
              
              $infoFac->save();

              $cobro = \App\Cobro::firstOrNew(['user_id' => $user->id,'numero_operacion'=>$request->preference_id]);
              
              $cobro->cuenta_id = 2;
              $cobro->monto = $precio;
              $cobro->tipo = 0;
              $cobro->cant_cuotas = 1;
              $cobro->fecha = $hoy;
              
              $cobro->save();

              return redirect()->route('User.show',['id'=> Auth::id()])->with('mp','approved');
              break;
            case 'in_process':

              $venta = \App\Venta::firstOrNew(['alumno'=> $user->id]);
              $venta->estado = 'pendiente';
              if ($venta->vendedor == null) {
                $venta->vendedor = 2;
              }
              $venta->fecha = Carbon::now();
              $venta->save();
              return redirect()->route('User.show',['id'=> Auth::id()])->with('mp','pending');
              break;
            default:
              return redirect()->route('User.show',['id'=> Auth::id()]);
              break;
          }
          
        }
      return redirect()->route('User.show',['id'=> Auth::id()]);
    }
}
