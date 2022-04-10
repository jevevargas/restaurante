<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nombree=$_POST['nombree'];
$duie=$_POST['duie'];
$telefonoe=$_POST['telefonoe'];
$direccione=$_POST['direccione'];
$idcliente=$_POST['idcliente'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE cliente
SET nomcliente= :nombree, direccioncliente=:direccione, telefonocliente=:telefonoe, dui=:duie WHERE idcliente = :idcliente";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':nombree',$nombree,PDO::PARAM_STR);
$sql2->bindParam(':direccione',$direccione,PDO::PARAM_STR);
$sql2->bindParam(':telefonoe',$telefonoe,PDO::PARAM_STR);
$sql2->bindParam(':duie',$duie,PDO::PARAM_STR);
$sql2->bindParam(':idcliente',$idcliente,PDO::PARAM_INT);

$sql2->execute(); 

?>