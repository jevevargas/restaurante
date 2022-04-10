<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$totalorden=$_POST['totalorden'];
$estado=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE venta
SET acocina= :estado, impresion=:estado WHERE orden = :totalorden";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':totalorden',$totalorden,PDO::PARAM_INT);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);


$sql2->execute(); 

?>