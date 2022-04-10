<?php
session_start();
date_default_timezone_set('America/El_Salvador');


    $idu= $_POST['idu'];

require_once('../config/conexion.php');

$consulta = "DELETE FROM  mesa WHERE idmesa=:idu ";
$sql = $pdo-> prepare($consulta);

$sql -> bindParam(':idu', $idu, PDO::PARAM_INT);

$idu=trim($_POST['idu']);


$sql->execute();

?> 