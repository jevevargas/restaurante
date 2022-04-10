<?php
require_once('../config/conexion.php');
    $estado = $pdo->prepare(" SELECT * FROM usuario LEFT JOIN tipo ON usuario.idtipo=tipo.idtipo ");
        $estado->execute();
    while ($result = $estado->fetch()) {
 ?>
<tr>
    <td><?php echo $result -> idusuario;  ?></td>
    <td><?php echo $result -> nombre;  ?></td>
    <td><?php echo $result -> clave;  ?></td>
    <td><?php echo $result -> tipo;  ?></td>
    <td><button class="btn btn-danger btn-sm eliminar"  data-toggle="modal" data-target="#eliminar" value="<?php echo $result -> idusuario; ?>"><i class="bi bi-trash"></i></button>
    <span id="idu<?php  echo $result -> idusuario;  ?>" style="display:none"><?php  echo $result ->idusuario;  ?></span>
</td>
</tr>

<?php } ?>

