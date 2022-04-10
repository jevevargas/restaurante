<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idplato=$_POST['idplato'];
$compo=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE plato
SET compocicion= :compo WHERE idplato = :idplato";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':idplato',$idplato,PDO::PARAM_INT);
$sql2->bindParam(':compo',$compo,PDO::PARAM_INT);

$sql2->execute(); 

?>