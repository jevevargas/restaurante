<?php
$idplato=$_POST['idplato']; //echo $idplato;
?>
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
    <script src="../app/js/composicion.js"></script>
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
              <div class="col-md-12 composicion">
                  <div class="col-md-12"><h5 class="text-center">AGREGAR COMPOSICION</h5></div>
                        <hr>
                      <div class="col-md-12">
                        <div class="row">

                            <?php
                                date_default_timezone_set('America/El_Salvador');
                                $todalazona = $pdo->prepare(" SELECT * FROM plato WHERE idplato='$idplato' ");
                                $todalazona->execute();
                                while ($result = $todalazona->fetch()) {
                            ?>

                            <input type="text" VALUE="<?php echo $idplato; ?>" id="idplato" style="display:none">
                           <div class="form-group col-md-2">
                               <label for="">PRODUCTOS DE BODEGA</label>
                               <select name="idbodega" id="idbodega" class="form-control">
                               <?php
                                date_default_timezone_set('America/El_Salvador');
                                $todalazona = $pdo->prepare(" SELECT * FROM bodega ");
                                $todalazona->execute();
                                while ($resultb = $todalazona->fetch()) {
                            ?>
                             <option value="<?php echo $resultb -> id_bodega ?>"><?php echo $resultb -> producto_bodega ?></option>
                            <?php } ?>
                               </select> 
                           </div>
                            <div class="form-group col-md-2">
                               <label for="">CANTIDAD</label>
                               <input type="text" class="form-control" id="cantidad">
                            </div>
                            <div class="form-group col-md-2">
                                <br>
                                <button class="btn btn-success"onclick="compocicion()">AGREGAR</button>
                            </div>

                            <div class="col-md-4 iconocomida"><i class="bi bi-cup-straw" style="font-size:40px;"></i> <?php  echo $result -> nomplato;  ?></div>

                        </div>

                           <?php }  ?>
                      </div>
                         <hr>
                      <div class="col-md-12">
                        <h5>COMPOSICIONES</h5>
                        <div class="col-md-12">
                          <table class="table table-bordered table-striped">
                             <thead>
                               <tr>
                                 <td>ID</td>
                                 <td>PRODUCTO</td>
                                 <td>CANTIDAD</td>
                               </tr>
                             </thead>
                             <tbody id="tablacompo"></tbody>
                          </table>
                        </div>
                      </div>
              </div>
            </div> 

          </div>
		</div>



<!-- Modal -->
<div class="modal fade" id="eliminarc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ELIMINAR EL INGREDIENTE</h5>
      </div>
      <div class="modal-body">
       <input type="text" id="idcompo" style="display:none">
       <h1 class="text-center"><i class="bi bi-question-circle" style="font-size:70px"></i></h1>
       <h5 class="text-center">DESEA ELIMINAR EL INGREDIENTE?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="eliminarcompo()">ELIMINAR</button>
      </div>
    </div>
  </div>
</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>