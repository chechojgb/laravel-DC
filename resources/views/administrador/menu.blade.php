
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content" >
            <ul>
                    <div class="logo" ><a href="{{ route('administrador') }}" class="navbar-brand"><img src=" {{ asset('animacion-inicio/client-side/images/decrochea.png') }}" class="img-fluid rounded" alt=""></a></div>
                    
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


                        <li>
                            <a class="sidebar-sub-toggle" >
                                <img src="{{ $fotoUrl }}" alt="foto de usuario"  style="width:60px; height: 60px; border-radius: 30%; border: 2px solid #fff;" > {{ $detUsu->nombres }} {{ $detUsu->apellidos }}
                                <span class="sidebar-collapse-icon ti-angle-down"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('perfil') }}"><i class="ti-marker-alt"></i> Editar cuenta</a></li>
                                <li><a href="{{ route('logout') }}"><i class="ti-eye"></i>Cerrar sesion</a></li>
                            </ul>
                        </li>

                    @else
                        <a href="{{ route('logueo') }}" class="my-auto"><i class="fas fa-user fa-2x" style="color: #e08eb1;"></i></a>
                    @endauth
                    


                    <li class="label" style="margin-left: 20px;font-size: 18px;">Menú principal</li>
                    
                    <li><a href="{{ route('administrador')}}"><i class="ti-calendar"></i > Inicio </a></li>

                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Usuarios <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('admiRegistrarUser')}}"><i class="ti-marker-alt"></i> Registrar</a></li>
                            <li><a href="{{ route('admiVerUser')}}"><i class="ti-eye"></i> Ver</a></li>
                            <li><a href="{{ route('admiExpoUser')}}"><i class="ti-download"></i>Descargar info</a></li>
                        </ul>
                    </li>
                    
                    <li><a class="sidebar-sub-toggle"><i class="ti-archive"></i> Inventario<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                    <li><a href="{{ route('admiRegistrarProd')}}"><i class="ti-clipboard"></i> Registrar productos</a></li>
                            <li><a href="{{ route('admiVerProd')}}"><i class="ti-menu-alt"></i> Ver productos</a></li>
                            <li><a href="{{ route('admiExpoProd')}}"><i class="ti-agenda"></i> Descargar info</a></li>
                    </ul>
                    <li><a class="sidebar-sub-toggle"><i class="ti-face-sad"></i> Radicados Pqr<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                    <li><a href="{{ route('admiVerPqr')}}"><i class="ti-clipboard"></i> Ver pqr</a></li>
                            <li><a href="{{ route('admiExpoPqr')}}"><i class="ti-menu-alt"></i> Descargar pqr</a></li>
                            
                    </ul>
                    <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart"></i> Ventas<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                    <li><a href="{{ route('admiVerCompras')}}"><i class="ti-clipboard"></i> Ver Compras</a></li>

                    </ul>
                    
                </ul>
            </div>
        </div>
</div>
@yield('menu')