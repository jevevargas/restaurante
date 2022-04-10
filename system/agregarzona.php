<?php
require_once('../config/conexion.php');
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$clave=$_POST['clave'];
$idusu=$_POST['idu'];
$zona=$_POST['zona'];


$statement = $pdo->prepare("select * from usuario WHERE clave='$clave' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clave==$clavebase && $nivel==6){
   
    
    $consulta = "insert into detallezona (idusuario, idzona) VALUES (:idusu,:zona)";

    $sql = $pdo->prepare($consulta);

  
    $sql->bindParam(':idusu',$idusu,PDO::PARAM_INT);
    $sql->bindParam(':zona',$zona,PDO::PARAM_INT);


    $sql->execute(); 

    echo 1;
  
}else{
    echo 0;
}

?>