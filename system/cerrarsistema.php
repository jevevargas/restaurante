<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////

$estado='0';
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "DELETE FROM  orden ";

$consulta6 = "ALTER TABLE orden AUTO_INCREMENT=1; ";


$consulta1 = "UPDATE caja SET estadocaja= :estado ";

$consulta2 = "UPDATE cliente SET estadocliente= :estado ";

$consulta3 = "UPDATE cuadre SET estadocierre= :estado";

$consulta4 = "UPDATE mesa SET estadomesa= :estado";

$consulta5 = "UPDATE sistema SET estadosistema= :estado";

$consulta7 = "UPDATE clientesub SET estadoclientesub= :estado";

$sql = $pdo->prepare($consulta);
$sql1 = $pdo->prepare($consulta1);
$sql2 = $pdo->prepare($consulta2);
$sql3 = $pdo->prepare($consulta3);
$sql4 = $pdo->prepare($consulta4);
$sql5 = $pdo->prepare($consulta5);
$sql6 = $pdo->prepare($consulta6);
$sql7 = $pdo->prepare($consulta7);

$sql1->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql3->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql4->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql5->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql7->bindParam(':estado',$estado,PDO::PARAM_INT);


$sql->execute(); 
$sql1->execute();
$sql2->execute();
$sql3->execute();
$sql4->execute();
$sql5->execute();
$sql6->execute();
$sql7->execute();
?>