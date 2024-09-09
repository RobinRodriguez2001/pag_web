<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/styles.css"/>
    <link rel="stylesheet" href="./css/noticias.css"/>

    <style>
        .navbar {
            background-color: #ff5733; /* Color llamativo */
        }

        .navbar-nav .nav-link {
            color: #fff !important; /* Color blanco para las letras de los enlaces */
        }

        .navbar-nav .nav-link:hover {
            color: #323 !important; /* Color oscuro al pasar el ratón sobre el enlace */
        }

        .navbar-toggler-icon {
            background-color: #fff; /* Color blanco para el icono del menú */
        }

        .form-control, .btn {
            border-radius: 0.25rem;
        }

        .form-control {
            color: #333;
        }

        .btn-outline-light {
            color: #fff;
            border-color: #fff;
        }

        .btn-outline-light:hover {
            color: #ff5733;
            background-color: #fff;
            border-color: #ff5733;
        }

        .logoweb {
            max-width: 120px; /* Tamaño máximo ancho */
            height: auto;     /* Mantiene la proporción del logo */
            display: block;   /* Asegura que la imagen sea un bloque */
        }

        .btn-custom {
            background-color: #ff5733; /* Color de fondo naranja */
            color: #fff; /* Color de texto blanco */
            border: 2px solid #ff5733; /* Borde naranja */
            border-radius: 0.25rem; /* Borde redondeado */
            font-size: 1.5rem; /* Tamaño de fuente adaptado */
            padding: 10px 20px; /* Espacio interno del botón adaptado */
            text-align: center; /* Alineación centrada del texto */
            display: block; /* Asegura que cada botón esté en su propia línea */
            width: 100%; /* Botones ocuparán todo el ancho del contenedor */
            margin-bottom: 10px; /* Margen inferior para espacio entre botones */
        }

        .btn-custom:hover {
            background-color: #fff; /* Color de fondo blanco al pasar el ratón */
            color: #ff5733; /* Color de texto naranja al pasar el ratón */
            border-color: #ff5733; /* Borde naranja */
        }

        /* Para pantallas grandes, los botones se muestran en línea */
        @media (min-width: 768px) {
            .btn-custom {
                display: inline-block;
                width: auto; /* Los botones ocupan solo el espacio necesario */
                margin-bottom: 0; /* Elimina margen inferior entre botones */
            }
        }

        .titulo-principal {
            text-align: center;      /* Centra el texto */
            font-size: 48px;         /* Ajusta el tamaño de la fuente a 48px */
            font-weight: bold;       /* Hace que el texto sea negrita */
            margin-top: 20px;        /* Añade un margen superior */
            color: #333;             /* Cambia el color del texto */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="admin/login.php">
                        <img class="logoweb" src="img/logo.png" alt="Logo">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-custom" href="mostrar.php">INICIO</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-custom" href="nosotros1.php">NOSOTROS</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-custom" href="contacto.php">CONTACTO</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-custom" href="referencia.php">PREGUNTAS FRECUENTES</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-custom" href="redes_sociales.php">REDES SOCIALES</a>
                </li>
            </ul>
        </div>
    </nav>

    

    <!-- Scripts necesarios para Bootstrap y WOW.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow.js/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init(); // Inicializa WOW.js
    </script>