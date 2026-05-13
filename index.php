<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Carrusel - Sustitución AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Contenedor principal sin transiciones */
        #contenedor-ajax {
            min-height: 550px;
            background-color: #222;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: none !important; /* BLOQUEA CUALQUIER ANIMACIÓN */
        }

        .img-sustituida {
            height: 550px;
            width: 100%;
            object-fit: cover;
            display: block; /* Evita que Bootstrap intente animarla como item de carrusel */
        }

        .btn-admin { position: fixed; bottom: 20px; right: 20px; z-index: 1000; }
    </style>
</head>
<body class="bg-light">

<a href="admin.php" class="btn btn-dark btn-admin shadow">⚙️ Panel de Control</a>

<div class="container mt-5">
    <h2 class="text-center mb-4">carrusel</h2>

    <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
        <div id="contenedor-ajax">
            <div class="text-white p-5">Iniciando conexión con el servidor...</div>
        </div>

        <div class="d-flex justify-content-between p-3 bg-white border-top">
            <button class="btn btn-primary px-4" id="btn-prev">⬅️ Anterior</button>
            <div class="text-center">
                <span id="contador" class="badge bg-secondary mb-1">Cargando...</span>
                <div id="nombre-foto" class="fw-bold d-block"></div>
            </div>
            <button class="btn btn-primary px-4" id="btn-next">Siguiente ➡️</button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let idActual = 0;

    function pedirImagen(accion) {
        $.ajax({
            url: 'get_imagenes.php',
            type: 'GET',
            dataType: 'json',
            data: { accion: accion, id_actual: idActual },
            success: function(foto) {
                if (!foto) return;
                idActual = foto.id;

                const timestamp = new Date().getTime();
                $('#contenedor-ajax').empty();
                $('#contenedor-ajax').append(`
                    <img src="${foto.ruta}"
                         id="img-node-${timestamp}"
                         class="img-sustituida"
                         alt="${foto.nombre}">
                                  alt="${foto.nombre}">
                `);
                $('#nombre-foto').text(foto.nombre);
                $('#contador').text(`ID: ${foto.id}`);
            },
            error: function() {
                $('#contenedor-ajax').html('<div class="text-danger p-5">Error del servidor.</div>');
            }
        });
    }

    $('#btn-next').click(function() {
        pedirImagen('siguiente');
    });

    $('#btn-prev').click(function() {
        pedirImagen('anterior');
    });

    // Carga solo la primera imagen
    pedirImagen('inicio');
});
</script>

</body>
</html>
