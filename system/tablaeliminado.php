
<table class="table table-striped table-bordered">
    <thead>
    <tr>
      <td>ID</td>
      <td>PRODCUTO</td>
      <td>COMENTARIO</td>
      <td>FECHA</td>
      <td>TOTAL</td>
      <td>USUARIO</td>
      </tr>
    </thead>
    <tbody>
            <?php
        $inicial = $_REQUEST['inicial']; //echo $inicial;
        $final = $_REQUEST['final']; //echo $final;
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $totalo = $pdo->prepare("  SELECT * FROM eliminar LEFT JOIN plato ON eliminar.idplato = plato.idplato LEFT JOIN usuario ON eliminar.idusuario = usuario.idusuario WHERE  fecha  BETWEEN  '$inicial' AND '$final'   ");
        $totalo->execute();
        while ($resultc = $totalo->fetch()) {

        ?>
         <tr>
            <td><?php echo $resultc -> id_eliminar; ?></td>
            <td><?php echo $resultc -> nomplato; ?></td>
            <td><?php echo $resultc -> coment; ?></td>
            <td><?php echo $resultc -> fecha; ?></td>
            <td>$<?php echo $resultc -> totale; ?></td>
             <td><?php echo $resultc -> nombre; ?></td>
         </tr>
        <?php } ?>
    </tbody>
</table>




