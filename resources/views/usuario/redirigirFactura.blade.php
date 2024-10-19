<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo...</title>
    <script>
        window.onload = function() {
            // Obtener la URL del PDF y la URL de redirección desde las variables de PHP
            var pdfUrl = "{{ $pdfUrl }}";
            var redirectUrl = "{{ $redirectUrl }}";

            // Abrir el PDF en una nueva ventana
            window.open(pdfUrl, '_blank');

            // Redirigir a la URL de perfilRol después de un breve retraso
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, 0000); // 2 segundos de retraso
        }
    </script>
</head>
<body>
</body>
</html>
