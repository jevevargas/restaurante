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

<script>
		function imprimir() {
  window.print();
}
		</script>
</head>

<body onload="window.print()">

	<?php $orden=$_GET['orden'];   ?>
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
       	<h5 class="centrado"><?php echo $resul ->giro; ?></h5>
         <h1 class="centrado"><?php echo $resul ->direccion; ?></h1>
        
         <?php } ?>
         =============================
         <center><h1 style="font-size:40px"><?php echo $orden ?></h1></center>
         <h1 class="centrado">ENVIO A COCINA</h1> 
         =============================
         <?php
      $estado = $pdo->prepare(" SELECT * FROM orden WHERE orden='$orden' ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
          $idcliente=$resul -> idcliente; //echo $idcliente;
      }
      $estado = $pdo->prepare(" SELECT * FROM cliente WHERE cliente.idcliente='$idcliente'  AND estadocliente='1' ");
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
  =============================
  <p class="centrado">FECHA: <?php echo $dia=date('d-m-Y'); ?></p>
  <p class="centrado">HORA: <?php echo $hora=date('H:i:s A'); ?>  </p>
       <?php } ?>
<br>
              <table border="0" style="width: 100%;">
              <?php
        $usu=$_SESSION['idusuario'];
       // echo $orden;
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;   //echo $inicio;
          $final=date('Y-m-d H:i:s');  //echo $final;
        }          
                                
        $pedido = $pdo->prepare("SELECT SUM(cantidadorden) AS cantidades, nomorden,idventa, precioventa , impresionplato, impresion
        FROM venta LEFT JOIN plato ON venta.idplato=plato.idplato WHERE
          fechaorden  BETWEEN  '$inicio' AND '$final' AND orden='$orden' AND estadoorden='0' 
          AND impresionplato='1' AND impresion='0' GROUP BY plato.idplato ");

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
    <center><p>COMPROBANTE DE COCINA</p></center>
        </div>
        <input type="text" id="imp" value="1" style="display:none">
 
<script>
  $(document).ready(function() {
 
 orden = $("#orden").val(),
 imp = $("#imp").val();
 
 console.log(orden);
 $.ajax({
 url:'fact.php',
 type: 'POST',
 data:{'orden':orden,'imp':imp},
 beforeSend: function () {},
    success: function () 
    {
      DetalleVenta();
    }
  });
 
 
     
 } );
</script> 

</body>

</html>



