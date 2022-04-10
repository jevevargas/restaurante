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
    <script src="../app/js/metodopago.js"></script>
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
                  <div class="col-md-9 contenidoPlato esp">
                    <div class="col-md-12"><h5 class="text-center">FILTRAR POR TIPO DE PAGO</h5></div>

                    <div class="col-md-12">
                      <div class="row">
                      <div class="form-group col-md-3">
                                  <label for="">FECHA INICIAL</label>
                                  <input type="datetime-local" class="form-control" id="inicial">
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="">FECHA FINAL</label>
                                  <input type="datetime-local" class="form-control" id="final">
                               </div>
                               <div class="col-md-3">
                                 <label for="">TIPO DE PAGO</label>
                                 <select name="" id="tipopago" class="form-control">
                                  <option value="">TODOS</option>
                                  <option value="1">EFECTIVO</option>
                                  <option value="2">TARJETA</option>
                                  <option value="3">CREDITO</option>
                                  <option value="4">CORTESIA</option>
                                  <option value="5">DEPOSITO</option>
                                 </select>
                               </div>
                               <div class="col-md-2">
                                 <label for="">.</label>
                                 <br>
                                 <button class="btn btn-success" id="buscar"><i class="bi bi-funnel"></i> FILTRAR</button>
                               </div>

                      </div>
                    </div>
                    <hr>
                     <div class="col-md-12" id="resultado">

                     </div>




                  </div>

                  <div class="col-md-2 contenidoPlato esp"></div>
                </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>