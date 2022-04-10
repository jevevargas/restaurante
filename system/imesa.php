<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idzona=$_POST['idzona'];
$mesa=$_POST['mesa'];

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into mesa(idzona,nombremesa) 
values
(:idzona,:mesa)";

$sql = $pdo->prepare($consulta);

$sql->bindParam(':idzona',$idzona,PDO::PARAM_INT);
$sql->bindParam(':mesa',$mesa,PDO::PARAM_STR);

$sql->execute();    


?>