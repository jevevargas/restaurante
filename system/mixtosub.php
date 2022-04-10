
<?php  require_once('header.php'); ?>

<?php

$orden=$_GET['orden'];   //echo $orden;
$sub=$_GET['sub'];      //echo $sub;

date_default_timezone_set('America/El_Salvador');
error_reporting(E_ERROR);
include('../config/conexion.php'); 
$subcli = $pdo->prepare(" SELECT * FROM clientesub WHERE idclientesub='$sub' AND estadoclientesub='1' ");
      $subcli->execute();
      while ($resul = $subcli->fetch()) {
        $nomsub=$resul -> nomclientesub; //echo $nomsub;
   
    }

    $usu=$_SESSION['idusuario'];
    $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
    $todalcaja->execute();
    while ($resultc = $todalcaja->fetch()) {
      $inicio =$resultc ->iniciocaja;   //echo $inicio;
      $final=$resultc ->fincaja;  //echo $final;
    }   
                         
    $pedido = $pdo->prepare("SELECT SUM(cantidadorden) AS cantidades, nomorden,idventa, precioventa , impresionplato,idclientesub
    FROM venta LEFT JOIN plato ON venta.idplato=plato.idplato
    WHERE  fechaorden  BETWEEN  '$inicio' AND '$final'
    AND orden='$orden' AND estadoorden='0' AND impresion='1' AND idclientesub='$sub'  GROUP BY plato.idplato");
    $pedido->execute();
    while ($result = $pedido->fetch()) {
        $totalfinal += $result ->cantidades*$result ->precioventa;
         $propina = $totalfinal*0.10;
         $apagar = $totalfinal+$propina;
    }
  
?>
<input type="text" value="<?php  echo $sub; ?>" id="idclientesub" style="display:none">
  <input type="text" value="<?php  echo $orden; ?>" id="ordenmixtos" style="display:none">
<div class="col-md-12" style="background:#FFF;padding:20px;"><h5 class="text-center">CLIENTE: <?php echo $nomsub; ?></h5></div>

<div class="col-md-12" style="background:#FFF; margin-top:5px; padding:10px;">
<p class="centrado">TOTAL FACTURADO: $<?php echo number_format((float) $totalfinal,2,'.',''); ?>  </p> 
      
      <p class="centrado">PROPINA: $<?php  echo number_format((float) $propina,2,'.',''); ?>  </p>   
      <p class="centrado">TOTAL A PAGAR: $<?php  echo number_format((float) $apagar,2,'.',''); ?>  </p> 
      
      
      <input type="text" name="tolat" id="totals" value="<?php echo number_format((float) $totalfinal,2,'.','');   ?>" style="display:none">

        <div class="form-group col-md-6">
          <input type="text" name="tarjeta" id="tarjetas" class="form-control" placeholder="$ Pago con tarjeta" autofocus="autofocus">
        </div>

        <div class="form-group col-md-6">
          <input type="text" name="efectivos" id="efectivos" class="form-control" placeholder="$ Pago en efectivo" autofocus="autofocus">
        </div>
        

        <div class="form-group col-md-6">
            <button class="btn btn-success" onclick="pagarmixtosub()">PAGAR</button>
            <button class="btn btn-primary" onclick="cerrarsub()">Cerrar subcuenta</button>
        </div>

</div>


<script>
     $(document).ready(function(){
 //funcion para el vuelto
 $('#tarjetas').on('keyup change', function() {
    var rec = $('#tarjetas').val();
    var com = $('#totals').val();
    
    if (rec > 0) {
        var totalprp = com*0.10 ;
        var sum = (com - rec );
        var fin =sum + totalprp;
        var cal = parseFloat(parseFloat(fin).toFixed(2));
        $('#efectivos').val(cal);
    } else {
        $('#efectivos').val(0);
    }
});
    }); 



    
 
</script>
<script src="../app/js/caja.js"></script>