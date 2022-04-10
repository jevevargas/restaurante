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
              <div class="col-md-10 contenidoPlato esp">
                <div class="col-md-12"><h5 class="text-center">HISTORIAL DE CUADRES</h5></div>
                <hr>
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>USUARIO</td>
                                <td>EFECTIVO</td>
                                <td>TARJETA</td>
                                <td>CREDITO</td>
                                <td>CORTESIA</td>
                                <td>DEPOSITO</td>
                                <td>EGRESO</td>
                                <td>ARQUEO</td>
                                <td>FECHA CIERRE</td>
                                <td>TIPO</td>
                                <td></td>
                               
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include('../config/conexion.php');
                                $todalcaja = $pdo->prepare("  SELECT * FROM cuadre LEFT JOIN usuario ON cuadre.idusuario =usuario.idusuario");
                                $todalcaja->execute();
                                while ($resultc = $todalcaja->fetch()) {
                                    $tipo = $resultc -> tipocuadre; 
                        ?>
                            <tr>
                            <td><?php echo $resultc -> idcuadre; ?></td>
                            <td><?php echo $resultc -> nombre; ?></td>
                            <td>$<?php echo $resultc -> efectivo; ?>(+)</td>
                            <td>$<?php echo $resultc -> tarjeta; ?>(-)</td>
                            <td>$<?php echo $resultc -> credito; ?>(-)</td>
                            <td>$<?php echo $resultc -> cortesia; ?>(-)</td>
                            <td>$<?php echo $resultc -> deposito; ?>(-)</td>
                            <td>$<?php echo $resultc -> egreso; ?>(-)</td>
                            <td>$<?php echo $resultc -> arqueo; ?>(-)</td>
                            <td><?php echo $resultc -> fechacierre; ?></td>
                            <td><?php 
                            if($tipo ==1){
                                ?>CUADRE<?php
                            }elseif($tipo ==2){
                                ?>CUADRE PARCIAL<?php
                            }
                            ?></td>
                            <td><a href="" class="btn btn-success btn-sm">IMPRIMIR </a></td>    
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                
              </div>
              <div class="col-md-1 contenidoPlato esp">
                  <a href="cuadre" class="btn btn-success">VER CUADRES</a>
              </div> 
              </div>
            </div> 

          </div>
          
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>