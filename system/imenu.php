<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nommenu=$_POST['nommenu'];
$iconomenu=$_POST['iconomenu'];
$clase=$_POST['clase'];
$link=$_POST['link'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$consulta = "insert into menu(menu,icon,clase,link) 
values
(:nommenu,:iconomenu,:clase,:link)";




$sql = $pdo->prepare($consulta);


$sql->bindParam(':nommenu',$nommenu,PDO::PARAM_STR);
$sql->bindParam(':iconomenu',$iconomenu,PDO::PARAM_STR);
$sql->bindParam(':clase',$clase,PDO::PARAM_STR);
$sql->bindParam(':link',$link,PDO::PARAM_STR);



$sql->execute();    


?>