<?php  $orden=$_REQUEST['orden']; //echo $orden; ?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12"><h5 class="text-center">ORDEN #<?php  echo $orden; ?></h5></div>
        <hr>
        <button class="btn btn-success"   data-toggle="modal" data-target="#cambiartipo"><i class="bi bi-shuffle"></i> Cambiar tipo de pago</button>
        <a  class="btn btn-danger esp"  href="precuentaenvior.php?orden=<?php  echo $orden; ?>" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" >Reimprimir ticket</a>
    </div>
</div>
<br>
<div class="col-md-12">
  <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <td>ID</td>
          <td>Plato</td>
          <td>Cantidad</td>
          <td>Nota</td>
          <td>Fecha</td>
          <td>Estado</td>
          <td>Mesero</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      <?php
        include('../config/conexion.php');
        session_start();
        $usu=$_SESSION['idusuario']; 
        //echo $usu;
        date_default_timezone_set('America/El_Salvador');
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
          $inicio =$resultc ->iniciocaja;
          $final =$resultc ->fincaja;
        }

          date_default_timezone_set('America/El_Salvador');
            $todalazona = $pdo->prepare("SELECT * FROM venta LEFT JOIN usuario ON venta.idusuario =usuario.idusuario WHERE  venta.orden='$orden' AND fechaorden  BETWEEN  '$inicio' AND '$final'");
          $todalazona->execute();
        while ($resultb = $todalazona->fetch()) {
      ?>
     <tr>
       <td><?php echo  $resultb->idventa; ?></td>
       <td><?php echo  $resultb->nomorden; ?></td>
       <td><?php echo  $resultb->cantidadorden; ?></td>
       <td><?php echo  $resultb->descorden; ?></td>
       <td><?php echo  $resultb->fechaordencorta; ?></td>
       <td><?php echo  $resultb->estadoorden; ?></td>
       <td><?php echo  $resultb->nombre; ?></td>
       <td></td>
     </tr>
      <?php } ?>
      </tbody>
  </table>
</div>
<hr>
<div class="col-md-12">
<?php
        include('../config/conexion.php');
          date_default_timezone_set('America/El_Salvador');
            $totalo = $pdo->prepare("SELECT * FROM orden WHERE orden='$orden' ");
          $totalo->execute();
        while ($result = $totalo->fetch()) {
          $ido = $result -> idmesa; //echo $ido;

          if($ido == ""){
            ?>
            <a href="" class="btn btn-success">Reimprimir factura de envio</a><br>
            TIPO DE ATENCION : (ENVIO O DOMICILIO)
            <?php
          }elseif($ido > 0){
            ?>
            <a href="" class="btn btn-success">REIMPRMIR TICKET DE ATENCION EN MESA</a><br>
            TIPO DE ATENCION : (ATENCION EN MESA)
            <?php
          }
        }
      ?>

</div>














<!-- Modal -->
<div class="modal fade" id="cambiartipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CAMBIAR TIPO DE PAGO</h5>

      </div>
      <div class="modal-body">
        <h1 class="text-center"><?php echo $orden; ?></h1>
        <input type="text" value="<?php echo $orden; ?>" id="orden" style="display:none">
        <div class="form-group">
           <label for="">TIPO DE PAGO</label>
           <select name="" id="tipopago" class="form-control">
                            <option value="0">ELEGIR METODO DE PAGO</option>
                            <option value="1">EFECTIVO</option>
                            <option value="2">TARJETA</option>
                            <option value="3">CREDITO</option>
                            <option value="4">CORTESIA</option>
                            <option value="5">DEPOSITO</option>
            </select>
        </div>
        <div class="form-group">
        <label for="">CLAVE DE ADMINISTRADOR</label>
        <input type="password" id="clave" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="cambiapago()">CAMBIAR</button>
      </div>
    </div>
  </div>
</div>

