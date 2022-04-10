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
    <script src="../app/js/nmesa.js"></script>
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
                 <div class="col-md-4 contenidoPlato esp">
                   <center><i class="bi bi-info-circle-fill" style="font-size:60px; color:#63BE09;"></i></center>
                   <div class="col-md-12"><h5 class="text-center">INGRESAR UNA MESA NUEVA</h5></div>
                   <hr>
                   <div class="col-md-12">

                     <div class="form-group">
                       <label for="">NOMBRE DE MESA</label>
                       <input type="text" class="form-control" id="mesa" onkeyup="mayus(this);">
                     </div>

                     <div class="form-group">
                       <select name="" id="idzona" class="form-control">
                          <?php
                          require_once('header.php');
                          $estado = $pdo->prepare(" SELECT * FROM zona ");
                          $estado->execute();
                          while ($result = $estado->fetch()) {
                          ?>
                            <option value="<?php echo $result -> idzona ?>"><?php echo $result -> zona ?></option>
                          <?php } ?>
                       </select>
                     </div>

                     <div class="col-md-12"><center><button class="btn btn-success" onclick="nmesa()">INGRESAR</button></center></div>

                   </div>
                 </div>
                 <div class="col-md-7 contenidoPlato esp lou2">
                   <table class="table table-striped table-hover">
                     <thead>
                       <tr>
                         <td>ID</td>
                         <td>NOMBRE MESA</td>
                         <td>ZONA</td>
                         <td>ESTADO</td>
                         <td></td>
                       </tr>
                     </thead>
                     <tbody id="tablamesa"></tbody>
                   </table>
                 </div>
               </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>