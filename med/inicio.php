<?php ob_start(); ?>
<?php include("../template/cabecera1.php");?>

<?php 
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtModelo = (isset($_POST['txtModelo'])) ? $_POST['txtModelo'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtCantidad = (isset($_POST['txtCantidad'])) ? $_POST['txtCantidad'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../base/bd.php");

switch($accion){

    case "Agregar":

        $sentenciaSQL = $conexion->prepare("INSERT INTO product (nombre, modelo, imagen, cantidad, precio) VALUES (:nombre, :modelo, :imagen, :cantidad, :precio)");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':modelo', $txtModelo);
        $sentenciaSQL->bindParam(':cantidad', $txtCantidad);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);

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
        $sentenciaSQL = $conexion->prepare("UPDATE product SET nombre=:nombre, modelo=:modelo, cantidad=:cantidad, precio=:precio WHERE id_producto=:id_producto"); 
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':modelo', $txtModelo);
        $sentenciaSQL->bindParam(':cantidad', $txtCantidad);
        $sentenciaSQL->bindParam(':precio', $txtPrecio);
        $sentenciaSQL->bindParam(':id_producto', $txtID);
        $sentenciaSQL->execute();
        
        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"];
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        
            move_uploaded_file($tmpImagen, "../img/" . $nombreArchivo);
        
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM product WHERE id_producto=:id_producto");
            $sentenciaSQL->bindParam(':id_producto', $txtID); 
            $sentenciaSQL->execute();
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
                
            if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
                if (file_exists("../img/" . $producto["imagen"])) {
                    unlink("../img/" . $producto["imagen"]);
                } 
            }
        
            $sentenciaSQL = $conexion->prepare("UPDATE product SET imagen=:imagen WHERE id_producto=:id_producto"); 
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id_producto', $txtID);
            $sentenciaSQL->execute();
        }
        
        break;
    
    case "Cancelar":
        header("Location:productos.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM product WHERE id_producto=:id_producto"); 
        $sentenciaSQL->bindParam(':id_producto', $txtID);
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $producto['nombre'];
        $txtModelo = $producto['modelo'];
        $txtImagen = $producto['imagen'];
        $txtCantidad = $producto['cantidad'];
        $txtPrecio = $producto['precio'];

        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM product WHERE id_producto=:id_producto");
        $sentenciaSQL->bindParam(':id_producto', $txtID); 
        $sentenciaSQL->execute();
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
            if (file_exists("../img/" . $producto["imagen"])) {
                unlink("../img/" . $producto["imagen"]);
            } 
        }
        
        $sentenciaSQL = $conexion->prepare("DELETE FROM product WHERE id_producto=:id_producto");
        $sentenciaSQL->bindParam(':id_producto', $txtID);
        $sentenciaSQL->execute();
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM product"); 
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Productos
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del producto">
                </div>

                <div class="form-group">
                    <label for="txtModelo">Modelo:</label>
                    <input type="text" class="form-control" value="<?php echo $txtModelo; ?>" name="txtModelo" id="txtModelo" placeholder="Modelo del producto">
                </div>

                <div class="form-group">
                    <label for="txtCantidad">Cantidad:</label>
                    <input type="text" class="form-control" value="<?php echo $txtCantidad; ?>" name="txtCantidad" id="txtCantidad" placeholder="Cantidad">
                </div>

                <div class="form-group">
                    <label for="txtPrecio">Precio:</label>
                    <input type="text" class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>
                    <?php if($txtImagen!=""){ ?>
                        <img class="img-thumbnail rounded" src="../img/<?php echo $txtImagen; ?>" width="50" />
                    <?php } ?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")? "disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")? "disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")? "disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProductos as $producto){ ?>
                <tr>
                    <td><?php echo $producto['id_producto'];?></td>
                    <td><?php echo $producto['nombre'];?></td>
                    <td><?php echo $producto['modelo'];?></td>
                    <td>
                        <img src="../img/<?php echo $producto['imagen'];?>" width="50" alt="" srcset="">
                    </td>
                    <td><?php echo $producto['cantidad'];?></td>
                    <td><?php echo $producto['precio'];?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id_producto'];?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie1.php");?>