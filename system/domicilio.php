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
    <link rel="stylesheet" href="../app/css/datatable.css">
    <script src="../app/js/datatable.js"></script>
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

                      <div class="col-md-12"><h5 class="text-center"><i class="bi bi-plus-circle-fill" style="font-size:20px; color:#A3D900;"></i> Ingresar datos del cliente</h5></div>
                      <hr>
                      <div class="col-md-12">
                          <div class="row">

                              <div class="col-md-12 form-group">
                                  <label for="">Nombre</label>
                                  <input type="text" id="nombrecliente" class="form-control" onkeyup="mayus(this);">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                              </div>
                              
        

                            <div class="form-group col-md-12 col-xs-12">
                            <label for="">Elegir tipo de entrega</label>
                            <select name="" id="tipo" class="form-control">
                                <option value="2">DOMICILIO</option>
                                <option value="3">LLEVAR</option>
                            </select>
                            </div>

                            <div class="col-md-12 form-group">
                                  <label for="">Dirección</label>
                                  <input type="text" id="direccioncli" class="form-control" onkeyup="mayus(this);">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                            <div class="col-md-6 form-group">
                                  <label for="">Teléfono</label>
                                  <input type="text" id="telefonocli" class="form-control">
                                  <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                            <div class="col-md-6 form-group">
                                  <label for="">DUI O NIT</label>
                                  <input type="text" id="duicli" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                              <div class="row">
                                <center><button class="btn btn-success" onclick="usuarioenvio()" style="margin-left:20px">Ingresar</button></center> 
                                <center><button class="btn btn-danger" style="margin-left:10px" data-toggle="modal" data-target="#activarcliente">Buscar</button></center> 
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
                                   <td><i class="bi bi-person-check-fill"></i> $nombre</td>
                                   <td><i class="bi bi-house-fill"></i> Dirección</td>
                                   <td><i class="bi bi-phone-vibrate-fill"></i> Teléfono</td>
                                   <td><i class="bi bi-postcard-fill"></i> Documento</td>
                                   <td>Tipo pedido</td>
                                   
                               </tr>
                           </thead>
                           <tbody id="tablauserpedido"></tbody>
                       </table>
                   </div>
               </div>
            </div> 

          </div>
		</div>



<!-- Modal -->
<div class="modal fade" id="activarcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTIVAR AL CLIENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="example" style="width:100%">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>CLIENTE</td>
                    <td>DIRECCION</td>
                    <td>DOCUMENTO</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            <?php
                
                   include('../config/conexion.php');

                //    date_default_timezone_set('America/El_Salvador');
                //    $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
                //    $todalcaja->execute();
                //    while ($resultc = $todalcaja->fetch()) {
                //      $inicio =$resultc ->iniciocaja;   //echo $inicio;
                //      $final=$resultc ->fincaja;  //echo $final;
                //    }  
                    $todalventa = $pdo->prepare(" SELECT * FROM cliente ");
                    $todalventa->execute();
                    while ($resultventa = $todalventa->fetch()) {  
                      
                    ?>
                <tr>
                    <td style="font-size:12px;"><?php  echo $resultventa->idcliente; ?></td>
                    <td style="font-size:12px;"><?php  echo $resultventa->nomcliente; ?></td>
                    <td style="font-size:12px;"><?php  echo $resultventa->direccioncliente; ?></td>
                    <td style="font-size:12px;"><?php  echo $resultventa->dui; ?></td>
                    <td style="font-size:12px;"><button class="btn btn-success btn-sm activar"  data-toggle="modal" data-target="#activar" value="<?php echo $resultventa ->idcliente; ?>"><i class="bi bi-check-circle-fill" ></i></button>
                    <span id="idcliente<?php  echo $resultventa ->idcliente; ?>" style="display:none"><?php  echo $resultventa ->idcliente; ?></span>
                   </td>
                </tr>

                    <?php } ?>
            </tbody>
            
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade bg-light" id="activar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTIVAR</h5>

      </div>
      <div class="modal-body">
          <h5 class="text-center">Activar el cliente</h5>
          <div class="form-group">
          <label for="">ELEGIR TIPO DE ENTREGA</label>
                <select name="" id="tipoe" class="form-control">
                    <option value="2">DOMICILIO</option>
                     <option value="3">LLEVAR</option>
                </select>

          </div>
        <input type="text" id="idcliente" style="display:none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="activarcliente()" data-dismiss="modal">ACTIVAR</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );

$(document).on('click', '.activar', function(){
var id=$(this).val();
var idcliente=$('#idcliente'+id).text();

 console.log(idcliente);

$('#activar').modal('show');
$('#idcliente').val(idcliente);

});

</script>

     <?php  require_once('pie.php');  ?>
    </body>
</html>