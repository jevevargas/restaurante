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
        <nav id="sidebar" class="active">
            <?php require_once('menu.php'); ?>
        </nav>

        <!-- Page Content  -->
          <div id="content" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
             <?php require_once('lateral.php');  ?>
            </nav>
        
            <div class="container blanco">
              <div class="col-md-10">
              <div class="col-md-12"><h5 class="text-center">HISTORIAL</h5></div>

              <table class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <td>ID</td>
                          <td>PRODUCTO</td>
                          <td>CANTIDAD</td>
                          <td>FECHA</td>
                          <td>FACTURA</td>
                          <td>PROVEEDOR</td>
                          <td>PRECIO</td>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
               $idbodega=$_POST['idbodega'];  //echo $idbodega ;
                $estado = $pdo->prepare(" SELECT * FROM movbode LEFT JOIN bodega ON movbode.id_bodega = bodega.id_bodega WHERE movbode.id_bodega='$idbodega' ");
                $estado->execute();
                while ($result = $estado->fetch()) {
              ?>
              <tr>
                  <td><?php  echo $result -> idmovbode; ?></td>
                  <td><?php  echo $result -> producto_bodega; ?></td>
                  <td><?php  echo $result -> canmovbod; ?></td>
                  <td><?php  echo $result -> fechamovbod; ?></td>
                  <td><?php  echo $result -> factura; ?></td>
                  <td><?php  echo $result -> proveedor; ?></td>
                  <td><?php  echo $result -> costomov; ?></td>
                 
              </tr>
              <?php } ?>
              </div>
                  </tbody>
              </table>
              

             
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>