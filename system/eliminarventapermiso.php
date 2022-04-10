<?php
session_start();
date_default_timezone_set('America/El_Salvador');

$passclave=$_POST['passclave'];
$coment=$_POST['comenti'];
$ideli=$_POST['ideli'];
$idpla=$_POST['idpla'];
$pre=$_POST['pre'];
$usu=$_SESSION['idusuario'];
$dia=date('Y-m-d H:i:s');
  
require_once('../config/conexion.php');

$statement = $pdo->prepare("select * from usuario WHERE clave='$passclave'");
$statement->execute();
while ($result = $statement->fetch()) {

    $clavebase= $result -> clave;
    $nivel= $result -> idtipo;
}

if($passclave==$clavebase && $nivel==6){
   
$ingresar = "insert into eliminar(coment ,idusuario, fecha, idplato, totale) 
values
(:coment,:usu,:dia,:idpla,:pre)";

$sqli = $pdo->prepare($ingresar);

$sqli->bindParam(':coment',$coment,PDO::PARAM_STR);
$sqli->bindParam(':usu',$usu,PDO::PARAM_INT);
$sqli->bindParam(':dia',$dia,PDO::PARAM_STR);
$sqli->bindParam(':idpla',$idpla,PDO::PARAM_INT);
$sqli->bindParam(':pre',$pre,PDO::PARAM_STR);



$consulta = "DELETE FROM  venta WHERE idventa=:ideli";
$sql = $pdo-> prepare($consulta);
$sql -> bindParam(':ideli', $ideli, PDO::PARAM_INT);
  
$ideli=trim($_POST['ideli']);


     
    $sqli->execute(); 
    $sql->execute();
    echo 1;
  
}else{
    echo 0;
}

?> 