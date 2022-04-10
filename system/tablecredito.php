
<table class="table table-striped table-bordered">
    <thead>
    <tr>
      <td>ID</td>
      <td>ORDEN</td>
      <td>TOTAL</td>
      <td>FECHA</td>
      <td></td>

      </tr>
    </thead>
    <tbody>



<?php
$inicial = $_REQUEST['inicialcre']; //echo $inicial;
$final = $_REQUEST['finalcre']; //echo $final;
include('../config/conexion.php');
date_default_timezone_set('America/El_Salvador');
$totalo = $pdo->prepare(" SELECT * FROM pago  LEFT JOIN cliente ON pago.idcliente = cliente.idcliente WHERE tipopago='3' ");
$totalo->execute();
while ($resultc = $totalo->fetch()) {

?>      
 <tr>
    <td><?php echo $resultc -> idpago; ?></td>
    <td><?php echo $resultc -> nomcliente; ?></td>
    <td><?php echo $resultc -> orden; ?></td>
    <td>$<?php echo $resultc -> totalpago; ?></td>
    <td><?php echo $resultc -> fechapago; ?></td>
    <td>
        <a href="" class="btn btn-success btn-sm"><i class="bi bi-printer"> </i>IMPRIMIR</a>
        <button class="btn btn-danger btn-sm"><i class="bi bi-archive"></i> PAGAR</button>
    </td>
   
</tr>
        <?php } ?>
    </tbody>
</table>