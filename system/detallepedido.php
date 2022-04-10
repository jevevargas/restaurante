<?php
 $idcliente=$_POST['idcli']; //echo $idcliente;
require_once('../config/conexion.php');
session_start();
if(!isset($_SESSION['idusuario'])){
   
$url='../index.php';
header("Location: $url");
}else{
    $id=$_SESSION['idusuario'];
    $nombre=$_SESSION['nombre'];
    $tipo=$_SESSION['tipo'];
    $permisoaddplato=$_SESSION['permisoaddplato'];
    $permisoaddtipo=$_SESSION['permisoaddtipo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENVENIDO <?php  echo $nombre; ?></title>
    <link rel="stylesheet" href="../app/css/bootstrap.css">
    <link rel="stylesheet" href="../app/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c12fa38f79.js" crossorigin="anonymous"></script>
    <script src="../app/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../app/js/envio.js"></script>
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
                <input type="text" value="<?php echo $idcliente;  ?>" id="idcliente" style="display:none">
               <div class="row">

                   <div class="col-md-4 DetalleVentapedido">
                       <?php
                       
                        date_default_timezone_set('America/El_Salvador');
                        $todalazona = $pdo->prepare("SELECT * FROM cliente WHERE idcliente='$idcliente'");
                        $todalazona->execute();
                        while ($resultb = $todalazona->fetch()) {
                            $nombre = $resultb -> nomcliente;
                        }
                       ?>
                       <div class="col-md-12"><h5 class="text-center"></h5></div>
                       <div class="col-md-12"><h5 class="text-center"><?php  echo $nombre; ?></h5></div>
                         <hr>
                       <div class="col-md-12">
                        <center>
                            <button class="btn btn-success" onclick="asignarorden()">ABRIR ORDEN</button>
                            <button class="btn btn-danger">EDITAR CLIENTE</button>
                        </center>
                        </div>
                        <hr>
                        <div class="col-md-12" id="carretilla"></div>

                   </div>
                   <div class="col-md-7 DetalleVentapedido">
                   <div class="col-md-12" id="menuplato"></div>
                   </div>
               </div>
            </div> 

          </div>
		</div>




  <!-- addplato -->
  <div class="modal fade" id="addplato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">NUEVO PLATO</h5>

        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="nomplato" placeholder="NOMBRE PLATO" onkeyup="mayus(this);">
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="precioplato" placeholder="PRECIO PLATO">
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="">CATEGORIA</label>
              <select name="cat" id="cat" class="form-control">
                <?php
                $estado = $pdo->prepare(" SELECT * FROM categoria ");
                $estado->execute();
                while ($result = $estado->fetch()) {
                ?>
                  <option value="<?php echo $result->idcategoria; ?>"><?php echo $result->categoria; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">IMPRESION</label>
              <select name="imp" id="imp" class="form-control">
                <option value="1">COCINA</option>
                <option value="2">BAR</option>
                <option value="3">PUPUSERIA</option>
                <option value="4">PIZZA</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="">DESCRIPCION</label>
              <textarea name="desc" id="descplato" class="form-control" onkeyup="mayus(this);"></textarea>
              <div class="invalid-feedback">Campo obligatorio</div>
            </div>
            <div class="col-md-12">
              <center><label for="">CLAVE</label></center>
              <center><input type="password" class="form-control col-md-4" id="clave"></center>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="nuevoplato()">GUARDAR</button>
        </div>
      </div>
    </div>
  </div>

  <!-- eitar -->
  <div class="modal fade" id="editacliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">EDITAR CLIENTE</h5>
        </div>
        <div class="modal-body">
          <?php
          $estado = $pdo->prepare(" SELECT * FROM cliente WHERE idmesa='$idmesa' AND estadocliente='1' ");
          $estado->execute();
          while ($result = $estado->fetch()) {
          ?>
            <input type="text" value="<?php echo $result->idcliente; ?>" id="idcliente" style="display:none">
            <div class="form-group">
              <label for="">NOMBRE</label>
              <input type="text" class="form-control" id="nombree" value="<?php echo $result->nomcliente; ?>">
            </div>
            <div class="form-group">
              <label for="">DUI</label>
              <input type="text" class="form-control" id="duie" value="<?php echo $result->dui; ?>">
            </div>
            <div class="form-group">
              <label for="">TELEFONO</label>
              <input type="text" class="form-control" id="telefonoe" value="<?php echo $result->telefonocliente; ?>">
            </div>
            <div class="form-group">
              <label for="">DIRECCION</label>
              <input type="text" class="form-control" id="direccione" value="<?php echo $result->direccioncliente; ?>">
            </div>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="editarcliente()">EDITAR</button>
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="eliminarventa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ELIMINAR?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <center><i class="bi bi-trash" style="font-size:90px;color:#B20000;"></i></center>
          <input type="text" id="ideliminare" name="ideliminare" style="display:none">
          <input type="text" name="cantidades" id="cantidadeseliminar" style="display:none">
          <input type="text" name="idPlato" id="idPlatoeliminar" style="display:none">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="eliminarorden()">ELIMNAR?</button>
        </div>
      </div>
    </div>
  </div>

  <!-- elimnar con permiso -->

  <div class="modal fade " id="elieli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <center><svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg></center>
        </div>
        <div class="col-md-12">
          <div class="form-group col-md-12">
            <input type="password" name="passclave" id="passclave" class="form-control" placeholder="Ingrese la clave">
          </div>

          <div class="form-group col-md-12">
            <input type="text" name="comenti" id="comenti" class="form-control" placeholder="Comentario">
            <input type="text" id="ideli" name="ideli" style="display:none">
            <input type="text" id="pre" name="pre" style="display:none">
          </div>

          <div class="form-group col-md-12">
            <button type="button" class="btn btn-danger btn-block" onclick="eliminapermiso()" data-dismiss="modal">ElIMINAR ORDEN</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">EDITAR</h5>

        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">COMENTARIO</label>
            <input type="text" class="form-control" id="comentario">
          </div>
          <input type="text" class="form-control" id="idnota" style="display:none">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="modificar()" data-dismiss="modal">MODIFICAR</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="subc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">SUB CUENTA</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">NOMBRE SUB CUENTA</label>
            <input type="text" class="form-control" id="nombresub" onkeyup="mayus(this);">
            <div class="invalid-feedback">Campo obligatorio</div>
            <input type="text" value="<?php echo $orden; ?>" id="ordensub" style="display:none">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="ingresarsub()">INGRESAR</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="cambiarmesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CAMBIAR DE MESA</h5>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <h4 class="text-center">ORDEN #<?php echo $orden; ?></h4>
          </div>
          <div class="form-group col-md-12">
            <input type="text" value="<?php echo $orden; ?>" style="display:none" id="ordencambio">
            <input type="text" value="<?php echo $idmesa; ?>" style="display:none" id="idmesacambio">
            <input type="text" value="<?php echo $nomcliente; ?>" style="display:none" id="nomcli">

            <label for="">MESAS DISPONIBLES</label>
            <select name="mesa" id="mesac" class="form-control">
              <?php
              $estado = $pdo->prepare(" SELECT * FROM mesa WHERE estadomesa='0' ");
              $estado->execute();
              while ($resultmesa = $estado->fetch()) {
              ?>
                <option value="<?php echo $resultmesa->idmesa; ?>"><?php echo $resultmesa->nombremesa; ?> - <?php echo $resultmesa->idmesa; ?></option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
          <button type="button" class="btn btn-success" onclick="cambiarcuenta()">CAMBIAR</button>
        </div>
      </div>
    </div>
  </div>








        <script src="../app/js/buscador.js"></script>
     <?php  require_once('pie.php');  ?>
    </body>
</html>
<?php
}


?>