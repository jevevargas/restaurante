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

<script>
		function imprimir() {
  window.print();
}
		</script>
</head>

<body onload="window.print()">

	<?php $id=$_GET['id'];  //echo //$id;  ?>
	<div class="ticket">
  <input type="text" value="<?php echo $id;  ?>" id="orden" style="display:none">      
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
         <center><h1 style="font-size:30px">Nº<?php echo $id; ?></h1></center>
         <h1 class="centrado">CORTE </h1> 
         =============================
         <?php
    
      $estado = $pdo->prepare(" SELECT * FROM cuadre left join usuario ON cuadre.idusuario = usuario.idusuario WHERE idcuadre='$id' ");
      $estado->execute();
      while ($resul = $estado->fetch()) {
       	?>  
 <p class="centrado">USUARIO: <?php echo $resul -> nombre; ?></p>
  =============================

       <?php } ?>
<br>
              <table border="0" style="width: 100%;">
              <?php
        $usu=$_SESSION['idusuario']; // echo $usu;
        include('../config/conexion.php');                 
        $pedido = $pdo->prepare(" SELECT * FROM cuadre
        WHERE  idcuadre='$id'");
        $pedido->execute();
        while ($result = $pedido->fetch()) {
          $acumulado=($result-> efectivo)+($result-> credito)+($result-> deposito)+($result-> tarjeta);  // echo $acumulado;
          //$tar=$result-> tarjeta; echo $tar;
          
        ?>

           <br>

     <p class="centrado">FECHA : <?php echo $result-> fechacierre; ?>  </p>  
     <p class="centrado" style="font-size:12px;">FECHA INICIO : <?php echo $result-> fechainiciocuadre; ?>  </p>
     <p class="centrado" style="font-size:12px;">FECHA CIERRE : <?php echo $result-> finally; ?>  </p>     
     ----------------------------         
<p class="centrado">VENTA EFECTIVO: $<?php echo $result-> efectivo; ?>  </p>   
----------------------------
<p class="centrado">(+)VENTA TARJETA: $<?php echo $result-> tarjeta; ?>  </p> 
----------------------------
<p class="centrado">(-)CREDITO: $<?php echo $result-> credito; ?>  </p> 
----------------------------
<p class="centrado">(-)CORTESIA: $<?php echo $result-> cortesia; ?>  </p> 
----------------------------
<p class="centrado">(-)DEPOSITO: $<?php echo $result-> deposito; ?>  </p>
----------------------------
<p class="centrado">(-)EGRESO: $<?php echo $result-> egreso; ?>  </p>  
----------------------------
<p class="centrado">(+)ARQUEO: $<?php echo $result-> arqueo; ?>  </p> 
----------------------------
<p class="centrado">(+)CAJA INICIAL: $<?php echo $fondo; ?>  </p> 
<br><br>

<p class="centrado">(+)VENTA: $<?php  $venta=($fondo+$result-> efectivo)-$result-> egreso; echo number_format((float) $venta,2,'.',''); ?>  </p> 
<p class="centrado">(-)CAJA: $<?php echo $result-> arqueo; ?>  </p> 
<br>

----------------------------
<p class="centrado">TOTAL ACUMULADO: $<?php echo $acumulado; ?>  </p> 
<br>
----------------------------
<p class="centrado">CREDITOS RECUPERADOS  </p> 
<br>
<p class="centrado">TOTAL EFECTIVO: $<?php  echo $result-> efecre; ?>  </p>
----------------------------
<p class="centrado">TOTAL PLANILLA: $<?php  echo $result-> planilla; ?>  </p>
---------------------------- 
<p class="centrado">TOTAL TARJETA: $<?php  echo $result-> tarcre; ?>  </p> 
----------------------------
<p class="centrado">TOTAL BITCOIN: $<?php  echo $result-> bitcre; ?>  </p> 
----------------------------
<p class="centrado">TOTAL TRANSFERENCIA: $<?php  echo $result-> trancre; ?>  </p>  
        <?php  } ?> 
     
        </table>
 ----------------------------         
   <br><br>
    <center><p>TEN UN LINDO DIA</p></center>
        </div>
 

</body>

</html>



