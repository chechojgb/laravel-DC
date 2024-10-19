<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios {{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/formularios/dist/style.css')}}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <x-header />

    <div class="wrapper">
        <div class="content-principal">
            <div class="contenedor-formulario" style="margin-top: 150px;" >

                <main class="contenedor-formulario-content">
              
              
                  <section class="section-principal-formulario">
                    <h1>
                      {{$title}}
                    </h1>
                    <p>
                      Solicita información o asistencia sobre nuestros productos y servicios. Estamos aquí para responder a tus preguntas y ofrecerte el soporte que necesites.
                    </p>
              
                    
                    <form  method="post" id="envioPeticion" enctype="multipart/form-data">
                      @csrf
                      <div class="seccion-formulario">
                        <label>Nombre</label>
                        <input type="text" placeholder="Tu nombre" class="icon-left" name="nombre" id="nombre"/>
                      </div>
              
                      <div class="seccion-formulario">
                        <label>Correo electronico</label>
                        <input type="email" placeholder="dasdas@hotmail.com"  class="icon-left" name="email" id="email" />
                      </div>
              
                      <legend>Detalles de la Petición</legend>
              
                      <div class="seccion-formulario">
                        <label>Motivo</label>
                        <select class=""  name="motivo" required id="motivo">
                          <option value="" disabled selected>Seleccionar</option>
                          <option value="producto">Producto</option>
                          <option value="envio">Envío</option>
                          <option value="cuenta">Cuenta</option>
                        </select>
                      </div>
              
                      <div class="seccion-formulario">
                        <label for="descripcion">Descripción o Comentarios: </label>
                        <textarea  name="detalle" placeholder="Proporcione detalles adicionales..." rows="4" style="height: 100px;" id="detalle" ></textarea>
                      </div>
              
                      <div class="seccion-formulario">
                        <label for="archivo">Adjuntar Archivo: </label>
                        <input type="file" class="form-control" name="foto" id="foto" accept=".png,.jpg">
                      </div>

                      <div style="display: none">
                        <label for="servicio" >Tipo de servicio</label>
                        <input type="text" class="form-control" name="tipo_servicio" id="foto" accept=".png,.jpg" value="{{$title}}">
                      </div>
              
                      <div class="enviar_radicadop" style="margin: 25px 10px; ">
                        <button type="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" >Enviar {{$title}}</button>
                      </div>
              
                    </form>
                    
              
              
              
                  </section>
              
                </main>
            </div>
        </div>
    </div>
    

    @include('footer')



    <script src="{{ asset('js/sesion/consultas.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>

</body>
</html>