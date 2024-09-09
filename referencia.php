<?php include("template/cabecera.php"); ?>

<?php 
$txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
$txtUsuario = (isset($_POST['txtUsuario'])) ? $_POST['txtUsuario'] : "";
$txtCargo = (isset($_POST['txtCargo'])) ? $_POST['txtCargo'] : "";
$txtComentario = (isset($_POST['txtComentario'])) ? $_POST['txtComentario'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

$mensaje = ''; // Variable para el mensaje de éxito

include("base/bd.php");

switch($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO referencia (Usuario, Cargo, Comentario, Imagen) VALUES (:Usuario, :Cargo, :Comentario, :Imagen)");
        $sentenciaSQL->bindParam(':Usuario', $txtUsuario);
        $sentenciaSQL->bindParam(':Cargo', $txtCargo);
        $sentenciaSQL->bindParam(':Comentario', $txtComentario);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        
        $mensaje = "Agregado exitosamente"; // Mensaje de éxito
        break;
    
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE referencia SET Usuario=:Usuario, Cargo=:Cargo, Comentario=:Comentario WHERE Id=:Id"); 
        $sentenciaSQL->bindParam(':Usuario', $txtUsuario);
        $sentenciaSQL->bindParam(':Cargo', $txtCargo);
        $sentenciaSQL->bindParam(':Comentario', $txtComentario);
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
    
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "img/" . $nombreArchivo);
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM referencia WHERE Id=:Id");
            $sentenciaSQL->bindParam(':Id', $txtId); 
            $sentenciaSQL->execute();
            $referencia = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            if (isset($referencia["Imagen"]) && ($referencia["Imagen"] != "imagen.jpg")) {
                if (file_exists("img/" . $referencia["Imagen"])) {
                    unlink("img/" . $referencia["Imagen"]);
                } 
            }

            $sentenciaSQL = $conexion->prepare("UPDATE referencia SET Imagen=:Imagen WHERE Id=:Id"); 
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':Id', $txtId);
            $sentenciaSQL->execute();
        }
        
        $mensaje = "Modificado exitosamente"; // Mensaje de éxito
        break;

    case "Cancelar":
        header("Location:referencia.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM referencia WHERE Id=:Id"); 
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();
        $referencia = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtUsuario = $referencia['Usuario'];
        $txtCargo = $referencia['Cargo'];
        $txtComentario = $referencia['Comentario'];
        $txtImagen = $referencia['Imagen'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM referencia WHERE Id=:Id");
        $sentenciaSQL->bindParam(':Id', $txtId);
        $sentenciaSQL->execute();

        $mensaje = "Eliminado exitosamente"; // Mensaje de éxito
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM referencia"); 
$sentenciaSQL->execute();
$listaReferencia = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($mensaje): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>

<div class="col-md-5 mb-2">
    <div class="card">
        <div class="card-header">
            Comentarios
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtUsuario">Usuario:</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($txtUsuario); ?>" name="txtUsuario" id="txtUsuario" placeholder="Nombre de Usuario">
                </div>

                <div class="form-group">
                    <label for="txtCargo">Cargo:</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($txtCargo); ?>" name="txtCargo" id="txtCargo" placeholder="Cargo que Ocupa">
                </div>

                <div class="form-group">
                    <label for="txtComentario">Comentario:</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($txtComentario); ?>" name="txtComentario" id="txtComentario" placeholder="Escriba su comentario">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>
                    <?php if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="img/<?php echo htmlspecialchars($txtImagen); ?>" width="50" />
                    <?php } ?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
    <?php foreach($listaReferencia as $Referencia) { ?>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
            <img class="card-img-top" src="img/<?php echo htmlspecialchars($Referencia['Imagen']); ?>" alt="" />
                <div class="card-body d-flex flex-column">
                <h4 class="card-title"><?php echo htmlspecialchars($Referencia['Usuario']); ?></h4>
                <p>Cargo: <?php echo htmlspecialchars($Referencia['Cargo']); ?></p>
                <p><?php echo htmlspecialchars($Referencia['Comentario']); ?></p>
                <div class="mt-auto">
                    
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<br><br><br><br>




<?php include("template/pie.php"); ?>