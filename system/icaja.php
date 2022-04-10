<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nomcaja=$_POST['nomcaja'];
$usu=$_POST['usu'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into caja(caja,idusuario) 
    values
    (:nomcaja,:usu)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':nomcaja',$nomcaja,PDO::PARAM_INT);
    $sql->bindParam(':usu',$usu,PDO::PARAM_INT);

    
    $sql->execute();

