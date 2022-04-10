<?php

session_start();

    require_once('config/conexion.php');
     sleep(2);
     //$usuario=mysqli_real_escape_string($enlace,$_POST['usuario']); 
      $clave=($_POST['clave']);
      //$usuario=($_POST['usuario']);
       //$usuario=utf8_encode($usuario);
         //$usuario=utf8_encode($usuario);
         $clave=utf8_encode($clave);


         $sql = "SELECT * FROM usuario WHERE   clave='$clave' AND acceso=1 "; 
         $query =$pdo -> prepare($sql); 
         $query -> execute(); 
         $results = $query -> fetchAll(PDO::FETCH_OBJ); 
         
         if($query -> rowCount() > 0)   { 
         foreach($results as $result) { 
            $_SESSION['idusuario']=$result -> idusuario;
            $_SESSION['tipo']=$result -> idtipo;
            $_SESSION['nombre']=$result -> nombre;
            $_SESSION['permisoaddplato']=$result -> permisoaddplato;
            $_SESSION['permisoaddtipo']=$result -> permisoaddtipo;
            $_SESSION['admin']=$result -> admin;
               echo 1;
            } 
               
            }elseif($query -> rowCount() == 0){
                echo 0;  
            }
        



?>