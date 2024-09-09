<?php
$host = "localhost";
$bd = "transportes";
$usuario = "root";
$contraseña = "danigero"; // Deja vacío si no has configurado una contraseña

try {
    $dsn = "mysql:host=$host;dbname=$bd";
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>