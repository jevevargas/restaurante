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
    <script src="../app/js/inactivo.js"></script>
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
            <div class="col-md-12">
              <div class="container blanco">
                 <div class="col-md-12"><h5 class="text-center">PLATOS CON INGREDIENTES - <span>INACTIVOS</span></h5></div>
                 <hr>
                 <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="caja_busqueda" placeholder="Buscar plato" name="caja_busqueda">
                    </div>
                    

                   <hr>
                    <div class="col-md-12 table-responsive tablaco" id="tablai">
                    </div>
                 </div>
              </div> 
            </div> 
            </div> 

          </div>
		</div>


<!-- Modal -->
<div class="modal fade" id="nom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR EL NOMBRE </h5>

      </div>
      <div class="modal-body">
       <input type="text" id="nome" style="display:none">
       <div class="form-group">
           <label for="">NOMBRE PLATO</label>
           <input type="text" id="nomrepla" class="form-control" onkeyup="mayus(this);">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success" onclick="modificarnom()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="precio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR EL PRECIO </h5>

      </div>
      <div class="modal-body">
       <input type="text" id="preciop" style="display:none">
       <div class="form-group">
           <label for="">PRECIO PLATO</label>
           <input type="text" id="preciopla" class="form-control">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success" onclick="modificarprecio()">MODIFICAR</button>
      </div>
    </div>


    
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="desci" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR LA DESCRIPCION </h5>

      </div>
      <div class="modal-body">
       <input type="text" id="ipdesc" style="display:none">
       <div class="form-group">
           <label for="">DESCRIPCION PLATO</label>
           <input type="text" id="despla" class="form-control" onkeyup="mayus(this);">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success" onclick="modificardesc()">MODIFICAR</button>
      </div>
    </div>


    
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="activar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTIVAR </h5>

      </div>
      <div class="modal-body">
       <input type="text" id="desacti" style="display:none">
       <h5 class="text-center">ACTIVAR EL PLATO?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
        <button type="button" class="btn btn-success" onclick="activar()">ACTIVAR</button>
      </div>
    </div>


    
  </div>
</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>