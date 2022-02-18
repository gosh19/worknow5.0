<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\VendedorMail;
use Carbon\Carbon;

use App\User;
use App\Venta;
use App\DatosUser;
use App\Vendedor;
use App\Pendiente;

class VendedorController extends Controller
{
    /**
     * guarda el horario del primer logueo del vendedor
     */
    private function primerLog(){
        $hoy = Carbon::now();

        $ingreso = \App\Ingreso::whereDate('created_at',$hoy)->where('user_id',Auth::user()->id)->get();
        if (count($ingreso) == 0) {
            $ingreso = new \App\Ingreso;
            $ingreso->user_id = Auth::user()->id;
            $ingreso->save();
        } 
    }
    /**
     * Inicio de perfil de vendedoras
     */
    public function inicio()
    {
        $hoy = Carbon::now();

        $this->primerLog();

        $comision = 0;

        $objetivo = \App\Objetivo::getObjMonth();
        $ventas = Venta::where([
                                ['vendedor',Auth::user()->id],
                                ['estado', 'cerrada'],
                                ['alta', 1],
                            ])->whereMonth('fecha', $hoy->month)
                            ->whereYear('fecha',$hoy->year)
                            ->get();
        
        $vendedora = Vendedor::find(Auth::user()->id);

        foreach ($ventas as $key => $value) {
            $comision += $value->comision;
        }                                   

        return view('vendedor.vendedor',[
                                        'user' => Auth::user(), 
                                        'ventas'=>  $ventas, 
                                        'comision' => $comision
                                        ]);
    }

    public function index($id,$mes = null)
    {
        $vendedora = Vendedor::find($id);

        $year = Carbon::now()->year;
        if ($mes == null) {
            $hoy = \Carbon\Carbon::now();
            $mes = $hoy->month;
        }
        $ventasAlta = \App\Venta::whereMonth('fecha', $mes)
                                    ->whereYear('fecha',$year)
                                    ->where([
                                        ['vendedor', $vendedora->id],
                                        ['estado', 'cerrada'],
                                        ['alta', 1],
                                        ])->get();
        $vendedora->comision = 0;

        foreach ($ventasAlta as $j => $venta) {
            $vendedora->comision += $venta->comision;
        }
        return view('admin.perfilVendedora.index',['vendedora' => $vendedora,'mes' => $mes]);
    }



    public function verHistorialVentas()
    {
        $vendedora = Vendedor::find(Auth::user()->id);

        return view('vendedor.historialVentas', ['user'=> $vendedora]);
    }

    public function alumnoPendiente($id)
    {
        try {
            
            $user = User::find($id);
            $datosUser = DatosUser::where('user_id', $id)->get();

            return view('vendedor.alumnoPendiente',['user' => $user, 'datosUser' => $datosUser]);

        } catch (\Throwable $th) {
            return 'Error al abrir alumno pendiente ------>>   '.$th->getMessage();
        }
    }

    /**
     * muestra el formulario de envio de correo
     */
    public function formEnvioMail($case)
    {
        return view('vendedor.formEnvioMail',['case' => $case]);
    }
    /**
     * Envia la view del mail correspondiente a la direccion brindada
     */
    public function envioMail(Request $request)
    {
        $validator = $request->validate([
            'course_id' => ['required'],
            'name' => ['required'],
            'email' => ['required']
        ]);
            

        $pendiente = Pendiente::where('email', $request->email)->get();

        if (count($pendiente) == 0) {
            $pendiente = new Pendiente;
            $pendiente->email = $request->email;
            $pendiente->vendedor_id = Auth::user()->id;
        }else {
            $pendiente = Pendiente::find($pendiente[0]->id);
        }

        $pendiente->name = $request->name;
        $pendiente->course_id = $request->course_id;
        $request->curso = $request->course_id; //Esto es por un cambio en el nombre de variables q hice y debo normalizar

        if ($request->case == "informativo") {
            $pendiente->informativo = true;
        }elseif ($request->case == "cupon") {
            $pendiente->cupon = true;
        }
        $pendiente->save();

        try {
            
            //Mail::to($request->email)->queue(new VendedorMail($request));

            return redirect('/vendedor')->with('msg', 'success');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/vendedor')->with('msg', 'danger');
        } 
    }

    public function verMailsEnviados()
    {
        $pendientes = Pendiente::where('vendedor_id', Auth::user()->id)
                                ->orderBy('id','Desc')
                                ->take(30)
                                ->with('course')
                                ->get();
        
        return view('vendedor.verPendientes', ['pendientes' => $pendientes]);
    }

    /**Hay q laburarla mucho mas */
    public function envioMsjWpp(Request $request)
    {
        return redirect('https://wa.me/'.$request->tel.'?text='.$request->msj);
    }

    public function verPrecios()
    {
        $courses = \App\Course::orderBy('nombre','asc')->get();

        return view('vendedor.verPrecios',['courses'=> $courses]);
    }
}
