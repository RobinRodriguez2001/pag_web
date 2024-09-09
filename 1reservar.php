<?php include("../template/cabecera1.php"); ?>
<?php
include("../base/bd.php");
$sentenciaSQL=$conexion->prepare("SELECT * FROM reservar"); 
$sentenciaSQL->execute();
$listaReservar=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>


<?php foreach( $listaReservar as $reservar){ ?>

<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="../img/<?php echo $reservar['TipoTransporte']; ?>" alt="" width="150" height="200" aling= "left" />
    <div class="card-body">
        <h4 class="card-title"><?php echo $reservar['Destino']; ?></h4>
        <p>No. DE PASAJEROS: <?php echo $reservar['No_pasajeros']; ?></p>
        <p>COMENTARIO: <?php echo $reservar['Comentario']; ?></p>
    </div>
    </div>
    </div>

<?php } ?>