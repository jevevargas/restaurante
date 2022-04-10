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
    <script src="../app/js/caja.js"></script>
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
        
           
             <div class="col-md-11 contenidoPlato esp" style="padding:20px;">
                    <center><i class="bi bi-plus-circle-fill" style="color:#A3D900; font-size:40px;"></i></center>
                    <div class="col-md-12"><h5 class="text-center">NUEVA CAJA</h5></div>
            <div class="row">
                     <div class="form-group col-md-3">
                         <label for="">USUARIO</label>
                         <select name="usu" id="usu" class="form-control">
                            <?php
                                $estado = $pdo->prepare(" SELECT * FROM usuario WHERE idtipo IN ('5','6') ");
                                $estado->execute();
                                while ($result = $estado->fetch()) {
                            ?>
                            <option value="<?php echo $result -> idusuario; ?>"><?php echo $result -> nombre; ?></option>
                                <?php } ?>
                            </select>
                  
                    </div> 
                    <div class="col-md-3 form-group">
                        <label for="">CAJA</label>
                        <input type="text" class="form-control" id="nomcaja">
                    </div> 
                    <div class="col-md-3 form-group">
                        <br>
                    <label for="">.</label>
                        <button class="btn btn-success" onclick="crearcaja()">CREAR</button>
                    </div>


            </div>   
            
            <div class="col-md-12">
                <div class="col-md-12"><h5 class="">CAJAS CREADAS</h5></div>
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>CAJA</td>
                                <td>USUARIO</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="tablacaja"></tbody>
                    </table>
                </div>
            </div>
             </div>
        

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>