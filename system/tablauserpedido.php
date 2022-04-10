<?php
include('../config/conexion.php');
 date_default_timezone_set('America/El_Salvador');
 $todalazona = $pdo->prepare(" SELECT * FROM cliente WHERE estadocliente='1' AND tipoatencion IN (2,3) ORDER BY idcliente DESC ");
 $todalazona->execute();
 while ($resultb = $todalazona->fetch()) {
    $tipo = $resultb -> tipoatencion;
?>
<tr>
 <td style="font-size:12px; padding-bottom:10px;">#<?php echo $resultb -> idcliente;  ?></td>
 <td style="font-size:12px; padding-bottom:10px;"><?php echo $resultb -> nomcliente;  ?></td>
 <td style="font-size:12px; padding-bottom:10px;"><?php echo $resultb -> direccioncliente;  ?></td>
 <td style="font-size:12px; padding-bottom:10px;"><?php echo $resultb -> telefonocliente;  ?></td>
 <td style="font-size:12px; padding-bottom:10px;"><?php echo $resultb -> dui;  ?></td>
 <td style="padding-bottom:0px;">
   <?php 
      if($tipo ==2){
          ?>
          <form action="detallepedido" method="POST">
              <input type="text" value="<?php echo $resultb -> idcliente;  ?>" name="idcli" style="display:none">
              <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="bi bi-send" style="font-size:15px;"></i> DOMICILIO</button>
          </form>
          <?php
      }elseif($tipo == 3){
          ?>

          <form action="detallepedido" method="POST">
              <input type="text" value="<?php echo $resultb -> idcliente;  ?>" name="idcli" style="display:none">
              <button type="submit" class="btn btn-info btn-sm btn-block"><i class="bi bi-shop-window" style="font-size:15px;"></i> <span> LLEVAR</button>
          </form>

          <?php
      }
   ?>
</td>

</tr>
<?php
 }
?>