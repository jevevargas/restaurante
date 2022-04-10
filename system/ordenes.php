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
    <script src="../app/js/orden.js"></script>
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
              <div class="row">
                  <div class="col-md-4 contenidoPlato esp">
                    <div class="col-md-12"><h5 class="text-center">ORDENES DEL DIA</h5></div>
                    <hr>
                    <div class="col-md-12" id="ordenes">
                        
                    </div>
                  </div>


                  <div class="col-md-7 contenidoPlato esp">
                  <div class="col-md-12" id="detalle"></div>
                  </div>
              </div>
            </div> 

          </div>
		</div>

<script>
$(document).on('click', '.edit', function(){
    var id=$(this).val();
    var orden=$('#orden'+id).text();
 // console.log(orden);
       $.ajax({
            url:"historialorden.php",
            type : 'POST',
            dataType : 'html',
            data : {'orden':orden},
            success:function(respuesta){
                      
             $("#detalle").html(respuesta);
             $("#detalle").show("fast");
               }
            });

}); 
</script>

     <?php  require_once('pie.php');  ?>
    </body>
</html>