<?php
session_start();
$idu=$_SESSION['idusuario'];
        require_once('../config/conexion.php');

        date_default_timezone_set('America/El_Salvador');
        $contzona = $pdo->prepare(" SELECT * FROM detallezona LEFT JOIN zona ON detallezona.idzona = zona.idzona WHERE detallezona.idusuario='$idu'  ");
        $contzona->execute();
        while ($resultestado = $contzona->fetch()) {
          $idz = $resultestado -> idzona;  //echo $idz;
          $zona = $resultestado -> zona;
        
        ?>
        <div class="col-md-12">
          <div class="row">
        <div class="col-md-12 tituloZona"><p class="text-left"><b><i class="bi bi-grid-fill"  style="color:#63BE09; font-size:20px;"></i></i> <?php echo  $zona;  ?></b></p></div>
        <div class="col-md-12 conMesa">
            <div class="row">
              <?php
                date_default_timezone_set('America/El_Salvador');
                $todalazona = $pdo->prepare(" SELECT nombremesa,mesa.idmesa,estadomesa,orden.orden FROM mesa left join orden on mesa.idmesa=orden.idmesa WHERE idzona='$idz' ");
                $todalazona->execute();
                while ($resultestadozona = $todalazona->fetch()) {
                $estadomesa= $resultestadozona->estadomesa;
                if($estadomesa == 0){
              ?>
                <div class="col-md-2 mt-2">
                  <a href="detallemesa?idmesa=<?php  echo $resultestadozona -> idmesa; ?>" class="btn btn-success btn-block rounded-1">
                  <div class="col-md-12"><?php  echo $resultestadozona -> nombremesa; ?></div>
                  <div class="col-md-12"><p>DISPONIBLE</p></div>
                  </a>
                </div>
              <?php
               }elseif($estadomesa == 1){
              ?>
              <div class="col-md-2 mt-2">
                  <a href="detallemesa?idmesa=<?php  echo $resultestadozona -> idmesa; ?>" class="btn btn-danger2 btn-block rounded-1">
                  <div class="col-md-12"><?php  echo $resultestadozona -> nombremesa; ?></div>
                  <div class="col-md-12">ORDEN #<?php  echo $resultestadozona -> orden; ?></div>
                  </a>
                </div>
              <?php
              }
              ?>
              <?php  } ?>
        </div>
            </div>
        </div>
        </div>
        <?php  } ?>