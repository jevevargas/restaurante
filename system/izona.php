<?php
session_start();
date_default_timezone_set('America/El_Salvador');

	$clave= $_POST['clave'];
    $idu= $_POST['idu'];
    $zona= $_POST['zona'];
  
require_once('../config/conexion.php');

$statement = $pdo->prepare("select * from usuario WHERE clave='$clave' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clave==$clavebase && $nivel==6){
   
    
    $consulta = "insert into detallezona(idusuario,idzona) 
    values
    (:idu,:zona)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':zona',$zona,PDO::PARAM_INT);
    $sql->bindParam(':idu',$idu,PDO::PARAM_INT);
  

    $sql->execute();


    echo 1;
  
}else{
    echo 0;
}

?> 