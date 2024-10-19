function swalerror(text) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: text,
        position: 'top',
        toast: true,
        showConfirmButton: false,
        timer: 3000
    });
}

function swalsuccess(text) {
    Swal.fire({
        icon: 'success',
        text: text,
        position: 'top',
        toast: true,
        showConfirmButton: false,
        timer: 6000
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formularioRegistro');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        registro();
    });


    function registro() {
        const formData = new FormData(form);

        fetch('/validar.registro.usu', {
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
                swalsuccess("Registro exitoso, Bienvenido");
                setTimeout(() => {
                    location.href = "logueo";
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formularioLogueo');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        login();
    });


    function login() {
        const formData = new FormData(form);

        fetch('/inicio.sesion', {
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
            } else if (data.status === 'cliente') {
                swalsuccess("Logueo exitoso, Bienvenido cliente");
                setTimeout(() => {
                    location.href = "/";
                }, 2000);
            }
            else if (data.status === 'administrador') {
                swalsuccess("Logueo exitoso, Bienvenido administrador");
                setTimeout(() => {
                    location.href = "/administrador";
                }, 2000);
            }
            else if (data.status === 'vendedor') {
                swalsuccess("Logueo exitoso, Bienvenido vendedor");
                setTimeout(() => {
                    location.href = "/vendedor";
                }, 2000);
            }
            else if (data.status === 'inactivo') {
                swalerror("Tu usuario no esta activo");

            }
            else if (data.status === 'invalido') {
                swalerror("Las credenciales no coinciden");

            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});



document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registrarDireccion');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        registrarDireccion();
    });


    function registrarDireccion() {
        const formData = new FormData(form);

        fetch('/actualizarDireccion', {
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
                swalsuccess("Actulizacion de datos de envio exitosa");
                setTimeout(() => {
                    location.href = "perfil";
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('actualizarPerfil');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        registrarDireccion();
    });


    function registrarDireccion() {
        const formData = new FormData(form);

        fetch('/actualizarPerfil', {
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
                swalsuccess("Actulizacion de datos de personales exitosa");
                setTimeout(() => {
                    location.href = "perfil";
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cambiarClave');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        cambiarClave();
    });


    function cambiarClave() {
        const formData = new FormData(form);

        fetch('/cambiarClave', {
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
                swalsuccess("Actulizacion de datos de personales exitosa");
                setTimeout(() => {
                    location.href = "perfil";
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});