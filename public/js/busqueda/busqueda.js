document.addEventListener('DOMContentLoaded', () => {

    const inputElementBuscar = document.getElementById('buscarProducto');
    if (inputElementBuscar) {
        inputElementBuscar.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                buscar_ahora();
            }
        });
    }

    const inputElementBuscar_a = document.getElementById('buscarProducto_a');
    if (inputElementBuscar_a) {
        inputElementBuscar_a.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                buscar_ahora_a();
            }
        });
    }

});





function buscar_ahora() {
    const query = document.getElementById('buscarProducto').value;
    fetch(`/buscar?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const cajaBuscador = document.getElementById('caja_buscador');
            const cajaBuscador1 = document.getElementById('caja_buscador1');
            const datosBuscador = document.getElementById('datos_buscador');
          

            // Limpiar resultados anteriores
            datosBuscador.innerHTML = '';

            if (data.length > 0) {
                cajaBuscador.style.display = 'block';
                cajaBuscador1.style.display = 'block';
                cajaBuscador.style.position = 'absolute';
                
                // Mostrar los productos encontrados
                data.forEach(producto => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <div class="timeline-badge primary"><i class="ti-shopping-cart-full"></i></div>
                        <div class="timeline-panel buscador-encuentro">
                            <a href="/detalles-producto/${producto.id_pro}" style="width: 100%;">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">${producto.nombre}</h5>
                                </div>
                                <div class="timeline-body">
                                    <p>Categoria: ${producto.categoria}</p>
                                </div>
                            </a>
                        </div>
                    `;
                    datosBuscador.appendChild(li);
                });

                // Ocultar el contenedor después de 7 segundos
                setTimeout(() => {
                    cajaBuscador.style.display = 'none';
                }, 7000); // 7000 milisegundos = 7 segundos
            } else {
                cajaBuscador.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
}



function buscar_ahora_a() {
    const query = document.getElementById('buscarProducto_a').value;
    const caja = document.getElementById('caja_buscador_a');
    fetch(`/buscar?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const datosBuscador = document.getElementById('datos_buscador_a');

            // Limpiar resultados anteriores
            datosBuscador.innerHTML = '';

            if (data.length > 0) {
                caja.style.display = 'block';
                
                // Mostrar los productos encontrados
                data.forEach(producto => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <div class="timeline-badge primary"><i class="ti-shopping-cart-full"></i></div>
                        <div class="timeline-panel buscador-encuentro">
                            <a href="/detalles-producto/${producto.id_pro}" style="width: 100%;">
                                <div class="timeline-heading">
                                    <h5 class="timeline-title">${producto.nombre}</h5>
                                </div>
                                <div class="timeline-body">
                                    <p>Categoria: ${producto.categoria}</p>
                                </div>
                            </a>
                        </div>
                    `;
                    datosBuscador.appendChild(li);
                });

            } else {
                caja.style.display = 'block';
                datosBuscador.innerHTML = '<p>No se encontraron productos.</p>';
            }
        })
        .catch(error => console.error('Error:', error));
}
