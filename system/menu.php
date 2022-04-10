<h1><a href="index" class="logo"><img src="../imagen/logo.fw.png" width="50px" alt=""></a></h1>
        <ul class="list-unstyled components mb-5">
            <?php 
           // echo $id;
              date_default_timezone_set('America/El_Salvador');
              $estado = $pdo->prepare(" SELECT * FROM  detallemenu LEFT JOIN menu ON detallemenu.idmenu = menu.idmenu WHERE idusuario='$id' ");
              $estado->execute();
              while ($resultestado = $estado->fetch()) {
            ?>
          <li class="active">
            <a href="<?php echo $resultestado -> link ?>"><?php echo $resultestado -> icon ?> <br><p style="font-size: 12px;;"><?php echo $resultestado -> menu ?></p></a>
          </li>
            <?php
              }
            ?>
        </ul>

        <div class="footer">
        	<p>
			Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SOFTYMEDIC <i class="icon-heart" aria-hidden="true"></i> by <a href="https://softymedic.com" target="_blank">COCINAS</a>
			</p>
        </div>