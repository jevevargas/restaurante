<?php
require_once('../config/conexion.php');
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$clavezonan=$_POST['clavezonan'];
$nzona=$_POST['nzona'];



$statement = $pdo->prepare("select * from usuario WHERE clave='$clavezonan' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clavezonan==$clavebase && $nivel==6){
   
    
    $consulta = "insert into zona (zona) VALUES (:nzona)";

    $sql = $pdo->prepare($consulta);

    $sql->bindParam(':nzona',$nzona,PDO::PARAM_STR);

    $sql->execute(); 

    echo 1;
  
}else{
    echo 0;
}

?>