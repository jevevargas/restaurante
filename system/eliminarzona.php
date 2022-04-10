<?php
session_start();
date_default_timezone_set('America/El_Salvador');

	$idzonass= $_POST['idzonass'];
    $clavezonae= $_POST['clavezonae'];
    $idue= $_POST['idue'];
  
require_once('../config/conexion.php');

$statement = $pdo->prepare("select * from usuario WHERE clave='$clavezonae' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clavezonae==$clavebase && $nivel==6){
   
    
    $consulta = "DELETE FROM  detallezona WHERE idusuario=:idue AND idzona=:idzonass";
    $sql = $pdo-> prepare($consulta);

    $sql -> bindParam(':idzonass', $idzonass, PDO::PARAM_INT);
    $sql -> bindParam(':idue', $idue, PDO::PARAM_INT);

    $idzonass=trim($_POST['idzonass']);
    $idue=trim($_POST['idue']);

    $sql->execute(); 

    echo 1;
  
}else{
    echo 0;
}

?> 