@extends('layouts.app-alt')

@section('content')

    <div class="min-h-screen bg-gradient-to-tr from-blue-300 to-indigo-400">


        {{-- navBar --}}
        <div class="grid grid-cols-8 p-3 items-center justify-end gap-7 md:gap-0">
            <div class="col-start-1 col-span-8 md:col-span-1 justify-self-center">
                <a href="/">

                    <img src="{{ asset('img\inicio\logo-blanco.png') }}" alt="">
                </a>
            </div>

            <div class="md:col-start-6 col-span-2 md:col-span-1 justify-self-center">
                <a href={{ route('Intro.Cursos') }}
                            class="no-underline hover:text-gray-400 text-white inline-block mt-3 transform hover:scale-105 transition duration-500">
                            Cursos
                        </a>
            </div>

        </div>


        {{-- area de registro --}}
        <div>
            <div class="py-10">
                <div class="grid grid-cols-1 rounded-xl shadow-md w-full md:w-10/12 mx-auto">
                    <div class="col-span-1">                        
                       @livewire('inscripcion.formulario-inscripcion')
                    </div>
                </div>
            </div>
        </div>
        


        
    </div>
    <form id="form-checkout" >
      @csrf
        <input type="text" name="cardNumber" id="form-checkout__cardNumber" />
        <input type="text" name="cardExpirationDate" id="form-checkout__cardExpirationDate" />
        <input type="text" name="cardholderName" id="form-checkout__cardholderName"/>
        <input type="email" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
        <input type="text" name="securityCode" id="form-checkout__securityCode" />
        <select name="issuer" id="form-checkout__issuer"></select>
        <select name="identificationType" id="form-checkout__identificationType"></select>
        <input type="text" name="identificationNumber" id="form-checkout__identificationNumber"/>
        <select name="installments" id="form-checkout__installments"></select>
        <button type="submit" id="form-checkout__submit">Pagar</button>
        <progress value="0" class="progress-bar">Cargando...</progress>
     </form>
   <script src="https://sdk.mercadopago.com/js/v2"></script>
   <script>
       
       const mp = new MercadoPago('TEST-5e4664e6-3941-4a13-8094-05ad5ee9967e');
       // Step #3
const cardForm = mp.cardForm({
  amount: "100.5",
  autoMount: true,
  form: {
    id: "form-checkout",
    cardholderName: {
      id: "form-checkout__cardholderName",
      placeholder: "Titular de la tarjeta",
    },
    cardholderEmail: {
      id: "form-checkout__cardholderEmail",
      placeholder: "E-mail",
    },
    cardNumber: {
      id: "form-checkout__cardNumber",
      placeholder: "Número de la tarjeta",
    },
    cardExpirationDate: {
      id: "form-checkout__cardExpirationDate",
      placeholder: "Data de vencimiento (MM/YYYY)",
    },
    securityCode: {
      id: "form-checkout__securityCode",
      placeholder: "Código de seguridad",
    },
    installments: {
      id: "form-checkout__installments",
      placeholder: "Cuotas",
    },
    identificationType: {
      id: "form-checkout__identificationType",
      placeholder: "Tipo de documento",
    },
    identificationNumber: {
      id: "form-checkout__identificationNumber",
      placeholder: "Número de documento",
    },
    issuer: {
      id: "form-checkout__issuer",
      placeholder: "Banco emisor",
    },
  },
  callbacks: {
    onFormMounted: error => {
      if (error) return console.warn("Form Mounted handling error: ", error);
      console.log("Form mounted");
    },
    onSubmit: event => {
      event.preventDefault();
      
      const {
        paymentMethodId: payment_method_id,
        issuerId: issuer_id,
        cardholderEmail: email,
        amount,
        token,
        installments,
        identificationNumber,
        identificationType,
      } = cardForm.getCardFormData();

      const data = {
          "token":token,
          "issuer_id":issuer_id,
          "payment_method_id":payment_method_id,
          "installments": Number(installments),
          "transaction_amount": 200,
          "description": "Descripción del producto",
          "payer": {
            "email":email,
            "identification": {
              "type": identificationType,
              "number": identificationNumber,
            },
          },
        }; //ME SALTA Q SIGUE NULL EL TRANSACTION AMOUNT, REVISAR ESA WEA
      
      fetch("/process_payment", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: data,
      });
    },
    onFetching: (resource) => {
      console.log("Fetching resource: ", resource);

      // Animate progress bar
      const progressBar = document.querySelector(".progress-bar");
      progressBar.removeAttribute("value");

      return () => {
        progressBar.setAttribute("value", "0");
      };
    }
  },
});
   </script>
@endsection
