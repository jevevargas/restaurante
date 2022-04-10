<div class="row">
                    <?php
                    require_once('../config/conexion.php');
                    $idboton=$_REQUEST['idboton'];
                        //echo $idui;
                       $estado = $pdo->prepare(" SELECT * FROM detallemenu LEFT JOIN menu ON detallemenu.idmenu = menu.idmenu WHERE idusuario='$idboton' ");
                       $estado->execute();
                       while ($result = $estado->fetch()) {
                    ?>
                        
                <button class="btn btn-light btnn eliminar" data-toggle="modal" data-target="#eliminar" value="<?php echo $result->idmenu; ?>" style="margin-top:10px"><?php echo $result -> menu;  ?> <i class="bi bi-trash" style="color:#63BE09;font-size:20px;"></i></button>
                <span id="idm<?php  echo $result ->idmenu;  ?>" style="display:none"><?php  echo $result ->idmenu;  ?></span>
                <span id="idu<?php  echo $result ->idmenu;  ?>" style="display:none"><?php  echo $result ->idusuario;  ?></span>

                        <?php } ?>
                        </div>