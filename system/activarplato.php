<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$desacti=$_POST['desacti'];
$estado=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE plato
SET estadoplato= :estado WHERE idplato = :desacti";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql2->bindParam(':desacti',$desacti,PDO::PARAM_INT);


$sql2->execute(); 

?>