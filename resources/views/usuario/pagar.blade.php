

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


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

        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/client-side/css/pago.css') }} ">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://sdk.mercadopago.com/js/v2"></script>


    </head>
    <body class="antialiased">
        <x-header />


        <div class="wrapper">
            <div class="content-principal">

        
                <div class="jumbotron text-center" style="margin-top: 150px;" >
                    <h1 class="display-4">¡Paso final!</h1>
                    <hr class="my-4">
                    <p class="lead">Estás a punto de pagar la cantidad de:
                        <h4 style="font-size: 30px;">{{ number_format($total) }}</h4>
                    </p>
                    <div class="paypals">
                        <div id="paypal-button-container"></div>
                        <p id="result-message"></p>
                    </div>
                    <p style="color:#4b4b4b; font-size: 1em;">Los productos podrán ser descargados una vez que se procese el pago
                        <strong>(Para aclaraciones: decrochesoporte@gmail.com)</strong>
                    </p>
                </div>
                <div class="containerr mt-5 text-center">
                    <h1 class="mb-4 text-center">Formas de pagar</h1>
                    <div id="wallet_container"></div>
                </div>

                

            </div>
        </div>
    
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Obtén la clave pública de Mercado Pago desde la configuración
                const publicKey = "{{ config('mercadopago.public_key') }}";
    
                if (publicKey) {
                    const mp = new MercadoPago(publicKey, {
                        locale: 'es-CO'
                    });
    
                    fetch("{{ route('get.payment.preference') }}")
                        .then(response => response.json())
                        .then(data => {
                            if (data.id) {
                                mp.bricks().create("wallet", "wallet_container", {
                                    initialization: {
                                        preferenceId: data.id
                                    },
                                    customization: {
                                        texts: {
                                            valueProp: 'smart_option'
                                        }
                                    },
                                    locale: 'es',
                                    modal: true
                                });
                            } else {
                                document.getElementById('result-message').textContent = 'No se pudo obtener la preferencia de pago.';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('result-message').textContent = 'Error al procesar el pago.';
                        });
                } else {
                    document.getElementById('result-message').textContent = 'No se pudo obtener la clave pública.';
                }
            });
        </script>


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
