<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Tech</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        h1, h2 {
            color: #333;
        }

        .cabecera {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        .cabecera h1 {
            margin: 0;
            font-size: 36px;
        }

        /* Estilos del apartado de contacto */
        .contacto {
            background-color: #f4f4f4;
            padding: 50px 0;
            text-align: center;
        }

        .contacto-contenedor {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contacto h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .contacto p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            background-color: #25D366;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-whatsapp:hover {
            background-color: #1EBF57;
        }

        .whatsapp-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <?php include 'template/cabecera.php'; ?>

    <!-- Sección sobre la empresa -->
    <section class="sobre-empresa">
        <div class="container">
            <h2>Sobre Tech</h2>
            <p>En <strong>Tech</strong>, nos especializamos en ofrecer las últimas tecnologías y las mejores soluciones en computadoras. Nuestro objetivo es proporcionar productos de alta calidad y un servicio excepcional a nuestros clientes, asegurando que encuentren exactamente lo que necesitan para sus proyectos personales o empresariales.</p>
            <p>Ofrecemos una amplia gama de productos que incluye computadoras de escritorio, portátiles, componentes de hardware, y accesorios tecnológicos de las marcas más reconocidas del mercado. Nuestro equipo de expertos está siempre listo para asesorarte y ayudarte a elegir la mejor opción según tus necesidades.</p>
            <p>Con años de experiencia en la industria, nos enorgullecemos de ser un proveedor confiable para empresas y usuarios individuales que buscan productos tecnológicos de alta calidad. ¡Estamos aquí para ayudarte a crecer con la tecnología más avanzada!</p>
        </div>
    </section>

    <!-- Sección de contacto -->
    <section class="contacto">
        <div class="contacto-contenedor">
            <h2>Contacto</h2>
            <p>¿Tienes alguna pregunta o necesitas asesoría? ¡Estamos aquí para ayudarte! Puedes contactarnos a través de WhatsApp o enviarnos un correo electrónico para recibir asistencia personalizada.</p>
            <a href="https://api.whatsapp.com/send?phone=+521234567890&text=Hola,%20tengo%20una%20pregunta%20sobre%20los%20productos%20de%20Tech" class="btn-whatsapp">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp Logo" class="whatsapp-icon">
                Contáctanos por WhatsApp
            </a>
            <p>O envíanos un correo a <a href="mailto:contacto@tech.com">contacto@tech.com</a></p>
        </div>
    </section>

    <!-- Sección de ubicación -->
    <section class="ubicacion">
        <div class="container">
            <h2>Ubicación</h2>
            <p>Nos encontramos en el corazón de la ciudad, en un lugar accesible y bien comunicado.</p>
            <p>Dirección: Calle Tecnología 123, Ciudad Tech, CP 45678</p>
            <p>Horario de atención: Lunes a Viernes, de 9:00 AM a 6:00 PM</p>
        </div>
        </br>   </br>   </br>   </br>   </br>
    </section>

    <?php include 'template/pie.php'; ?>

    