<?php
$idmesa=$_REQUEST['idmesa'];
require_once('header.php');

$estado = $pdo->prepare(" SELECT * FROM mesa WHERE idmesa='$idmesa' ");
$estado->execute();
while ($result = $estado->fetch()) {
   $estadomesa = $result -> estadomesa;
}
if($estadomesa ==1){
    ?>
    <center><button class="btn btn-danger" data-toggle="modal" data-target="#editacliente">EDITAR EL CLIENTE</button></center>
    <?php
}elseif($estadomesa == 0){
    ?>
    <div class="row">
        <div class="form-group col-md-12">
          <input type="text" class="form-control" id="cliente" placeholder="NOMBRE CLIENTE" autofocus onkeyup="mayus(this);">
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" id="direccion" placeholder="DIRECCION" onkeyup="mayus(this);">
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" id="telefono" placeholder="TELEFONO" onkeyup="mayus(this);">
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" id="dui" placeholder="DUI">
        </div>
        <div class="form-group col-md-12">
            <center><button class="btn btn-success" onclick="cliente()">INGRESAR</button></center>
        </div>
    </div>
    <?php
}
?>

