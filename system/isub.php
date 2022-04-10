<?php
session_start();
 date_default_timezone_set('America/El_Salvador');
////// Informacion enviada por el formulario /////
$ordensub=$_POST['ordensub'];
$nombresub=$_POST['nombresub'];


////// Fin informacion enviada por el formulario ///
require_once('../config/conexion.php');
////////////// Actualizar la tabla /////////

    $consulta = "insert into clientesub(nomclientesub,orden) 
    values
    (:nombresub,:ordensub)";
    
    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':nombresub',$nombresub,PDO::PARAM_STR);
    $sql->bindParam(':ordensub',$ordensub,PDO::PARAM_INT);
    
    $sql->execute();



    


?>