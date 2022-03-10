<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html" ; charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="s7njxyo83h0devx1e4t3az1p0ywvdr" />
    <link href={{ asset('confs/logo.ico') }} rel="shortcut icon" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Work Now Cursos') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/methods.js') }}"></script>
    <script src="https://kit.fontawesome.com/d6a7d1914a.js" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script> {{-- EDITOR DE TEXTO --}}

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '791464128425300');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=791464128425300&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Ads: 1001943045 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1001943045"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-1001943045');
    </script>
    <!-- End Global site tag -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('confs/diseno.css') }}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    @livewireScripts
</head>

<body style="height:100vh;">
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @yield('fixed-div')
    <div id="app">



        <nav class="navbar navbar-expand-md text-light barra-menu">

            <div class="container">

                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <div class="d-flex align-items-lg-center">

                        <img src="{{ asset('confs/logo.png') }}" class="h-10" />
                        <span class="fuente-bauhaus93">Work Now</span>
                    </div>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-white"><i class="fas fa-plus-square"></i></span>
                </button>
                @auth

                    @if ((Auth::user()->rol == 'admin' || Auth::user()->rol == 'alumno') && Auth::user()->tipo_pago != 'test')
                        <div class="d-flex justify-content-around w-100 font-weight-bolder">


                            <a class="text-white" style="margin:2px;" href="{{ route('Novedad.index') }}">Novedades <i
                                    class="far fa-newspaper"></i></a>

                            @include('layouts.acceso-foro')

                            <a class="text-white" style="margin:2px;"
                                href="https://worknowshop.mitiendanube.com/">Tienda&nbsp;<i
                                    class="fas fa-cart-arrow-down fa-2x"></i></a>
                        </div>
                    @endif

                @endauth

                <div class="collapse navbar-collapse" id="navbarSupportedContent">



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item text-light">
                                <a class="nav-link text-light" href="{{ url('/') }}">{{ __('Ingresar') }}</a>
                            </li>

                        @else



                            <li class="nav-item">

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="navbarDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesion') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>

            </div>
        </nav>

        @yield('anuncio')

        <div id="form-edit"></div>



        <main class="py-3">
            @yield('content')
            @yield('panel')
            @yield('curso')
            @yield('exam')
            @yield('resultado')
            @yield('correction')
            @yield('postVenta')
            @yield('desarrollo')
            @yield('corregidos')
            @yield('cursosDesarrollo')
            @yield('confirmar_delete')
            @yield('intro')
            @yield('modificar')
        </main>




    </div>



    <script type="text/javascript">
        function edit() {
            document.getElementById("datos-noedit").style.display = "none";
            document.getElementById("datos-edit").style.display = "block";
        }

        function noedit() {
            document.getElementById("datos-noedit").style.display = "block";
            document.getElementById("datos-edit").style.display = "none";
        }
    </script>




    <script src="{{ asset('js/app.js') }}"></script>
    @auth

        <small style="
            position: fixed;
            bottom:0;
            opacity: 0.7;
        ">
            E-Campus V. 4.1.5.0</small>
    @endauth

    
</body>

</html>
