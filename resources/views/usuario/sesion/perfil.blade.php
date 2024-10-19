<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Decroche</title>


  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link rel='stylesheet' href='https://dl.dropboxusercontent.com/u/69747888/MoGo%20carousel/font-awesome.min.css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700'>


  <link rel="stylesheet" href="{{ asset('animacion-inicio/presentacion/dist/style.css') }}">
  <link rel="stylesheet" href="{{ asset('animacion-inicio/cartas/dist/style.css') }}">
  <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">


  <link rel="stylesheet" href="{{asset('animacion-inicio/profile/style.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <style>
    button {
      all: unset;
    }

    .submit {
      background-color: #e08eb1;
      color: #fff;
      border-color: #df7ba6;
      display: inline-block;
      text-align: center;
      float: left;
      border-radius: 0;
      padding: 7px;
      transition: 0.5s;
    }

    .submit:hover {
      background-color: #dd7ba5;
    }
  </style>

</head>

<body class="antialiased">


  <div class="wrapper">
    <div class="content-principal">


      @auth


      <div class="container">
        <a href="{{route('perfilRol')}}" style="display:flex; justify-content:center"><img
            src="{{ asset('animacion-inicio/client-side/images/decrocher.png') }}" style="height: 75px;"></a>
        <form method="POST" id="actualizarPerfil">
          <div class="row">
            <h4>Detalles de cuenta</h4>
            <div class="input-group input-group-icon">
              <input type="text" placeholder="Tu nombre" value="{{ Auth::user()->Detusu->nombres }}" name="nombres">
              <div class="input-icon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input-group input-group-icon">
              <input type="text" placeholder="Tu apellido" value="{{ Auth::user()->Detusu->apellidos }}" name="apellidos">
              <div class="input-icon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input-group input-group-icon">
              <input type="email" placeholder="Correo" value="{{ Auth::user()->email }}" name="email">
              <div class="input-icon"><i class="fa fa-envelope"></i></div>
            </div>

            


          </div>

          <div class="row">
            <button class="submit">Guardar datos</button>


          </div>

        </form>
      </div>

      <div class="container" style="margin-top:30px">
        <form method="POST" id="cambiarClave">
          @csrf
          <div class="row">
            <h4>Cambiar clave</h4>

          </div>
          <div class="col-half">
            <div class="input-group input-group-icon">
              <input type="password" name="clave_actual"  placeholder="clave actual" />
              <div class="input-icon"><i class="fa fa-key"></i></div>
            </div>
          </div>
          <div class="col-half">
            <div class="input-group input-group-icon">
              <input type="password" name="nueva_clave" placeholder="nueva clave" />
              <div class="input-icon"><i class="fa fa-key"></i></div>
            </div>
          </div>

          <div class="row">
            <button class="submit">Guardar datos</button>


          </div>
        </form>
      </div>

      
      <div class="container" style="margin-top:30px">
        <form   method="POST" id="registrarDireccion">
          
          @csrf
          <div class="row">
            <h4>Detalles de envio</h4>
            <div class="input-group input-group-icon">
              <input type="text" placeholder="Ciudad" name="ciudad" value="{{ Auth::user()->detEnvios->ciudad ?? '' }}"/>
              <div class="input-icon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input-group input-group-icon">
              <input type="text" placeholder="Barrio" name="barrio" value="{{ Auth::user()->detEnvios->barrio ?? ''}}">
              <div class="input-icon"><i class="fa fa-paper-plane-o"></i></div>
            </div>
            <div class="input-group input-group-icon">
              <input type="text" placeholder="Direccion" name="direccionEntrega" value="{{ Auth::user()->detEnvios->direccion ?? '' }}">
              <div class="input-icon"><i class="fa fa-map-marker"></i></div>
            </div>
            <div class="input-group input-group-icon">
              <input type="number" placeholder="Telefono" name="telefono" value="{{ Auth::user()->detEnvios->telefono ?? ''}}"/>
              <div class="input-icon"><i class="fa fa-phone"></i></div>
            </div>
          </div>

          <div class="row">
            <button class="submit">Guardar datos</button>
          </div>
        </form>
      </div>    
      @endauth
      
    </div>
  </div>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src='https://use.fontawesome.com/8ae46bccf5.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js'></script>

  <script src="{{ asset('js/sesion/sesiones.js') }}"></script>

  <script src="{{asset('animacion-inicio/profile/script.js')}}"></script>
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