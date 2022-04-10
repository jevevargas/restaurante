<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/css/bootstrap.css">
    <link rel="stylesheet" href="app/css/style.css">
    <link rel="stylesheet" href="app/css/icono.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c12fa38f79.js" crossorigin="anonymous"></script>
    <script src="app/js/cdn.js"></script>
    <script src="app/js/sw.js"></script>
    <script src="app/js/entrar.js"></script>

    <title>ACCESO</title>
</head>
<body>
      <div class="acceso">
           <div class="accesotwo">
               <center><i class="fa-solid fa-circle-user icono"></i></center>
               <div class="form-group">
                   <label for="">ACCESO</label>
                   <input type="password"  id="clave" class="form-control rounded-0" autofocus>
               </div>
               <div class="form-group">
                   <button class="btn btn-danger btn-block" onclick="ingresar()">INGRESAR</button>
               </div>

               <center>
                <div id="carga2" style="display:none" class="carga">
                   <img src="imagen/carga.gif" alt="" width="100px">
                </div>
               </center>
               <div class="alert alert-dark alert-dismissible fade show col-md-12" role="alert" id="alertlogin2" style="display:none">
                   <strong>Cuidado!</strong> El password o usuario es incorrecto
                </div> 


               <br>
               <hr>
               <div class="col-md-12"><center><b>COCINALOPOST - 2022</b>  </center></div>
           </div>
      </div>



      <script src="app/js/bootstrap.min.js"></script>
</body>
</html>