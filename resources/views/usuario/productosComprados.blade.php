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
        <link rel="stylesheet" href="{{ asset('animacion-inicio/facturas/dist/style.css') }}">


        
        <link rel="stylesheet" href="{{asset('animacion-inicio/welcome/style.css')}}">
        <link rel="stylesheet" href="{{asset('animacion-inicio/landing/style.css')}}">
       
        <link rel="stylesheet" href="{{ asset('animacion-inicio/cartas/dist/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">

        <link rel="stylesheet" href="{{ asset('animacion-inicio/client-side/css/style.cs') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/jackie-s-pet-store/dist/style2.css') }}">

        


    </head>
    <body class="antialiased">
        <x-header />
        


        <div class="wrapper">
            <div class="content-principal" >

                



                <div class="container-opinion">
                    <div class="headerOpinion">
                        <h1>Productos comprados</h1>
                        <div class="filter">
                            <span>Total productos</span>
                            @if ($totalProductosComprados <= 0 )
                                <span>No hay productos registrados</span>
                            @else
                            <span>{{ $totalProductosComprados }}</span>
                            @endif
                        </div>
                    </div>

                    @foreach($productosComprados as $detalle)
                        @php
                            // Obtener el producto asociado a este detalle de compra
                            $producto = $productos->where('id_pro', $detalle->producto_id)->first();
                            $fotoUrl = asset('storage/' . $producto->detProducto->foto); // Verifica que la relación detProducto esté definida correctamente
                        @endphp

                        <div class="product">
                            <img src="{{ $fotoUrl }}" alt="Producto">
                            <div class="details">
                                <p class="status">Entregado</p>
                                
                                <p class="description">{{ $producto->nombre }}, {{ Str::limit($producto->descripcion, 30, '...') }}</p>
                                <p class="seller">Compraste {{ $detalle->total_comprado }} unidades</p>
                                <a href="#">Enviar mensaje</a>
                            </div>
                            <div class="actions">
                                <!-- Usamos una ruta de Laravel para calificación -->
                                <a href="{{route('calificacion', ['id_pro' => $producto->id_pro])}}">
                                    <button>Dejar calificación</button>
                                </a>
                                <button class="actions-2">Ver producto</button>
                            </div>
                        </div>
                    @endforeach

                    
                    
                </div>


            </div>
        </div>

    


            

            



        
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
