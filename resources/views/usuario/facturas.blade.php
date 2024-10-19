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
        
        <link rel="stylesheet" href="{{ asset('animacion-inicio/facturas/dist/style.css') }} ">

        


    </head>
    <body class="antialiased">
        <x-header />
        

        

        <div class="wrapper">
            <div class="content-principal" >
                <h1 style="margin-top: 140px;" >Historial de compras</h1>
                <div  class="factura_individual_usu">
                    @foreach ($facturas as $factura)
                        @auth
                            @php
                            
                            $detEnvio = Auth::user()->detEnvios;  
                            @endphp
                            
                        
                            
                                <div id="invoice-POS">
                                    <center id="top">
                                        <div class="logo"></div>
                                        <div class="info"> 
                                            <h2>Factura N-{{$factura->numero_factura}}</h2>
                                        </div><!--End Info-->
                                    </center><!--End InvoiceTop-->
                                    
                                    <div id="mid">
                                        <div class="info">
                                            <h2>Información de factura</h2>
                                            <p> 
                                                Dirección: {{$detEnvio->direccion}}<br><br>
                                                Ciudad: {{$detEnvio->ciudad}}<br><br>
                                                Email: {{$detEnvio->email}}<br><br>
                                                Celular: {{$detEnvio->telefono}}<br><br>
                                                nombre: {{Auth::user()->detUsu->nombres}} <br>
                                                *La información de dirección, ciudad, celular y nombre es editable por el usuario y puede cambiar.
                                            </p>
                                        </div>
                                    </div><!--End Invoice Mid-->
                                    
                                    <div id="bot">
                                        <div id="table">
                                            <table>
                                                <tr class="tabletitle">
                                                    <td class="item"><h2 style="font-size: 10px">Prod</h2></td>
                                                    <td class="Hours">   <h2 style="font-size: 10px">Cant</h2></td>
                                                    <td class="Rate"><h2 style="font-size: 10px">Sub Total</h2></td>
                                                </tr>

                            
                                        
                                                @php
                                                    $total = 0;
                                                @endphp

                                                
                                                    @foreach ($factura->detFacturas as $detalle)
                                                        @php
                                                            
                                                            $subtotal = $detalle->cantidad * $detalle->producto->precio;
                                                            $total += $subtotal;
                                                        @endphp

                                                        <tr class="service">
                                                            <td class="tableitem"><p class="itemtext" style="font-size: 13px;">{{ $detalle->producto->nombre }}</p></td>
                                                            <td class="tableitem" ><p class="itemtext" style="font-size: 13px">{{ $detalle->cantidad }}</p></td>
                                                            <td class="tableitem" ><p class="itemtext" style="font-size: 13px">${{ number_format($subtotal, 2) }}</p></td>
                                                        </tr>
                                                    @endforeach
                                                

                                            
                            

                            

                                                <tr class="tabletitle">
                                                    <td></td>
                                                    <td class="Rate"><h2>Total</h2></td>
                                                    <td class="payment"><h2>${{ number_format($total, 2) }}</h2></td>
                                                </tr>
                                            </table>
                                        </div><!--End Table-->

                                        <button style="margin: 10px auto; padding: 6px;"><a href="{{ Storage::url('Facturas/DeCroche' . $factura->numero_factura . '.pdf') }}"  target="_blank">Descargar factura</a></button>
                                        
                                        <div id="legalcopy">
                                            <p class="legal">Gracias por comprar con DeCroche te esperamos en la siguente compra</p>
                                        </div>
                                    </div>
                                </div>
                        
                    
                            
                        @endauth
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
