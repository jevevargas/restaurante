<?php
  include('../config/conexion.php');
 $estado = $pdo->prepare(" SELECT * FROM mesa LEFT JOIN zona ON mesa.idzona = zona.idzona ");
 $estado->execute();
 while ($result = $estado->fetch()) {
    $estadom = $result -> vidamesa;
?>
<tr>
    <td style="font-size:12px"><?php echo $result -> idmesa; ?></td>
    <td style="font-size:12px"><?php echo $result -> nombremesa; ?></td>
    <td style="font-size:12px"><?php echo $result -> zona; ?></td>
    <td style="font-size:12px">
    <?php
     if($estadom ==1){
         ?>ACTIVA<?php
     }elseif($estadom ==0){
         ?>INACTIVA<?php
     }
    ?>
    </td>
    <td>
    <button class="btn btn-danger btn-sm eliminar"  data-toggle="modal" data-target="#eliminar" value="<?php echo $result -> idmesa; ?>"><i class="bi bi-trash"></i></button>
    <span id="idu<?php  echo $result -> idmesa;  ?>" style="display:none"><?php  echo $result ->idmesa;  ?></span>
    <span id="nom<?php  echo $result -> idmesa;  ?>" style="display:none"><?php  echo $result ->nombremesa;  ?></span>
    </td>
</tr>

<?php } ?>

