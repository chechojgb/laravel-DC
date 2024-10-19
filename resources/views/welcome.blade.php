<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Decroche</title>


        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'><link rel='stylesheet' href='https://dl.dropboxusercontent.com/u/69747888/MoGo%20carousel/font-awesome.min.css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700'>

        <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

        
        <link rel="stylesheet" href="{{asset('animacion-inicio/welcome/style.css')}}">
        <link rel="stylesheet" href="{{asset('animacion-inicio/landing/style.css')}}">
       
        <link rel="stylesheet" href="{{ asset('animacion-inicio/cartas/dist/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">

        <link rel="stylesheet" href="{{ asset('animacion-inicio/client-side/css/style.cs') }} ">

        


    </head>
    <body class="antialiased">
        <x-header />
        




            @include('cuerpo')


            

            



        
        @include('footer')
        
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script src='https://use.fontawesome.com/8ae46bccf5.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js'></script>


        <script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>
        <script src="{{ asset('animacion-inicio/presentacion/dist/script.js') }}"></script>
        <script src="{{ asset('animacion-inicio/cartas/dist/script.js') }}"></script>

        <script src="{{ asset('js/busqueda/busqueda.js') }}"></script>
    </body>
</html>
