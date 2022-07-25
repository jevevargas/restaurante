<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nome=$_POST['nome'];
$dire=$_POST['dire'];
$tele=$_POST['tele'];
$whate=$_POST['whate'];
$giroe=$_POST['giroe'];
$nite=$_POST['nite'];
$ncre=$_POST['ncre'];
$rese=$_POST['rese'];
$aue=$_POST['aue'];
$sere=$_POST['sere'];



////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////
$consulta2 = "UPDATE empresa
SET empresa= :nome, direccion= :dire,telefono= :tele, whatsapp= :whate, giro= :giroe, nit= :nite, ncr= :ncre, resolucion= :rese, autorizacion= :aue, serie= :sere";

$sql2 = $pdo->prepare($consulta2);


$sql2->bindParam(':nome',$nome,PDO::PARAM_STR);
$sql2->bindParam(':dire',$dire,PDO::PARAM_STR);
$sql2->bindParam(':tele',$tele,PDO::PARAM_STR);
$sql2->bindParam(':whate',$whate,PDO::PARAM_STR);
$sql2->bindParam(':giroe',$giroe,PDO::PARAM_STR);
$sql2->bindParam(':nite',$nite,PDO::PARAM_STR);
$sql2->bindParam(':ncre',$ncre,PDO::PARAM_STR);
$sql2->bindParam(':rese',$rese,PDO::PARAM_STR);
$sql2->bindParam(':aue',$aue,PDO::PARAM_STR);
$sql2->bindParam(':sere',$sere,PDO::PARAM_STR);


$sql2->execute(); 

?>