<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idbodega=$_POST['idbodega'];
$cantidad=$_POST['cantidad'];
$idplato=$_POST['idplato'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into componentes(idplato,id_bodega,cantidad_componente) 
values
(:idplato,:idbodega,:cantidad)";

$sql = $pdo->prepare($consulta);

$sql->bindParam(':cantidad',$cantidad,PDO::PARAM_STR);
$sql->bindParam(':idbodega',$idbodega,PDO::PARAM_INT);
$sql->bindParam(':idplato',$idplato,PDO::PARAM_INT);


$sql->execute(); 