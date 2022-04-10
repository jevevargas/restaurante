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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    

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
                   <div class="col-md-1 todoMenu lou2" id="todomenu"></div>

                    <div class="col-md-3 todoMenu">
                        <div class="col-md-12"><h5 class="text-center">ASIGNAR BOTONES AL MENU</h5></div>
                   
        <div class="col-md-12 contenidoIcon contenidoUsu">
            <button class="btn btn-warning botonn"  data-toggle="modal" data-target="#botonn">AGREGAR BOTON DE MENU AL USUARIO</button>
            
        </div>  

                    </div>
                   <div class="col-md-7">
                    
                      <div class="col-md-12 ingresarBoton">
                        <div class="row">
                          <div class="col-md-12"><h5 class="text-center">AGREGAR BOTON DEL MENU</h5></div>

                            <div class="form-group col-md-4">
                              <input type="text" id="nommenu" class="form-control" placeholder="NOMBRE DEL BOTON" onkeyup="mayus(this);">
                            </div>

                            <div class="form-group col-md-8">
                              <input type="text" id="iconomenu" class="form-control" placeholder="ICONO DEL BOTON (BOOTSTRAP 4.6 https://icons.getbootstrap.com/)" >
                            </div>

                            <div class="form-group col-md-4">
                              <input type="text" id="clase" class="form-control" placeholder="CLASE" >
                            </div>

                            <div class="form-group col-md-4">
                              <input type="text" id="link" class="form-control" placeholder="LINK">
                            </div>

                            <div class="form-group col-md-4">
                              <button class="btn btn-success" onclick="ingresarmenu()">INGRESAR</button>
                            </div>

                          </div>
<hr>
                          <div class="col-d-12">
                              <div class="col-md-12"><h5 class="text-center">ELIMINAR MENU AL USUARIO</h5></div>
                              <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                   <thead>
                                      <tr>
                                        <td>IDUSUARIO</td>
                                        <td>NOMBRE</td>
                                        <td>ROL</td>
                                        <td></td>
                                      </tr>
                                   </thead>
                                   <tbody>
                                   <?php
                                   $estado = $pdo->prepare(" SELECT * FROM usuario LEFT JOIN tipo ON usuario.idtipo = tipo.idtipo ");
                                   $estado->execute();
                                   while ($result = $estado->fetch()) {
                                    $idusuario = $result -> idusuario;
                                    $nombreu = $result -> nombre;
                                    $rol = $result -> tipo;

                                  ?>
                                   <tr>
                                     <td style="font-size:12px;"><?php echo $idusuario;  ?></td>
                                     <td style="font-size:12px;"><?php echo $nombreu;  ?></td>
                                     <td style="font-size:12px;"><?php  echo  $rol; ?></td>
                                     <td style="font-size:12px;">
                                       <form action="eliminarmenu" method="POST">
                                         <input type="text" name="idui" value="<?php  echo $idusuario; ?>" style="display:none">
                                         <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-arrow-right-circle"></i> </button>
                                       </form>
                                     </td>
                                   </tr>
                                  <?php } ?>
                                   </tbody>
                                </table>
                              </div>
                          </div>

                      </div>
                   </div>
               </div>
            </div> 

          </div>
		</div>



<!-- eitar -->
<div class="modal fade" id="botonn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ASIGNAR MENU</h5>
      </div>
      <div class="modal-body">
       
       <div class="col-md-12">
           
           <form action="asignarnav" method="post">
           <div class="row">
           <div class="form-group col-md-12">
             <select name="idusu" id="idusu" class="form-control">
             <?php
                  $estado = $pdo->prepare(" SELECT * FROM usuario ");
                    $estado->execute();
                    while ($result = $estado->fetch()) {
               ?>
         <option value="<?php echo $result -> idusuario; ?>"><?php  echo $result -> nombre; ?></option>
               <?php } ?>
             </select>
           </div>
               <?php
                  $estado = $pdo->prepare(" SELECT * FROM menu ");
                    $estado->execute();
                    while ($result = $estado->fetch()) {
               ?>
                <div class="col-md-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox" name="checkbox[]" value="<?php echo $result ->idmenu; ?>">
                    <label class="form-check-label" for="inlineCheckbox1"><?php echo $result ->menu; ?></label>
                    </div>
                </div>

               <?php } ?>
               <div class="col-md-12 botonForm"> <center><input type="submit" class="btn btn-success" value="ASIGNAR" ></center></div>
              
               </div>
            </form>
          
       </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        
      </div>
    </div>
  </div>
</div>

<?php  require_once('pie.php');  ?>
    </body>
</html>