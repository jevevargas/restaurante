<?php
session_start();
date_default_timezone_set('America/El_Salvador');

	$orden= $_POST['orden'];
    $clave= $_POST['clave'];
    $tipopago= $_POST['tipopago'];
    
require_once('../config/conexion.php');

$statement = $pdo->prepare("select * from usuario WHERE clave='$clave' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clave==$clavebase && $nivel==6){
   
    $consulta = "UPDATE pago
    SET tipopago= :tipopago WHERE orden = :orden";

     $sql = $pdo->prepare($consulta);

    $sql->bindParam(':orden',$orden,PDO::PARAM_INT);
    $sql->bindParam(':tipopago',$tipopago,PDO::PARAM_INT);

    $sql->execute(); 

    echo 1;
  
}else{
    echo 0;
}

?> 