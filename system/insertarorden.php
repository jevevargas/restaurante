<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$orden=$_POST['orden'];
$nomplaton=$_POST['nomplaton'];
$precioplaton=$_POST['precioplaton'];
$cantidad=$_POST['cantidad'];
$sub=$_POST['sub'];
$hora=$_POST['hora'];
$dia=$_POST['dia'];
$idp=$_POST['idp'];
$desc=$_POST['desc'];
$diac=$_POST['diac'];
$impplato=$_POST['impplato'];
$idu=$_SESSION['idusuario'];

////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////


    $consulta = "insert into venta(idplato,idclientesub,idusuario,orden,nomorden,cantidadorden,descorden,fechaorden,fechaordencorta,horaorden,precioventa,impventa) 
    values
    (:idp,:sub,:idu,:orden,:nomplaton,:cantidad,:desc,:diac,:dia,:hora,:precioplaton,:impplato)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':idp',$idp,PDO::PARAM_INT);
    $sql->bindParam(':sub',$sub,PDO::PARAM_INT);
    $sql->bindParam(':idu',$idu,PDO::PARAM_INT);
    $sql->bindParam(':orden',$orden,PDO::PARAM_INT);
    $sql->bindParam(':nomplaton',$nomplaton,PDO::PARAM_STR);
    $sql->bindParam(':cantidad',$cantidad,PDO::PARAM_STR);
    $sql->bindParam(':desc',$desc,PDO::PARAM_STR);
    $sql->bindParam(':diac',$diac,PDO::PARAM_STR);
    $sql->bindParam(':dia',$dia,PDO::PARAM_STR);
    $sql->bindParam(':hora',$hora,PDO::PARAM_STR);
    $sql->bindParam(':precioplaton',$precioplaton,PDO::PARAM_STR);
    $sql->bindParam(':impplato',$impplato,PDO::PARAM_STR);
    $sql->execute();




    


?>