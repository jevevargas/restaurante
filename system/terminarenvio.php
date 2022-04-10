<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$ordenmixto=$_POST['ordenmixto'];
$idmesa=$_POST['idmesa'];
$idcli=$_POST['idcli'];
$tipopago=$_POST['tipopago'];
$totalpago=$_POST['totalpago'];
$fechacorta=date('Y-m-d');
$fechalarga=date('Y-m-d H:i:s');
$idu=$_SESSION['idusuario'];
$estado = '1';
$estado2 = '0';
$estado3 = '2';
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "UPDATE venta
SET estadoorden= :estado WHERE orden = :ordenmixto";

$consulta2 = "UPDATE orden
SET estadoorden= :estado2, idtipopago=:tipopago WHERE orden = :ordenmixto";

$consulta3 = "UPDATE pago
SET estadopago= :estado3, tipopago=:tipopago  WHERE orden = :ordenmixto";

$consulta4 = "UPDATE cliente
SET estadocliente= :estado2 WHERE idmesa = :idmesa";

$consulta5 = "UPDATE mesa
SET estadomesa= :estado2 WHERE idmesa = :idmesa";


$sql2 = $pdo->prepare($consulta);
$sql3 = $pdo->prepare($consulta2);
$sql4 = $pdo->prepare($consulta3);
$sql5 = $pdo->prepare($consulta4);
$sql6 = $pdo->prepare($consulta5);
;

$sql2->bindParam(':ordenmixto',$ordenmixto,PDO::PARAM_INT);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);

$sql3->bindParam(':ordenmixto',$ordenmixto,PDO::PARAM_INT);
$sql3->bindParam(':estado2',$estado2,PDO::PARAM_INT);
$sql3->bindParam(':tipopago',$tipopago,PDO::PARAM_INT);

$sql4->bindParam(':ordenmixto',$ordenmixto,PDO::PARAM_INT);
$sql4->bindParam(':estado3',$estado3,PDO::PARAM_INT);
$sql4->bindParam(':tipopago',$tipopago,PDO::PARAM_INT);

$sql5->bindParam(':estado2',$estado2,PDO::PARAM_INT);
$sql5->bindParam(':idmesa',$idmesa,PDO::PARAM_INT);

$sql6->bindParam(':estado2',$estado2,PDO::PARAM_INT);
$sql6->bindParam(':idmesa',$idmesa,PDO::PARAM_INT);


$sql2->execute(); 
$sql3->execute(); 
$sql4->execute(); 
$sql5->execute();
$sql6->execute();

?>