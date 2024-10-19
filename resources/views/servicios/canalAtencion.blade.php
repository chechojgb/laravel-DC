<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Canales de atencion</title>
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">


    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/pqr/dist/style.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/contacto/dist/style.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <x-header />


    <div class="wrapper">
        <div class="content-principal">
            <div class="header-contacto" style="margin-top: 100px;">
                <div class="container-contacto">
                    <div class="row-contacto">
                        <div class="">
                            <div class="intro-text">
                                <span class="titulo-header">Medios de atención</span>
                                <span class="subtitulo-header">Utiliza cualquiera de estos servicios</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <section class="canales-atencion">
                <div class="container-contacto">
                    <div class="row-contacto" style="margin: 30px 0 20px;" >
                        <div class=" text-center">
                            <h2 style="margin-bottom: 25px;">Cual prefieres</h2>
                        </div>
                    </div>
                    <div class="row-contacto" >
                        <div class="portfolio-item">
                            <a href="#" class="portfolio-link text-center" data-toggle="modal">
                                <span class="fa fa-envelope" aria-hidden="true"></span>
                            </a>
                            <article class="portfolio-item-One">
                                <header>
                                    <h3>Correo</h3>
                                </header>
                                <p>
                                    SoporteDeCroche@gmail.com. 
                                </p>
                            </article>                    
                        </div>
                        <div class="portfolio-item">
                            <a href="#" class="portfolio-link text-center" data-toggle="modal">
                                <span class="fa fa-phone" aria-hidden="true"></span>
                            </a>
                            <article class="portfolio-item-Two">
                                <header>
                                    <h3>Telefono</h3>
                                </header>
                                <p>
                                    +57 321 2752620 <br><br>
                                    +57 313 3819207
                                </p>
                            </article>                    
                        </div>
                        <div class="portfolio-item">
                            <a href="#" class="portfolio-link text-center" data-toggle="modal">
                                <span class="fa fa-fw fa-camera-retro" aria-hidden="true" ></span>
                            </a>
                            <article class="portfolio-item-Three">
                                <header>
                                    <h3>Nuestras redes sociales</h3>
                                </header>
                                <p>https://www.facebook.com/DeCroche  <br> <br> https://www.instagram.com/DeCroche/</p>
                            </article>                    
                        </div>
                    </div>
                </div>
            </section>
    
        </div>
    </div>


    @include('footer')



    <script src="{{ asset('js/busqueda/busqueda.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>

</body>
</html>