<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Consulta - PQR</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/contacto/dist/style.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/pqr/dist/style.css')}}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/formularios/dist/style.css')}}">
    
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('animacion-inicio/buscar_pqr/dist/style.css')}}">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <x-header />
    
    <p class="titulo_consulta">Consulta tu PQR</p>
    <form id="busqueda_form" class="busqueda_form" method="POST">
        @csrf
        <input type="text" class="busqueda" id="id_consulta" name="num_servicio">
        <button type="submit" id="enviarConsulta">
            <i class="fa fa-search icono_busqueda"></i>
        </button>
    </form>

    <div class="contenedor-formulario" style="margin-top: 400px; display:none;" id="consulta_peticion">
        <main class="contenedor-formulario-content">
            <section class="section-principal-formulario">
                <h1>Tipo : <span id="tipo_servicio"></span></h1>
                <p>Aqui se muestra toda la información de tu <span id="tipo_titulo"></span> hecha el día <span id="fecha"></span></p>

                <div class="seccion-formulario">
                    <label>Estado</label>
                    <input type="text" placeholder="Tu nombre" class="icon-left" name="estado" id="estado" readonly/>
                </div>

                <div class="seccion-formulario">
                    <label>Nombre</label>
                    <input type="text" placeholder="Tu nombre" class="icon-left" name="nombre" id="nombre" readonly/>
                </div>

                <div class="seccion-formulario">
                    <label>Correo electrónico</label>
                    <input type="email" placeholder="dasdas@hotmail.com" class="icon-left" name="email" id="email" readonly/>
                </div>

                <legend>Detalles de la <span id="tipo"></span></legend>

                <div class="seccion-formulario">
                    <label>Motivo</label>
                    <input type="text" id="motivo" name="motivo" readonly>
                </div>

                <div class="seccion-formulario">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="detalles" placeholder="Proporcione detalles adicionales..." rows="2" style="height: 100%;" id="detalles" readonly></textarea>
                </div>

                <div class="seccion-formulario">
                    <label for="descripcion">Respuesta:</label>
                    <textarea name="respuesta" rows="4" style="height: 100%;" id="respuesta" readonly></textarea>
                </div>
            </section>
        </main>
    </div>

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>
    <script src="{{ asset('js/sesion/consultas.js') }}"></script>
</body>
</html>

