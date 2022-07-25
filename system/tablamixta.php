<?php $orden=$_REQUEST['ordenm']; ?>
<center><a href="recibomixto.php?orden=<?php echo $orden;  ?>" class="btn btn-success" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;">Imprimir</a></center>
<br>
<table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                        <td></td>
                            <td>ID</td>
                            <td>DETALLE</td>
                            <td>CANTIDAD</td>
                            <td>PRECIO</td>
                            <td>ORDEN</td>
                            <td>HORA</td>
                            <td>COCINA</td>
                            
                        </tr>
                    </thead>

                    <tbody>
                   <?php
                   $ventas=0;
                   $propina=0;
                   $cobrar=0;
                   include('../config/conexion.php');

                   date_default_timezone_set('America/El_Salvador');
                   $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
                   $todalcaja->execute();
                   while ($resultc = $todalcaja->fetch()) {
                     $inicio =$resultc ->iniciocaja;   //echo $inicio;
                     $final=$resultc ->fincaja;  //echo $final;
                   }  

                   
                    $todalventa = $pdo->prepare(" SELECT * FROM venta WHERE fechaorden  BETWEEN  '$inicio' AND '$final' AND orden='$orden' AND estadoorden='0' ");
                    $todalventa->execute();
                    while ($resultventa = $todalventa->fetch()) {  
                        $cocina = $resultventa -> acocina; 
                        $check = $resultventa -> checkfact; 
                    ?>
                    <tr>
                        <td style="font-size:12px;">
                                          <?php
                          if($check==1){
                            ?><div class="form-check">
                            <input class="form-check-input validare " type="checkbox" value="<?php  echo $resultventa->idventa; ?>" disabled checked>
                          </div><?php
                          }elseif($check==0){
                            ?> <div class="form-check">
                            <input class="form-check-input validare" type="checkbox" value="<?php  echo $resultventa->idventa; ?>">
                          
                          </div><?php
                          }
                          ?>
                        </td>
                        <td style="font-size:12px;"><?php echo $resultventa -> idventa;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> nomorden;  ?></td>
                        <td style="font-size:12px;">(<?php echo $resultventa -> cantidadorden;  ?>)</td>
                        <td style="font-size:12px;">$<?php echo $resultventa -> precioventa;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> orden;  ?></td>
                        <td style="font-size:12px;"><?php echo $resultventa -> horaorden;  ?></td>
                        <td style="font-size:12px;">
                            <?php 
                        
                            if($check==1){
                            ?><i class="bi bi-printer-fill" style="font-size:17px;"></i><?php
                          }elseif($check==0){
                            ?>
                            <i class="bi bi-arrow-clockwise" style="font-size:17px;"></i>
                         <?php
                          }
                          ?>
                        </td>
                    
                    </tr>
                    <?php 
                      $ventas+=($resultventa ->cantidadorden)*($resultventa ->precioventa);
                      $propina = $ventas * 0.10;
                      $cobrar= $ventas + $propina;
                    } ?>

                    </tbody>
                 </table>