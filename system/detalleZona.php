<?php
$id=$_REQUEST['idu']; //echo $id;
require_once('header.php');
    date_default_timezone_set('America/El_Salvador');
    $estado = $pdo->prepare(" SELECT zona,detallezona.idzona FROM detallezona LEFT JOIN zona ON detallezona.idzona =  zona.idzona LEFT JOIN usuario 
    ON detallezona.idusuario = usuario.idusuario WHERE detallezona.idusuario = '$id' ");
        $estado->execute();
    while ($result = $estado->fetch()) {
        //echo  $result -> idzona;
?>
<div class="col-md-12 zona d-flex justify-content-between align-items-center">
    <i class="bi bi-chevron-compact-right iconop"></i> <button class="btn btn-light"><?php echo  $result -> zona; ?></button>
    <button class="btn btn-danger btn-sm eliminar" data-toggle="modal" data-target="#eliminare" value="<?php echo $result ->idzona; ?>"><i class="bi bi-trash3"></i></button>
    <span id="idzonas<?php  echo $result ->idzona; ?>" style="display:none"><?php  echo $result ->idzona; ?></span>
</div>
<?php } ?>


<!---------------------------------------- modal ----------------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
     
    $(document).on('click', '.eliminar', function(){
    var id=$(this).val();
    var idzonas=$('#idzonas'+id).text();
    
    $('#eliminar').modal('show');
    $('#idzonass').val(idzonas);

    });
</script>
