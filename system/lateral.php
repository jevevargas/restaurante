
<div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-danger">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-danger d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-box-arrow-left"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <?php
               
                error_reporting(E_ERROR);
               require_once('../config/conexion.php');
               $idu=$_SESSION['idusuario'];
               $sql = "SELECT * FROM caja WHERE  estadocaja='1' "; 
               $query =$pdo -> prepare($sql); 
               $query -> execute(); 
               $results = $query -> fetchAll(PDO::FETCH_OBJ); 
               
               if($query -> rowCount() > 0)   { 
                 

                 date_default_timezone_set('America/El_Salvador');
                 $todalazona = $pdo->prepare("SELECT * FROM caja WHERE estadocaja='1'");
               $todalazona->execute();
             while ($resultb = $todalazona->fetch()) {
              $inicio =$resultb ->iniciocaja;   //echo $inicio;
              $final =$resultb ->fincaja; ;  //echo $final;
              $estado=$resultb -> estadocaja;  //echo $estado;

             }
                  ?>
                   <a class="nav-link" href="#"><i class="bi bi-circle-fill" style="color:#63BE09;"></i><span class="sr-only">(current)</span> (INICIO: <?php echo $fecha1 = date("d-m-Y H:s:i", strtotime($inicio)); ?>) (FINAL: <?php  echo $fecha2 = date("d-m-Y H:s:i", strtotime($final));  ?>)</a>
                  <?php
                     
                  }elseif($query -> rowCount() == 0){
                   ?> <span style="color:#FFF;">No hay cajas abiertas</span> <?php 
                  }
         
                ?>
                   
              </li>
              </ul>
              <ul class="nav navbar-nav ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link" href="out" style="color:#FFF"><i class="bi bi-box-arrow-left"></i> SALIR</a>
                </li>
              </ul>
            </div>
          </div>