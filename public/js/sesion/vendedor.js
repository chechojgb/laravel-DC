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
    const form = document.getElementById('formularioRegistroProdVendedor');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        registro_prod();
    });


    function registro_prod() {
        const formData = new FormData(form);

        fetch('/registroProdVendedor', {
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
                swalsuccess("Registro de producto exitoso");
                setTimeout(() => {
                    location.href = "vendedorVerProd";
                }, 2000);
            }
        })
        .catch(error => {
            swalerror("Ocurrió un error inesperado");
        });
    }
});