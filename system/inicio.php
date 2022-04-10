<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idusu=$_POST['idusu'];
$fondo=$_POST['fondo'];
$inicio=$_POST['inicio'];
$final=$_POST['final'];
$estado=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////
$consulta = "insert into sistema(fechainicio,fechafinal,idusuario) 
values
(:inicio,:final,:idusu)";

$sql = $pdo->prepare($consulta);

$consulta2 = "UPDATE caja
SET estadocaja= :estado, iniciocaja=:inicio,  fincaja=:final, fondocaja=:fondo WHERE idusuario = :idusu";

$sql2 = $pdo->prepare($consulta2);


$sql->bindParam(':inicio',$inicio,PDO::PARAM_STR);
$sql->bindParam(':final',$final,PDO::PARAM_STR);
$sql->bindParam(':idusu',$idusu,PDO::PARAM_INT);


$sql2->bindParam(':fondo',$fondo,PDO::PARAM_STR);
$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql2->bindParam(':idusu',$idusu,PDO::PARAM_INT);
$sql2->bindParam(':inicio',$inicio,PDO::PARAM_STR);
$sql2->bindParam(':final',$final,PDO::PARAM_STR);

$sql->execute();
$sql2->execute(); 

?>