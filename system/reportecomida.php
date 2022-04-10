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
    <script src="../app/js/administrador.js"></script>
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
               <div class="row">
                   <div class="col-md-7 contenidoPlato esp">
                       <div class="col-md-12"><h5 class="text-center">REPORTE DE VENTAS POR COMIDA</h5></div>
                       <hr>
                       <table class="table table-hover table-bordered">
                           <thead>
                               <tr>
                                   <td>PLATO</td>
                                   <td>CANTIDAD</td>
                               </tr>
                           </thead>
                           <tbody>
                               <?php
                                $usu=$_SESSION['idusuario']; //echo $usu;
                                include('../config/conexion.php');
                                date_default_timezone_set('America/El_Salvador');
                                $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
                                $todalcaja->execute();
                                while ($resultc = $todalcaja->fetch()) {
                                $inicio =$resultc ->iniciocaja; //echo $inicio;
                                $fecha=date('Y-m-d H:i:s');  //echo $fecha;
                                }
    
                                $total = $pdo->prepare("SELECT a.idplato, a.nomplato,  SUM(b.cantidadorden) AS cant  FROM plato a LEFT JOIN venta b 
                                ON a.idplato = b.idplato WHERE fechaorden  BETWEEN  '$inicio' AND '$fecha' GROUP BY a.idplato, a.nomplato
                                ");
                                $total->execute();
                                while ($result = $total->fetch()) {
                                    
                               ?>
                                <tr>
                                    <td><?php echo $result -> nomplato; ?></td>
                                    <td><b>(<?php  echo $result ->cant; ?>)</b></td>
                                </tr>
                               <?php } ?>
                           </tbody>
                       </table>
                   </div>
                   <div class="col-md-4 contenidoPlato esp">
                       <div class="col-md-12"><h5 class="text-center">REPORTE DE COMIDA POR FECHAS</h5></div>
                       <div class="col-md-12">
                            <div class="row">
                               <div class="form-group col-md-6">
                                  <label for="">FECHA INICIAL</label>
                                  <input type="datetime-local" class="form-control" id="inicialc">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="">FECHA FINAL</label>
                                  <input type="datetime-local" class="form-control" id="finalc">
                               </div>
                               <div class="col-md-12"><center><button class="btn btn-success" id="buscarc">INSERTAR</button></center></div>
                           
                            </div>
                            <hr>
                            <div class="col-md-12"  id="resultadoc"></div>
                       </div>
                   </div>
               </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>