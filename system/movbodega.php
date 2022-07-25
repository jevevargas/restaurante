
<?php
 require_once('header.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
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
        
            <div class="col-md-12 admincont">
                 <div class="row">
                     <div class="col-md-6 admincontlateral admincontover">
                        <div class="col-ms-12"><h5><i class="bi bi-clipboard2-data-fill"></i> Movimiento de Bodega  
                        <button class="btn btn-light">
                        <i class="bi bi-calendar3"></i> Hoy: <?php  $dia=date('N');  if($dia==1){
                              ?>Lunes<?php
                              }elseif($dia==2){
                                  ?>Martes<?php
                                    }elseif($dia==3){
                                        ?>Miercoles<?php
                                           }elseif($dia==4){
                                               ?>Jueves<?php
                                                   }elseif($dia==5){
                                                       ?>Viernes<?php
                                                           }elseif($dia==6){
                                                              ?>Sabado<?php
                                                                  }elseif($dia==7){
                                                                     ?>Domingo<?php
                                                                       } 
                                                                        ?> - <?php echo $hoy=date('d/m/Y'); ?>
                        </button></h5>
                    </div>
                    <hr>
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
            
                                <td style="font-size:12px">PRODUCTO</td>
                                <td style="font-size:12px">CANTIDAD</td>
                                <td style="font-size:12px">FECHA</td>
                                <td style="font-size:12px">FACTURA</td>
                                <td style="font-size:12px">PROVEEDOR</td>
                                <td style="font-size:12px">PRECIO</td>
                            </tr>
                        </thead>
                  <tbody>
                    <?php
                        $dias=date('Y-m-d');
                        $estado = $pdo->prepare(" SELECT * FROM movbode LEFT JOIN bodega ON movbode.id_bodega = bodega.id_bodega WHERE fechamovbodecorta='$dias' ");
                        $estado->execute();
                        while ($result = $estado->fetch()) {
                    ?>
                    <tr>
                        <td style="font-size:12px"><?php  echo $result -> producto_bodega; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> canmovbod; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> fechamovbod; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> factura; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> proveedor; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> costomov; ?></td>   
                    </tr>
                    <?php } ?>

                  </tbody>
                    </table>
                </div>
                       

                     </div>


                     <div class="col-md-6">
                       <div class="col-md-12"><h5><i class="bi bi-funnel-fill"></i> Filtrar por fechas</h5></div>
                       <hr>
                       <div class="input-group mb-3">
                           <input type="date" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" id="fechabode">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" id="consultar">Consultar</button>
                            </div>
                        </div>

                        <div class="col-md-12 table-responsive">
                            <div class="col-md-12" id="resultadobode"></div>
                        </div>

                     </div> 
                 </div>
            </div> 

          </div>
		</div>

<script>
    $(document).ready(function(){
    $("#consultar").on("click", function(){
      var fechabode = $("#fechabode").val();
        $.ajax({
            type: "POST",
            url: "resultadobode.php",
            data:{fechabode:fechabode},
            success: function(respuesta){
                $("#resultadobode").html(respuesta);
            }
        })
    })
});
</script>
<script src="../app/js/bootstrap.min.js"></script>
     <?php  require_once('pie.php');  ?>
    </body>
</html>