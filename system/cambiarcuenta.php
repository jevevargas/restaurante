<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$ordencambio=$_POST['ordencambio'];
$idmesacambio=$_POST['idmesacambio'];
$mesa=$_POST['mesac'];
$nomcli=$_POST['nomcli'];
$estadomesa=0;
$estadomesa2=1;
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta = "UPDATE orden
SET idmesa=:mesa WHERE orden = :ordencambio";

//activa la mesa
$consulta2 = "UPDATE mesa
SET estadomesa= :estadomesa2 WHERE idmesa = :mesa ";

//desactiva la mesa
$consulta3 = "UPDATE mesa
SET estadomesa= :estadomesa WHERE idmesa = :idmesacambio";

$consulta4 = "UPDATE cliente
SET idmesa= :mesa WHERE idcliente = :nomcli";


$sql = $pdo->prepare($consulta);
$sql2 = $pdo->prepare($consulta2);
$sql3 = $pdo->prepare($consulta3);
$sql4 = $pdo->prepare($consulta4); 

$sql->bindParam(':mesa',$mesa,PDO::PARAM_INT);
$sql->bindParam(':ordencambio',$ordencambio,PDO::PARAM_INT);

 $sql2->bindParam(':estadomesa2',$estadomesa2,PDO::PARAM_INT);
 $sql2->bindParam(':mesa',$mesa,PDO::PARAM_INT);

 $sql3->bindParam(':estadomesa',$estadomesa,PDO::PARAM_INT);
 $sql3->bindParam(':idmesacambio',$idmesacambio,PDO::PARAM_INT);

 $sql4->bindParam(':mesa',$mesa,PDO::PARAM_INT);
 $sql4->bindParam(':nomcli',$nomcli,PDO::PARAM_INT);

$sql->execute(); 
 $sql2->execute(); 
 $sql3->execute(); 
 $sql4->execute(); 

?>