<?php
$id=$_POST['val']; //echo $id;
$estado='1';

include('../config/conexion.php');
////////////// Actualizar la tabla /////////
$consulta = "UPDATE venta
SET checkfact= :estado WHERE idventa = :id";

$sql = $pdo->prepare($consulta);
$sql->bindParam(':id',$id,PDO::PARAM_STR);
$sql->bindParam(':estado',$estado,PDO::PARAM_STR);


$sql->execute(); 

?>