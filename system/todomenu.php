<?php
                            require_once('header.php');
                            $estado = $pdo->prepare(" SELECT * FROM menu ");
                            $estado->execute();
                            while ($result = $estado->fetch()) {
                            ?>
                            <div class="col-md-12 contenidoIcon">
                                <center><span class="iconoAdmin"><?php  echo $result -> icon; ?><br></span></center>
                            <?php  echo $result -> menu; ?></div>
                            <?php
                            }
                        ?>