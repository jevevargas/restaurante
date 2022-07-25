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
    <script src="../app/js/bodega.js"></script>
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
                  <div class="col-md-4 ingresarPlato">
                   <div class="row">
                    <div class="col-md-12"><center><i class="bi bi-check-circle iconosenca"></i></center></div>
                    <div class="col-md-12"><h5 class="text-center">INGRESAR PRODUCTO A BODEGA</h5></div>
                    <hr>

                      <div class="form-group col-md-12">
                        <input type="text" class="form-control is-valid" id="nombodega" placeholder="INGRESAR NOMBRE" onkeyup="mayus(this);">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" class="form-control is-invalid" id="cantidadbodega" placeholder="CANTIDAD" readonly>
                      </div>
                      <div class="form-group col-md-8">
                        <select name="idmedida" id="idmedida" class="form-control">
                        <option value="1">UNIDAD</option>
                           <option value="2">LITRO</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" class="form-control is-valid" id="costobodega" placeholder="COSTO">
                      </div>
                      <div class="form-group col-md-8">
                      <select name="idcategoria" id="idcategoria" class="form-control">
                      <?php
                      require_once('header.php');
                      $estado = $pdo->prepare(" SELECT * FROM categoriabodega ");
                      $estado->execute();
                      while ($result = $estado->fetch()) {
                      ?>
                        <option value="<?php echo $result -> idcategoriabodega ?>"><?php echo $result -> categoriabodega ?></option>
                      <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-12"><center><button class="btn btn-success" onclick="ingresarbodega()">INGRESAR</button></center></div>
                   </div>
                   <hr>
                   <div class="col-md-12 alert alert-success">Ingrese el producto nuevo primero, y despues cargue las cantidades a bodega</div>
                   <hr>
                   <center><a href="movbodega.php" class="btn btn-primary">Ver moviemientos de bodega</a></center>
                  </div>


                  <div class="col-md-7 ingresarPlato">
                   <h5 class="text-center">CARGAR CANTIDADES</h5>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="caja_busqueda" placeholder="Buscar plato" name="caja_busqueda">
                  </div>
                  <br>
                  

                    <div class="col-md-12 table-responsive" id="tablabodega">
                        
                    </div>
                  </div>
                </div>
            </div> 

          </div>
		</div>

<!-- Modal -->
<div class="modal fade" id="ordenar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CARGAR CANTIDAD AL PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
       <input type="text" id="idbode" style="display:none">
       
       <div class="form-group col-md-12">
         <label for="">CANTIDAD EXISTENTE EN BODEGA</label>
         <input type="text" id="cantbode" class="form-control is-valid" readonly>
       </div>
       <div class="form-group col-md-6">
         <label for="">CANTIDAD A INGRESAR</label>
         <input type="text" id="ncantbode" class="form-control is-valid">
       </div>
       <div class="form-group col-md-6">
         <label for="">FACTURA</label>
         <input type="text" id="factura" class="form-control">
       </div>

       <div class="form-group col-md-6">
         <label for="">PROVEEDOR</label>
         <input type="text" id="proveedor" class="form-control">
       </div>
       <div class="form-group col-md-6">
         <label for="">COSTO</label>
         <input type="text" id="coston" class="form-control">
       </div>

     

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button class="btn btn-success" onclick="ingresarbodegan()">INGRESAR A BODEGA</button>
      </div>
    </div>
  </div>
</div>

     <?php  require_once('pie.php');  ?>
    </body>
</html>