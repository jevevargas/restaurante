<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nombodega=$_POST['nombodega'];
$cantidadbodega=$_POST['cantidadbodega'];
$idcategoria=$_POST['idcategoria'];
$costobodega=$_POST['costobodega'];
$facturabodega=$_POST['facturabodega'];
$idu=$_SESSION['idusuario'];
$hora=date('H:i:s');
$horalarga=date('Y-m-d H:i:s');

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into bodega(producto_bodega,cantidad_bodega,idcategoriabodega,costo) 
values
(:nombodega,:cantidadbodega,:idcategoria,:costobodega)";

$sql = $pdo->prepare($consulta);

$sql->bindParam(':nombodega',$nombodega,PDO::PARAM_STR);
$sql->bindParam(':cantidadbodega',$cantidadbodega,PDO::PARAM_STR);
$sql->bindParam(':idcategoria',$idcategoria,PDO::PARAM_INT);
$sql->bindParam(':costobodega',$costobodega,PDO::PARAM_STR);

$sql->execute(); 
  


?>