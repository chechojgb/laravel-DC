<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Logueo DeCroche</title>
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
    <div class="wrapper">
    

        <div class="content-principal">
            <x-header />
            <div class="unix-login" style="margin-top: 55px;">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="login-content">
                                <div class="login-logo">
                                    <a href="../../index.php"><span><img src="{{ asset('animacion-inicio/client-side/images/decrochea.png') }}"  ></span></a>
                                </div>
                                <div class="login-form" style="position: relative" >
                                    <h4>Iniciar sesión</h4>
                                    <form action="{{ route('inicio.sesion') }}" method="POST" id="formularioLogueo">
                                        @csrf
                                        <div class="form-group">
                                            <label >Email:</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" id="correoLogueo">
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña:</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" id="contraseñaLogueo">
                                        </div>
                                        <div class="form-group-checkbox">
                                            <div class="checkbox-login">
                                                <label>
                                                    <input type="checkbox" name="remember"> Recuérdame
                                                </label>
                                            </div>
                                        </div>

                                        
                                        <div class="checkbox">
                                            
                                            <label class="pull-right">
                                                <a href="page-reset-password.html">Olvidaste tu contraseña?</a>
                                            </label>
        
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="btnIniciarSesion" >Iniciar sesión</button>
                                        <p class="btn" style="margin: 0" >OR</p>
                                        <a class=" google-btn btn" href="/google-auth/redirect">
                                            
                                            <svg width="20" height="20" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>

                                            ㅤContinuar con Google
                                            
                                        </a>
        
                                        <br>
                                        <div class="register-link m-t-15 text-center">
                                            <p>No tienes una cuenta ? <a href="/registro"> Registrate</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('footer')
    </div>


    <script src="{{ asset('js/sesion/sesiones.js') }}"></script>
    
</body>
</html>