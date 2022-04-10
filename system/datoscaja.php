<?php
session_start();
include('../config/conexion.php');
 date_default_timezone_set('America/El_Salvador');
$usu=$_SESSION['idusuario']; //echo $usu;
$todalazona = $pdo->prepare(" SELECT * FROM caja left join usuario ON caja.idusuario=usuario.idusuario WHERE caja.idusuario = '$usu'  ");
$todalazona->execute();
while ($resultc = $todalazona->fetch()) {
 $estadocaja = $resultc -> estadocaja;  //echo   $estadocaja;
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6"><h1><img src="../imagen/caja.png" width="50px" alt=""> #<?php echo $resultc -> caja; ?></h1></div>
        <div class="col-md-6"><h1><?php echo $resultc -> nombre; ?></h1></div>
    </div>
</div>
<div class="col-md-12 alert alert-success">APERTURA $<?php  echo $resultc -> fondocaja;  ?> __ _ <?php  echo $resultc -> iniciocaja;  ?></div>

<?php } ?>