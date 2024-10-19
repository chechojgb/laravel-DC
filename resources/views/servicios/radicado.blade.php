<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios</title>
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/pqr/dist/style.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/radicado/dist/caja.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/formularios/dist/style.css')}}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <x-header />
    


    
    <div class="wrapper">
        <div class="content-principal">

            <div id="container" id="timer">
                <div id="circle">
                    <i class="fa fa-check"></i>
                </div>
            
                <p>
                    Hola {{ $radicados->nombre }}, <br> tu {{ $radicados->tipo_servicio }} ha sido generada el dia {{
                    $radicados->created_at }} con el codigo <br>"{{ $radicados->num_servicio }}"<br> (guarda este codigo para
                    consultar tu {{ $radicados->tipo_servicio }}) y se respondera lo mas pronto posible, te enviaremos un correo con
                    la respuesta al {{ $radicados->email }}
                </p>
                <p class="p_servicio" style="width: 100%;
                    background: #e08eb1;
                    border: transparent;
                    border-radius: 3%;
                    padding: 10px;
                    text-transform: uppercase;
                    color: white;
                    letter-spacing: 1px;">{{ $radicados->num_servicio }}</p>
            
            </div>
            
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