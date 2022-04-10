<?php $idcliente=$_GET['id']; //echo $idcliente; ?>
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
    <script src="../app/js/cajapedido.js"></script>
</head>
    <body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active lou">
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
                $idcliente = $_GET['id'];// echo $idcliente;
                date_default_timezone_set('America/El_Salvador');
                $todalazona = $pdo->prepare(" SELECT * FROM cliente WHERE idcliente='$idcliente' ");
                $todalazona->execute();
                while ($resultb = $todalazona->fetch()) {
                    $nom = $resultb -> nomcliente;
                }

                date_default_timezone_set('America/El_Salvador');
                $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
                $todalcaja->execute();
                while ($resultc = $todalcaja->fetch()) {
                  $inicio =$resultc ->iniciocaja;   //echo $inicio;
                  $final=$resultc ->fincaja;  //echo $final;
                }  
               
                $todalazona = $pdo->prepare(" SELECT * FROM orden WHERE idcliente='$idcliente' ");
                $todalazona->execute();
                while ($resultb = $todalazona->fetch()) {
                    $orden = $resultb -> orden; //echo $orden;     
                }

                ?>
               <div class="row">
                   <div class="col-md-7 contenidoPlato esp">
                       <div class="col-md-12"><h5 class="text-center"><?php echo $nom; ?></h5></div>
                       <hr>

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
                    $todalventa = $pdo->prepare(" SELECT * FROM venta WHERE  fechaorden  BETWEEN  '$inicio' AND '$final'  AND orden='$orden' AND estadoorden='0 ' ");
                    $todalventa->execute();
                    while ($resultventa = $todalventa->fetch()) {  
                        $cocina = $resultventa -> acocina; 
                    ?>
                    <tr>
                        <td><?php echo $resultventa -> idventa;  ?></td>
                        <td><?php echo $resultventa -> nomorden;  ?></td>
                        <td>(<?php echo $resultventa -> cantidadorden;  ?>)</td>
                        <td>$<?php echo $resultventa -> precioventa;  ?></td>
                        <td><?php echo $resultventa -> orden;  ?></td>
                        <td><?php echo $resultventa -> horaorden;  ?></td>
                        <td>
                            <?php 
                               if($cocina == 1){
                                   ?><i class="bi bi-circle-fill" style="color:#A3D900"><?php
                               }elseif($cocina == 0){
                                   ?><i class="bi bi-circle-fill" style="color:#B20000"></i><?php
                               }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <?php 
                      $ventas+=($resultventa ->cantidadorden)*($resultventa ->precioventa);
                      //$propina = $ventas * 0.10;
                      $cobrar= $ventas;
                    } ?>

                    </tbody>
                 </table>
                 <div class="col-md-12">
                    <div class="col-md-12"><h5>TOTAL: $<?php echo number_format((float) $ventas,2,'.','');  ?></h5></div>
                    <div class="col-md-12"><h5>PROPINA: SIN PROPINA</h5></div>
                    <div class="col-md-12"><h5><i class="bi bi-arrow-right-short"></i> A COBRAR: $<?php echo number_format((float) $cobrar,2,'.','');  ?></h5></div>
                    </div>
                  </div>








                   <div class="col-md-4 contenidoPlato esp">
                     <div class="col-md-12"><h3 class="text-center">ORDEN #<?php  echo $orden; ?></h3></div>

                     <div class="col-md-12">
                        <button class="btn btn-dark btn-block" data-toggle="modal" data-target="#dividir"><i class="bi bi-input-cursor"></i><br> DIVIDIR ORDEN</button>
                        <br><br><br>
                       
                      </div>
                      <br>
                     <div class="col-md-12">

                            <div class="col-md-12">
<center>
    <a href="precuentaenvio.php?orden=<?php  echo $orden; ?>" class="btn btn-info" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer"></i> TICKET</a>


                                <a href="" class="btn btn-info"><i class="bi bi-printer"></i> RECIBO</a>
</center> 
                            </div>
                            <br>
                            <hr>

                            <div class="col-md-12">
                            <div class="form-group">
                                <select name="" id="tipopago" class="form-control">
                                <option value="0">ELEGIR METODO DE PAGO</option>
                                <option value="1">EFECTIVO</option>
                                <option value="2">TARJETA</option>
                                <option value="3">CREDITO</option>
                                <option value="4">CORTESIA</option>
                                <option value="5">DEPOSITO</option>
                                </select>
                            </div>
                              <center><button class="btn btn-danger btn-block" onclick="terminar()"><i class="bi bi-check-circle"></i><br> TERMINAR PROCESO DE CIERRE</button> </center> 
                            </div>
                     </div>

                     <input type="text" value="<?php echo $idcliente;  ?>" id="idcli" style="display:none">
                     <input type="text" value="<?php echo $orden;  ?>" id="orden" style="display:none">
                     <input type="text" value="<?php echo number_format((float) $cobrar,2,'.','');   ?>" id="pago" style="display:none">
                   </div>
               </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>