<!DOCTYPE html>
   <html>
    <head>
        <meta charset="utf-8">
       <title>Recibo</title>
        <link rel="stylesheet" href="factura.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    </head>
    <body onload="window.print()">
           <?php   $orden=$_GET['orden']; //echo $orden;
           session_start();
  $usu=$_SESSION['idusuario'];
  include('../config/conexion.php');
  date_default_timezone_set('America/El_Salvador');
  $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;   //echo $inicio;
          $final =$resultc ->fincaja;
 }

 $estado = $pdo->prepare(" SELECT * FROM orden WHERE orden='$orden' ");
 $estado->execute();
 while ($resul = $estado->fetch()) {
     $idmesa=$resul -> idmesa; //echo $idmesa;
 }
 $estado = $pdo->prepare(" SELECT * FROM cliente LEFT JOIN mesa ON cliente.idmesa=mesa.idmesa WHERE cliente.idmesa='$idmesa' AND estadocliente='1' ");
 $estado->execute();
 while ($resul = $estado->fetch()) {  
   $cliente= $resul ->nomcliente;
 }
?>
 <div class="fecha"><?php echo $dia=date('d-m-Y');  ?></div>
 <div class="nom"><?php echo $cliente;  ?></div>

<div class="taba">
        <table class="espacio">
         <tbody>
           
<?php
 $sumatoria2=0;
  $pedido = $pdo->prepare("  SELECT SUM(cantidadorden) AS cantidades, nomorden,idventa, precioventa , impresionplato
  FROM venta LEFT JOIN plato ON venta.idplato=plato.idplato
  WHERE  fechaorden  BETWEEN  '$inicio' AND '$final' 
  AND orden='$orden' AND estadoorden='0' AND impresion='1'  GROUP BY plato.idplato ");
  $pedido->execute();
  while ($result = $pedido->fetch()) {   
 
      
        ?>
         <tr>
         <td class="canti"><?php echo $result ->cantidades; ?> </td>
         <td class="descrip"><?php echo $result ->nomorden; ?></td>
         <td class="descrip2">$<?php echo $result ->precioventa; ?></td>
         <td>$<?php $sumatoria=($result ->precioventa)*($result ->cantidades); echo number_format((float) $sumatoria,2,'.','');  ?></td>
       
         </tr>
         <?php 
         //echo $sumatoria;
    $sumatoria2+=$sumatoria;
    } ?>
         </tbody>
        </table>
        </div>

        

        <div class="total"><?php   echo number_format((float) $sumatoria2,2,'.',''); ?></div>
        <div class="propina">0.00</div>
        <div class="fin"><?php   $sumatoria2; echo number_format((float) $sumatoria2,2,'.',''); ?></div>
        <input type="text" name="pedido" id="pedido" value="<?php echo $mesa;  ?>" style="display:none">
    </body>
</html>







