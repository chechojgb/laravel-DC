

    {{-- <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> --}}
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top" style="box-shadow: 0px 5px 5px rgb(224, 142, 177);">
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl" style="box-sizing: content-box !important;" >
                <a href="/" class="navbar-brand"><div class="rounded me-4" style="width: 200px; height: 60px;"><img src=" {{ asset('animacion-inicio/client-side/images/decrocher.png') }} " class="img-fluid rounded" alt=""></div></a>
                
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        

                      @auth
                          <a style="display:none;" href="#" class="nav-item nav-link">Ingresa</a>
                      @else
                          <a href="{{ route('logueo') }}" class="nav-item nav-link">Ingresa</a>
                      @endauth
                        
                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tienda</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('productos.show', ['categoria' => 'ropa']) }}" class="dropdown-item" id="ropa">Ropa</a>
                                <a href="{{ route('productos.show', ['categoria' => 'lanas']) }}" class="dropdown-item" id="lana">Lana</a>
                                <a href="{{ route('productos.show', ['categoria' => 'articulos']) }}" class="dropdown-item" id="costura">Articulos de costura</a>
                                <a href="{{ route('productos.show', ['categoria' => 'Patrones']) }}" class="dropdown-item" id="patrones">Patrones</a>
                            </div>
                        </div>
                        <a href="{{ route('verCarrito') }}" class="nav-item nav-link">Compra</a>
                        <a href="{{ route('servicios') }}" class="nav-item nav-link">Nuestros servicios</a>
                        @auth
                        <div class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tus productos</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('verFacturas') }}" class="dropdown-item">Facturas</a>
                                <a href="{{route('productosComprados')}}" class="dropdown-item">Productos comprados</a>
                            </div>
                        </div>
                        @endauth
                        
                    </div>
                    <div class="d-flex m-3 me-0">
                        @auth
                          <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-top: 13px!important;" ><i class="fas fa-search color-pink"></i></button>
                        @else
                          <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal" style="margin-top: 0px!important;" ><i class="fas fa-search color-pink"></i></button>
                        @endauth
                        
                        
                        <a href="{{ route('verCarrito') }}" class="position-relative me-4 my-auto">
                          <i class="fa fa-cart-plus fa-2x" style="color:#e08eb1;" ></i>

                          @if($cartQuantity > 0)
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px; background-color: #e08eb1!important; color: #fff !important;">
                                {{ $cartQuantity }}
                            </span>
                                                            
                            @else
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px; background-color: #e08eb1!important; color: #fff !important;">
                                0
                            </span>
                        @endif
                          
                        </a>
                        @auth
                              @php
                                  $detUsu = Auth::user()->detUsu;

                                    $fotoUrl = $detUsu->foto;
                                    if (strpos($fotoUrl, 'https://lh3') === 0) {
                                        // URL de Google
                                        $fotoUrl = $detUsu->foto;
                                    } else {
                                        // URL local
                                        $fotoUrl = asset('storage/' . $detUsu->foto);
                                    }
              
                              @endphp
                          <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="{{ $fotoUrl }}" alt="foto de usuario" style="width:60px; height: 60px; border-radius: 30%; border: 2px solid #fff; cursor: pointer;">
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                {{ $detUsu->nombres }} {{ $detUsu->apellidos }}
                                <a href="{{ route('perfil')}}" class="dropdown-item">Editar Cuenta</a>
                                <a href="{{ route('logout') }}" class="dropdown-item">Cerrar sesión</a>
                            </div>
                              </div>
                        @else
                              <a href="{{ route('logueo') }}" class="my-auto"><i class="fas fa-user fa-2x" style="color: #e08eb1;"></i></a>
                        @endauth

                    </div>
                </div>
            </nav>
        </div>
</div>





<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
          <div class="modal-content rounded-0">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Busca tu producto</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              <div class="modal-body  align-items-center">
                <div class="input-group w-75 mx-auto d-flex" id="buscar_producto">
                  <input type="search" class="form-control p-3" placeholder="Busca tu producto" aria-describedby="search-icon-1" id="buscarProducto_a" >
                    <button onclick="buscar_ahora_a()" style="background: none; border: none; padding: 0;">
                        <span id="search-icon-1" class="input-group-text p-3" style="height: 100%; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                            <i class="fa fa-search"></i>
                        </span>
                    </button>

                </div>
                  <div class="col-lg-4" style="margin: auto;display: none;" id="caja_buscador_a">
                      <div class="card buscador" id="caja_buscador_a"  >
                              <div class="card-title">
                                  <h4>Productos relacionados</h4>

                              </div>
                              <div class="card-body">
                                  <ul class="timeline" id="datos_buscador_a">
                                  </ul>
                              </div>
                      </div>
                      <!-- /# card -->
                  </div>
              </div>
          </div>
      </div>
</div>

    <script src="{{ asset('js/busqueda/busqueda.js') }}"></script>
    @yield('header')
