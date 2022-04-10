<?php


session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idu=$_POST['idu'];
$ven=$_POST['ven'];
$efe=$_POST['efe'];
$tar=$_POST['tar'];
$cre=$_POST['cre'];
$cor=$_POST['cor'];
$dep=$_POST['dep'];
$egre=$_POST['egre'];
$arqueo=$_POST['arqueo'];

$creefe=$_POST['creefe'];
$credes=$_POST['credes'];
$cretar=$_POST['cretar'];
$crebit=$_POST['crebit'];
$cretran=$_POST['cretran'];
$inicio=$_POST['inicio'];

$fechainicio=$_POST['fechainicio'];
$finaly=$_POST['finaly'];

$fechacorta=date('Y-m-d');
$fechalarga=date('Y-m-d H:i:s');
$tipo = '1';


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into cuadre(idusuario,efectivo,tarjeta,credito,cortesia,deposito,egreso,arqueo,fechacierre,fechacierre2,tipocuadre,efecre,planilla,tarcre,bitcre,trancre,fondoinicial,fechainiciocuadre,finally) 
values
(:idu,:efe,:tar,:cre,:cor,:dep,:egre,:arqueo,:fechacorta,:fechalarga,:tipo,:creefe,:credes,:cretar,:crebit,:cretran,:inicio,:fechainicio,:finaly)";

$sql = $pdo->prepare($consulta);

$sql->bindParam(':idu',$idu,PDO::PARAM_INT);
$sql->bindParam(':efe',$efe,PDO::PARAM_STR);
$sql->bindParam(':tar',$tar,PDO::PARAM_STR);
$sql->bindParam(':cre',$cre,PDO::PARAM_STR);
$sql->bindParam(':cor',$cor,PDO::PARAM_STR);
$sql->bindParam(':dep',$dep,PDO::PARAM_STR);
$sql->bindParam(':egre',$egre,PDO::PARAM_STR);
$sql->bindParam(':arqueo',$arqueo,PDO::PARAM_STR);
$sql->bindParam(':fechacorta',$fechacorta,PDO::PARAM_STR);
$sql->bindParam(':fechalarga',$fechalarga,PDO::PARAM_STR);
$sql->bindParam(':tipo',$tipo,PDO::PARAM_INT);

$sql->bindParam(':creefe',$creefe,PDO::PARAM_STR);
$sql->bindParam(':credes',$credes,PDO::PARAM_STR);
$sql->bindParam(':cretar',$cretar,PDO::PARAM_STR);
$sql->bindParam(':crebit',$crebit,PDO::PARAM_STR);
$sql->bindParam(':cretran',$cretran,PDO::PARAM_STR);
$sql->bindParam(':inicio',$inicio,PDO::PARAM_STR);

$sql->bindParam(':fechainicio',$fechainicio,PDO::PARAM_STR);
$sql->bindParam(':finaly',$finaly,PDO::PARAM_STR);


$sql->execute(); 