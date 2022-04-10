<table class="table table-hover table-striped ">


                            <tbody>
                            <?php
                            include('../config/conexion.php');
                            session_start();
                            $usu=$_SESSION['idusuario']; //echo $usu;
                            $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
                            $todalcaja->execute();
                            while ($resultc = $todalcaja->fetch()) {
                            $inicio =$resultc ->iniciocaja;   //echo $inicio;
                            $final=$resultc ->fincaja;  //echo $final;
                            }   

                            date_default_timezone_set('America/El_Salvador');
                            $todalazona = $pdo->prepare("SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$final'  ORDER  BY orden ASC  ");
                            $todalazona->execute();
                            while ($resultb = $todalazona->fetch()) {
                                $tipo = $resultb -> tipopago;
                            ?>
                            <tr>
                                <td style="color:#FF0000;"><b>ORDEN: #<?php  echo $resultb  -> orden; ?></b></td>
                                <td><?php
                                 if($tipo ==1){
                                     ?>EFECTIVO<?php
                                 }elseif($tipo ==2){
                                     ?>TARJETA<?php
                                 }elseif($tipo ==3){
                                    ?>CREDITO<?php
                                }elseif($tipo ==4){
                                    ?>CORTESIA<?php
                                }elseif($tipo ==5){
                                    ?>DEPOSITO<?php
                                }

                                ?></td>
                                <td><i class="bi bi-currency-dollar"></i><?php  echo $resultb  -> totalpago; ?></td>
                                <td><button class="btn btn-danger btn-sm edit" value="<?php   echo $resultb  -> orden; ?>" id="orden<?php  echo $resultb  -> orden;  ?>"><?php  echo $resultb  -> orden;  ?></button></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>