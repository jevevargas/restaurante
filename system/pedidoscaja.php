<div class="col-md-12">
    <div class="row">
                    <?php
                    session_start();
                    $usu=$_SESSION['idusuario']; //echo $usu;
                    include('../config/conexion.php');
                    date_default_timezone_set('America/El_Salvador');

                    $todalazona = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
                    $todalazona->execute();
                    while ($resultc = $todalazona->fetch()) {
                    $estadocaja = $resultc -> estadocaja;  //echo   $estadocaja;
                    }
                    ?>

                <?php
                    if($estadocaja ==1){
                    $todalazona = $pdo->prepare(" SELECT * FROM mesa WHERE estadomesa='1' ");
                    $todalazona->execute();
                    while ($resultb = $todalazona->fetch()) {
                ?>
   
           <div class="col-md-6 cajapedidos">
                <a href="detallecaja?id=<?php  echo $resultb -> idmesa; ?>" class="btn btn-danger btn-block rounded-0">
                    <div class="row">
                        <div class="col-md-12"><?php echo $resultb -> nombremesa;  ?></div>
                    </div>
                </a>
           
            </div>
          
                        <?php } ?>
            <?php
            
        }elseif($estadocaja ==0){
            
            ?>
            <div class="col-md-12">
            <center><i class="bi bi-info-circle-fill" style="font-size:60px; color:#63BE09;"></i></center>
                <center>
                    <h1>CAJA CERRADA</h1>
                    <button class="btn btn-light"  data-toggle="modal" data-target="#abrir">ABRIR CAJA</button>
                </center>

            </div>
        
            <?php
          }
            ?>
    </div> 
</div>
