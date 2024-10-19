<div class="wrapper">
    <div class="content-principal">

        <div class="principal">
            <h1 class="tituloServicio">Nuestros servicios</h1>
            <div class="filita">
              <a href="{{ route('servicios.show', ['pqr' => 'peticion']) }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                <i class="fas fa-paper-plane"></i>
                <h2>Petición</h2>
                <p>
                  Solicita información o asistencia sobre nuestros productos y servicios. Estamos aquí para responder a tus preguntas y ofrecerte el soporte que necesites.
                </p>
              </div>
              </a>
              <a href="{{ route('servicios.show', ['pqr' => 'queja']) }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                  <i class="fas fa-comments"></i>
                  <h2>Queja</h2>
                  <p>
                    Si algo no ha cumplido con tus expectativas, háznoslo saber. Valoramos tus comentarios y nos comprometemos a mejorar para brindarte la mejor experiencia posible.
                  </p>
                </div>
              </a>
              <a href="{{ route('servicios.show', ['pqr' => 'reclamo']) }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                  <i class="fas fa-gavel"></i>
                  <h2>Reclamo</h2>
                  <p>
                    Si has tenido un problema con un producto o servicio, puedes presentar un reclamo. Nuestro equipo investigará la situación y trabajará para encontrar una solución satisfactoria para ti.
                  </p>
                </div>
              </a>
              <a href="{{ route ('canalAtencion') }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                  <i class="fas fa-headset"></i>
                  <h2>Canales de atención</h2>
                  <p>
                    Ofrecemos diversas formas de contacto, como teléfono, correo electrónico y redes sociales, para facilitar la comunicación contigo.
                  </p>
                </div>
              </a>
              <div class="servicios-d sombra-servicio">
                <i class="fas fa-edit"></i>
                <h2 class="h2-servicio">Sugerencias</h2>
                <p>
                  Comparte tus ideas o recomendaciones para ayudarnos a mejorar nuestros productos, servicios o la atención al cliente.
                </p>
              </div>
        
              <a href="{{ route ('seguimientoCasos') }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                  <i class="fa fa-search"></i>
                  <h2>Seguimiento de casos</h2>
                  <p>
                    Verifica el estado de tu petición, queja o reclamo con facilidad. Mantente informado sobre el progreso de tu caso.
                  </p>
                </div>
              </a>
              <a href="{{ route ('politicas') }}" style="color: inherit">
                <div class="servicios-d sombra-servicio">
                  <i class="fas fa-file-contract"></i>
                  <h2>Politicas de tratamiento</h2>
                  <p>
                    Conoce nuestras políticas relacionadas con peticiones, quejas y reclamos, así como los tiempos de respuesta y resolución esperados.
                  </p>
                </div>
              </a>
            </div>
        </div>

    </div>
</div>


@yield('cuerpoServicios')