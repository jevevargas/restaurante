<div class="row">
<?php
include('../config/conexion.php');
date_default_timezone_set('America/El_Salvador');
$todalazona = $pdo->prepare(" SELECT * FROM cliente WHERE estadocliente='1' AND tipoatencion IN ('2','3') ");
$todalazona->execute();
while ($resultb = $todalazona->fetch()) {
 ?>
<a class="btn btn-warning btn-cliente col-md-4" href="detallecliente.php?id=<?php echo $resultb -> idcliente; ?>"><?php echo $resultb -> nomcliente; ?></a>

<?php } ?>

</div>