<?php
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$imppago=$_POST['imppago'];
$estado='1';

////// Fin informacion enviada por el formulario ///
include('../config/conexion.php');
////////////// Actualizar la tabla /////////
$consulta = "UPDATE venta
SET addfactura= :estado WHERE orden = :imppago ";


$sql = $pdo->prepare($consulta);

$sql->bindParam(':estado',$estado,PDO::PARAM_STR);
$sql->bindParam(':imppago',$imppago,PDO::PARAM_STR);


$sql->execute();    

?>