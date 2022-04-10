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
    <script src="../app/js/caja.js"></script>
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
                 <div class="col-md-12 contenidoPlato">
                     <div class="col-md-12"><h5 class="text-center">CUADRES</h5></div>
                     <center><button class="btn btn-danger" onclick="cerrarsistema()">CERRAR TODO EL SISTEMA</button></center>
                     <hr>
                <div class="col-md-12">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td><i class="bi bi-person-circle"></i></td>
                                <td>EFECTIVO</td>
                                <td>TARJETA</td>
                                <td>CREDITO</td>
                                <td>CORTESIA</td>
                                <td>DEPOSITO</td>
                                <td>EGRESO</td>
                                <td>ARQUEO</td>
                                <td><i class="bi bi-calendar3"></i></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $usu=$_SESSION['idusuario']; //echo $usu;
                              include('../config/conexion.php');
                              date_default_timezone_set('America/El_Salvador');
                              $todalcaja = $pdo->prepare(" SELECT * FROM cuadre left join usuario ON cuadre.idusuario = usuario.idusuario LEFT JOIN caja ON usuario.idusuario=caja.idusuario   ORDER BY idcuadre DESC ");
                              $todalcaja->execute();
                              while ($resultc = $todalcaja->fetch()) {
                                  $tipo = $resultc -> tipocuadre;
                                  $estado=$resultc -> estadocierre;
                            ?>
                            <tr>
                                <td><?php echo $resultc -> idcuadre; ?></td>
                                <td><?php echo $resultc -> nombre; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> efectivo; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> tarjeta; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> credito; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> cortesia; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> deposito; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> egreso; ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php echo $resultc -> arqueo; ?></td>
                                <td><?php echo $resultc -> fechacierre; ?></td>
                                <td>
                                    <?php
                                    if($tipo == 2){
                                          ?>
                                          <a href="" class="btn btn-danger"><i class="bi bi-printer"></i></a>
                                          
                                          <?php
                                      }elseif($tipo ==1){
                                          ?><a href="cuadretotal.php?id=<?php echo $resultc -> idcuadre; ?>" class="btn btn-success " onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer"></i></a>

                                          <button class="btn btn-sm btn-danger cerrar"   data-toggle="modal" data-target="#cerrar" value="<?php echo $resultc -> idcuadre; ?>">CERRAR</button>
                                          <span id="idc<?php  echo $resultc -> idcuadre;  ?>" style="display:none"><?php  echo $resultc ->idusuario;  ?></span>
                                          <span id="idcu<?php  echo $resultc -> idcuadre;  ?>" style="display:none"><?php  echo $resultc ->idcuadre;  ?></span>
                                          <?php
                                      } ?>
                                </td>
                                <td>
                                    <?php
                                      if($tipo == 2){
                                          ?>(Parcial)<?php
                                      }elseif($tipo ==1){
                                          ?>(Final)</button><?php
                                      }
                                    ?>
                                    <?php 
                                if($estado ==1){
                                    ?>(<i class="bi bi-check-circle-fill" style="color:#63BE09"></i>Abierta)<?php
                                }elseif($estado==0){
                                    ?>(<i class="bi bi-x-circle-fill" style="color:red;"></i> Cerrada)<?php
                                }
                                ?>
                                </td>
                            
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                 </div>
            </div> 

          </div>
		</div>






     <?php  require_once('pie.php');  ?>
    </body>
</html>
