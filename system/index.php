<?php
 require_once('header.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app/css/bootstrap.css">
    <link rel="stylesheet" href="../app/css/style.css">
    <link rel="stylesheet" href="../app/css/icono.css">
    <link rel="stylesheet" href="../app/css/datatable.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c12fa38f79.js" crossorigin="anonymous"></script>
    <script src="../app/js/cdn.js"></script>
    <script src="../app/js/sw.js"></script>
    <script src="../app/js/entrar.js"></script>
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
              <?php
              //echo $tipo;
              if($tipo==1){
                  ?><div class="col-md-12"><?php include('mesero.php'); ?></div><?php
              }elseif($tipo==6){
                ?><div class="col-md-12"><?php include('administrador.php'); ?></div><?php
              }elseif($tipo==5){
                ?><div class="col-md-12"><?php include('caja.php'); ?></div><?php
              }
              ?>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>