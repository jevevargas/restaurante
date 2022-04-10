<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nombrecliente=$_POST['nombrecliente'];
$tipo=$_POST['tipo'];
$direccioncli=$_POST['direccioncli'];
$telefonocli=$_POST['telefonocli'];
$duicli=$_POST['duicli'];
$diabueno=date('Y-m-d');
$anio=date('Y');
$dia=date('d');
$estadomesa=1;
$idu=$_SESSION['idusuario'];
$hora=date('H:i:s');
$horalarga=date('Y-m-d H:i:s');

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into cliente(nomcliente,direccioncliente,telefonocliente,tipoatencion,dui) 
values
(:nombrecliente,:direccioncli,:telefonocli,:tipo,:duicli)";

//$consulta3 = "insert into orden(idmesa,idusuario,horaorden,fechacorta,fechalarga) 
//values
//(:idmesa,:idu,:hora,:diabueno,:horalarga)";

//$consulta2 = "UPDATE mesa
//SET estadomesa= :estadomesa, idusuario=:idu WHERE idmesa = :idmesa";


$sql = $pdo->prepare($consulta);
//$sql3 = $pdo->prepare($consulta3);
//$sql2 = $pdo->prepare($consulta2);

$sql->bindParam(':nombrecliente',$nombrecliente,PDO::PARAM_STR);
$sql->bindParam(':direccioncli',$direccioncli,PDO::PARAM_STR);
$sql->bindParam(':telefonocli',$telefonocli,PDO::PARAM_STR);
$sql->bindParam(':tipo',$tipo,PDO::PARAM_INT);
$sql->bindParam(':duicli',$duicli,PDO::PARAM_STR);


//$sql3->bindParam(':idmesa',$idmesa,PDO::PARAM_INT);
//$sql3->bindParam(':idu',$idu,PDO::PARAM_INT);
//$sql3->bindParam(':hora',$hora,PDO::PARAM_STR);
//$sql3->bindParam(':diabueno',$diabueno,PDO::PARAM_STR);
//$sql3->bindParam(':horalarga',$horalarga,PDO::PARAM_STR);

//$sql2->bindParam(':idmesa',$idmesa,PDO::PARAM_INT);
//$sql2->bindParam(':estadomesa',$estadomesa,PDO::PARAM_INT);
//$sql2->bindParam(':idu',$idu,PDO::PARAM_INT);

//$sql2->execute(); 
//$sql3->execute(); 
$sql->execute();    


?>