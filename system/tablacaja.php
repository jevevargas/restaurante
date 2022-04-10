<?php
 
include('../config/conexion.php');
date_default_timezone_set('America/El_Salvador');
$totalo = $pdo->prepare(" SELECT * FROM caja LEFT JOIN usuario ON caja.idusuario = usuario.idusuario ");
$totalo->execute();
while ($resultc = $totalo->fetch()) {
?>
<tr>
    <td><?php echo $resultc-> idcaja; ?></td>
    <td><?php echo $resultc-> caja; ?></td>
    <td><?php echo $resultc-> nombre; ?></td>
    <td></td>
</tr>

<?php } ?>