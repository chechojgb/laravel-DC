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


        <link rel="stylesheet" href="{{ asset('animacion-inicio/jackie-s-pet-store/dist/style3.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/jackie-s-pet-store/dist/style.css') }}">
        


    </head>
    <body class="antialiased">
        <x-header />
        


        <div class="wrapper">
            <div class="content-principal" >

                


                <div class="container-opinion">

                    <div class="left-section">
                        <div class="product-details">
                            <h2>{{ $producto->nombre }}, {{ Str::limit($producto->descripcion, 30, '...') }}...</h2>
                            <a href="{{ route('detalles.producto.show', ['id_pro' => $producto->id_pro]) }}">Ver detalles del producto</a>
                        </div>
                        <div class="delivery-status">
                            <div class="status-header">
                                <span class="status">Entregado</span>
                                <span class="date">Llegó el {{ $primeraCompra->created_at }}⚡ FULL</span>
                            </div>
                            <p>Enviamos este producto a la dirección <strong>{{ $usuario->detEnvios->direccion }}</strong>, {{ $usuario->detEnvios->ciudad }}</p>
                            <a href=""><button>Volver a comprar</button></a>
                        </div>
                    
                        @if ($calificacion == 0)
                            <div class="rating-section">
                                <label>¿Qué te pareció tu producto?</label>
                                <form method="POST" id="formularioValorOpinion">
                                    @csrf
                                    <input type="hidden" name="valorOpinion" id="valorOpinion">
                                    <div class="faces">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="submit" class="no-class" formaction="{{ route('calificarProducto', ['id_pro' => $producto->id_pro, 'calificacion' => $i]) }}">
                                                <div class="face face-{{ $i }}"></div>
                                            </button>
                                        @endfor
                                    </div>
                                </form>
                            </div>
                        @else
                            <p>Ya has calificado este producto con {{ $calificacion }} estrellas.</p>
                        @endif
                    </div>
                    
                    <div class="right-section">
                        <div class="purchase-summary">
                            <h3>Detalle de la compra</h3>
                            <p>{{ $primeraCompra->created_at }} | Factura #{{ $primeraCompra->facturacion->numero_factura }}</p>
                            <div class="summary-item">
                                <span>Cantidad: {{ $primeraCompra->cantidad }}</span>
                                <span>${{ number_format($producto->precio, 2) }}</span>
                            </div>
                            <div class="summary-item">
                                <span>Descuento</span>
                                <span class="discount">-$0.00</span>
                            </div>
                            <div class="summary-item">
                                <span>Envío</span>
                                <span>$0.00</span>
                            </div>
                            <div class="total">
                                <span>Total</span>
                                <span>${{ number_format($primeraCompra->cantidad * $producto->precio, 2) }}</span>
                            </div>
                            <p class="payment-method">Visa Débito **** 3322</p>
                            <p>Datos sujetos a la primera compra realizada de este producto</p>
                        </div>
                    </div>
                    
                    
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
