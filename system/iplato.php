<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nomplato=$_POST['nomplato'];
$precioplato=$_POST['precioplato'];
$cat=$_POST['cat'];
$imp=$_POST['imp'];
$desc=$_POST['desc'];
$clave=$_POST['clave'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

$statement = $pdo->prepare("select * from usuario WHERE clave='$clave' ");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($clave==$clavebase && $nivel==6){
    $consulta = "insert into plato(nomplato,descplato,precioplato,idcategoria,impresionplato) 
    values
    (:nomplato,:desc,:precioplato,:cat,:imp)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':nomplato',$nomplato,PDO::PARAM_STR);
    $sql->bindParam(':desc',$desc,PDO::PARAM_STR);
    $sql->bindParam(':precioplato',$precioplato,PDO::PARAM_STR);
    $sql->bindParam(':cat',$cat,PDO::PARAM_INT);
    $sql->bindParam(':imp',$imp,PDO::PARAM_INT);
    
    $sql->execute();

    echo 1;
}else{
    echo 0;
}


    


?>