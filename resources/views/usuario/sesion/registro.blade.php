<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro DeCroche</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'><link rel='stylesheet' href='https://dl.dropboxusercontent.com/u/69747888/MoGo%20carousel/font-awesome.min.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700'>

    <link rel="stylesheet" href="{{ asset('animacion-inicio/client-side/css/style.cs') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    

    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">
    



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-primary">
    <x-header />
    
    <div class="wrapper">
        <div class="content-principal">
            <div class="unix-login" style="margin-top: 55px;">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="login-content">
                                <div class="login-logo">
                                    <a href="/"><span><img src="{{ asset('animacion-inicio/client-side/images/decrochea.png') }}"  style=" object-fit: cover;"></span></a>
                                </div>
                                <div class="contenedor">
                                    <input type="checkbox" id="register">
        
                                    <div class="tarjetas">
                                        <div class="login-form cliente" style="width: 100%">
                                            <div class="titulo" id="tituloCliente">
                                                <button class="btn btn-primary btn-flat m-b-30 m-t-30 boton"><label for="register">Registro para vendedor</label></button>
                                                <button class="btn btn-primary btn-flat m-b-30 m-t-30 boton"><label>Registro para cliente</label> </button>
                                            </div>

                                            <form action="{{ route('validar.registro.usu') }}" method="POST" id="formularioRegistro">
                                                @csrf
                                                <h4>Registro de cliente</h4>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-6">   
                                                        <label>Documento</label>
                                                        <input type="number" class="form-control" placeholder="Ej:102758694" name="documento"> 
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <label>Nombres</label>
                                                        <input type="text" class="form-control" placeholder="Ej:Jonh" name="nombres" id="nombres">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Apellidos</label>
                                                        <input type="text" class="form-control" placeholder="Ej:Giglioli" name="apellidos" id="apellidos">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Ej:carolahindiaz@gmail.com" id="email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Clave</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Ej:****" id="clave">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Confirmar clave</label>
                                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Ej:****" id="cpassword">
                                                    </div>
                                                    <!-- <div class="form-group col-md-6"">
                                                        <label>Rol</label>
                                                        <select name="rol" id="rol" class="form-control">
                                                            <option>Seleccione una opcion</option>
                                                            <option value="Cliente">Cliente</option>
                                                        </select>
                                                    </div> -->
                                                    <!-- <div class="form-group col-md-6"">
                                                        <label>Estado</label>
                                                        <input type="text" class="form-control" name="" placeholder="Ej:activo">
                                                    </div> -->
                                                    {{-- <div class="form-group col-md-6"">
                                                        <label>Telefono</label>
                                                        <input type="number" class="form-control" name="telefono"   placeholder="Ej:3209925728" id="telefono">
                                                    </div> --}}
                                                    <button type="submit"  class="btn btn-primary btn-flat m-b-30 m-t-30">Registrar</button>
                                                    <p class="btn" style="margin: 0" >OR</p>
                                                    <a class=" google-btn btn" href="/google-auth/redirect">
                                                        
                                                        <svg width="20" height="20" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>

                                                        ㅤContinuar con Google
                                                    </a>

                                                    <div class="register-link m-t-15 text-center" style="margin: auto; margin-top:20px" >
                                                        <p>Ya tienes cuenta? <a href="/logueo"> Ingresa</a></p>
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="login-form vendedor" >
                                            <div class="titulo" id="tituloCliente">
                                                <button class="btn btn-primary btn-flat m-b-30 m-t-30 boton"><label>Registro para vendedor</label></button>
                                                <button class="btn btn-primary btn-flat m-b-30 m-t-30 boton" form="register"><label for="register">Registro para cliente</label> </button>
                                            </div>
                                            <form action="../../Controllers/registroVendedor.php" method="POST" id="formularioRegistroVendedor" >
                                            <h4>Registro de vendedor</h4>
                                            <div class="row">
                                                <div class="form-group col-md-6">   
                                                    <label>Documento</label>
                                                    <input type="number" class="form-control" placeholder="Ej:102758694" name="documentoVendedor" id="documentoVendedor"> 
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" placeholder="Ej:Jonh" name="nombresVendedor" id="nombresVendedor">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Apellidos</label>
                                                    <input type="text" class="form-control" placeholder="Ej:Giglioli" name="apellidosVendedor" id="apellidosVendedor">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="emailVendedor" placeholder="Ej:carolahindiaz@gmail.com"
                                                    id="emailVendedor">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Clave</label>
                                                    <input type="password" class="form-control" name="claveVendedor"  placeholder="Ej:****" id="claveVendedor">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Confirmar clave</label>
                                                    <input type="password" class="form-control" name="cclaveVendedor"   placeholder="Ej:****" id="cclaveVendedor">
                                                </div>
                                                <!-- <div class="form-group col-md-6"">
                                                    <label>Rol</label>
                                                    <select name="rol" id="rol" class="form-control">
                                                        <option>Seleccione una opcion</option>
                                                        <option value="Cliente">Cliente</option>
                                                    </select>
                                                </div> -->
                                                <!-- <div class="form-group col-md-6"">
                                                    <label>Estado</label>
                                                    <input type="text" class="form-control" name="" placeholder="Ej:activo">
                                                </div> -->
                                                <div class="form-group col-md-6">
                                                    <label>Telefono</label>
                                                    <input type="number" class="form-control" name="telefonoVendedor"   placeholder="Ej:3209925728" id="telefonoVendedor">
                                                </div>
                                                <button type="button" href="page-login.php" class="btn btn-primary btn-flat m-b-30 m-t-30" onclick="registroVendedor()"">Registrar</button>
                                                
                                                <div class="register-link m-t-15 text-center" style="margin: auto;" >
                                                    <p>Ya tienes cuenta? <a href="/logueo"> Ingresa</a></p>
                                                </div>
                                            </form>
                                        </div>
        
                                    </div>
                                    
                                </div>
                                
                                        
                                
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    
    <script src="{{ asset('js/sesion/sesiones.js') }}"></script>
    
</body>
</html>