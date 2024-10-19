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


        <link rel="stylesheet" href="{{ asset('animacion-inicio/presentacion/dist/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/cartas/dist/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">

        <link rel="stylesheet" href="{{ asset('animacion-inicio/client-side/css/style.cs') }} ">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        


    </head>
    <body class="antialiased">
        <x-header />


        <div class="wrapper">
            <div class="content-principal">

                <div class="contenedor-principal" >
                    <div class="container-fluid  tabla"  >
                        <div class="container py-5"  >
        
        
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio unitario</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Eliminar producto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @auth
                                            @if($carritos->isEmpty())
                                                    <div class='alert alert-success' role='alert'> No hay productos en el carrito.</div>
                                            @else
                                                @foreach ($carritos as $carrito)
                                                @php
                                                    $subtotal = $carrito->cantidad * $carrito->producto->precio
        
                                                @endphp
                                                <td>
                                                <p class="mb-0 mt-4">{{$carrito->producto->nombre}}</p>
                                                </td>
                                                <td>
                                                    <p class=" mb-0 mt-4">{{number_format($carrito->producto->precio)}}</p>
                                                </td>
                                                <td>
                                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <form action="{{ route('restarCarrito', ['id' => $carrito->id ])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id_pro" value="' . openssl_encrypt($producto['id_pro'], COD, KEY) . '">
                                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" name="accion" value="restar" type="submit">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </form>
                                                
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm text-center border-0" value="{{$carrito->cantidad}}" readonly
                                                        style="margin-bottom: 10px;">
                                                    <div class="input-group-btn">
                                                        <form action="{{ route('sumarCarrito', ['id' => $carrito->id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id_pro" value="' . openssl_encrypt($producto['id_pro'], COD, KEY) . '">
                                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" name="accion" value="sumar" type="submit">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="totalProducto">
                                                    <p class="mb-0 mt-4">{{number_format($subtotal)}}</p>
                                                </td>
                                                <td>
                                                    <form action="{{ route('eliminarCarrito', ['id' => $carrito->id ])}}" method="post">
                                                        @csrf
                                                    <input type="hidden" name="id_pro" value="' . openssl_encrypt($producto['id_pro'], COD, KEY) . '">
                                                    <button class="btn btn-md rounded-circle bg-light border mt-4" name="accion" value="eliminar" type="submit"><i
                                                        class="fa fa-times text-danger"></i></button>
                                                    </form>
                                                </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            
                                        @else
                                            @if(empty($carritos))
                                                <div class='alert alert-success' role='alert'> No hay productos en el carrito.</div>
                                            @else
                                            @foreach ($carritos as $carrito)
                                            
                                                @php
                                                    // Obtener los datos del producto desde la sesión
                                                    $subtotal = $carrito['cantidad'] * $carrito['precio'];
                                                    
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <p class="mb-0 mt-4">{{ $carrito['nombre'] }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 mt-4">{{ number_format($carrito['precio']) }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                                            <div class="input-group-btn">
                                                                <form action="{{ route('restarCarrito', ['id' => $carrito['id'] ])}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id_pro" value="">
                                                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" name="accion" value="restar" type="submit">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </form>
                                                        
                                                            </div>
                                                            <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $carrito['cantidad'] }}" readonly
                                                                style="margin-bottom: 10px;">
                                                            <div class="input-group-btn">
                                                                <form action="{{ route('sumarCarrito', ['id' => $carrito['id'] ])}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id_pro" value="">
                                                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" name="accion" value="sumar" type="submit">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="totalProducto">
                                                        <p class="mb-0 mt-4">{{ number_format($subtotal) }}</p>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('eliminarCarrito', ['id' => $carrito['id'] ])}}" method="post">
                                                            @csrf
                                                            <button class="btn btn-md rounded-circle bg-light border mt-4" name="accion" value="eliminar" type="submit">
                                                                <i class="fa fa-times text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            
                                    
                                        @endauth
                                    
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                        
                    <div class="row g-4 tick">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4 ticket">
                          <div class="bg-light rounded total-factura">
                            <div class="p-4">
                              <h1 class="display-6 mb-4">Total <span class="fw-normal">carrito</span></h1>
                              <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">${{ number_format($total, 0, '', '.') }}</p>
                              </div>
                              <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Adicionales</h5>
                                <div class="">
                                  <p class="mb-0">Iva: $0.00</p>
                                </div>
                              </div>
                              <p class="mb-0 text-end">Envios a toda Colombia.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                              <h5 class="mb-0 ps-4 me-4">Total</h5>
                              <p class="mb-0 pe-4">{{ number_format($total, 0, '', '.') }}</p>
                            </div>
                      
                            <form id="formPago" action="../../Controllers/procesarCompra.php" method="post">
                                @csrf
                              <button id="btnPagar" name="accion" value="proceder" type="submit"
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="button">Proceder al pago</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    
                </div>

            </div>
        </div>
        


        @include('footer')
        
        <script src="{{ asset('js/sesion/consultas.js') }}"></script>

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
