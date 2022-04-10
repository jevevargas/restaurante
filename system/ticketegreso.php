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
</head>

<body onload="window.print()">

	<?php $id=$_GET['id'];  ?>
	<div class="ticket">    
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
         <h1 class="centrado">EGRESOS</h1> 
         <?php
         //echo $id;
         $usuario = $pdo->prepare(" SELECT * FROM usuario WHERE idusuario='$id' ");
        $usuario->execute();
        while ($result = $usuario->fetch()) { 
            ?>  <h1 class="centrado">USUARIO: <?php echo $result -> nombre; ?></h1> <?php
        }
       	?> 
         =============================
  <p class="centrado">FECHA: <?php echo $dia=date('d-m-Y'); ?></p>
  <p class="centrado">HORA: <?php echo $hora=date('H:i:s A'); ?>  </p>
     
<br>
              <table border="0" style="width: 100%;">
              <?php
        $usu=$_SESSION['idusuario'];
        include('../config/conexion.php');
        date_default_timezone_set('America/El_Salvador');
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$id'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;   //echo $inicio;
          $final=$resultc ->fincaja;  //echo $final;
        }          
                                
        $pedido = $pdo->prepare(" SELECT * FROM egreso
        WHERE  fechaegresolarga  BETWEEN  '$inicio' AND '$final'  ");
        $pedido->execute();
        while ($result = $pedido->fetch()) {   
       	?>      
         <tbody>
      
        <tr >
        <td>$<?php echo $result -> montoegreso; ?></td>
        <td><?php echo $result -> descegreso; ?></td>
        <td><?php echo $result -> numfactura; ?></td>
        </tr>
          
        </tbody>
        <?php
     $total += $result -> montoegreso;
    } ?> 
     
        </table>
         <br><br>   
        <h1 class="centrado" style="font-size:25px">$<?php echo number_format((float) $total,2,'.','');  ?></h1> 

        =============================       
    <center><p>PASA LINDO DIA</p></center>
        </div>
   


</body>

</html>



