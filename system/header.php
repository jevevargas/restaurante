<?php
require_once('../config/conexion.php');
session_start();
if(!isset($_SESSION['idusuario'])){
   
$url='../index.php';
header("Location: $url");
}else{
    $id=$_SESSION['idusuario'];
    $nombre=$_SESSION['nombre'];
    $tipo=$_SESSION['tipo'];
    $permisoaddplato=$_SESSION['permisoaddplato'];
    $permisoaddtipo=$_SESSION['permisoaddtipo'];
    ?>
    <link rel="stylesheet" href="../app/css/bootstrap.css">
    <link rel="stylesheet" href="../app/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/c12fa38f79.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> 
    <script src="../app/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../app/js/cdn.js"></script>
    <script src="../app/js/sw.js"></script>
    <script src="../app/css/icono.css"></script>
    <?php
}


?>