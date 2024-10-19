<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios</title>
    

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    
    
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/weather-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/menubar/sidebar.css') }}">


    
    
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/helper.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
</head>
<body>

    @include('vendedor.menu')


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hola, <span>Bienvenido al exportador de archivos de datos de compras</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="background: #e08eb1;" class="center-div-bar">
                                                    <th style="color:#fff;">num_factura</th>
                                                    <th style="color:#fff;">Nombre de usuario</th>
                                                    <th style="color:#fff;">Fecha</th>
                                                    <th style="color:#fff;">Direccion</th>
                                                    <th style="color:#fff;">Correo</th>
                                                    <th style="color:#fff;">Número de celular</th>
                                                    <th style="color:#fff;">Ciudad</th>
                                                    <th style="color:#fff;">Productos</th>
                                                    <th style="color:#fff; text-align:center;">Descargar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                @foreach ($facturacion as $factura)
                                                    @php
                                                        // Obtén los datos del usuario relacionado con la factura
                                                        $usuario = $factura->usuario;
                                                        $envio = null;

                                                        // Si se encontró el usuario, busca los detalles de envío relacionados
                                                        if ($usuario) {
                                                            $envio = $envios->firstWhere('user_id', $usuario->id);
                                                        }

                                                        // Definición de variables para la tabla
                                                        $nombres = $usuario ? $usuario->detUsu->nombres : 'Datos de usuario no encontrados';
                                                        $direccion = $envio ? $envio->direccion : 'Dirección no disponible';
                                                        $telefono = $envio ? $envio->telefono : 'Teléfono no disponible';
                                                        $ciudad = $envio ? $envio->ciudad : 'Ciudad no disponible';
                                                        $email = $usuario ? $usuario->email : 'Email no disponible';
                                                    @endphp
                                                    <tr class="center-div-bar">
                                                        <td style="color: #000;">{{$factura->numero_factura}}</td>
                                                        <td style="color: #000;">{{$nombres}}</td>
                                                        <td style="color: #000;">{{$factura->created_at}}</td>
                                                        <td style="color: #000;">{{$direccion}}</td>
                                                        <td style="color: #000;">{{$email}}</td>
                                                        <td style="color: #000;">{{$telefono}}</td>
                                                        <td style="color: #000; text-align:center">{{$ciudad}}</td>
                                                        <td style="color: #000;">
                                                            @if($factura->detFacturas->isEmpty())
                                                                <p style="color: red">No se encontraron los productos de la factura en la bd.</p>
                                                            @else
                                                                @foreach ($factura->detFacturas as $detFactura)
                                                                    @php
                                                                        $detProducto = $detFactura->producto->nombre ?? null; // Usamos el operador de fusión nula
                                                                        $detCantidad = $detFactura->cantidad;
                                                        
                                                                        // Si $detProducto es null, asignamos el mensaje "No se encontró el producto"
                                                                        $producto = $detProducto ? $detProducto : 'No se encontró el producto';
                                                                    @endphp
                                                                    Producto: {{ $producto }}, Cantidad: {{ $detCantidad }}<br>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        
                                                        
                                                        <td style="color: #fff; text-align: center;">
                                                            <button class="btn btn-info">
                                                                <a href="{{ Storage::url('Facturas/DeCroche' . $factura->numero_factura . '.pdf') }}" style="color:#fff;" target="_blank">Ver factura</a>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach



                                                

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->


                </section>
            </div>
        </div>
    </div>
    
    
    





    <script src="{{ asset('animacion-inicio/dashboard/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/scripts.js') }}"></script>


    <script src="{{ asset('animacion-inicio/dashboard/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/jquery.nanoscroller.min.js') }}"></script>

    <script src="{{ asset('animacion-inicio/dashboard/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/preloader/pace.min.js') }}"></script>



    <script src="{{ asset('animacion-inicio/dashboard/js/lib/bootstrap.min.js') }}"></script>


    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/data-table/datatables-init.js') }}"></script>
</body>
</html>