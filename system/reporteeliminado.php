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
                       <div class="col-md-12"><h5 class="text-center">REPORTE DE ORDENES ELIMINADAS</h5></div>
                       <hr>
                       <div class="col-md-12 table-responsive">
                           <table class="table table-hover table-bordered">
                               <thead>
                                   <tr>
                                       <td>ID</td>
                                       <td>PRODCUTO</td>
                                       <td>COMENTARIO</td>
                                       <td>FECHA</td>
                                       <td>TOTAL</td>
                                       <td>USUARIO</td>
                                       
                                   </tr>
                               </thead>
                               <tbody>
                                <?php
                                include('../config/conexion.php');
                                date_default_timezone_set('America/El_Salvador');
                                $total = $pdo->prepare(" SELECT * FROM eliminar LEFT JOIN plato ON eliminar.idplato = plato.idplato LEFT JOIN usuario ON eliminar.idusuario = usuario.idusuario  ORDER BY id_eliminar DESC");
                                $total->execute();
                                while ($result = $total->fetch()) {
                                ?>
                                  <tr>
                                      <td><?php echo $result -> id_eliminar; ?></td>
                                      <td><?php echo $result -> nomplato; ?></td>
                                      <td><?php echo $result -> coment; ?></td>
                                      <td><?php echo $result -> fecha; ?></td>
                                      <td>$<?php echo $result -> totale; ?></td>
                                      <td><?php echo $result -> nombre; ?></td>
                                  </tr>
                                <?php } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>

                   <div class="col-md-4 contenidoPlato esp">
                   <div class="col-md-12"><h5 class="text-center">FILTRAR POR PERIODO DE TIEMPO</h5></div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="form-group col-md-6">
                                  <label for="">FECHA INICIAL</label>
                                  <input type="datetime-local" class="form-control" id="inicial">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="">FECHA FINAL</label>
                                  <input type="datetime-local" class="form-control" id="final">
                               </div>
                               <div class="col-md-12"><center><button class="btn btn-success" id="buscar">INSERTAR</button></center></div>
                           
                          </div>
                         <hr>
                            <div class="col-md-12">
                                <div class="col-md-12" id="resultado"></div>
                            </div>
                   </div>
                   </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>