<script src="../app/js/buscador.js"></script>
<?php
$idcliente = $_REQUEST['idcliente'];  //echo $idcliente;

include('../config/conexion.php');
date_default_timezone_set('America/El_Salvador');
$sql = "SELECT * FROM orden WHERE idcliente = '$idcliente'  "; 
$query =$pdo -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 

if($query -> rowCount() > 0)   { 
foreach($results as $result) { 
  $orden = $result -> orden;
   ?>
   <!-- todo el menu -->
   <div class="col-md-12">
     <div class="row">
         <div class="col-md-3 detalleOrd"><h5>ORDEN: #<?php  echo $orden;  ?></h5></div>
         <div class="col-md-2">
         <button class="btn btn-warning"  onclick="cocina()"><i class="bi bi-node-plus" style="font-size:20px"></i><br> CREAR</button>
         </div>

         <div class="col-md-7">
         <button class="btn btn-success" data-toggle="modal" data-target="#tickets"><i class="bi bi-receipt" style="font-size:20px"></i><br> TICKETS</button>

         <a class="btn btn-success" href="precuentaenvio.php?orden=<?php  echo $orden; ?>" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" ><i class="bi bi-receipt" style="font-size:20px"></i><br> PRECUENTA</a>

         <button class="btn btn-success" data-toggle="modal" data-target="#reimprmir"><i class="bi bi-receipt" style="font-size:20px"></i><br> REIMPRIMIR</button>
         </div>

        
     </div>
   </div>
   <br>
    <div class="col-md-12 table-responsive" >
      <div class="col-md-5">
        <input type="text" class="form-control" id="caja_busqueda" placeholder="Buscar plato" name="caja_busqueda">
              
        </div>
        <hr>  
       
        <div class="col-md-12" id="datos"></div>      
    </div>

    

  <!-- /todo el menu -->
   <?php
   } 
      
   }elseif($query -> rowCount() == 0){
       ?>
       <h1 class="text-center">
       <i class="bi bi-info-circle" style="font-size:90px;"></i><br>
         No hay una orden aun para este cliente
       </h1>
       
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

               <a href="ticketcomidapedido.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block " onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" ><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br> COCINA</a>

              </div>
              <div class="col-md-12 form-group">
               <a href="ticketbarpedido.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>BAR</a>
              </div>
              <div class="col-md-12 form-group">
               <a href="ticketpupusllevar.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>PUPUSAS</a>
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
 <div class="modal fade" id="reimprmir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">RE-IMPRIMIR</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12 form-group">

               <a href="ticketcomidapedidor.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block " onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;" ><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br> COCINA REIMPRESION</a>

              </div>
              <div class="col-md-12 form-group">
               <a href="ticketbarpedidor.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>BAR REIMPRESION</a>
              </div>
              <div class="col-md-12 form-group">
               <a href="ticketpupusamesar.php?orden=<?php  echo $orden; ?>" class="btn btn-dark btn-block" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-receipt-cutoff" style="font-size:30px"></i><br>PUPUSAS REIMPRESION</a>
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


  