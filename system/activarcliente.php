<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idcliente=$_POST['idcliente'];
$tipoe=$_POST['tipoe'];
$estado=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////
$consulta2 = "UPDATE cliente SET estadocliente= :estado, tipoatencion=:tipoe WHERE idcliente = :idcliente";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':idcliente',$idcliente,PDO::PARAM_INT);
$sql2->bindParam(':tipoe',$tipoe,PDO::PARAM_INT);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql2->execute(); 

?>