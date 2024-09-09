
<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:../index.php");
  exit();
} else if ($_SESSION['usuario'] == 'ok') {
  $nombreUsuario = $_SESSION['nombreUsuario'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>TECH-ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/bootstrap.min.css"/> <!-- Corrección en el nombre del archivo -->
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
            font-size: 2.1rem; /* Tamaño de fuente aumentado */
            padding: 20px 40px; /* Aumento del espacio interno del botón */
        }

        .btn-custom:hover {
            background-color: #fff; /* Color de fondo blanco al pasar el ratón */
            color: #ff5733; /* Color de texto naranja al pasar el ratón */
            border-color: #ff5733; /* Borde naranja */
        }
    </style>
</head>
<body>

<?php 
$url = "http://" . $_SERVER['HTTP_HOST'] . ""; // Ajusta la URL base según la estructura de carpetas de tu proyecto
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/med/productos.php">
                    <img class="logoweb" src="/img/logo.png" alt="Logo">
                </a>
            </li>
            <li class="nav-item">
                <a class="btn btn-custom" href="<?php echo $url; ?>/med/productos.php">INICIO</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-custom" href="<?php echo $url; ?>/med/reservar.php">PREGUNTAS FRECUENTES</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-custom" href="<?php echo $url; ?>/med/cerrar.php">CERRAR</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-custom" href="<?php echo $url; ?>/mostrar.php">SITIO WEB</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <br>
</div>

<!-- Scripts necesarios para Bootstrap y WOW.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow.js/1.1.2/wow.min.js"></script>
<script>
    new WOW().init(); // Inicializa WOW.js
</script>