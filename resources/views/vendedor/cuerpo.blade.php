<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Hola, <span>Bienvenido al apartado de administrador</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Menu principal</a></li>
                                <li class="breadcrumb-item active">Inicio</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total de ventas</div>
                                    <div class="stat-digit">{{$ventas}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 color-pink border-pink"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text"  >Total productos</div>
                                    <div class="stat-digit">{{$productos}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">


                    <div class="col-lg-12" style="padding: 30px;">
                        <div class="card" style="height: 100%;" >

                            <div class="card-body">
                                <h2 style="text-align: center; margin: 25px" >Diagrama Sectorial de ventas de productos top</h2>
                                
                                    @if($productosData)
                                        <div class="ct-pie-chart"></div>
                                        
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                var datosProductos = @json($productosData);

                                                var data = {
                                                    labels: [],
                                                    series: []
                                                };

                                                datosProductos.forEach(function(producto) {
                                                    data.labels.push(producto.label);
                                                    data.series.push({
                                                        value: producto.value,
                                                        colors: [producto.color]
                                                    });
                                                });

                                                var options = {
                                                    labelInterpolationFnc: function(value) {
                                                        return value[0];
                                                    }
                                                };

                                                var responsiveOptions = [
                                                    ['screen and (min-width: 640px)', {
                                                        chartPadding: 30,
                                                        labelOffset: 100,
                                                        labelDirection: 'explode',
                                                        labelInterpolationFnc: function(value) {
                                                            return value;
                                                        }
                                                    }],
                                                    ['screen and (min-width: 1024px)', {
                                                        labelOffset: 80,
                                                        chartPadding: 20
                                                    }]
                                                ];

                                                new Chartist.Pie('.ct-pie-chart', data, options, responsiveOptions);
                                            });
                                        </script>
                                    @else
                                        <h2>No hay productos disponibles con ventas</h2>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-pink">
                            <div class="testimonial-widget-one">
                                <div class="owl-carousel owl-theme">
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i>Bienvenido al corazón de nuestra operación! Aquí es donde tus ideas se convierten en acción, donde la creatividad se encuentra con la estrategia y donde juntos construimos el futuro de nuestra empresa. Adelante, ¡haz realidad tus sueños y lleva nuestro negocio hacia nuevos horizontes  <i class="fa fa-quote-right"></i>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i> Aquí, tu creatividad y liderazgo impulsan nuestro progreso. ¡Bienvenido! <i class="fa fa-quote-right"></i>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="testimonial-content">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left"></i> En este panel de administración, no solo encuentras herramientas y datos, sino un reflejo de nuestro compromiso con la excelencia, la innovación y el crecimiento. Aquí es donde la visión se convierte en realidad, y donde cada clic y decisión importa. ¡Bienvenido a nuestro espacio de posibilidades infinitas! <i class="fa fa-quote-right"></i>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /# row -->
            </section>
        </div>
    </div>
</div>


@yield('cuerpo')