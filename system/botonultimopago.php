<?php
            $orden=$_REQUEST['ordenmixto']; //echo $orden;

session_start();
            require_once('../config/conexion.php');


            $usu=$_SESSION['idusuario']; //echo $usu;
                        date_default_timezone_set('America/El_Salvador');
                        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE idusuario = '$usu'  ");
                        $todalcaja->execute();
                        while ($resultc = $todalcaja->fetch()) {
                          $inicio =$resultc ->iniciocaja; //echo $inicio;
                          $final =$resultc ->fincaja; //echo $final;
                        }

            $sql = "SELECT * FROM pago WHERE orden='$orden' AND fechapago2  BETWEEN  '$inicio' AND '$final' "; 
            $query =$pdo -> prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetchAll(PDO::FETCH_OBJ); 
    
            if($query -> rowCount() > 0)   { 
            foreach($results as $result) { 
            
            } 
            ?>
             <div class="col-md-12 alert alert-success">PAGO MIXTO REALIZADO </div>
             <center><button class="btn btn-danger btn-block" onclick="terminarmesa()"><i class="bi bi-check-circle"></i><br> TERMINAR PROCESO DE CIERRE MIXTO</button> </center> 
             <?php
            }elseif($query -> rowCount() == 0){
                ?>
                 <div class="form-group">
                            <select name="" id="tipopago" class="form-control">
                            <option value="0">ELEGIR METODO DE PAGO</option>
                            <option value="1">EFECTIVO</option>
                            <option value="2">TARJETA</option>
                            <option value="3">CREDITO</option>
                            <option value="4">CORTESIA</option>
                            <option value="5">DEPOSITO</option>
                            </select>
                            <div class="valid-feedback">Elegir el metodo de pago</div>
                        </div>
                    
                <button class="btn btn-danger btn-block"  onclick="terminarenvio()"><i class="bi bi-check-circle"></i><br> TERMINAR PROCESO DE CIERRE SIN MIXTO</button>
            <?php
            }
?>

