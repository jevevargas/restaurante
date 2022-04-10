<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$ipdesc=$_POST['ipdesc'];
$despla=$_POST['despla'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE plato
SET descplato= :despla WHERE idplato = :ipdesc";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':despla',$despla,PDO::PARAM_STR);
$sql2->bindParam(':ipdesc',$ipdesc,PDO::PARAM_INT);


$sql2->execute(); 

?>