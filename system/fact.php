<?php

////// Informacion enviada por el formulario /////
$orden=$_POST['orden'];
$imp=$_POST['imp'];
$estado=1;


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


$consulta2 = "UPDATE venta
SET impresion= :estado WHERE orden = :orden AND estadoorden='0' AND impventa=:imp ";

$sql2 = $pdo->prepare($consulta2);

$sql2->bindParam(':estado',$estado,PDO::PARAM_INT);
$sql2->bindParam(':orden',$orden,PDO::PARAM_INT);
$sql2->bindParam(':imp',$imp,PDO::PARAM_INT);

$sql2->execute(); 
print_r($sql2->errorInfo());

?>