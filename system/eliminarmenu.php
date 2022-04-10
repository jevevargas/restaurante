<?php
 require_once('header.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENVENIDO <?php  echo $nombre; ?></title>
    <script src="../app/js/administrador.js"></script>
</head>
    <body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active lou">
            <?php require_once('menu.php'); ?>
        </nav>

        <!-- Page Content  -->
          <div id="content" class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
             <?php require_once('lateral.php');  ?>
            </nav>
        
            <div class="col-md-12">
                <div class="col-auto p-5 losPermisos">
                    <?php
                       $idui=$_POST['idui']; //echo $idui;
                       $estado = $pdo->prepare(" SELECT * FROM usuario LEFT JOIN tipo ON usuario.idtipo = tipo.idtipo WHERE idusuario='$idui' ");
                       $estado->execute();
                       while ($result = $estado->fetch()) {
                    ?>
                    <div class="col-md-12"><h5><i class="bi bi-check-circle-fill" style="color:#63BE09;font-size:20px;"></i> USUARIO: <?php echo $result -> nombre;  ?> (<?php echo $result -> tipo;  ?>)</h5></div>

                    <?php } ?>
                       <br>
                       <hr>
                    <div class="col-md-12" >
                        <input type="text" value="<?php echo $idui ?>" id="idboton" style="display:none">
                        <div class="col-md-12" id="permiso">
                    
                        </div>
                    </div>
                    

                </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>


