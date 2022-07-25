<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$cantbode=$_POST['cantbode'];
$idbode=$_POST['idbode'];
$ncantbode=$_POST['ncantbode'];
$proveedor=$_POST['proveedor'];
$coston=$_POST['coston'];
$factura=$_POST['factura'];
$idu=$_SESSION['idusuario'];
$hora=date('H:i:s');
$horalarga=date('Y-m-d H:i:s');
$horacorta=date('Y-m-d');

$total=$cantbode+$ncantbode;

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "UPDATE bodega
SET cantidad_bodega= :total WHERE id_bodega = :idbode";

$consulta2 = "insert into movbode(canmovbod,fechamovbod,idusuario,id_bodega,factura,proveedor,costomov,fechamovbodecorta) 
values
(:ncantbode,:horalarga,:idu,:idbode,:factura,:proveedor,:coston,:horacorta)";

$sql = $pdo->prepare($consulta);
$sql2 = $pdo->prepare($consulta2);

$sql->bindParam(':total',$total,PDO::PARAM_INT);
$sql->bindParam(':idbode',$idbode,PDO::PARAM_INT);


$sql2->bindParam(':ncantbode',$ncantbode,PDO::PARAM_STR);
$sql2->bindParam(':horalarga',$horalarga,PDO::PARAM_STR);
$sql2->bindParam(':idu',$idu,PDO::PARAM_INT);
$sql2->bindParam(':idbode',$idbode,PDO::PARAM_INT);
$sql2->bindParam(':factura',$factura,PDO::PARAM_STR);
$sql2->bindParam(':proveedor',$proveedor,PDO::PARAM_STR);
$sql2->bindParam(':coston',$coston,PDO::PARAM_STR);
$sql2->bindParam(':horacorta',$horacorta,PDO::PARAM_STR);


$sql->execute(); 
$sql2->execute();   


?>