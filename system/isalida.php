<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$factura=$_POST['factura'];
$costo=$_POST['costo'];
$desc=$_POST['desc'];
$tipofact=$_POST['tipofact'];
$idu=$_SESSION['idusuario'];
$fecha1=date('Y-m-d');
$fecha2=date('Y-m-d H:i:s');

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into egreso(montoegreso,descegreso,tipofactura,fechaegreso,fechaegresolarga,idusuario,numfactura) 
    values
    (:costo,:desc,:tipofact,:fecha1,:fecha2,:idu,:factura)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':costo',$costo,PDO::PARAM_STR);
    $sql->bindParam(':desc',$desc,PDO::PARAM_STR);
    $sql->bindParam(':tipofact',$tipofact,PDO::PARAM_INT);
    $sql->bindParam(':fecha1',$fecha1,PDO::PARAM_STR);
    $sql->bindParam(':fecha2',$fecha2,PDO::PARAM_STR);
    $sql->bindParam(':idu',$idu,PDO::PARAM_INT);
    $sql->bindParam(':factura',$factura,PDO::PARAM_STR);
  
    
    $sql->execute();

