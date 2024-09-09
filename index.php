<?php include("template/cabecera.php"); ?>
<?php
include("base/bd.php");

$mensaje = '';

// Cambiar la consulta a la tabla `product` para mostrar los productos
$sentenciaSQL = $conexion->prepare("SELECT * FROM product"); 
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="titulo-principal">BIENVENIDOS A TECH</h1>
<div class="container">
    <?php if ($mensaje): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php foreach($listaProductos as $producto) { ?>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <!-- Mostrar la imagen del producto -->
                <img class="card-img-top img-fluid" src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                <div class="card-body d-flex flex-column">
                    <!-- Mostrar el nombre del producto -->
                    <h4 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                    <p>Modelo: <?php echo htmlspecialchars($producto['modelo']); ?></p>
                    <p>Cantidad disponible: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                    <p>Precio: $<?php echo htmlspecialchars($producto['precio']); ?></p>
                    <div class="mt-auto">
                        <div class="btn-group" role="group" aria-label="">
                            <!-- Enlace para comprar (redireccionado a WhatsApp) -->
                            <a href="https://wa.me/33783177?text=Hola%2C%20quiero%20comprar%20el%20producto%20<?php echo urlencode(htmlspecialchars($producto['nombre'])); ?>.%20Por%20favor%20proporci%C3%B3name%20m%C3%A1s%20informaci%C3%B3n.%20Gracias!" class="btn btn-primary" target="_blank">Comprar</a>
                            <!-- Botón para ver más información -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal<?php echo $producto['id_producto']; ?>">
                                Más información
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="infoModal<?php echo $producto['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel<?php echo $producto['id_producto']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel<?php echo $producto['id_producto']; ?>"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img class="img-fluid" src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                        <p>Modelo: <?php echo htmlspecialchars($producto['modelo']); ?></p>
                        <p>Cantidad disponible: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                        <p>Precio: $<?php echo htmlspecialchars($producto['precio']); ?></p>
                        <!-- Aquí puedes añadir más detalles si es necesario -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php include("template/pie.php"); ?>