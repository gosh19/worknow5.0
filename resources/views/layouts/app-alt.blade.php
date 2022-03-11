<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="s7njxyo83h0devx1e4t3az1p0ywvdr" />
    <link href={{ asset('confs/logo.ico') }} rel="shortcut icon" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Work Now Cursos') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script  src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>
    <script defer src="{{ url(mix('js/app.js')) }}"></script>
    

    @livewireStyles
    @livewireScripts
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '791464128425300');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=791464128425300&ev=PageView&noscript=1"
    /></noscript>
  <!-- End Facebook Pixel Code -->

   <!-- Global site tag (gtag.js) - Google Ads: 1001943045 -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1001943045"></script>
   <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'AW-1001943045');
   </script>
   <!-- End Global site tag -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <link href="{{ asset('confs/diseno.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="height:100vh;">
    @guest
        <div class="fixed right-4 bottom-4 md:right-10 md:bottom-10 z-50">
            <div class="w-16 md:w-24">
                <a href="https://api.whatsapp.com/send?phone=542236772444&app=facebook&entry_point=page_cta&fbclid=IwAR3NHSP8Z8dlKtOC_SkfkU55n8jAUC75rJIq_QX04SXJoXBnFxBBLbNlSn4">

                    <img src="{{ asset('/img/whatsapp.png') }}" alt="">
                </a>
            </div>
        </div>    
    @endguest
    
        <main >
            @yield('content')
        </main>


    @auth
        
        <small
        style="
            position: fixed;
            bottom:0;
            opacity: 0.7;
        "
        >
        E-Campus V. 4.0.7.0</small>
    @endauth
    
    <script type="text/javascript" src="{{ asset('js/methods.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
