
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ticket</title>

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

<style>

@font-face {
    font-family:Fake Receipt;
    src: url(fuente/Led\ Panel\ Station\ On.ttf);
}
.texo{
    /* font-family: 'Chathura', sans-serif; */
   /* font-family: 'Codystar', cursive; */
   /* font-family: 'Roboto Mono', monospace; */
   /* font-family: 'Abel', sans-serif; */
   /* font-family: 'Rajdhani', sans-serif; */
   /* font-family:Receiptional Receipt; */
   /* font-family: 'IBM Plex Mono', monospace; */
   /* font-family: 'Volkhov', serif; */
   /* font-family: 'Changa', sans-serif; */
   /* font-family: 'Mitr', sans-serif; */
   /* font-family: 'Alata', sans-serif; */
   
    font-size: 13px;
    /* font-weight: bold; */
    font-family:Fake Receipt;
}

body{
    font-family:Fake Receipt;
    padding: 0px;
    box-sizing: border-box;
    font-weight: 600;
    background-color: #111111;
}

*{
    margin: 0;
padding: 0;

}
tbody,
table {
    border-top: 1px dashed black;
    border-collapse: collapse;
}

.ticket{
    background-color: #FFF;
}

td.producto,
th.producto {
    width: 500px;
    max-width: 500px;
    
}

td.cantidad,
th.cantidad {
    width: 200px;
    max-width: 200px;
    word-break: break-all;

}

td.precio,
th.precio {
    width: 300px;
    max-width: 300px;
    word-break: break-all;
   
}


td.nota,
th.nota {
    width: 60px;
    max-width: 40px;
    word-break: break-all;
    
}



.centrado {
    text-align: center;
    align-content: center;
    padding-left:10px;
    padding: 3px;
}

h1 {
    text-align: center;
    align-content: center;
    padding-left: 2px;
    font-size:17px;
   
    padding: 5px;
}

h4{
     text-align: center;
    align-content: center;
    padding-left: 2px;
    font-size:14px;
    
    padding: 5px;
}

p{
    text-align: center;
    align-content: center;
    padding-left: 2px;
    font-size:17px;
  
    padding: 5px;
  
}


.ticket {
    width:255px;
    max-width: 255px;
    padding: 0px;
}



</style>
<link rel="stylesheet" href="../ticket.css" type="text/css">
		<script>
		function imprimir() {
  window.print();
}
		</script>
</head>

<body onload="window.print()">

	<div class="ticket">
           
            <?php
           // $inicial=$_GET['inicial']; //echo $inicial;
           // $final=$_GET['final']; //echo $final;
            //$metodo=$_GET['id']; //echo $metodo;

            $inicial=$_GET['ini']; //echo $ini;
            $final=$_GET['fin']; //echo $fin;
            $metodo=$_GET['tipo']; //echo $tipo; 

            date_default_timezone_set('America/El_Salvador');
            // error_reporting(E_ERROR);
            include('../config/conexion.php');
     
        $estado = $pdo->prepare("SELECT * FROM empresa");
        $estado->execute();
        while ($result = $estado->fetch()) {


       	?>

<h1 class="centrado"><?php echo $result ->empresa; ?></h1>
       	<h1 class="centrado"><?php echo $result ->giro; ?></h1>
           <!-- <p class="centrado"><?php echo $result ->registro; ?></p>
           <p class="centrado"><?php echo $result ->autorizacion; ?></p>
           <p class="centrado"><?php echo $result ->fechaautorizacion; ?></p>
           <p class="centrado"><?php echo $result ->tirajeinicial; ?> -- <?php echo $result ->tirajefinal; ?></p>
         <p class="centrado"><?php echo $result ->direccion; ?></p> -->
        
         <?php } ?>

      <?php
         $total=0;
        $estado = $pdo->prepare("SELECT * FROM pago WHERE fechapago2  BETWEEN  '$inicial' AND '$final' AND tipopago='$metodo'");
        $estado->execute();
        while ($result = $estado->fetch()) {
            $total += $result ->totalpago; echo $total;
    }

       	?>
  <p class="centrado">Fecha: <?php echo $dia=date('d-m-Y'); ?>&nbsp;-- &nbsp;&nbsp;&nbspHora: <?php echo $hora=date('H:i:s A'); ?>  </p>
  <p class="centrado">-------------------------</p>

  <p class="centrado">Desde: <?php  echo $fi = date("(d-m-Y) - H:s:i", strtotime($inicial)); ?>  </p>
  <p class="centrado">Hasta: <?php echo $ff = date("(d-m-Y) - H:s:i", strtotime($final)); ?>  </p>

  <h1 class="centrado" style="font-size:20px">Metodo: <?php 
  if($metodo==1){
      ?>Efectivo<?php
  }elseif($metodo==2){
      ?>Tarjeta<?php
  }elseif($metodo==3){
      ?>Credito<?php
  }elseif($metodo==4){
      ?>Cortesia<?php
  }elseif($metodo==5){
      ?>Deposito<?php
  }
  ?>  </h1>
       
  <p class="centrado">------------------------</p>
  <h1 class="centrado">REPORTE DE TIPO DE PAGO</h1>
  <h1 class="centrado" style="font-size:40px">$<?php echo $total; ?></h1>       

    <p class="centrado">--------------------</p>

    </p>

    <p class="centrado"><?php echo $nombre=$_SESSION['nombre'];  ?></p>

    </p>
         
        </div>
	


</body>
</html>



