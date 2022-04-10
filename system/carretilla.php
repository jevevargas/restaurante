

<?php
require_once('../config/conexion.php');
$idcliente=$_REQUEST['idcliente'];
date_default_timezone_set('America/El_Salvador');
$sql = "SELECT * FROM orden WHERE idcliente = '$idcliente'  "; 
$query =$pdo -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 
if($query -> rowCount() > 0)   { 
    foreach($results as $result) { 
        $orden =$result -> orden;
       ?>
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
      $estado = $pdo->prepare(" SELECT * FROM venta WHERE orden='$orden' AND estadoorden='0' AND fechaorden  BETWEEN  '$inicio' AND '$final' ");
      $estado->execute();
      while ($result = $estado->fetch()) {
        $estadoventa=$result-> impresion;  //echo $estadoventa;
  ?>
   <tr>
      <td><?php echo $result ->nomorden;  ?></td>
      <td><?php echo $result ->cantidadorden;  ?></td>
      <td>$<?php echo $result ->precioventa;  ?></td>
      <td>


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
<button class="btn btn-info btn-sm elieliminar btn-sm" data-toggle="modal" data-target="#elieliminar" value="<?php echo $result -> idventa; ?>"><i class="bi bi-trash"></i> </button>

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
<div class="col-md-12"><h5>PROPINA SIN PROPINA</h5></div>
 <hr>
<div class="col-md-12"><h5><i class="bi bi-arrow-right-short"></i> A COBRAR: $<?php $cobrear=$ventas; echo number_format((float) $cobrear,2,'.',''); ?></h5></div>
</div>

<input type="text" value="<?php echo number_format((float) $cobrear,2,'.','');  ?>" id="totalpagar" style="display:none">
    <input type="text" value="<?php echo $orden  ?>" id="totalorden" style="display:none">


<?php
       } 
          
       }elseif($query -> rowCount() == 0){
        ?>
        <h3 class="text-center">
        <i class="bi bi-info-circle" style="font-size:60px;"></i><br>
          No hay una orden aun para este cliente
        </h3>
        
        <?php
    }
 
 ?>

<script>
   

    $(document).on('click', '.elieliminar', function(){
      var id=$(this).val();
      var ideli=$('#ideli'+id).text();
        var idpla=$('#idpla'+id).text();
        var pre=$('#pre'+id).text();
       var idPlato=$('#idPlato'+id).text();
      var cantidades=$('#cantidades'+id).text();
      
     // console.log(ideli);
       // console.log(idpla);
       // console.log(pre);
      
      $('#elieli').modal('show');
      $('#ideli').val(ideli);
      $('#idpla').val(idpla);
      $('#pre').val(pre);
      $('#elieli').modal('show');
      $('#idPlatoeliminar').val(idPlato);
       $('#cantidadeseliminar').val(cantidades);
      
      
      });


</script>