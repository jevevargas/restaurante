<?php
session_start();
date_default_timezone_set('America/El_Salvador');

    $ide=$_POST['ide'];

require_once('../config/conexion.php');

$consulta = "DELETE FROM  egreso WHERE idegreso=:ide";
$sql = $pdo-> prepare($consulta);

$sql -> bindParam(':ide', $ide, PDO::PARAM_INT);

$ide=trim($_POST['ide']);

$sql->execute();

?> 