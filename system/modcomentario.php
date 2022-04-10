<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$comentario=$_POST['comentario'];
$idnota=$_POST['idnota'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE venta
SET descorden= :comentario WHERE idventa = :idnota";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':comentario',$comentario,PDO::PARAM_STR);
$sql2->bindParam(':idnota',$idnota,PDO::PARAM_INT);


$sql2->execute(); 

?>