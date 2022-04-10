<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$inicaja=$_POST['inicaja'];
$finicaja=$_POST['finicaja'];
$idusufech=$_POST['idusufech'];

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE caja
SET fincaja= :finicaja WHERE idusuario = :idusufech";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':finicaja',$finicaja,PDO::PARAM_STR);
$sql2->bindParam(':idusufech',$idusufech,PDO::PARAM_INT);


$sql2->execute(); 

?>