<?php
session_start();
date_default_timezone_set('America/El_Salvador');

$idcompo= $_POST['idcompo'];

require_once('../config/conexion.php');

$consulta = "DELETE FROM  componentes WHERE id_componente=:idcompo ";
$sql = $pdo-> prepare($consulta);

$sql -> bindParam(':idcompo', $idcompo, PDO::PARAM_INT);

$idcompo=trim($_POST['idcompo']);

$sql->execute();

?> 