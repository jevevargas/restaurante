<?php
$inicio = $_REQUEST['inicial'];  //echo $inicio;
$final = $_REQUEST['final'];  //echo $final;
$tipopago = $_REQUEST['tipopago']; // echo $tipopago;
$total=0;
include('../config/conexion.php');
date_default_timezone_set('America/El_Salvador');
$totalo = $pdo->prepare("SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$final' AND tipopago='$tipopago'");
$totalo->execute();
while ($resultc = $totalo->fetch()) {
  $orden = $resultc -> orden;
  $tipo = $resultc -> tipopago;
  $total += $resultc -> totalpago;
?>
<style>
  @font-face {
    font-family:Fake Receipt;
    src: url(fuente/Led\ Panel\ Station\ On.ttf);
}
.texo{
    /* font-family: 'Chathura', sans-serif; */
   /* font-family: 'Codystar', cursive; */
   /* font-family: 'Roboto Mono', monospace; */
   /* font-family: 'Abel', sans-serif; */
   /* font-family: 'Rajdhani', sans-serif; */
   /* font-family:Receiptional Receipt; */
   /* font-family: 'IBM Plex Mono', monospace; */
   /* font-family: 'Volkhov', serif; */
   /* font-family: 'Changa', sans-serif; */
   /* font-family: 'Mitr', sans-serif; */
   /* font-family: 'Alata', sans-serif; */
    font-weight: bold;
    font-size: 16px;
    /* font-weight: bold; */
    font-family:Fake Receipt;
}

</style>

 <div class="col-md-12"><h5 class="texo">ORDEN # <?php  echo $orden;  ?> --- $<?php  echo $resultc ->totalpago;  ?>
 <?php 
 if($tipo ==1){
   ?>( + EFECTIVO)<?php
 } elseif($tipo ==2){
   ?>(- TARJETA)<?php
 }elseif($tipo ==3){
   ?>(- CREDITO)<?php
 }elseif($tipo ==4){
   ?>(- CORTESIA)<?php
 }elseif($tipo ==5){
   ?>(+ DEPOSITO)<?php
 }
   ?> -- <?php  echo $resultc ->fechapago;  ?>
   </h5></div>
 <hr>


<?php } ?>
<div class="col-md-12"><h2 class="texo">TOTAL: $<?php echo $total; ?></h2></div>

<div class="col-md-12"><a href="tickettipopago?ini=<?php echo $inicio; ?>&&fin=<?php echo $final; ?>&&tipo=<?php  echo $tipo; ?>" class="btn btn-info" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;">IMPRIMIR TICKET</a></div>
