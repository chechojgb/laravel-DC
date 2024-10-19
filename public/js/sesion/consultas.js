
function swalerror(text) {
    Swal.fire({
        icon: 'error',
        text: text,
        position: 'top',
        toast: true,
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
    });
}

function swalsuccess(text) {
    Swal.fire({
        icon: 'success',
        text: text,
        position: 'top',
        toast: true,
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('envioPeticion');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        registro_pqr();
    });


    function registro_pqr() {
        const formData = new FormData(form);

        fetch('/guardarPqr', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                for (const [key, value] of Object.entries(data.errors)) {
                    swalerror(value[0]);
                    break;
                }
            } else if (data.status === 'success') {
                swalsuccess("Se ha recibido tu solucitud: " + data.radicado);
                setTimeout(() => {
                    
                    location.href = data.redirect;
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});




document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('busqueda_form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        consultar_peticion();
    });

    function consultar_peticion() {
        const formData = new FormData(form);

        fetch('/buscar.consulta', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ num_servicio: formData.get('num_servicio') })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                swal.fire('Error', data.error, 'error');
                document.getElementById('consulta_peticion').style.display = 'none';
            } else {
                document.getElementById('consulta_peticion').style.display = 'block';
                document.getElementById('nombre').value = data.nombre;
                document.getElementById('email').value = data.email;
                document.getElementById('motivo').value = data.motivo;
                document.getElementById('detalles').value = data.detalle;
                document.getElementById('tipo_servicio').innerText = data.tipo_servicio;
                document.getElementById('tipo').innerText = data.tipo_servicio;
                document.getElementById('tipo_titulo').innerText = data.tipo_servicio;
                document.getElementById('fecha').innerText = data.fecha;
                document.getElementById('estado').value = data.estado;
                document.getElementById('respuesta').value = data.respuesta;
            }
        })
        .catch(error => {
            Swal.fire('Error', 'No se pudo encontrar la petición que creaste, verifica el código', 'error');
            document.getElementById('consulta_peticion').style.display = 'none';
        });
    }
});



document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formPago');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        validar_carrito();
    });


    function validar_carrito() {
        const formData = new FormData(form);

        fetch('/validarCarrito', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                for (const [key, value] of Object.entries(data.errors)) {
                    swalerror(value[0]);
                    break;
                }
            } else if (data.status === 'success') {
                swalsuccess("Validacion de datos correcta");
                setTimeout(() => {
                    location.href = "pagar";
                }, 2000);
            }
            else if (data.status === 'NotProduct') {
                swalerror("Agrega productos al carrito");
            }
            else if (data.status === 'notAuth') {
                swalerror("Inicia sesion para prodecer al pago");
            }
            else if (data.status === 'NotEnvio') {
                
                
                Swal.fire({
                    icon: 'error',
                    title: 'Faltan datos de envío',
                    text: 'Por favor, complete los detalles de envío en la edición de su perfil.',
                    position: 'top',
                    toast: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Registrar dirección de entrega',
                    confirmButtonColor: '#3085d6', // Color del botón de confirmación
                    timer: 6000, // Duración de la alerta
                    timerProgressBar: true, // Mostrar barra de progreso
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirige al usuario a la página de edición de detalles de envío si confirma
                        window.location.href = '/perfil';
                    }
                });
                
        
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});

