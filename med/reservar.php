<?php ob_start(); ?>

<?php include("../template/cabecera1.php"); ?>
<?php 

$txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
$txtUsuario = (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : "";
$txtCargo = (isset($_POST['txtCargo'])) ? $_POST['txtCargo'] : "";
$txtComentario = (isset($_POST['txtComentario'])) ? $_POST['txtComentario'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../base/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO referencia (Usuario, Cargo, Comentario, Imagen) VALUES (:usuario, :cargo, :comentario, :imagen)");
        $sentenciaSQL->bindParam(':usuario', $txtUsuario);
        $sentenciaSQL->bindParam(':cargo', $txtCargo);
        $sentenciaSQL->bindParam(':comentario', $txtComentario);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../img/" . $nombreArchivo);   
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        break;
    
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE referencia SET Usuario = :usuario, Cargo = :cargo, Comentario = :comentario WHERE Id = :Id"); 
        $sentenciaSQL->bindParam(':usuario', $txtUsuario);
        $sentenciaSQL->bindParam(':cargo', $txtCargo);
        $sentenciaSQL->bindParam(':comentario', $txtComentario);
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"];
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM tabla_referencia WHERE Id = :Id");
            $sentenciaSQL->bindParam(':Id', $txtId);
            $sentenciaSQL->execute();
            $registro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($registro["Imagen"]) && ($registro["Imagen"] != "imagen.jpg")) {
                if (file_exists("../img/" . $registro["Imagen"])) {
                    unlink("../img/" . $registro["Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE referencia SET Imagen = :imagen WHERE Id = :Id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':Id', $txtId);
            $sentenciaSQL->execute();
        }
        break;

    case "Cancelar":
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM referencia WHERE Id = :Id"); 
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        $registro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtUsuario = $registro['Usuario'];
        $txtCargo = $registro['Cargo'];
        $txtComentario = $registro['Comentario'];
        $txtImagen = $registro['Imagen'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM referencia WHERE Id = :Id");
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        $registro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($registro["Imagen"]) && ($registro["Imagen"] != "imagen.jpg")) {
            if (file_exists("../img/" . $registro["Imagen"])) {
                unlink("../img/" . $registro["Imagen"]);
            }
        }
        
        $sentenciaSQL = $conexion->prepare("DELETE FROM referencia WHERE Id = :Id");
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM referencia"); 
$sentenciaSQL->execute();
$listaRegistros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            REGISTRO
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtId">ID:</label>
                    <input required type="text" readonly class="form-control" value="<?php echo $txtId; ?>" name="txtId" id="txtId" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtUsuario">Usuario:</label>
                    <input required type="text" class="form-control" value="<?php echo $txtUsuario; ?>" name="txtUsuario" id="txtUsuario" placeholder="Usuario">
                </div>

                <div class="form-group">
                    <label for="txtCargo">Cargo:</label>
                    <input required type="text" class="form-control" value="<?php echo $txtCargo; ?>" name="txtCargo" id="txtCargo" placeholder="Cargo">
                </div>

                <div class="form-group">
                    <label for="txtComentario">Comentario:</label>
                    <input required type="text" class="form-control" value="<?php echo $txtComentario; ?>" name="txtComentario" id="txtComentario" placeholder="Comentario">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>
                    <?php if($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../img/<?php echo $txtImagen; ?>" width="50" />
                    <?php } ?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
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
                <th>Usuario</th>
                <th>Cargo</th>
                <th>Comentario</th>
                <th>Imagen</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaRegistros as $registro) { ?>
            <tr>
                <td><?php echo $registro['Id']; ?></td>
                <td><?php echo $registro['Usuario']; ?></td>
                <td><?php echo $registro['Cargo']; ?></td>
                <td><?php echo $registro['Comentario']; ?></td>
                <td><img src="../img/<?php echo $registro['Imagen']; ?>" width="75"/></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtId" value="<?php echo $registro['Id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                    </form>

                    <form method="post" style="display:inline;">
                        <input type="hidden" name="txtId" value="<?php echo $registro['Id']; ?>"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php"); ?>