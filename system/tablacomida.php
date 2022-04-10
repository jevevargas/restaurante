
<table class="table table-striped table-bordered">
    <thead>
    <tr>
      <td>PRODUCTO</td>
      <td>CANTIDAD</td>
  
      </tr>
    </thead>
    <tbody>
            <?php
        $inicial = $_REQUEST['inicialc']; //echo $inicial;
        $final = $_REQUEST['finalc']; //echo $final;
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $totalo = $pdo->prepare(" SELECT a.idplato, a.nomplato,  SUM(b.cantidadorden) AS cant  FROM plato a LEFT JOIN venta b 
        ON a.idplato = b.idplato WHERE fechaorden  BETWEEN  '$inicial' AND '$final' GROUP BY a.idplato, a.nomplato   ");
        $totalo->execute();
        while ($resultc = $totalo->fetch()) {

        ?>
         <tr>
         <td><?php echo $resultc -> nomplato; ?></td>
          <td><b>(<?php  echo $resultc ->cant; ?>)</b></td>
         </tr>
        <?php } ?>
    </tbody>
</table>




