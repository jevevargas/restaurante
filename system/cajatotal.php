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
  <script src="../app/js/caja.js"></script>
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
            <div class="col-md-12">
              <h5 class="text-center">Información de la caja</h5>
            </div>
            <hr>
            <div class="col-md-12">
              <?php
              $usu = $_SESSION['idusuario']; //echo $usu;
              $admin = $_SESSION['admin']; //echo $admin;

              include('../config/conexion.php');
              date_default_timezone_set('America/El_Salvador');
              $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
              $todalcaja->execute();
              while ($resultc = $todalcaja->fetch()) {
                $inicio = $resultc->iniciocaja; //echo $inicio;
                $fecha = $resultc->fincaja;  // echo $fecha;
                $fondo = $resultc->fondocaja; //echo $fondo;
              }
              $total = 0;
              $todalazona = $pdo->prepare("SELECT * FROM egreso LEFT JOIN usuario ON egreso.idusuario=usuario.idusuario WHERE  fechaegresolarga  BETWEEN  '$inicio' AND '$fecha' ");
              $todalazona->execute();
              while ($resultb = $todalazona->fetch()) {
                $total += $resultb->montoegreso;
              }

              $ventas = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND idusuario = '$usu'  ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $ventas += $resultc->totalpago;
              }
              $efectivo = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND tipopago='1' AND idusuario = '$usu'   ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $efectivo += $resultc->totalpago;
              }
              $tarjeta = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND tipopago='2'  AND idusuario = '$usu'   ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $tarjeta += $resultc->totalpago;
              }
              $credito = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND tipopago='3' AND idusuario = '$usu'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $credito += $resultc->totalpago;
              }
              $cortesia = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND tipopago='4' AND idusuario = '$usu'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $cortesia += $resultc->totalpago;
              }
              $deposito = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$fecha' AND tipopago='5' AND idusuario = '$usu'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $deposito += $resultc->totalpago;
              }

              $totalo = $pdo->prepare(" SELECT * FROM usuario WHERE idusuario='$usu'  ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $admin = $resultc->admin;
              }
              // creditos
              $pagocreefe = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapagocre  BETWEEN  '$inicio' AND '$fecha' AND tipopagocre='1'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $pagocreefe += $resultc->totalpago;
              }
              $pagocredes = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapagocre  BETWEEN  '$inicio' AND '$fecha' AND tipopagocre='2'     ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $pagocredes += $resultc->totalpago;
              }
              $pagocretar = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapagocre  BETWEEN  '$inicio' AND '$fecha' AND tipopagocre='3'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $pagocretar += $resultc->totalpago;
              }
              $pagocrebit = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapagocre  BETWEEN  '$inicio' AND '$fecha' AND tipopagocre='4' '    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $pagocrebit += $resultc->totalpago;
              }
              $pagocretran = 0;
              date_default_timezone_set('America/El_Salvador');
              $totalo = $pdo->prepare(" SELECT * FROM pago WHERE  fechapagocre  BETWEEN  '$inicio' AND '$fecha' AND tipopagocre='5'    ");
              $totalo->execute();
              while ($resultc = $totalo->fetch()) {
                $pagocretran += $resultc->totalpago;
              }


              ?>
              <?php
              if ($admin == 1) {
              ?>
                <div class="col-md-12">
                  <h5><i class="bi bi-check-circle-fill" style="color:#00DA60"></i> TOTAL VENTA $<?php echo number_format((float) $ventas, 2, '.', '');  ?> (+)</h5>
                </div>
                <hr>
                <div class="col-md-12">
                  <h5><i class="bi bi-wallet-fill" style="color:#00DA60"></i> TOTAL EFECTIVO $<?php echo number_format((float) $efectivo, 2, '.', '');  ?> (+)</h5>
                </div>
                <hr>
                <div class="col-md-12">
                  <h5><i class="bi bi-credit-card-2-back-fill" style="color:#00DA60"></i> TOTAL TARJETA $<?php echo number_format((float) $tarjeta, 2, '.', '');  ?> (+)</h5>
                </div>
                <hr>
                <div class="col-md-12">
                  <h5><i class="bi bi-file-text-fill" style="color:#00DA60"></i> TOTAL CREDITO $<?php echo number_format((float) $credito, 2, '.', '');  ?> (-)</h5>
                </div>
                <hr>
                <div class="col-md-12">
                  <h5><i class="bi bi-gift-fill" style="color:#00DA60"></i> TOTAL CORTESIA $<?php echo number_format((float) $cortesia, 2, '.', '');  ?> (-)</h5>
                </div>
                <hr>
                <div class="col-md-12">
                  <h5><i class="bi bi-node-plus-fill" style="color:#00DA60"></i> TOTAL DEPOSITO $<?php echo number_format((float) $deposito, 2, '.', '');  ?> (-)</h5>
                </div>

                <div class="col-md-12 alert alert-info">
                  <h5 class="text-center">$<?php $totalventa = $ventas - $tarjeta - $credito - $cortesia - $deposito;
                                            echo number_format((float) $totalventa, 2, '.', '');
                                            ?></h5>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <button class="btn btn-info" data-toggle="modal" data-target="#cierre"><i class="bi bi-archive-fill" style="font-size:20px;"></i><br> Cerrar caja</button>

                    <button class="btn btn-danger esp" data-toggle="modal" data-target="#cierrep"><i class="bi bi-archive-fill" style="font-size:20px;"></i><br> Cerrar caja</button>


                  </div>
                </div>
              <?php
              } elseif ($admin == 0) {
              ?>
                <div class="col-md-12">
                  <h5 class="text-center">No tienes el permiso del administrador</h5>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <center> <button class="btn btn-info" data-toggle="modal" data-target="#cierre"><i class="bi bi-archive-fill" style="font-size:20px;"></i><br> Cerrar caja</button>

                      <button class="btn btn-success esp" data-toggle="modal" data-target="#cierrep"><i class="bi bi-archive-fill" style="font-size:20px;"></i><br> Corte parcial</button>
                    </center>

                    <!-- <button class="btn btn-warning arriba addadmin" data-toggle="modal" data-target="#addadmin" value="<?php echo $usu ?>"><i class="bi bi-plus-circle" style="font-size:20px;"></i><br> AGREGAR PERMISO DE ADMINISTRADOR </button> -->
                    <span id="usu<?php echo $usu;  ?>" style="display:none"><?php echo $usu  ?></span>
                  </div>
                </div>
              <?php
              }
              ?>




            </div>
          </div>
          <div class="col-md-7 contenidoPlato esp">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="">FACTURA</label>
                <input type="text" id="factura" class="form-control" rounder-0>
              </div>
              <div class="form-group col-md-2">
                <label for="">COSTO</label>
                <input type="text" id="costo" class="form-control">
              </div>
              <div class="form-group col-md-5">
                <label for="">DESCRIPCION</label>
                <input type="text" id="desc" class="form-control">
              </div>
              <div class="form-group col-md-2">
                <label for="">TIPO</label>
                <select name="tipodefact" id="tipofact" class="form-control">
                  <option value="1">Factura comercial</option>
                  <option value="2">Consumido final</option>
                  <option value="3">Credito fiscal</option>
                  <option value="4">Ticket</option>
                </select>
              </div>
              <div class="col-md-12">
                <center><button class="btn btn-success" onclick="egreso()">Registrar</button></center>
              </div>

            </div>
            <hr>
            <div class="col-md-12 table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <td>ID</td>
                    <td>Factura</td>
                    <td>Costo</td>
                    <td>Descripción</td>
                    <td>tipo factura</td>
                    <td>USER</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody id="tablaegreso"></tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>





  <!-- cierre -->
  <div class="modal fade" id="cierre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CIERRE DE CAJA TOTAL</h5>
        </div>
        <div class="modal-body">
          <input type="text" value="<?php echo $usu; ?>" id="idu" style="display:none">
          <input type="text" value="<?php echo $ventas; ?>" id="ven" style="display:none">
          <input type="text" value="<?php echo $efectivo; ?>" id="efe" style="display:none">
          <input type="text" value="<?php echo $tarjeta; ?>" id="tar" style="display:none">
          <input type="text" value="<?php echo $credito; ?>" id="cre" style="display:none">
          <input type="text" value="<?php echo $cortesia; ?>" id="cor" style="display:none">
          <input type="text" value="<?php echo $deposito; ?>" id="dep" style="display:none">
          <input type="text" value="<?php echo number_format((float) $total, 2, '.', ''); ?>" id="egre" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocreefe, 2, '.', ''); ?>" id="creefe" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocredes, 2, '.', ''); ?>" id="credes" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocretar, 2, '.', ''); ?>" id="cretar" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocrebit, 2, '.', ''); ?>" id="crebit" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocretran, 2, '.', ''); ?>" id="cretran" style="display:none">

          <input type="text" value="<?php echo number_format((float) $fondo, 2, '.', ''); ?>" id="inicio" style="display:none">

          <input type="text" value="<?php echo $inicio;  ?>" id="fechainicio" style="display:none">
          <input type="text" value="<?php echo $fecha;  ?>" id="finaly" style="display:none">


          <h1 class="text-center"><i class="bi bi-plus-circle-fill" style="font-size:60px; color:#63BE09;"></i></h1>
          <div class="input-group">
            <input type="text" Class="form-control" id="arqueo">
            <button class="btn btn-success  rounded-0" onclick="arqueo()">
              INGRESAR ARQUEO </button>
          </div>
          <br>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>

        </div>
      </div>
    </div>
  </div>


  <!-- parcial -->
  <div class="modal fade" id="cierrep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CIERRE DE CAJA PARCIAL</h5>
        </div>
        <div class="modal-body">
          <input type="text" value="<?php echo $usu; ?>" id="idu" style="display:none">
          <input type="text" value="<?php echo $ventas; ?>" id="ven" style="display:none">
          <input type="text" value="<?php echo $efectivo; ?>" id="efe" style="display:none">
          <input type="text" value="<?php echo $tarjeta; ?>" id="tar" style="display:none">
          <input type="text" value="<?php echo $credito; ?>" id="cre" style="display:none">
          <input type="text" value="<?php echo $cortesia; ?>" id="cor" style="display:none">
          <input type="text" value="<?php echo $deposito; ?>" id="dep" style="display:none">
          <input type="text" value="<?php echo number_format((float) $total, 2, '.', ''); ?>" id="egre" style="display:none">
          <input type="text" value="<?php echo number_format((float) $pagocreefe, 2, '.', ''); ?>" id="creefe" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocredes, 2, '.', ''); ?>" id="credes" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocretar, 2, '.', ''); ?>" id="cretar" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocrebit, 2, '.', ''); ?>" id="crebit" style="display:none">

          <input type="text" value="<?php echo number_format((float) $pagocretran, 2, '.', ''); ?>" id="cretran" style="display:none">

          <input type="text" value="<?php echo number_format((float) $fondo, 2, '.', ''); ?>" id="inicio" style="display:none">

          <h1 class="text-center"><i class="bi bi-plus-circle-fill" style="font-size:60px; color:#D90000;"></i></h1>
          <div class="input-group">
            <input type="text" Class="form-control" id="arqueo">
            <button class="btn btn-danger  rounded-0" onclick="arqueop()">
              ARQUEO PARCIAL </button>
          </div>
          <br>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>

        </div>
      </div>
    </div>
  </div>


  <?php require_once('pie.php');  ?>
</body>

</html>