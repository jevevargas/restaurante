<?php
require_once('../config/conexion.php');
$idmesa=$_REQUEST['idmesa']; //echo $idmesa;
//$orden=$_REQUEST['orden'];  echo $orden;
date_default_timezone_set('America/El_Salvador');
$estado = $pdo->prepare(" SELECT * FROM mesa WHERE idmesa='$idmesa' ");
$estado->execute();
while ($result = $estado->fetch()) {
   $nombremesa = $result -> nombremesa;
   $estadomesa = $result -> estadomesa; 
}

$estado = $pdo->prepare(" SELECT * FROM orden WHERE idmesa='$idmesa' ");
$estado->execute();
while ($result = $estado->fetch()) {
   $orden = $result -> orden;  //echo $orden;
}

if($estadomesa == 0){
    ?>
   <center><h5><i class="bi bi-info-circle-fill icono"></i><br>LA MESA Y ORDEN NO HA SIDO ACTIVADA</h5></center> 
    <?php
}elseif($estadomesa == 1){
    ?>
    <div class="div col-md-12 detalleVentaactiva">

      <table class="table table-hover table-striped">
      <tbody>
        <?php
$todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
$todalcaja->execute();
while ($resultc = $todalcaja->fetch()) {
  $inicio =$resultc ->iniciocaja;   //echo $inicio;
  $final =$resultc ->fincaja; ;  //echo $final;
}  
            $ventas=0;
            date_default_timezone_set('America/El_Salvador');
            $estado = $pdo->prepare(" SELECT * FROM venta WHERE orden='$orden' AND estadoorden='0' AND fechaorden  BETWEEN  '$inicio' AND '$final'  ");
            $estado->execute();
            while ($result = $estado->fetch()) {
              $estadoventa=$result-> impresion;
        ?>
         <tr>
            <td style="font-size:12px; width:170px;"><?php echo $result ->nomorden;  ?></td>
            <td style="font-size:12px;"><?php echo $result ->cantidadorden;  ?></td>
            <td style="font-size:12px;">$<?php echo $result ->precioventa;  ?></td>
            <td style="font-size:12px;">


            <button class="btn btn-warning btn-sm editar" data-toggle="modal" data-target="#editar" value="<?php echo $result -> idventa; ?>"><i class="bi bi-pencil-square "></i></button>
            <span id="comentario<?php  echo $result ->idventa;   ?>" style="display:none"><?php echo $result ->descorden; ?></span>

            <span id="idnota<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idventa; ?></span>


            <?php
              if($estadoventa == 0){
                ?>
                <button class="btn btn-danger btn-sm eliminarventa" data-toggle="modal" data-target="#eliminarventa" value="<?php echo $result -> idventa; ?>"><i class="bi bi-trash"></i></button>
               
<span id="cantidades<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->cantidadorden ?></span>
<span id="iddetallepedido<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idventa; ?></span>
<span id="ideliminar<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idventa; ?></span>
<span id="idPlato<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idplato; ?></span>
<span id="ideli<?php  echo $result ->idventa; ;  ?>" style="display:none" ><?php echo $result ->idventa;  ?></span> 
<span id="nota<?php  echo $result ->idventa;   ?>" style="display:none"><?php $result ->descorden;  ?></span>
<span id="idpla<?php  echo $result ->idventa;   ?>" style="display:none" ><?php echo $result ->idplato; ?></span>       
 <span id="pre<?php  echo $result ->idventa;   ?>" style="display:none" ><?php echo $result ->precio; ?></span>







  <?php
    }elseif($estadoventa == 1){
  ?>
    <button class="btn btn-info btn-sm elieliminar btn-sm" data-toggle="modal" data-target="#elieliminar" value="<?php echo $result -> idventa; ?>"><i class="bi bi-trash"></i></i></button>

    <span id="cantidades<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->cantidadorden ?></span>
    <span id="iddetallepedido<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idventa; ?></span>
    <span id="ideliminar<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idventa; ?></span>
    <span id="idPlato<?php  echo $result ->idventa;  ?>" style="display:none"><?php echo $result ->idplato; ?></span>
    <span id="ideli<?php  echo $result ->idventa; ;  ?>" style="display:none" ><?php echo $result ->idventa;  ?></span> 
    <span id="nota<?php  echo $result ->idventa;   ?>" style="display:none"><?php $result ->descorden;  ?></span>
    <span id="idpla<?php  echo $result ->idventa;   ?>" style="display:none" ><?php echo $result ->idplato; ?></span>       
    <span id="pre<?php  echo $result ->idventa;   ?>" style="display:none" ><?php echo $result ->precioventa; ?></span>
    <span id="idnota<?php  echo $result ->idventa;  ?>" style="display:none"><?php $result ->idventa; ?></span>
    <span id="idcomentario<?php  echo $result ->idventa;   ?>" style="display:none"><?php echo $result ->idventa; ?></span>
    <span id="comentario<?php  echo $result ->idventa;   ?>" style="display:none"><?php echo $result ->comentario; ?></span>


  <?php
    }
  ?>
  
     <?php
       if($estadoventa == 1){
         ?><i class="bi bi-check-circle-fill" style="color:#63BE09"></i><?php
       }
     ?>
   </td>
    </tr>
      <?php $ventas+=($result ->cantidadorden)*($result ->precioventa);
    } 
  ?>  
    </tbody>
</table>


      <div class="col-md-12"><h5>TOTAL $<?php  echo number_format((float) $ventas,2,'.',''); ?></h5></div>
      <div class="col-md-12"><h5>PROPINA $<?php $pro=$ventas*0.10; echo number_format((float) $pro,2,'.',''); ?></h5></div>
       <hr>
      <div class="col-md-12"><h5><i class="bi bi-arrow-right-short"></i> A COBRAR: $<?php $cobrear=$pro+$ventas; echo number_format((float) $cobrear,2,'.',''); ?></h5></div>
    </div>

    <input type="text" value="<?php echo number_format((float) $cobrear,2,'.','');  ?>" id="totalpagar" style="display:none">
    <input type="text" value="<?php echo $orden  ?>" id="totalorden" style="display:none">
    <?php
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


<script>
  $(document).on('click', '.eliminarventa', function(){
  var id=$(this).val();
  var ideliminare=$('#ideliminar'+id).text();
    var cantidades=$('#cantidades'+id).text();
    var idPlato=$('#idPlato'+id).text();

  //console.log(ideliminare);

  $('#eliminarventa').modal('show');
  $('#ideliminare').val(ideliminare);
  $('#cantidadeseliminar').val(cantidades);
  $('#idPlatoeliminar').val(idPlato);
  });

</script>