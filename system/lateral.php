<?php
 error_reporting(E_ERROR);
require_once('../config/conexion.php');

$idu=$_SESSION['idusuario'];
$todalcaja = $pdo->prepare(" SELECT * FROM caja ");
$todalcaja->execute();
while ($resultc = $todalcaja->fetch()) {
  $inicio =$resultc ->iniciocaja;   //echo $inicio;
  $final =$resultc ->fincaja; ;  //echo $final;
  $estado=$resultc -> estadocaja;  //echo $estado;
}  
?>
<div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-danger">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-danger d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-box-arrow-left"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <?php
                 if($estado==1){
                   ?>
                   <a class="nav-link" href="#"><i class="bi bi-circle-fill" style="color:#63BE09;"></i><span class="sr-only">(current)</span> (INICIO: <?php echo $fecha1 = date("d-m-Y H:s:i", strtotime($inicio)); ?>) (FINAL: <?php  echo $fecha2 = date("d-m-Y H:s:i", strtotime($final));  ?>)</a>
                   <?php
                 }elseif($estado==0){
                   ?><span style="color:#FFF;">No hay cajas abiertas</span>  <?php
                 }
                ?>
                   
              </li>
              </ul>
              <ul class="nav navbar-nav ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link" href="out" style="color:#FFF"><i class="bi bi-box-arrow-left"></i> SALIR</a>
                </li>
              </ul>
            </div>
          </div>