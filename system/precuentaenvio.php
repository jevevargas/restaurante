<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ticket</title>
<link rel="stylesheet" href="ticket.css" type="text/css">
		<script>
		function imprimir() {
  window.print();
}
		</script>
</head>

<body onload="window.print()">
	<?php
    session_start();
    ?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ticket</title>
<link rel="stylesheet" href="ticket.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body onload="window.print()">

	<?php $orden=$_GET['orden'];  ?>
	<div class="ticket">
  <input type="text" value="<?php echo $orden;  ?>" id="orden" style="display:none">      
            <?php
            date_default_timezone_set('America/El_Salvador');
              error_reporting(E_ERROR);
      include('../config/conexion.php'); 
      $estado = $pdo->prepare(" SELECT * FROM empresa  ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
       	?>
<h1 class="centrado"><?php echo $resul -> empresa; ?></h1>
         <h1 class="centrado"><?php echo $resul ->direccion; ?></h1>
         <p class="centrado">TEL: <?php echo $resul -> telefono; ?>  </p>
         <p class="centrado">NRC: <?php echo $resul -> ncr; ?> -- <?php echo $resul ->giro; ?> </p>
         <p class="centrado">NIT: <?php echo $resul -> nit; ?></p>
         <p class="centrado">RESOLUCION: <?php echo $resul -> resolucion; ?> </p>
         <p class="centrado">NRC: <?php echo $resul -> autorizacion; ?> </p>
         <p class="centrado">SERIE AUTORIZADA: <?php echo $resul -> serie; ?> </p>
        
         <?php } ?>
         =============================
         <center><h1 style="font-size:20px">ORDEN #<?php echo $orden ?></h1></center>

         =============================
         <?php
      $estado = $pdo->prepare(" SELECT * FROM orden WHERE orden='$orden' ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
          $idcliente=$resul -> idcliente; //echo $idmesa;
      }
      $estado = $pdo->prepare(" SELECT * FROM cliente  WHERE idcliente='$idcliente' ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
        $tipo = $resul -> tipoatencion;
       	?>  
 <p class="centrado">TIPO: <?php
  if($tipo ==2){
      ?>(DOMICILIO)<?php
  }elseif($tipo ==3){
      ?>(LLEVAR)<?php
  }
  ?></p>

  <p class="centrado">CLIENTE: <?php echo $resul ->nomcliente; ?></p>
  <p class="centrado" style="font-size:15px">TEL: <?php echo $resul ->telefonocliente; ?></p>
  <p class="centrado" style="font-size:15px">DIR: <?php echo $resul ->direccioncliente; ?></p>
  =============================
  <p class="centrado">FECHA: <?php echo $dia=date('d-m-Y'); ?></p>
  <p class="centrado">HORA: <?php echo $hora=date('H:i:s A'); ?>  </p>
       <?php } ?>
<br>
              <table border="0" style="width: 100%;">
              <?php
        $usu=$_SESSION['idusuario'];
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;   //echo $inicio;
          $final=date('Y-m-d H:i:s');  //echo $final;
        }          
                                
        $pedido = $pdo->prepare(" SELECT SUM(cantidadorden) AS cantidades, nomorden,idventa, precioventa , impresionplato
        FROM venta LEFT JOIN plato ON venta.idplato=plato.idplato
        WHERE  fechaorden  BETWEEN  '$inicio' AND '$final' 
        AND orden='$orden' AND estadoorden='0' AND impresion='1'  GROUP BY plato.idplato ");
        $pedido->execute();
        while ($result = $pedido->fetch()) {   
       	?>      
         <tbody>
      
        <tr >
            <td class="nota"><p><?php echo $result ->cantidades; ?></p></td>
            <td class="producto"><p> <?php echo $result ->nomorden; ?></p></td>
            <td class="precio">$<p> <?php echo $result ->precioventa; ?></p></td>
            <td class="precio">$<p> <?php  $total=$result ->precioventa*$result ->cantidades;
           echo number_format((float) $total,2,'.',''); ?></p></td>
        </tr>
        </tbody>
        <?php 
         $totalfinal += $result ->cantidades*$result ->precioventa;
         //$propina = $totalfinal*0.10;
         $apagar = $totalfinal;
    } ?> 
     
        </table>
<br><br>  
     <p class="centrado">TOTAL FACTURADO: $<?php echo number_format((float) $totalfinal,2,'.',''); ?>  </p> 
      
    <p class="centrado">PROPINA: SIN PROPINA  </p>   
    <p class="centrado">TOTAL A PAGAR: $<?php  echo number_format((float) $apagar,2,'.',''); ?>  </p>   
        =============================  
        <center><p>PRECUENTA DE MESA</p></center>     
    <center><p>COMPROBANTE DE PRECUENTA</p></center>
    <center><p>VUELVE PRONTO</p></center>
        </div>
        <input type="text" id="imp" value="1" style="display:none">


</body>

</html>



