<?php
require_once('../config/conexion.php');

$idusu=$_POST['idusu'];
foreach ($_POST['checkbox'] as $id){
    //echo $id."<br>";
    $consulta = "insert into detallemenu(idmenu,idusuario) 
    values
    (:id,:idusu)";

    $sql = $pdo->prepare($consulta);
    
    $sql->bindParam(':id',$id,PDO::PARAM_INT);
    $sql->bindParam(':idusu',$idusu,PDO::PARAM_INT);
    
    $sql->execute();

    if($sql){
        echo "<center><img src='../imagen/check.gif' alt='' width='100px'></center>";
        echo "<h1><center>Examenes ingresados</h1></center>";
    }
}
?>
    
    
 
 
        