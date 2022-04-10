<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$totalpagar=$_POST['totalpagar'];
$totalorden=$_POST['totalorden'];
$fecha=date('Y-m-d H:i:s');
$fecha2=date('Y-m-d');
$idu=$_SESSION['idusuario'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into pago(totalpago,orden,fechapago,fechapago2,idusuario) 
values
(:totalpagar,:totalorden,:fecha,:fecha2,:idu)";

$sql = $pdo->prepare($consulta);

$sql->bindParam(':totalpagar',$totalpagar,PDO::PARAM_STR);
$sql->bindParam(':totalorden',$totalorden,PDO::PARAM_INT);
$sql->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$sql->bindParam(':fecha2',$fecha2,PDO::PARAM_STR);
$sql->bindParam(':idu',$idu,PDO::PARAM_INT);

$sql->execute(); 