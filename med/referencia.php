<?php include("../template/cabecera1.php"); ?>
<?php
include("../base/bd.php");
$sentenciaSQL=$conexion->prepare("SELECT * FROM horarios"); 
$sentenciaSQL->execute();
$listaHorarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>


<?php foreach( $listaReferencia as $Referencia){ ?>

<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="img/<?php echo $Horarios['tipoTransporte']; ?>" alt="" width="150" height="200" aling= "left" />
    <div class="card-body">
        <h4 class="card-title"><?php echo $Referencia['destino']; ?></h4>
        <p>Hora de Salida: <?php echo $Referencia['horaSalida']; ?></p>
        <p>Hora de Regreso: <?php echo $Referencia['horaRegreso']; ?></p>
        <p>Fecha de salida: <?php echo $Referencia['fechaSalida']; ?></p>
        <p>Fecha de Regreso: <?php echo $Referencia['fechaRegreso']; ?></p>
        <p>Precio de viaje: <?php echo $Referencia['precio']; ?></p>
    </div>
    </div>
    </div>

<?php } ?>