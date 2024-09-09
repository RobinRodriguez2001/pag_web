<?php 
session_start();
session_destroy();
header("Location: ../mostrar.php");
exit();
?>