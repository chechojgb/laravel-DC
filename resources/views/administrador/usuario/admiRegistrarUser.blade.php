<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <!-- /# row -->
                <section id="main-content">
    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="border: 1px solid #c96691; border-radius: 2%;">
                                <div class="card-title">
                                    <h1 style="font-family: 'Teko', sans-serif;">REGISTRAR USUARIOS-ADMINISTRADOR<h1>
                                            <h4>Completa los campos para crear una cuenta de usuario</h4>
    
                                </div>
                                <div class="card-body">
                                    <form  method="POST" enctype="multipart/form-data" id="formularioRegistroAdmin">
                                        @csrf
                                        <div class="row">
                                            
                                                <div class="form-group col-md-6">
                                                    <label>Documento</label>
                                                    <input type="number" class="form-control" placeholder="Ej:102758694" name="documento">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" placeholder="Ej:Jonh" name="nombres">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Apellidos</label>
                                                    <input type="text" class="form-control" placeholder="Ej:Giglioli" name="apellidos">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Ej:carolahindiaz@gmail.com">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Estado</label>
                                                    <select name="estado"  class="form-control">
                               
                                                        <option value="Activo">Activo</option>
                                                        <option value="Pendiente">Pendiente</option>
                                                        <option value="Bloqueado">Bloqueado</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Rol</label>
                                                    <select name="rol"  class="form-control">
   
                                                        <option value="Cliente">Cliente</option>
                                                        <option value="Proveedor">Proveedor</option>
                                                        <option value="Administrador">Administrador</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="archivo">Adjuntar Archivo: </label>
                                                    <input type="file" class="form-control" name="foto" id="foto" accept=".png,.jpg">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Telefono</label>
                                                    <input type="number" class="form-control" name="telefono" placeholder="Ej:3209925728">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Contraseña</label>
                                                    <input type="password" class="form-control" placeholder="Ej:102758694" name="password">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Confirmar contraseña</label>
                                                    <input type="password" class="form-control" placeholder="Ej:102758694" name="password_confirmation">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"
                                                    style="background: #c96691; color: #fff; margin-left: 45%; height:50px; font-size: 17px;">Crear
                                                    nuevo usuario</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>

    
    
    




    <script src="{{ asset('js/sesion/admin.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/preloader/pace.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/bootstrap.min.js') }}"></script>

    <script src="{{ asset('animacion-inicio/dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/calendar-2/pignose.init.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/dashboard/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>

    <script src="{{ asset('animacion-inicio/dashboard/js/dashboard2.js') }}"></script>
</body>
</html>