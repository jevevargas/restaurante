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

	<?php $orden=$_GET['orden']; echo $orden;
    $venta=$_GET['venta']; echo $venta;
    ?>
	<div class="ticket">
    
            <?php
            date_default_timezone_set('America/El_Salvador');
            //  error_reporting(E_ERROR);
      include('../config/conexion.php'); 
      $estado = $pdo->prepare(" SELECT * FROM empresa  ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
       	?>

        <h1 class="centrado"><?php echo $resul -> empresa; ?></h1>
       	<h5 class="centrado"><?php echo $resul ->giro; ?></h5>
         <h1 class="centrado"><?php echo $resul ->direccion; ?></h1>
        
         <?php } ?>
         =============================
         <center><h1 style="font-size:40px"><?php echo $orden ?></h1></center>
         <h1 class="centrado">ENVIO A BAR</h1> 
         =============================
         <?php
      $estado = $pdo->prepare(" SELECT * FROM orden LEFT JOIN usuario ON orden.idusuario=usuario.idusuario WHERE orden='$orden' ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
          $idmesa=$resul -> idmesa;
          $nomuser=$resul -> nombre; //echo $nomuser;
      }
      $estado = $pdo->prepare(" SELECT * FROM cliente LEFT JOIN mesa ON cliente.idmesa=mesa.idmesa  WHERE cliente.idmesa='$idmesa' AND estadocliente='1'");
      $estado->execute();
      while ($resul = $estado->fetch()) {
       	?>  
  <p class="centrado">CLIENTE: <?php echo $resul ->nomcliente; ?></p>
  <p class="centrado">MESA: <?php echo $resul ->nombremesa; ?></p>\
  <p class="centrado">MESERO: <?php echo $nomuser; ?></p>
  =============================
  <p class="centrado">FECHA: <?php echo $dia=date('d-m-Y'); ?></p>
  <p class="centrado">HORA: <?php echo $hora=date('H:i:s A'); ?>  </p>
       <?php } ?>
<br>
              <table border="0" style="width: 100%;">
              <?php
             // echo $venta;
        $usu=$_SESSION['idusuario'];
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;   //echo $inicio;
          $final =$resultc ->fincaja;   //echo $final;
        }          
                                
        $pedido = $pdo->prepare(" SELECT SUM(cantidadorden) AS cantidades, nomorden,idventa, precioventa , impresionplato,acocina,venta.impresion
        FROM venta LEFT JOIN plato ON venta.idplato=plato.idplato,venta.descorden
        WHERE  fechaorden  BETWEEN  '$inicio' AND '$final' 
        AND idventa='$venta' AND estadoorden='0' ");
        $pedido->execute();
        while ($result = $pedido->fetch()) {   
       	?>      
         <tbody>
      
        <tr >
            <td class="cantidad" colspan="4"><p>CANTIDAD <?php echo $result ->cantidades; ?></p></td>
        </tr>
        <tr >
            <td class="cantidad" colspan="4"><p> <?php echo $result ->nomorden; ?></p></td>
        </tr>
        <tr >
            <td class="cantidad" colspan="4"><p> <?php echo $result ->descorden; ?></p></td>
        </tr>
          
        </tbody>
        <?php  } ?> 
     
        </table>
            
        =============================       
    <center><p>COMPROBANTE DE BAR (MESAS)</p></center>
        </div>
        <input type="text" id="imp" value="1" style="display:none">


</body>

</html>



