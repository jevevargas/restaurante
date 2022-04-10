<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$tarjeta=$_POST['tarjeta'];
$ordenmixto=$_POST['ordenmixto'];
$fechacorta=date('Y-m-d');
$fechalarga=date('Y-m-d H:i:s');
$idu=$_SESSION['idusuario'];
$tipo='2';

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into pago(totalpago,orden,fechapago,fechapago2,idusuario,tipopago) 
    values
    (:tarjeta,:ordenmixto,:fechacorta,:fechalarga,:idu,:tipo)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':tarjeta',$tarjeta,PDO::PARAM_STR);
    $sql->bindParam(':ordenmixto',$ordenmixto,PDO::PARAM_INT);
    $sql->bindParam(':fechacorta',$fechacorta,PDO::PARAM_STR);
    $sql->bindParam(':fechalarga',$fechalarga,PDO::PARAM_STR);
    $sql->bindParam(':idu',$idu,PDO::PARAM_INT);
    $sql->bindParam(':tipo',$tipo,PDO::PARAM_INT);
    
    $sql->execute();

