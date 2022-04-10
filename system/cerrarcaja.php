<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idc=$_POST['idc'];
$idcu=$_POST['idcu'];

$dia=date('Y-m-d H:i:s');
$estado=0;

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "UPDATE sistema
SET fechafinal= :dia WHERE idusuario = :idc";

$consulta1 = "UPDATE caja
SET estadocaja= :estado WHERE idusuario = :idc";

$consulta2 = "UPDATE sistema
SET estadosistema= :estado WHERE idusuario = :idc";

$consulta3 = "UPDATE cuadre
SET estadocierre= :estado WHERE idcuadre = :idcu";



$sql = $pdo->prepare($consulta);
$sql1 = $pdo->prepare($consulta1);
$sql2 = $pdo->prepare($consulta2);
$sql3 = $pdo->prepare($consulta3);

$sql->bindParam(':dia',$dia,PDO::PARAM_STR);
$sql->bindParam(':idc',$idc,PDO::PARAM_INT);

$sql1->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql1->bindParam(':idc',$idc,PDO::PARAM_INT);

$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql2->bindParam(':idc',$idc,PDO::PARAM_INT);

$sql3->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql3->bindParam(':idcu',$idcu,PDO::PARAM_INT);

$sql->execute(); 
$sql1->execute();
$sql2->execute();
$sql3->execute();
?>