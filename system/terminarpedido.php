<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idcli=$_POST['idcli'];
$orden=$_POST['orden'];
$pago=$_POST['pago'];
$tipopago=$_POST['tipopago'];
$fechacorta=date('Y-m-d');
$fechalarga=date('Y-m-d H:i:s');
$idu=$_SESSION['idusuario'];
$estado = '1';
$estado2 = '0';
$estado3 = '2';
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into pago(totalpago,orden,fechapago,fechapago2,idusuario,tipopago,idcliente) 
values
(:pago,:orden,:fechacorta,:fechalarga,:idu,:tipopago,:idcli)";


$consulta1 = "UPDATE venta
SET estadoorden= :estado WHERE orden = :orden";

$consulta2 = "UPDATE orden
SET estadoorden= :estado2 WHERE orden = :orden";

$consulta3 = "UPDATE cliente
SET estadocliente= :estado2 WHERE idcliente = :idcli";


$sql = $pdo->prepare($consulta);
$sql1 = $pdo->prepare($consulta1);
$sql2 = $pdo->prepare($consulta2);
$sql3 = $pdo->prepare($consulta3);

$sql->bindParam(':pago',$pago,PDO::PARAM_STR);
$sql->bindParam(':orden',$orden,PDO::PARAM_INT);
$sql->bindParam(':fechacorta',$fechacorta,PDO::PARAM_STR);
$sql->bindParam(':fechalarga',$fechalarga,PDO::PARAM_STR);
$sql->bindParam(':idu',$idu,PDO::PARAM_INT);
$sql->bindParam(':tipopago',$tipopago,PDO::PARAM_INT);
$sql->bindParam(':idcli',$idcli,PDO::PARAM_INT);

$sql1->bindParam(':orden',$orden,PDO::PARAM_INT);
$sql1->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql2->bindParam(':orden',$orden,PDO::PARAM_INT);
$sql2->bindParam(':estado2',$estado2,PDO::PARAM_INT);

$sql3->bindParam(':idcli',$idcli,PDO::PARAM_INT);
$sql3->bindParam(':estado2',$estado2,PDO::PARAM_INT);

$sql->execute();
$sql1->execute(); 
$sql2->execute(); 
$sql3->execute(); 
?>