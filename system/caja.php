<?php
$usu=$_SESSION['idusuario']; 
?>
<script src="../app/js/caja.js"></script>

<script src="../app/js/datatable.js"></script>

<div class="row">

    <div class="col-md-4 contenidoPlato esp">
      <div class="col-md-12">
        <div class="col-md-12" id="datoscaja"></div>
      </div>
      <div class="col-md-12"><center><button class="btn btn-success" data-toggle="modal" data-target="#fechacaja" ><i class="bi bi-calculator-fill" style="font-size:20px;"></i> AMPLIAR LA VIDA DE LA CAJA</button>
<hr>
      <button class="btn btn-danger" data-toggle="modal" data-target="#menu" ><i class="bi bi-cup-straw" style="font-size:20px;"></i> MENU</button>
    </center></div>
      <hr>
      <div class="col-md-12">
        <div class="col-md-12"><h5 class="text-center">ORDENES PARA LLEVAR Y DOMICILIO</h5></div>
     

        <div class="col-md-12" id="pedidocliente"></div>
      </div>
    </div>


    <div class="col-md-7 contenidoPlato esp">

       <div class="col-md-12" id="pedidoscaja"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="abrir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ABRIR DIA</h5>

      </div>
      <div class="modal-body">
       
      <div class="form-group">
            <label for="">FONDO INICIAL</label>
            <input type="text" id="fondo" class="form-control">
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <label for="">FECHA APERTURA</label>
                <input type="datetime-local" id="inicio" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">FECHA CIERRE</label>
                <input type="datetime-local" id="final" class="form-control">
            </div>
            </div>
            <input type="text" value="<?php  echo $usu; ?>" id="idusu" style="display:none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="comenzarcaja()" data-dismiss="modal">ABRIR CAJA</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="fechacaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FECHAS CAJAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
           $usu=$_SESSION['idusuario'];  //echo $usu;
           include('../config/conexion.php');
           date_default_timezone_set('America/El_Salvador');
           $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
           $todalcaja->execute();
           while ($resultc = $todalcaja->fetch()) {
             $inicio =$resultc ->iniciocaja;   //echo $inicio;
             $final =$resultc ->fincaja;   //echo $final;
           }   
        ?>

        <div class="form-group col-md-12">
          <input type="text" value="<?php  echo $inicio; ?>" class="form-control" readonly id="inicaja">
        </div>
        <div class="form-group col-md-12">
          <input type="text" value="<?php  echo $final; ?>" class="form-control" id="finicaja">
        </div>

    <input type="text" value="<?php  echo $usu; ?>" id="idusufech" style="display:none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-success" onclick="modfecha()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">VER EL MENU</h5>

      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="example" style="width:100%">
          <thead>
            <tr>
              <td>ID</td>
              <td>NOMBRE</td>
              <td>PRECIO</td>
            </tr>
          </thead>
          <tbody>
          <?php
           $todalcaja = $pdo->prepare(" SELECT * FROM plato ");
           $todalcaja->execute();
           while ($resultc = $todalcaja->fetch()) {  
          ?>
           <tr>
             <td><?php echo $resultc->idplato;  ?></td>
             <td><?php echo $resultc->nomplato;  ?></td>
             <td>$<?php echo $resultc->precioplato;  ?></td>
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


<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
