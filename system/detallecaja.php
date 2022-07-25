<?php
 require_once('header.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENVENIDO <?php  echo $nombre; ?></title>
    <link rel="stylesheet" href="../app/css/icono.css">
    <script src="../app/js/caja.js"></script>
    <script src="../app/js/cdn.js"></script>
    <script src="../app/js/sw.js"></script>
</head>
    <body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <?php require_once('menu.php'); ?>
        </nav>

        <!-- Page Content  -->
          <div id="content" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
             <?php require_once('lateral.php');  ?>
            </nav>
        
            <div class="col-md-12">
                <?php
                include('../config/conexion.php');
                $idcliente = $_GET['id']; //echo $idcliente;
                date_default_timezone_set('America/El_Salvador');
                $todalazona = $pdo->prepare(" SELECT * FROM cliente WHERE idmesa='$idcliente' ");
                $todalazona->execute();
                while ($resultb = $todalazona->fetch()) {
                    $nom = $resultb -> nomcliente; //echo $nom;
                    $idcli = $resultb -> idcliente; //echo $idcli;
                }

                date_default_timezone_set('America/El_Salvador');
                $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
                $todalcaja->execute();
                while ($resultc = $todalcaja->fetch()) {
                  $inicio =$resultc ->iniciocaja;   //echo $inicio;
                  $final=$resultc ->fincaja;  //echo $final;
                }  
               
                $todalazona = $pdo->prepare(" SELECT * FROM orden WHERE idmesa='$idcliente' ");
                $todalazona->execute();
                while ($resultb = $todalazona->fetch()) {
                    $orden = $resultb -> orden; //echo $orden;     
                }

                ?>
             <div class="row">
                 <div class="col-md-7 contenidoPlato esp">
                     <div class="col-md-12 titulo"><h5 class="text-center"><?php  echo $nom; ?></h5></div> 
                     <hr> 
                    <!-- extrigo la orden -->
                    
                 <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>DETALLE</td>
                            <td>CANTIDAD</td>
                            <td>PRECIO</td>
                            <td>ORDEN</td>
                            <td>HORA</td>
                            <td>COCINA</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                   <?php
                   $ventas=0;
                   $propina=0;
                   $cobrar=0;
                    $todalventa = $pdo->prepare(" SELECT * FROM venta WHERE fechaorden  BETWEEN  '$inicio' AND '$final' AND orden='$orden' AND estadoorden='0' ");
                    $todalventa->execute();
                    while ($resultventa = $todalventa->fetch()) {  
                        $cocina = $resultventa -> acocina; 
                    ?>
                    <tr>
                        <td style="font-size:12px;"><?php echo $resultventa -> idventa;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> nomorden;  ?></td>
                        <td style="font-size:12px;">(<?php echo $resultventa -> cantidadorden;  ?>)</td>
                        <td style="font-size:12px;">$<?php echo $resultventa -> precioventa;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> orden;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> horaorden;  ?></td>
                        <td>
                            <?php 
                               if($cocina == 1){
                                   ?><i class="bi bi-circle-fill" style="color:#A3D900"><?php
                               }elseif($cocina == 0){
                                   ?><i class="bi bi-circle-fill" style="color:#B20000"></i><?php
                               }
                            ?>
                        </td>
                      
                    </tr>
                    <?php 
                      $ventas+=($resultventa ->cantidadorden)*($resultventa ->precioventa);
                      $propina = $ventas * 0.10;
                      $cobrar= $ventas + $propina;
                    } ?>

                    </tbody>
                 </table>
            <div class="col-md-12">
               <div class="col-md-12"><h5>TOTAL: $<?php echo number_format((float) $ventas,2,'.','');  ?></h5></div>
               <div class="col-md-12"><h5>PROPINA: $<?php echo number_format((float) $propina,2,'.','');  ?></h5></div>
               <div class="col-md-12"><h5><i class="bi bi-arrow-right-short"></i> A COBRAR: $<?php echo number_format((float) $cobrar,2,'.','');  ?></h5></div>


               
            </div>


              <hr>
            <div class="col-md-12">
                <h5 class="text-center bg-light">SUB CUENTAS</h5>
                <table class="table table-bordered table-hover">
                    <tbody>
                    <?php
                  
                    $todalventa = $pdo->prepare(" SELECT * FROM clientesub  WHERE orden='$orden' AND estadoclientesub='1' ");
                    $todalventa->execute();
                    while ($resultsub = $todalventa->fetch()) {  
                      $idsub =$resultsub -> idclientesub;  //echo $idsub;
                    ?>
                    <tr>
                        <td><?php  echo $resultsub -> nomclientesub; ?></td>
                        <td>ORDEN #<?php  echo $resultsub -> orden; ?></td>
                        <td>
                          <a href="ticketsub.php?orden=<?php  echo $orden; ?>&sub=<?php echo $resultsub->idclientesub; ?>" class="btn btn-success btn-sm" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff"></i></a>
                          <button class="btn btn-info btn-sm"><i class="bi bi-printer-fill"></i></button>

                          <a class="btn btn-danger btn-sm" href="mixtosub.php?orden=<?php  echo $orden; ?>&sub=<?php echo $resultsub->idclientesub; ?>" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-credit-card-2-back-fill"></i></a>

                         

                      </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

                 </div>
<!------------------------------------------ totales ------------------------->
                 <div class="col-md-4 contenidoPlato esp">
                    <div class="col-md-12"><h3 class="text-center">ORDEN #<?php  echo $orden; ?></h3></div>
                    <div class="col-md-12">
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#dividir"><i class="bi bi-stack" style="font-size:20px;"></i><br> DIVIDIR ORDEN</button>
                        <br><br><br>
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#mixto"><i class="bi bi-credit-card-2-back-fill" style="font-size:20px;"></i><br> PAGO MIXTO</button>
                    </div>
                    <hr>
                    <div class="col-md-12">
                       
                        <div class="col-md-12">
                        <?php  
                 $sql = "SELECT * FROM venta WHERE fechaorden  BETWEEN  '$inicio' AND '$final' AND orden='$orden' AND estadoorden='0' "; 
                 $query =$pdo -> prepare($sql); 
                 $query -> execute(); 
                 $results = $query -> fetchAll(PDO::FETCH_OBJ); 
                  $cuenta = $query -> rowCount();

                  if($cuenta > 20){
                    ?>
                     <div class="col-md-12"><h5><?php  echo $cuenta; ?> Items registrados</h5></div>
                     <a class="btn btn-info" href="precuentacaja.php?orden=<?php  echo $orden; ?>" class="btn btn-info" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer-fill"></i> TICKET</a>

                     <button class="btn btn-warning"  data-toggle="modal" data-target="#multiple">FACTURACION MULTIPLE</button>

                    <?php
                  }elseif($cuenta <= 20){
                  ?>
                   <div class="col-md-12"><h5><?php  echo $cuenta; ?> Items registrados</h5></div>
                  <center>
                    <a class="btn btn-info" href="precuentacaja.php?orden=<?php  echo $orden; ?>" class="btn btn-info" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer-fill"></i> TICKET</a>

                    <a href="reciboc.php?orden=<?php  echo $orden; ?>" class="btn btn-info" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer-fill"></i> RECIBO</a>
                  </center> 

                  <?php
                  }
                  ?>
                </div>
                   <br>
                     <hr>
                        <div class="col-md-12 form-group" id="botonultimopago"></div>
                    </div>
                 </div>

                <input type="text" value="<?php echo $idcliente;  ?>" id="idmesa" style="display:none">
                <input type="text" value="<?php echo $idcli;  ?>" id="cliente" style="display:none">
                <input type="text" value="<?php echo number_format((float) $cobrar,2,'.','');   ?>" id="totalpago" style="display:none">
             </div>
            </div> 

          </div>
		</div>




<!-- dividir -->
<div class="modal fade" id="dividir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DIVIDIR ORDEN</h5>
      </div>
      <div class="modal-body">
      <?php echo number_format((float) $ventas,2,'.','');  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>



<!-- mixto -->
<div class="modal fade" id="mixto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">PAGO MIXTO</h5>
      </div>
      <div class="modal-body">
       <input type="text" value="<?php  echo $orden; ?>" id="ordenmixto" style="display:none">

       <div class="col-md-12"><h4 class="text-center"><i class="bi bi-arrow-right-short"></i> A COBRAR: $<?php echo number_format((float) $cobrar,2,'.','');  ?></h4></div>
      </div>
      <div class="col-md-12">

      <input type="text" name="tolat" id="total" value="<?php echo number_format((float) $ventas,2,'.','');   ?>" style="display:none">

        <div class="form-group">
          <input type="text" name="tarjeta" id="tarjeta" class="form-control" placeholder="$ Pago con tarjeta" autofocus="autofocus">
        </div>
        <div class="form-group">
          <input type="text" name="efectivo" id="efectivo" class="form-control" placeholder="$ Pago en efectivo" autofocus="autofocus">
        </div>


        </div>
    


      <div class="modal-footer">
      <button class="btn btn-success" onclick="tarjeta()">REGISTRAR PAGOS</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
     
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="multiple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR A LA FACTURA</h5>
      </div>
      <div class="modal-body">
      <input type="text" value="<?php  echo $orden; ?>" id="ordenm" style="display:none">
      <div class="col-md-12" id="tablamixta"></div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
       
      </div>
    </div>
  </div>
</div>



<script src="../app/js/bootstrap.min.js"></script>
     <?php  require_once('pie.php');  ?>
    </body>
</html>