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
                                    <h1 style="font-family: 'Teko', sans-serif;">GESTIONAR PRODUCTOS - ADMINISTRADOR<h1>
                                            <h4>Selecciona la acción que deseas realizar con la información de cada
                                                producto (editar/eliminar)</h4>
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
                                                        <th style="color: #fff;">Nombre</th>
                                                        <th style="color: #fff;">Categoría</th>
                                                        <th style="color: #fff;">Precio</th>
                                                        <th style="color: #fff;">Proveedor</th>
                                                        <th style="color: #fff;">Estado</th>
                                                        <th onclick="scrollToEnd()" id="scrollHere"
                                                            style="text-align: center; color: #fff;"></i>Editar</th>
                                                        <th style="text-align: center; color:#fff;">Eliminar
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($productos as $producto)
                                                        @php
                                                            // Determinar el estilo basado en el estado del usuario
                                                            $estado = $producto->estado == "Activo" 
                                                                ? 'background-color: #4caf5057; color: #fff; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;' 
                                                                : 'background-color: #e79c96; color: #000; text-align: center; line-height: 14px; padding: 2px; border-radius: 3px;';
                                                            
                                                            // Determinar la URL de la imagen
                                                            $fotoUrl = $producto->detProducto->foto;
                                                            if (strpos($fotoUrl, 'https://lh3') === 0) {
                                                                // URL de Google
                                                                $fotoUrl = $producto->detUsu->foto;
                                                            } else {
                                                                // URL local
                                                                $fotoUrl = asset('storage/' . $producto->detProducto->foto);
                                                            }
                                                        @endphp
                                                        
                                                        <tr class="center-div-bar">
                                                            <td><img src="{{$fotoUrl}}" alt="Foto User" width="80px" height="80px"></td>
                                                            <td style="color: #000 !important;">{{ $producto->nombre }}</td>
                                                            <td style="color: #000 !important;">{{ $producto->categoria }}</td>
                                                            <td style="color: #000 !important;">{{ number_format($producto->precio) }}</td>
                                                            <td style="color: #000 !important;">{{ $producto->detProducto->proveedor }}</td>
                                                            <td id="estado" ><p style="{{ $estado }}">{{ $producto->estado }}</p></td>
                                                            
                                                            <td style="color: #000; text-align: center;">
                                                                <button onclick="editarProducto('{{ $producto->id_pro }}'); scrollToEnd()" class="btn btn-info" style="display: ruby;">
                                                                    <i class="ti-pencil"></i><p style="margin: 0; color: #fff;">ㅤEDITAR</p>
                                                                </button>
                                                            </td>
                                                            <td style="color: #000; text-align: center;">
                                                                <form action="{{ route('producto.destroy', ['id' => $producto->id_pro]) }}" method="POST" >
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
    
    
        <div id="formularioEdicion">
            <form id="form_editar_servicios" method="post" action="{{ route('actualizar_producto') }}">
                @csrf
                <table class="table table-bordered table-hover form-edit" style="border: 8px solid #dee2e6;">
                    <thead style="display: none;">
                        <tr>
                            <th colspan="2">Editar Producto</th>
                        </tr>
                    </thead>
                    <tbody class="form-edit">
                        <tr>
                            <td colspan="2">
                                <h2 style="text-align: center; margin: 30px 0 50px;">Editar Producto <span id="nombreProducto"></span></h2>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" id="id_pro" name="id_pro">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre"></td>
                        </tr>
                        <tr>
                            <td><label for="precio">Precio:</label></td>
                            <td><input type="text" id="precio" name="precio"></td>
                        </tr>
                        <tr>
                            <td><label for="proveedor">Proveedor:</label></td>
                            <td><input type="text" id="proveedorProducto" name="proveedor" readonly></td>
                        </tr>
                        <tr>
                            <td><label for="categoria">Categoría:</label></td>
                            <td>
                                <select name="categoria" required id="categoria" style="width: -webkit-fill-available; padding: 10px;">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="Ropa">Ropa</option>
                                    <option value="Lanas">Lanas</option>
                                    <option value="Patrones">Patrones</option>
                                    <option value="Articulos">Artículos</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="estado">Estado:</label></td>
                            <td>
                                <select name="estado" id="estados" style="width: -webkit-fill-available; padding: 10px;">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Agrega otros campos del formulario de edición aquí -->
                <button type="submit" style="margin: 30px 45%; height: 50px; font-size: 17px;" class="btn btn-pink">Guardar Cambios</button>
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
        function editarProducto(id) {
            fetch(`/producto/${id}`)
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
                    document.getElementById('nombreProducto').innerText = data.nombre;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('id_pro').value = data.id_pro;
                    document.getElementById('precio').value = data.precio;
                    document.getElementById('proveedorProducto').value = data.det_producto.proveedor ; 
                    document.getElementById('categoria').value = data.categoria ; 
                })
                .catch(error => console.error('Error al obtener producto por ID:', error));
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