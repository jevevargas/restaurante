<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$preciopla=$_POST['preciopla'];
$preciop=$_POST['preciop'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE plato
SET precioplato= :preciopla WHERE idplato = :preciop";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':preciopla',$preciopla,PDO::PARAM_STR);
$sql2->bindParam(':preciop',$preciop,PDO::PARAM_INT);


$sql2->execute(); 

?>