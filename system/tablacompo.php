<?php
include('../config/conexion.php');
$idplato=$_REQUEST['idplato'];
 date_default_timezone_set('America/El_Salvador');
 $todalazona = $pdo->prepare(" SELECT * FROM componentes LEFT JOIN plato ON componentes.idplato = plato.idplato  LEFT JOIN bodega ON componentes.id_bodega = bodega.id_bodega WHERE componentes.idplato='$idplato' ");
 $todalazona->execute();
 while ($resultb = $todalazona->fetch()) {
    $idplato = $resultb -> idplato;
?>
<tr>
<td><?php echo $resultb -> id_componente;  ?></td>
    <td><?php echo $resultb -> producto_bodega;  ?></td>
    <td><?php echo $resultb -> cantidad_componente;  ?></td>
    <td>
        <button class="btn btn-danger btn-sm eliminarc" data-toggle="modal" data-target="#eliminarc" value="<?php echo $resultb ->id_componente; ?>"><i class="bi bi-eraser"></i></button>
        <span id="idcompo<?php  echo $resultb ->id_componente; ?>" style="display:none"><?php  echo $resultb ->id_componente; ?></span>
    </td>
    </tr>
 


<?php

 }
?>
  <tr>
    <td colspan="4">
        <input type="text" value="<?php  echo $idplato; ?>" id="idplato" style="display:none">
        <center><button class="btn btn-info" onclick="finalizarcompo()">FINALIZAR</button></center>
    </td>
</tr>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
     
    $(document).on('click', '.eliminarc', function(){
    var id=$(this).val();
    var idcompo=$('#idcompo'+id).text();
    
    $('#eliminarc').modal('show');
    $('#idcompo').val(idcompo);

    });
</script>