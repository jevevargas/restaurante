<?php
session_start();
$usu=$_SESSION['idusuario']; //echo $usu;
include('../config/conexion.php');
error_reporting(0);
date_default_timezone_set('America/El_Salvador');
$todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
$todalcaja->execute();
while ($resultc = $todalcaja->fetch()) {
  $inicio =$resultc ->iniciocaja;
  $fecha=date('Y-m-d H:i:s');
}
$total=0;
 $todalazona = $pdo->prepare("SELECT * FROM egreso LEFT JOIN usuario ON egreso.idusuario=usuario.idusuario WHERE  fechaegresolarga  BETWEEN  '$inicio' AND '$fecha' AND egreso.idusuario = '$usu'   ");
 $todalazona->execute();
 while ($resultb = $todalazona->fetch()) {
   $tipo= $resultb -> tipofactura;
?>
<tr>
    <td><?php echo $resultb -> idegreso; ?></td>
    <td><?php echo $resultb -> numfactura; ?></td>
    <td>$<?php echo $resultb -> montoegreso; ?></td>
    <td><?php echo $resultb -> descegreso; ?></td>
    <td><?php 
    if($tipo ==1){
        ?>COMERCIAL<?php
    } elseif($tipo ==2){
        ?>CONSUMIDOR FINAL<?php
    }elseif($tipo ==3){
        ?>CREDITO FISCAl<?php
    }elseif($tipo ==4){
        ?>TICKET<?php
    }
     ?></td>
    <td><?php echo $resultb -> nombre; ?></td>
    <td><button class="btn btn-light btn-sm eliminar"  data-toggle="modal" data-target="#eliminar" value="<?php echo $resultb -> idegreso; ?>"><i class="bi bi-trash3-fill" style="color:#FF0000; font-size:17px;"></i></button>
    <span id="ide<?php  echo $resultb -> idegreso;  ?>" style="display:none"><?php  echo $resultb ->idegreso;  ?></span>
   </td>
</tr>

<?php
 $total += $resultb -> montoegreso;
} ?>

<tr>
    <td colspan='3'  class="bg-info"><h4 class="text-center"  style="color:#FFF; padding-top:5px;">$<?php echo number_format((float) $total,2,'.','');   ?></h4></td>
    <td colspan='4'><a href="" class="btn btn-danger" >Imprimir pdf</a> <a href="ticketegreso?id=<?php echo $usu; ?>" class="btn btn-warning" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;">Imprimir ticket</a></td>
</tr>