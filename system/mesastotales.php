<?php
 require_once('header.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app/css/bootstrap.css">
    <link rel="stylesheet" href="../app/css/style.css">
    <link rel="stylesheet" href="../app/css/icono.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c12fa38f79.js" crossorigin="anonymous"></script>
    <script src="../app/js/cdn.js"></script>
    <script src="../app/js/sw.js"></script>
    <script src="../app/js/entrar.js"></script>
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
              
<script src="../app/js/zona.js"></script>
<input type="text" value="<?php echo $id; ?>" id="idu" style="display:none">
<div class="row">
     
    <div class="col-md-12 islas">
     <div class="row">
      
        <button class="btn btn-light" data-toggle="modal" data-target="#agregarzona"  style="margin-left:10px;"><i class="bi bi-plus-circle-fill" style="color:#63BE09; font-size:20px;"></i> AGREGAR ZONA </button>
    
        <button class="btn btn-light" data-toggle="modal" data-target="#agregar"  style="margin-left:10px;"><i class="bi bi-plus-circle-fill" style="color:#63BE09; font-size:20px;"></i>  AGREGAR ZONA AL MESERO </button>

        <button class="btn btn-light" data-toggle="modal" data-target="#verzonas"  style="margin-left:10px;"><i class="bi bi-check-circle-fill"  style="color:#63BE09; font-size:20px;"></i> VER ZONA </button>

      <div class="col-md-12"  id="contmesas"></div>
      </div>
    </div>
  <!------------------------------------------ mesas --------------------------------------->   
</div>


<!-- elimimar -->
<div class="modal fade" id="verzonas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">ELIMINAR ZONA</h5>
      </div>
      <div class="modal-body">
      <div class="col-md-12" id="detalleZona"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>

<!-- agregar -->
<div class="modal fade" id="agregar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">AGREGAR ZONA</h5>
      </div>
      <div class="modal-body">
        <input type="text" value="<?php echo $id; ?>" id="idu" style="display:none">

        <div class="form-group">
          <label for="">ZONAS</label>
          <select name="zona" id="zona" class="form-control">
            <?php 
              date_default_timezone_set('America/El_Salvador');
              $estado = $pdo->prepare(" SELECT * FROM zona ");
              $estado->execute();
              while ($resultestado = $estado->fetch()) {
            ?>
             <option value="<?php echo $resultestado -> idzona ?>"><?php echo $resultestado -> zona ?></option>
            <?php  } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="">CLAVE DE ADMINISTRADOR</label>
          <input type="password" id="clave" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="agregarZona()" data-dismiss="modal">AGREGAR</button>
      </div>
    </div>
  </div>
</div>

<!-- elimimar -->
<div class="modal fade" id="eliminare" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">ELIMINAR ZONA</h5>
      </div>
      <div class="modal-body">
        <input type="text"  id="idzonass" style="display:none" >
        <input type="text" value="<?php echo $id; ?>" id="idue" style="display:none">
        <div class="form-group">
          <label for="">CLAVE DE ADMINISTRADOR</label>
          <input type="password" id="clavezonae" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="eliminarZona()" data-dismiss="modal">ELIMIMAR</button>
      </div>
    </div>
  </div>
</div>

<!-- addzona -->
<div class="modal fade" id="agregarzona" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">AGREGAR ZONA</h5>

      </div>
      <div class="modal-body">

        <div class="form-group">
          <label for="">NOMBRE DE LA NUEVA ZONA</label>
          <input type="text" id="nzona" class="form-control" onkeyup="mayus(this);">
        </div>
        <div class="form-group">
          <label for="">CLAVE DE ADMINISTRADOR</label>
          <input type="password" id="clavezonan" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success"onclick="nuevaZona()"  data-dismiss="modal">AGREGAR</button>
      </div>
    </div>
  </div>
</div>


            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>