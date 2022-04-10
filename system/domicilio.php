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
    <script src="../app/js/envio.js"></script>
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

                      <div class="col-md-12"><h5 class="text-center"><i class="bi bi-plus-circle-fill" style="font-size:20px; color:#A3D900;"></i> INGRESAR DATOS DEL CLIENTE</h5></div>
                      <hr>
                      <div class="col-md-12">
                          <div class="row">

                              <div class="col-md-12 form-group">
                                  <label for="">NOMBRE</label>
                                  <input type="text" id="nombrecliente" class="form-control" onkeyup="mayus(this);">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                              </div>
                              
        

                            <div class="form-group col-md-12 col-xs-12">
                            <label for="">ELEGIR TIPO DE ENTREGA</label>
                            <select name="" id="tipo" class="form-control">
                                <option value="2">DOMICILIO</option>
                                <option value="3">LLEVAR</option>
                            </select>
                            </div>

                            <div class="col-md-12 form-group">
                                  <label for="">DIRECCION</label>
                                  <input type="text" id="direccioncli" class="form-control" onkeyup="mayus(this);">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                            <div class="col-md-6 form-group">
                                  <label for="">TELEFONO</label>
                                  <input type="text" id="telefonocli" class="form-control">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                            <div class="col-md-6 form-group">
                                  <label for="">DUI O NIT</label>
                                  <input type="text" id="duicli" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                              <div class="row">
                                <center><button class="btn btn-success" onclick="usuarioenvio()" style="margin-left:20px">INGRESAR</button></center> 
                                <center><button class="btn btn-danger" style="margin-left:10px">BUSCAR</button></center> 
                             </div>
                            </div>
                          </div>
                      </div>
                   </div>


                   <div class="col-md-7 contenidoPlato esp">
                       <table class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <td>ID</td>
                                   <td><i class="bi bi-person-check-fill"></i> NOMBRE</td>
                                   <td><i class="bi bi-house-fill"></i> DIRECCION</td>
                                   <td><i class="bi bi-phone-vibrate-fill"></i> TELEFONO</td>
                                   <td><i class="bi bi-postcard-fill"></i> DOCUMENDO</td>
                                   <td>TIPO PEDIDO</td>
                                   
                               </tr>
                           </thead>
                           <tbody id="tablauserpedido"></tbody>
                       </table>
                   </div>
               </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>