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
    <script src="../app/js/user.js"></script>
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
                  <div class="col-md-4 ingresarPlato">
                    <div class="row">

                        <div class="col-md-12"><center><i class="bi bi-person-circle" style="font-size:90px; color:#A3D900;"></i></center></div>

                          <div class="col-md-12"><h5 class="text-center">INGRESARA USUARIO</h5></div>
                           
                        <div class="form-group col-md-6">
                            <label for="">NICKNAME</label>
                            <input type="text" class="form-control" id="nick" >
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">CLAVE</label>
                            <input type="password" class="form-control" id="pass" >
                            <div class="invalid-feedback">Campo obligatorio</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">TIPO DE USUARIO</label>
                            <select name="tipo" id="tipo" class="form-control">
                            <?php
                                $estado = $pdo->prepare(" SELECT * FROM tipo ");
                                $estado->execute();
                                while ($result = $estado->fetch()) {
                            ?>
                            <option value="<?php echo $result -> idtipo; ?>"><?php echo $result -> tipo; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">ADMIN?</label>
                            <select name="admin" id="admin" class="form-control">
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                            <hr>
                        <div class="col-md-12"><center><button class="btn btn-success" onclick="insertaruser()">INGRESAR</button></center></div>
                  </div>


                  </div>

                  <div class="col-md-7 ingresarPlato">
                      
<div class="col-md-12r"><center><a href="nuevacaja.php" class="btn-light btn"><i class="bi bi-plus-circle-fill" style="color:#A3D900; font-size:20px;"></i> CREAR UNA CAJA</a></center></div>
<br>
                      <div class="col-md-12 table-responsive">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <td>ID</td>
                                      <td>NOMBRE</td>
                                      <td>CLAVE</td>
                                      <td>TIPO</td>
                                      <td></td>
                                  </tr>
                              </thead>
                              <tbody  id="tablauser"></tbody>
                          </table>
                      </div>

                  </div>
              </div>
            </div> 

          </div>
		</div>



     <?php  require_once('pie.php');  ?>
    </body>
</html>