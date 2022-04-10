<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nomrepla=$_POST['nomrepla'];
$nome=$_POST['nome'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE plato
SET nomplato= :nomrepla WHERE idplato = :nome";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':nomrepla',$nomrepla,PDO::PARAM_STR);
$sql2->bindParam(':nome',$nome,PDO::PARAM_INT);


$sql2->execute(); 

?>