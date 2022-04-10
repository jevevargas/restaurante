<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nick=$_POST['nick'];
$pass=$_POST['pass'];
$admin=$_POST['admin'];
$tipo=$_POST['tipo'];
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into usuario(clave,idtipo,admin,nombre) 
    values
    (:pass,:tipo,:admin,:nick)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':nick',$nick,PDO::PARAM_STR);
    $sql->bindParam(':pass',$pass,PDO::PARAM_STR);
    $sql->bindParam(':admin',$admin,PDO::PARAM_INT);
    $sql->bindParam(':tipo',$tipo,PDO::PARAM_INT);

    $sql->execute();




    


?>