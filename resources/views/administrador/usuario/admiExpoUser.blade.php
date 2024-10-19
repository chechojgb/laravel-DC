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

    @include('administrador.menu')
    

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hola, <span>Bienvenido al exportador de archivos de datos de usuarios</span></h1>
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
                                                    <th style="color:#fff;" >rol</th>
                                                    <th style="color:#fff;">Nombres</th>
                                                    <th style="color:#fff;">apellidos</th>
                                                    <th style="color:#fff;">Email</th>
                                                    <th style="color:#fff;">Teléfono</th>
                                                    <th style="color:#fff; text-align:center;">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($usuarios as $usuario)
                                                    <tr class="center-div-bar">
                                                        <td style="color: #000;">{{$usuario->detUsu->rol}}</td>
                                                        <td style="color: #000;">{{$usuario->detUsu->nombres}}</td>
                                                        <td style="color: #000;">{{$usuario->detUsu->apellidos}}</td>
                                                        <td style="color: #000;">{{$usuario->email}}</td>
                                                        <td style="color: #000;">{{$usuario->detUsu->telefono}}</td>
                                                        <td style="color: #000; text-align:center">{{$usuario->detUsu->estado}}</td>
                                                        
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