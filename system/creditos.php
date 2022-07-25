<?php
require_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BIENVENIDO <?php echo $nombre; ?></title>
  <script src="../app/js/creditos.js"></script>
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
          <div class="col-md-9  contenidoPlato esp">
            <div class="col-md-12 border-bottom ">
              <h5 class="text-center">Reportes de créditos</h5>
            </div>
            <div class="col-md-12 mt-2 p-3">
              <div class="row">
                <input type="text" class="form-control col-md-4" id="caja_busqueda" placeholder="Buscar créditos por nombre" name="caja_busqueda">


              </div>
            </div>
            <hr>
            <div class="col-md-12" id="datos"></div>
          </div>


          <div class="col-md-2  contenidoPlato esp">

          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="modal fade" id="pagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pagar crédito</h5>

        </div>
        <div class="modal-body">
          <input type="text" id="ap" style="display:none">

          <div class="form-group">
            <label for="">Elegir el metódo de pago</label>
            <select name="" id="metodo" class="form-control">
              <option value="1">Efectivo</option>
              <option value="2">Descuento de planilla</option>
              <option value="3">Tarjeta</option>
              <option value="4">Bitcoin</option>
              <option value="5">Trasferencia</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="pagarcredito()" data-dismiss="modal">Pagar</button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once('pie.php');  ?>
</body>

</html>