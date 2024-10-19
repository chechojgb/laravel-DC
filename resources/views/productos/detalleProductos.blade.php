<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('animacion-inicio/client-side/images/icono_decroche.jpeg')}}" />
    <title>DeCroche - descripción producto </title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <x-header />


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">

                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="Busca tus productos" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <div class="wrapper">
        <div class="content-principal">

            <div class="container-fluid py-5 mt-5">
                <div class="container py-5">
                    <div class="row g-4 mb-5">
                        <div class="col-lg-8 col-xl-9">
                            
                                
        
                            @if ($productos)
                                @php
                                    // Sanitizar las rutas de las fotos
                                    $foto = !empty($productos->detProducto->foto) ? htmlspecialchars($productos->detProducto->foto) : null;
                                    $foto2 = !empty($productos->detProducto->foto2) ? htmlspecialchars($productos->detProducto->foto2) : null;
                                    $foto3 = !empty($productos->detProducto->foto3) ? htmlspecialchars($productos->detProducto->foto3) : null;
                        
                                    // Contar las fotos disponibles
                                    $fotoCount = 0;
                                    if ($foto) $fotoCount++;
                                    if ($foto2) $fotoCount++;
                                    if ($foto3) $fotoCount++;



                                    $fotoUrl = $productos->detProducto->foto;
                                    if (strpos($fotoUrl, 'https://lh3') === 0) {
                                        // URL de Google
                                        $fotoUrl = $productos->detProducto->foto;
                                    } else {
                                        // URL local
                                        $fotoUrl = asset('storage/' . $productos->detProducto->foto);
                                    }
                                @endphp

                            @php
                                                            

                            

                            @endphp
                            
                            @endif
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner border rounded">
                                
                                                @if ($foto)
                                                <div class="carousel-item active">
                                                    <img src="{{ asset($fotoUrl) }}" class="d-block w-100 imagen-p" alt="Producto">
                                                </div>
                                                @endif
                                
                                                @if ($foto2)
                                                    <div class="carousel-item">
                                                        <img src="{{ asset($productos->detProducto->foto2) }}" class="d-block w-100 imagen-p" alt="Producto">
                                                    </div>
                                                @endif
                                
                                                @if ($foto3)
                                                    <div class="carousel-item">
                                                        <img src="{{ asset($productos->detProducto->foto3) }}" class="d-block w-100 imagen-p" alt="Producto">
                                                    </div>
                                                @endif
                                            
                                
                                            </div>
                                            @if ($fotoCount > 1)
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                
                                            
                                            
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <h4 class="fw-bold mb-3">{{ $productos->nombre }}</h4>
                                        <p class="mb-3">{{ $productos->categoria }}</p>
                                        <h5 class="fw-bold mb-3">{{ number_format($productos->precio) }}$</h5>
                                            @php
                                                $cantidadOpiniones = $productos->detOpinion->count(); // Contar las opiniones
                                                $sumar = $productos->detOpinion->sum('calificacion'); // Sumar las calificaciones
                                                $estrellas = $cantidadOpiniones > 0 ? $sumar / $cantidadOpiniones : 0; // Calcular el promedio de estrellas
                                            @endphp
                                        
                                        
                                            
                                            <!-- Si quieres mostrar las estrellas visualmente -->
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star {{ $i <= $estrellas ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                        <h6 class="fw-bold mb-3"><strong>{{ $productos->stock }}</strong> cantidades disponibles</h6>
                                        <p class="mb-4">{{ $productos->descripcion }}</p>
                                        <p class="mb-4">Vendido por: <strong>{{ $productos->detProducto->proveedor }}</strong></p>
                                
                                        @if ($productos->stock >= 1)
                                            <form action="{{ route('agregarProducto', ['id_pro' => $productos->id_pro]) }}" method="post">
                                                @csrf <!-- Protege tu formulario con CSRF -->
                                                <input type="hidden" name="id_pro" value="{{ $productos->id_pro}}">
                                                <input type="hidden" name="precio" value="{{ $productos->precio}}">
                                                <input type="hidden" name="nombre" value="{{ $productos->nombre}}">
                                                <input type="hidden" name="stock" value="{{ $productos->stock}}">
                                                <input type="hidden" name="cantidad" >
                                                
                                                    
                                                    @if ($productos->stock >= 1 && $productos->estado == 'Activo')
                                                        <button type="submit" name="accion" value="agregar" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                                            <i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito
                                                        </button>
                                                    @else
                                                        <p style="color: rgb(202, 109, 197)"><strong>Producto no disponible en el momento</strong></p>
                                                    @endif
                                                    

                                            </form>
                                        @endif
                                    </div>
                                </div>
        
                            
        
        
        
        
        
        
        
        
        
        
        
        
                        </div>
                        <div class="col-lg-4 col-xl-3">
                            <div class="row g-4 fruite">
                                <div class="col-lg-12">
        
                                    <div class="mb-4">
                                        <h4>Categoria</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="./categoria/ropa/ropa.php"><i class="fas fas fa-star  me-2"></i>Ropa de lana</a>
                                                            <span>(3)</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="./categoria/lanas/lana.php"><i class="fas fas fa-star  me-2"></i>Lana</a>
                                                            <span>(5)</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="./categoria/costura/costura.php"><i class="fas fas fa-star  me-2"></i>Articulos de costura</a>
                                                            <span>(2)</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="./categoria/patrones/patrones.php"><i class="fas fas fa-star  me-2"></i>Patrones</a>
                                                            <span>(8)</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                    <h1 class="fw-bold mb-0">Productos relacionados</h1>
                    <div class="vesitable">
                        <div class="owl-carousel vegetable-carousel justify-content-center">
                        <?php 
                            // cargarBarraProductos();
                        ?>
        
                        @foreach ($productosAll as $todos)


                                @php
                                    $fotoUrl = $todos->detProducto->foto;
                                    if (strpos($fotoUrl, 'https://lh3') === 0) {
                                        // URL de Google
                                        $fotoUrl = $todos->detProducto->foto;
                                    } else {
                                        // URL local
                                        $fotoUrl = asset('storage/' . $todos->detProducto->foto);
                                    }
                                @endphp
                            @if ($todos->stock >= 1 )
        
                                <div class="border border-primary rounded position-relative vesitable-item">
                                    <div class="vesitable-img">
                                        <a href="{{ route('detalles.producto.show', ['id_pro' => $todos->id_pro]) }}">
                                            <img src="{{asset($fotoUrl)}}" class="img-fluid w-100 rounded-top" alt="" style="height: 150px; object-fit:cover">
                                        </a>
                                    </div>
                                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$todos->categoria}}</div>
                                    <div class="p-4 pb-0 rounded-bottom">
                                        <h4>{{$todos->nombre}}</h4>
                                        <p>{{ Str::limit($todos->descripcion, 50, '...') }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                        <form action="{{ route('agregarProducto', ['id_pro' => $todos->id_pro]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                                            <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                                            <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                                            <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                                            <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                                            <p class="text-dark fs-5 fw-bold mb-0">${{ number_format($todos->precio) }}</p>
                                            <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                                        </form>
                                            
                                        </div>
                                        </div>
                                </div>
                                
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- Single Product Start -->
    
    <!-- Single Product End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    @include('footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript Libraries -->
<script src="./script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>

</body>

</html>