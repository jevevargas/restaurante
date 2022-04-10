<?php
session_start();
date_default_timezone_set('America/El_Salvador');

	$ideliminare= $_POST['ideliminare'];
	

require_once('../config/conexion.php');

$consulta = "DELETE FROM  venta WHERE idventa=:ideliminare ";
$sql = $pdo-> prepare($consulta);

$sql -> bindParam(':ideliminare', $ideliminare, PDO::PARAM_INT);

$ideliminare=trim($_POST['ideliminare']);

$sql->execute();

?> 