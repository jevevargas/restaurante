<?php
session_start();
date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$idcliente=$_POST['idcliente'];
$idu=$_SESSION['idusuario'];
$hora=date('H:i:s');
$fechacorta=date('Y-m-d');
$fechalarga=date('Y-m-d H:i:s');

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into orden(idcliente,idusuario,horaorden,fechacorta,fechalarga) 
    values
    (:idcliente,:idu,:hora,:fechacorta,:fechalarga)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':idcliente',$idcliente,PDO::PARAM_INT);
    $sql->bindParam(':idu',$idu,PDO::PARAM_INT);
    $sql->bindParam(':hora',$hora,PDO::PARAM_STR);
    $sql->bindParam(':fechacorta',$fechacorta,PDO::PARAM_STR);
    $sql->bindParam(':fechalarga',$fechalarga,PDO::PARAM_STR);

    $sql->execute();

?>