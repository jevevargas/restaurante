

<?php
require_once('../config/conexion.php');

$idmesa=$_REQUEST['idmesa'];  //echo $idmesa;
date_default_timezone_set('America/El_Salvador');
$estado = $pdo->prepare(" SELECT * FROM mesa WHERE idmesa='$idmesa' ");
$estado->execute();
while ($result = $estado->fetch()) {
   $nombremesa = $result -> nombremesa;
   $estadomesa = $result -> estadomesa;
}

if($estadomesa == 0){
    ?>
   <center><h3><i class="bi bi-info-circle-fill icono"></i><br>LA MESA Y ORDEN NO HA SIDO ACTIVADA</h3></center> 
    <?php
}elseif($estadomesa == 1){
        $idmesa=$_REQUEST['idmesa'];  //echo $idmesa;
        date_default_timezone_set('America/El_Salvador');
        $estado = $pdo->prepare(" SELECT * FROM orden LEFT JOIN mesa ON  mesa.idmesa = orden.idmesa LEFT JOIN 
        cliente ON cliente.idmesa=orden.idmesa WHERE orden.idmesa='$idmesa' AND orden.estadoorden='1' ");
        $estado->execute();
        while ($result = $estado->fetch()) {
            $orden = $result -> orden;
            $cliente = $result -> nomcliente;
        }
     ?>
     <script src="../app/js/detalle.js"></script> 
     <!-- controla toda la compra-->
     <div class="col-md-12">
         <div class="row">
             <div class="col-md-3 detalleOrd"><h5>ORDEN # <?php echo $orden; ?></h5></div>
             <div class="col-md-7 detalleCli"><h5><i class="bi bi-person-circle"></i> CLIENTE: <?php echo $cliente; ?></h5></div>
             <!-- <div class="col-md-2 activoC"><button class="btn btn-light"  data-toggle="modal" data-target="#addplato"><i class="bi bi-plus-circle-fill" style="color:#63BE09; font-size:20px;"></i><br> PLATO</button></div> -->
         </div>
     </div>
     <div class="col-md-12 tablaPlato table-responsive" >
       

                <div class="col-md-4">
                  <input type="text" class="form-control" id="caja_busqueda" placeholder="Buscar plato" name="caja_busqueda">
                
                </div>


                  <br>
                <div class="col-md-12"  id="datos"></div> 
                
                <div class="col-md-12 contenidosBotones">
              <div class="row">
                <button class="btn btn-success" onclick="cocina()"><i class="bi bi-node-plus" style="font-size:15px;"></i><br> Crear Cuenta</button>

                <button class="btn btn-success" style="margin-left:5px;" data-toggle="modal" data-target="#subc"><i class="bi bi-person-plus" style="font-size:15px;"></i><br> Crear subcuenta</button>

                <button class="btn btn-success" style="margin-left:5px;" data-toggle="modal" data-target="#cambiarmesa"><i class="bi bi-arrow-left-right" style="font-size:20px;"></i><br> Cambio de mesa</button>

                <a href="precuenta.php?orden=<?php  echo $orden; ?>" class="btn btn-success" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" style="margin-left:5px;"><i class="bi bi-printer" style="font-size:15px;"></i></i><br> Precuenta</a>

                <button class="btn btn-danger" style="margin-left:5px;" data-toggle="modal" data-target="#tickets"><i class="bi bi-receipt-cutoff" style="font-size:15px;"></i></i><br> Tickets</button>

                <button class="btn btn-danger" style="margin-left:5px;" data-toggle="modal" data-target="#ticketsre"><i class="bi bi-receipt-cutoff" style="font-size:15px;"></i></i><br> Reimprimir</button>
              </div>
     </div>

     <?php
       }
     ?>


<!-- ordenar -->
<div class="modal fade" id="ordenar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ORDENAR</h5>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
            <div class="row">

        <div class="form-group col-md-12">
          <input type="text" value="<?php  echo $orden;  ?>" id="orden" class="ordenes">
        </div>  

        <div class="form-group col-md-12">
          <input type="text" id="nomplaton" class="nombreplato">
        </div>

        <div class="form-group  col-md-4">
          <input type="text" id="precioplaton" class="form-control is-valid" readonly >
        </div>

        <div class="form-group col-md-8">
             <div class="quantity">
             <input type="number" min="1"  step="1" value="1" name="cantidad" id="cantidad" class="form-control">
             </div>
        </div>

        <div class="form-group col-md-12">
        <label for="">DESCRIPCION</label>
          <textarea name="des" id="desc" cols="10" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-12">
          <label for="">SUBCUENTA</label>
          <select name="sub" id="sub" class="form-control">
          <?php
            $estado = $pdo->prepare(" SELECT * FROM clientesub WHERE orden='$orden' ");
            $estado->execute();
            while ($result = $estado->fetch()) {
          ?>
              <option value="<?php echo $result -> idclientesub; ?>"><?php echo $result -> nomclientesub; ?></option>
          <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-6" style="display:none">
            <input type="text" class="form-control" value="<?php  echo $hora=date('H:i:s'); ?>" id="hora">
        </div>
        <div class="form-group col-md-6" style="display:none">
            <input type="text" class="form-control" value="<?php  echo $fecha=date('Y-m-d'); ?>" id="dia">
        </div>

        <div class="form-group col-md-6" style="display:none">
            <input type="text" class="form-control" value="<?php  echo $fechac=date('Y-m-d H:i:s'); ?>" id="diac">
        </div>

        <div class="col-md-12"> <div class="alert alert-danger  NoDisplay text-center" id="alertFalta"></div></div>

            </div>
        </div>
       
        <input type="text" id="idp" style="display:none">
        <input type="text" id="impplato" style="display:none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
  <button type="button" class="btn btn-success" onclick="ordene()" id="AgregarOrden" data-dismiss="modal">ORDENAR</button>
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



 <!-- Modal -->
 <div class="modal fade" id="tickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">IMPRIMIR</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12 form-group">

               <a href="ticketcomidamesa.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block " onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" ><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br> COCINA</a>

              </div>
              <div class="col-md-12 form-group">
               <a href="ticketbarmesa.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>BAR</a>
              </div>
              <div class="col-md-12 form-group">
               <a href="ticketpupusamesa.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>PUPUSAS</a>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>




   <!-- Modal -->
 <div class="modal fade" id="ticketsre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">RE-IMPRIMIR</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12 form-group">

               <a href="ticketcomidamesar.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block " onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" ><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br> COCINA</a>

              </div>
              <div class="col-md-12 form-group">
               <a href="ticketbarmesar.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>BAR</a>
              </div>
              <div class="col-md-12 form-group">
               <a href="ticketpupusamesar.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>PUPUSAS</a>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>

  

<script src="../app/js/buscador.js"></script>
