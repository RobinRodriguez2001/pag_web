<?php include("template/cabecera.php"); ?>
<?php
include("base/bd.php");

$mensaje = '';

// Número de productos a mostrar por página
$productosPorPagina = 9;

// Obtener el número de la página actual
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($paginaActual < 1) $paginaActual = 1;

// Calcular el OFFSET para la consulta SQL
$offset = ($paginaActual - 1) * $productosPorPagina;

// Consultar el número total de productos
$sentenciaSQL = $conexion->prepare("SELECT COUNT(*) as total FROM product");
$sentenciaSQL->execute();
$totalProductos = $sentenciaSQL->fetch(PDO::FETCH_ASSOC)['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalProductos / $productosPorPagina);

// Consulta para obtener los productos de la página actual
$sentenciaSQL = $conexion->prepare("SELECT * FROM product LIMIT :limit OFFSET :offset");
$sentenciaSQL->bindParam(':limit', $productosPorPagina, PDO::PARAM_INT);
$sentenciaSQL->bindParam(':offset', $offset, PDO::PARAM_INT);
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <h1 class="titulo-principal">Bienvenidos a TECH</h1>
        <br>
    </div>

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
                <img class="card-img-top img-fluid" src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                    <p>Modelo: <?php echo htmlspecialchars($producto['modelo']); ?></p>
                    <p>Cantidad disponible: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                    <p>Precio: Q. <?php echo htmlspecialchars($producto['precio']); ?></p>
                    <div class="mt-auto">
                        <div class="btn-group" role="group" aria-label="">
                            <a href="https://wa.me/55318675?text=Hola%2C%20quiero%20comprar%20el%20producto%20<?php echo urlencode(htmlspecialchars($producto['nombre'])); ?>.%20Por%20favor%20proporci%C3%B3name%20m%C3%A1s%20informaci%C3%B3n.%20Gracias!" class="btn btn-primary" target="_blank">Comprar</a>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#infoModal<?php echo $producto['id_producto']; ?>">
                                Más información
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="infoModal<?php echo $producto['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel<?php echo $producto['id_producto']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel<?php echo htmlspecialchars($producto['nombre']); ?>"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img class="img-fluid" src="img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                        <p>Modelo: <?php echo htmlspecialchars($producto['modelo']); ?></p>
                        <p>Cantidad disponible: <?php echo htmlspecialchars($producto['cantidad']); ?></p>
                        <p>Precio: Q. <?php echo htmlspecialchars($producto['precio']); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Navegación entre páginas -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if($paginaActual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $paginaActual - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php if($paginaActual == $i) echo 'active'; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if($paginaActual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $paginaActual + 1; ?>" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<br><br><br><br>
<?php include("template/pie.php"); ?>