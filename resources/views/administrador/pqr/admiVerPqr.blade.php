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
                            <div class="card">
                                <div class="card-title">
                                    <h1 style="font-family: 'Teko', sans-serif;">Ver radicados<h1>
                                            <h4>Selecciona la acción que deseas realizar con la información de cada
                                                radicado (responder)</h4>
                                            <br><br><br>
                                </div>
                                <div class="card-body">
                                    <div class="basic-elements">
                                        <div class="table-responsive" id="scrollHere">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="background: #e08eb1;" class="center-div-bar">
                                                        <th style="color: #fff;">Numero de servicio</th>
                                                        <th style="color: #fff;">Nombre usuario</th>
                                                        <th style="color: #fff;">Email</th>
                                                        <th style="color: #fff;">Detalle</th>
                                                        <th style="color: #fff;">Estado</th>
                                                        <th style="color: #fff;">Fecha</th>
                                                        <th style="color: #fff;">Tipo de pqr</th>
                                                        <th style="color: #fff; text-align:center;"></i>Contestar</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @foreach ($peticiones as $peticion)
                                                    @php
                                                        $estado = $peticion->estado == "Contestada" 
                                                            ? 'background-color: #4caf5057; color: #fff; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;' 
                                                            : 'background-color: #e79c96; color: #000; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;';
                                                    @endphp
                                                    
                                                    <tr class="center-div-bar">
                                                        
                    
                                                        <td style="color: #000;">{{$peticion->num_servicio}}</td>
                                                        <td style="color: #000;">{{$peticion->nombre}}</td>
                                                        <td style="color: #000;">{{$peticion->email}}</td>
                                                        <td style="color: #000;">{{$peticion->detalle}}</td>
                                                        <td  ><p   style="{{$estado}}">{{$peticion->estado}}</p></td>
                                                        <td style="color: #000;">{{$peticion->created_at}}</td>
                                                        <td style="color: #000;">{{$peticion->tipo_servicio}}</td>
                                                        <td style="color: #000;text-align: center;"><button onclick="editarPqr({{$peticion->id_servicios}});scrollToEnd()" class="btn btn-info">CONTESTAR</button></td>
       
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>


        <div id="formularioEdicion">
            <form id="form_editar_servicios" method="post" action="{{ route('actualizar_pqr') }}">
                @csrf
                <table class="table table-bordered table-hover form-edit" style="border: 8px solid #dee2e6;">
                    <thead style="display: none;">
                        <tr>
                            <th colspan="2">Editar PQR <span id="nombreUsuario"></span></th>
                        </tr>
                    </thead>
                    <tbody class="form-edit">
                        <tr>
                            <h2 colspan="2" style="text-align: center; margin: 30px 0 50px;">Editar PQR Número <span id="numeroPqr"></span></h2>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" id="idPqr" name="idPqr">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="num_servicio">Número de servicio:</label></td>
                            <td><input type="text" id="num_servicio" name="num_servicio" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="text" id="email" name="email" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="motivo">Motivo:</label></td>
                            <td><input type="text" id="motivo" name="motivo" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="detalle">Detalles de PQR:</label></td>
                            <td><input type="text" id="detalle" name="detalle" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="respuesta">Respuesta:</label></td>
                            <td><textarea id="respuesta" name="respuesta" placeholder="Proporcione detalles adicionales..." rows="4" style="height: 100px; width: 100%"></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="estado">Estado:</label></td>
                            <td>
                                <select name="estado" id="estado" style="width: -webkit-fill-available; padding: 10px;">
                                    <option value="Sin contestar">Sin contestar</option>
                                    <option value="Contestada">Contestada</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" style="margin: 30px 45%; height: 50px; font-size: 17px;" class="btn btn-pink">Guardar Cambios</button>
            </form>
        </div>
        




        </section>

    </div>
    </div>
    </div>


    <script>

            document.getElementById('form_editar_servicios').addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Evita el comportamiento predeterminado si hay algún conflicto
                    this.submit();
                }
            });
        function editarPqr(id) {
            fetch(`/peticion/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Verifica la respuesta del servidor
                    console.log(data);

                    if (data.error) {
                        // Maneja el error en caso de que el usuario no se encuentre
                        alert(data.error);
                        return;
                    }

                    // Asigna los valores a los campos del formulario
                    document.getElementById('formularioEdicion').style.display = 'block';
                    document.getElementById('numeroPqr').innerText = data.num_servicio;
                    document.getElementById('idPqr').value = data.id_servicios;
                    document.getElementById('num_servicio').value = data.num_servicio;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('email').value = data.email;
                    document.getElementById('motivo').value = data.motivo;
                    document.getElementById('detalle').value = data.detalle; 
                    document.getElementById('estado').value = data.estado; 
                    document.getElementById('respuesta').value = data.respuesta; 
                })
                .catch(error => console.error('Error al obtener producto por ID:', error));
        }
        
        function scrollToEnd() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    </script>


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