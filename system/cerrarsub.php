<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idclientesub=$_POST['idclientesub'];
$estado=0;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE clientesub
SET estadoclientesub= :estado WHERE idclientesub = :idclientesub";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':idclientesub',$idclientesub,PDO::PARAM_INT);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);


$sql2->execute(); 

?>