<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$ap=$_POST['ap'];
$metodo=$_POST['metodo'];
$fecha=date('Y-m-d H:i:s');
$estado=2;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE pago
SET tipopagocre= :metodo, fechapagocre=:fecha, pendiente=:estado WHERE idpago = :ap";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':ap',$ap,PDO::PARAM_INT);
$sql2->bindParam(':metodo',$metodo,PDO::PARAM_INT);
$sql2->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql2->execute(); 

?>