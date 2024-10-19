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
                                    <h1 style="font-family: 'Teko', sans-serif;">GESTIONAR USUARIOS - ADMINISTRADOR<h1>
                                            <h4>Selecciona la acción que deseas realizar con la información de cada
                                                usuario (editar/eliminar)</h4>
                                            <br><br><br>
                                </div>
                                <div class="card-body">
                                    <div class="basic-elements">
                                        <div class="table-responsive" id="scrollHere">
                                            <table id="bootstrap-data-table-export"
                                                class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="background: #e08eb1;" class="center-div-bar">
                                                        <th style="color: #fff;">Foto</th>
                                                        <th style="color: #fff;">Rol</th>
                                                        <th style="color: #fff;">Nombres</th>
                                                        <th style="color: #fff;">Apellidos</th>
                                                        <th style="color: #fff;">Email</th>
                                                        <th style="color: #fff;">Teléfono</th>
                                                        <th style="color: #fff;">Estado</th>
                                                        <th onclick="scrollToEnd()" id="scrollHere"
                                                            style="text-align: center; color: #fff;"></i>Editar</th>
                                                        <th style="text-align: center; color: #fff;">Eliminar
    
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @foreach ($usuarios as $usuario)
                                                        @php
                                                            // Determinar el estilo basado en el estado del usuario
                                                            $estado = $usuario->detUsu->estado == "Activo" 
                                                                ? 'background-color: #4caf5057; color: #fff; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;' 
                                                                : 'background-color: #e79c96; color: #000; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;';
                                                            
                                                            // Determinar la URL de la imagen
                                                            $fotoUrl = $usuario->detUsu->foto;
                                                            if (strpos($fotoUrl, 'https://lh3') === 0) {
                                                                // URL de Google
                                                                $fotoUrl = $usuario->detUsu->foto;
                                                            } else {
                                                                // URL local
                                                                $fotoUrl = asset('storage/' . $usuario->detUsu->foto);
                                                            }
                                                        @endphp
                                                        
                                                        <tr class="center-div-bar">
                                                            <td><img src="{{ $fotoUrl }}" alt="Foto User" style="width:80px; height: 80px; object-fit: contain;"></td>
                                                            <td style="color: #000;">{{ $usuario->detUsu->rol }}</td>
                                                            <td style="color: #000;">{{ $usuario->detUsu->nombres }}</td>
                                                            <td style="color: #000;">{{ $usuario->detUsu->apellidos }}</td>
                                                            <td style="color: #000;">{{ $usuario->email }}</td>
                                                            <td style="color: #000;">{{ $usuario->detUsu->telefono }}</td>
                                                            <td style="color: #000;"><p style="{{ $estado }}">{{ $usuario->detUsu->estado }}</p></td>
                                                            <td style="color: #000; text-align: center;">
                                                                    <button onclick="editarUsuario('{{ $usuario->id }}'); scrollToEnd()" class="btn btn-info" style="display: ruby;">
                                                                        <i class="ti-pencil"></i><p style="margin: 0; color: #fff;">ㅤEDITAR</p>
                                                                    </button>
     
                                                            </td>
                                                            <td style="color: #000; text-align: center;">
                                                                <form action="{{ route('usario.destroy', ['id' => $usuario->id]) }}" method="POST" >
                                                                    @csrf
                                                                    <button type="submit" href="" class="btn btn-danger" style="display: ruby;;">
                                                                        <i class="ti-trash"></i><p style="margin: 0; color: #fff;">ㅤELIMINAR</p>
                                                                    </button>
                                                                </form>
                                                            </td>
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
    
    
        <div id="formularioEdicion" >
            <form id="form_editar_servicios" method="post" action="{{ route('actualizar_usuario') }}">
                @csrf
                <table class="table table-bordered table-hover form-edit" style="border: 8px solid #dee2e6;">
                    <thead style="display: none;"></thead>
                    <tbody class="form-edit">
                        <tr>
                            <h2 colspan="2" style="text-align: center; margin: 30px 0 50px;">Editar usuario <span id="nombreUsuario"></span></h2>
                        </tr>
                        <tr>
                            <input type="hidden" id="idUsuario" name="id">
                        </tr>
                        <tr>
                            <input type="hidden" id="id_det" name="id_det">
                        </tr>
                        <tr>
                            <td><label for="nombres">Nombres:</label></td>
                            <td><input type="text" id="nombres" name="nombres"></td>
                        </tr>
                        <tr>
                            <td><label for="apellidos">Apellidos:</label></td>
                            <td><input type="text" id="apellidos" name="apellidos"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="text" id="email" name="email"></td>
                        </tr>
                        <tr>
                            <td><label for="telefono">Telefono:</label></td>
                            <td><input type="number" id="telefono" name="telefono"></td>
                        </tr>
                        <tr>
                            <td><label for="rol">Rol:</label></td>
                            <td>
                                <select name="rol" required id="rol" style="width: -webkit-fill-available; padding: 10px;">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Cliente">Cliente</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="estado">Estado:</label></td>
                            <td>
                                <select name="estado" required id="estado" style="width: -webkit-fill-available; padding: 10px;">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" style="margin: 30px  45%; height: 50px; font-size: 17px;" class="btn btn-pink">Guardar Cambios</button>
            </form>
        </div>
    
    
    
    
        </section>
    
    </div>
    </div>
    </div>
    <script>
        function scrollToEnd() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    </script>

    <script>
        function editarUsuario(id) {
            fetch(`/usuarios/${id}`)
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
                    document.getElementById('nombreUsuario').innerText = data.det_usu.nombres;
                    document.getElementById('idUsuario').value = data.det_usu.id_usuario;
                    document.getElementById('id_det').value = data.det_usu.id_det;
                    document.getElementById('rol').value = data.det_usu.rol ; 
                    document.getElementById('nombres').value = data.det_usu.nombres ; 
                    document.getElementById('apellidos').value = data.det_usu.apellidos ; 
                    document.getElementById('email').value = data.email ; 
                    document.getElementById('telefono').value = data.det_usu.telefono; 
                    document.getElementById('estado').value = data.det_usu.estado; 
                })
                .catch(error => console.error('Error al obtener usuario por ID:', error));
        }
        
        function scrollToEnd() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    </script>

    



    <script src="{{ asset('animacion-inicio/script.js') }}"></script>


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


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>



    <script>
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable({
            dom: 'l<"toolbar">frtip', // 'l' para el selector de entradas por página
            buttons: [], // Esto elimina todos los botones de exportación
            language: {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ entradas",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando   _START_ de _END_  de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 entradas",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ entradas)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "  Siguiente",
                    "sPrevious": "Anterior  "
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        // Agregar un contenedor personalizado para el selector de entradas por página
    });
    </script>

</body>
</html>


