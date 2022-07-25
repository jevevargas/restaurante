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
                   <div class="col-md-4 ingresarPlato">
                      <div class="col-md-12"><center><i class="bi bi-check-circle-fill iconosenca"></i></center></div>
                     <div class="col-md-12"><h5 class="text-center">INGRESE EL PATO AL MENU</h5></div>
                     <div class="col-md-12">
                         <div class="row">
                             <hr>
                             <div class="form-group col-md-12">
                                 <input type="text" class="form-control is-valid" id="nomplato" onkeyup="mayus(this);" placeholder="INGRESAR EL NOMBRE DEL PLATO">
                             </div>
                              <hr>
                             <div class="form-group col-md-6">
                                <input type="text" class="form-control is-valid" id="pecioplato" placeholder="PRECIO">
                             </div>

                             <div class="form-group col-md-6">
                                <select name="impplato" id="impplato" class="form-control">
                                    <option value="1">COCINA</option>
                                    <option value="2">BAR</option>
                                    <option value="3">PUPUSAS</option>
                                </select>
                             </div>

                             <div class="form-group col-md-6">
                                <select name="catplato" id="catplato" class="form-control">
                                <?php
                                 require_once('header.php');
                                    $estado = $pdo->prepare(" SELECT * FROM categoria  ORDER BY categoria ASC ");
                                    $estado->execute();
                                    while ($result = $estado->fetch()) {
                                 ?>
                                 <option value="<?php echo $result -> idcategoria; ?>"><?php echo $result-> categoria; ?></option>
                                <?php } ?>
                                </select>
                             </div>

                             <div class="form-group col-md-12">
                                 <label for="">DESCRIPCION</label>
                                 <textarea name="descplato" id="descplato" class="form-control is-valid" onkeyup="mayus(this);"></textarea>
                             </div>

                         <div class="col-md-12">
                             <center><button class="btn btn-success" onclick="ingresarplato()">INGRESAR</button></center>
                         </div>
                         </div>
                     </div>
                   </div>
                   <div class="col-md-7 ingresarPlato">
                       <div class="col-md-12"><h5 class="text-center">SEGUIR EDITANDO</h5></div>
                       <hr>
                       <div class="col-md-12" id="contenidoUltimo"></div>
                       <hr>
                       <div class="col-md-12">
                           <div class="col-md-12"><h5 class="text-center">PLATOS SIN COMPOSICION</h5></div>

                           <div class="col-md-6">
                           <input type="text" class="form-control" id="caja_busqueda" placeholder="Buscar plato" name="caja_busqueda">
                           </div>
                           <div class="col-md-12" id="datos"></div>  

                       </div>
                   </div>
               </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>