<?php include("../template/cabecera1.php");?>

<?php 
$txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtTipo = (isset($_POST['txtTipo'])) ? $_POST['txtTipo'] : "";
$txtContenido = (isset($_POST['txtContenido'])) ? $_POST['txtContenido'] : "";
$txtFecha = (isset($_POST['txtFecha'])) ? $_POST['txtFecha'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../base/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO posts (titulo, tipo, contenido, fecha) VALUES (:titulo, :tipo, :contenido, NOW())");
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':tipo', $txtTipo);
        $sentenciaSQL->bindParam(':contenido', $txtContenido);
        $sentenciaSQL->execute();
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE posts SET titulo=:titulo, tipo=:tipo, contenido=:contenido WHERE id=:Id"); 
        $sentenciaSQL->bindParam(':titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':tipo', $txtTipo);
        $sentenciaSQL->bindParam(':contenido', $txtContenido);
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        break;

    case "Cancelar":
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM posts WHERE id=:Id"); 
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        $contenido = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtTitulo = $contenido['titulo'];
        $txtTipo = $contenido['tipo'];
        $txtContenido = $contenido['contenido'];
        $txtFecha = $contenido['fecha'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM posts WHERE id=:Id");
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM posts"); 
$sentenciaSQL->execute();
$listaContenido = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            CONTENIDO
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="txtId">ID:</label>
                    <input type="text" readonly class="form-control" value="<?php echo $txtId; ?>" name="txtId" id="txtId" placeholder="ID del contenido">
                </div>

                <div class="form-group">
                    <label for="txtTitulo">Título:</label>
                    <input type="text" class="form-control" value="<?php echo $txtTitulo; ?>" name="txtTitulo" id="txtTitulo" placeholder="Título del contenido">
                </div>

                <div class="form-group">
                    <label for="txtTipo">Tipo:</label>
                    <input type="text" class="form-control" value="<?php echo $txtTipo; ?>" name="txtTipo" id="txtTipo" placeholder="Tipo de contenido">
                </div>

                <div class="form-group">
                    <label for="txtContenido">Contenido:</label>
                    <textarea class="form-control" name="txtContenido" id="txtContenido" placeholder="Contenido"><?php echo $txtContenido; ?></textarea>
                </div>

                <div class="btn-group" role="group">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?>>Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?>>Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-8">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Contenido</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaContenido as $contenido) { ?>
                <tr>
                    <td><?php echo $contenido['id']; ?></td>
                    <td><?php echo $contenido['titulo']; ?></td>
                    <td><?php echo $contenido['tipo']; ?></td>
                    <td><?php echo $contenido['contenido']; ?></td>
                    <td><?php echo $contenido['fecha']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtId" value="<?php echo $contenido['id']; ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie1.php");?>