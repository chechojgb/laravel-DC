(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);


    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 10) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        } else {
            if ($(this).scrollTop() > 10) {
                $('.fixed-top').addClass('shadow').css('top', -10);
            } else {
                $('.fixed-top').removeClass('shadow').css('top', 0);
            }
        } 
    });
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    // vegetable carousel
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });



    // Product Quantity
    // $('.quantity button').on('click', function () {
    //     // Obtener el botón que se ha clicado
    //     var button = $(this);
    
    //     // Encontrar el contenedor del producto
    //     var productContainer = button.closest('tr');
    
    //     // Obtener el ID del producto
    //     var productId = productContainer.find('[name="id_pro"]').val();
    
    //     // Obtener el valor actual de la cantidad para este producto
    //     var quantityInput = productContainer.find('.form-control');
    //     var quantity = parseFloat(quantityInput.val());
    
    //     // Obtener el precio del producto
    //     var price = parseFloat(productContainer.find('#precio_').data('precio'));
    
    //     // Incrementar o decrementar el valor de la cantidad dependiendo del botón clicado
    //     if (button.hasClass('btn-plus')) {
    //         quantity++;
    //     } else {
    //         if (quantity > 1) {
    //             quantity--;
    //         } else {
    //             quantity = 1; // Establecer un mínimo de 1 para la cantidad
    //         }
    //     }
    
    //     // Establecer el nuevo valor de la cantidad en el input para este producto
    //     quantityInput.val(quantity);
    
    //     // Calcular el subtotal
    //     var subtotal = quantity * price;
    
    //     // Mostrar el nuevo subtotal en la fila del producto
    //     productContainer.find('.totalProducto p').text(subtotal.toFixed(3));
    
    //     // Actualizar el total sumando todos los subtotales de los productos en la tabla
    //     var totales = 0;
    //     var nuevoTotal = 0;
    //     $('.totalProducto p').each(function () {
    //         totales = nuevoTotal + subtotal;
    //     });
    
    //     // Mostrar el nuevo total en la interfaz
    //     $('#total').text('$' + totales.toFixed(3));
    
    //     // Enviar la nueva cantidad y el ID del producto al servidor
    //     $.ajax({
    //         type: 'POST',
    //         url: '../../Controllers/cargarCompra.php', // Cambia esto por la URL de tu archivo PHP que manejará la actualización del carrito
    //         data: { id_pro: productId, cantidad: quantity , totales: totales}, // Enviar el ID del producto y la nueva cantidad al servidor
    //         success: function(response) {
    //             // Manejar la respuesta del servidor si es necesario
    //             console.log(`Respuesta del servidor id: ${productId} y cantidad: ${quantity} con un precio de ${totales}`, response);
    //         },
    //         error: function(xhr, status, error) {
    //             // Manejar errores de la solicitud AJAX si es necesario
    //             console.error('Error en la solicitud AJAX:', error);
    //         }
    //     });
    // });
    
    

})(jQuery);

