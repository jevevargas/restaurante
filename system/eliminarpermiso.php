<?php
session_start();
date_default_timezone_set('America/El_Salvador');

	$idm= $_POST['idm'];
    $idu= $_POST['idu'];

require_once('../config/conexion.php');

$consulta = "DELETE FROM  detallemenu WHERE idusuario=:idu AND idmenu=:idm ";
$sql = $pdo-> prepare($consulta);

$sql -> bindParam(':idu', $idu, PDO::PARAM_INT);
$sql -> bindParam(':idm', $idm, PDO::PARAM_INT);

$idu=trim($_POST['idu']);
$idm=trim($_POST['idm']);

$sql->execute();

?> 