<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$nomplato=$_POST['nomplato'];
$pecioplato=$_POST['pecioplato'];
$impplato=$_POST['impplato'];
$descplato=$_POST['descplato'];
$catplato=$_POST['catplato'];
////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into plato(nomplato,descplato,precioplato,idcategoria,impresionplato) 
    values
    (:nomplato,:descplato,:pecioplato,:catplato,:impplato)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':nomplato',$nomplato,PDO::PARAM_STR);
    $sql->bindParam(':descplato',$descplato,PDO::PARAM_STR);
    $sql->bindParam(':pecioplato',$pecioplato,PDO::PARAM_STR);
    $sql->bindParam(':catplato',$catplato,PDO::PARAM_INT);
    $sql->bindParam(':impplato',$impplato,PDO::PARAM_INT);
    
    $sql->execute();




    


?>