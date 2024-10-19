<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seccion de {{ $productos->isNotEmpty() ? $productos->first()->categoria : 'Categoría no disponible' }}</title>

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'><link rel='stylesheet' href='https://dl.dropboxusercontent.com/u/69747888/MoGo%20carousel/font-awesome.min.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700'>

    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/calendar2/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/lib/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/dashboard/css/style.css') }}">


    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/lightbox/css/lightbox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('animacion-inicio/carrito/lib/owlcarousel/assets/owl.carousel.min.css') }} ">

</head>
<body>
    <x-header />
    <div class="wrapper">
        <div class="content-principal">
            
      
      
      
      
              <!-- Fruits Shop Start-->
              <div class="container-fluid fruite py-5" style="margin-top: 70px;" >
                  <div class="container py-5">
                    <h1>Seccion de {{ $productos->isNotEmpty() ? $productos->first()->categoria : 'Categoría no disponible' }}</h1>

                      <div class="row g-4">
                          <div class="col-lg-12">
                            <div class="row g-4" style="display: block;" >
                                <div class="col-xl-3">
                                    <div class="input-group w-100 mx-auto d-flex" style="margin-bottom: 15px;" id="buscar_producto">
                                        <input type="search" class="form-control p-3" placeholder="Busca tu producto" aria-describedby="search-icon-1" id="buscarProducto" >
                                        <button onclick="buscar_ahora()" style="background: none;border: none; padding: 0;" ><span id="search-icon-1" class="input-group-text p-3" style="height: 100%;         border-top-left-radius: 0;border-bottom-left-radius: 0;border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i class="fa fa-search"></i></span></button>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin: 0; display:none" id="caja_buscador1">
                                    <div class="card buscador" id="caja_buscador"  >
                                        <div class="card-title">
                                            <h4>Productos relacionados</h4>
    
                                        </div>
                                        <div class="card-body">
                                            <ul class="timeline" id="datos_buscador">
                                            </ul>
                                        </div>
                                </div>
                                <!-- /# card -->
                            </div>
                                 <div class="col-xl-3 buscador" id="caja_buscador">
                                    <div class="input-group w-100 mx-auto d-flex" style="margin-bottom: 15px;" >
                                        <span id="datos_buscador"></span>
                                    </div>
                                </div> 
      
                              </div>
                              <div class="row g-4">
                                  <div class="col-lg-3">
                                      <div class="row g-4">
                                          <div class="col-lg-12">
                                              <div class="mb-3">
                                                  <h4>Categorias</h4>
                                                  <ul class="list-unstyled fruite-categorie">
                                                      <li class="">
                                                          <div class="d-flex justify-content-between fruite-name active">
                                                              <a href="{{ route('productos.show', ['categoria' => 'ropa']) }}"><i class="fas fa-star  me-2"></i>Ropa de lana</a>
                                                              <span>(3)</span>
                                                          </div>
                                                      </li>
                                                      <li>
                                                          <div class="d-flex justify-content-between fruite-name">
                                                              <a href="{{ route('productos.show', ['categoria' => 'lanas']) }}"><i class="fas fa-star  me-2"></i>Lana</a>
                                                              <span>(5)</span>
                                                          </div>
                                                      </li>
                                                      <li>
                                                          <div class="d-flex justify-content-between fruite-name">
                                                              <a href="{{ route('productos.show', ['categoria' => 'articulos']) }}"><i class="fas fa-star  me-2"></i>Articulos de costura</a>
                                                              <span>(2)</span>
                                                          </div>
                                                      </li>
                                                      <li>
                                                          <div class="d-flex justify-content-between fruite-name">
                                                              <a href="{{ route('productos.show', ['categoria' => 'patrones']) }}"><i class="fas fa-star  me-2"></i>Patrones</a>
                                                              <span>(8)</span>
                                                          </div>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
      
      
      
      
                                      </div>
                                  </div>
                                  <div class="col-lg-9">
                                      <div class="row g-4 justify-content-center">
                                        @foreach ($productos as $producto)

                                            @php
                                                $fotoUrl = $producto->detProducto->foto;
                                                if (strpos($fotoUrl, 'https://lh3') === 0) {
                                                    // URL de Google
                                                    $fotoUrl = $producto->detProducto->foto;
                                                } else {
                                                    // URL local
                                                    $fotoUrl = asset('storage/' . $producto->detProducto->foto);
                                                }
                                            @endphp
                                            <div class="col-md-6 col-lg-6 col-xl-4">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <a href="{{ route('detalles.producto.show', ['id_pro' => $producto->id_pro]) }}">
                                                            <img src="{{ asset($fotoUrl) }}" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">

                                                        </a>
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Costura</div>
                                                    <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                                                        <h4>{{ $producto->nombre }}</h4>
                                                        <p >
                                                            {{ Str::limit($producto->descripcion, 50, '...') }}
                                                        </p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                        
                                
                                
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                                                            <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                                                            <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                                                            <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                                                            <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{ number_format($producto->precio) }}$</p>

                                                            <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                                                        </form>
                                
                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                          <div class="col-12">
                                              <div class="pagination d-flex justify-content-center mt-5">
                                                  <a href="#" class="rounded">&laquo;</a>
                                                  <a href="#" class="active rounded">1</a>
                                                  <a href="#" class="rounded">2</a>
                                                  <a href="#" class="rounded">3</a>
                                                  <a href="#" class="rounded">&raquo;</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
    </div>
    @include('footer')
    
    <script src="{{ asset('js/busqueda/busqueda.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('animacion-inicio/carrito/js/main.js') }}"></script>

</body>
</html>
