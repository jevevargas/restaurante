<?php
  //error_reporting(E_ERROR);
 include('../config/conexionClass.php');

//  $orden=$_REQUEST['orden']; // echo $orden;
    $salida = "";
    // $orden = "";

    $query = "SELECT * FROM pago  LEFT JOIN cliente ON pago.idcliente = cliente.idcliente WHERE tipopago='3' LIMIT 8";
  
    if (isset($_POST['consulta'])) {
    	$q = $enlace->real_escape_string($_POST['consulta']);
    	$query = " SELECT * FROM pago  LEFT JOIN cliente ON pago.idcliente = cliente.idcliente WHERE tipopago='3' AND nomcliente  LIKE '%$q%' ";
      
    }

    $resultado = $enlace->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='table   table-bordered'>
    			<thead>
    				<tr id='titulo'>
    				
    					<td style='text-align:center'>ID</td>
                        <td style='text-align:center'>NOMBRE</td>
    					          <td style='text-align:center'>ORDEN</td>
    					          <td style='text-align:center'>TOTAL</td>
                        <td style='text-align:center'>FECHA</td>
                        <td style='text-align:center'></td>
                        <td style='text-align:center'></td>
    			   	</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
        $salidat='';
        $pendiente=$fila['pendiente']; 
        if($pendiente==1){
          $salidat.="<button class='btn btn-danger'>Pendiente</button>";
        }elseif($pendiente==2){
          $salidat.="<button class='btn btn-light'>Pagado</button>";
        }
    		$salida.="<tr>
    		
    		<td style='text-align:center; font-size:12px;'>".$fila['idpago']."</td>

    		<td style='text-align:center; font-size:12px;'>".$fila['nomcliente']."</td>

    		<td style='text-align:center; font-size:12px;'>".$fila['orden']."</td>
            <td style='text-align:center; font-size:12px;'><b>($".$fila['totalpago'].")</b></td>
            <td style='text-align:center; font-size:12px;'>".$fila['fechapago']."</td>
            <td style='text-align:center; font-size:12px;'>
            <a href='' class='btn btn-success btn-sm'><i class='bi bi-printer'> </i>IMPRIMIR</a>
            <button class='btn btn-danger btn-sm pagar'  data-toggle='modal' data-target='#pagar' value=".$fila['idpago']."><i class='bi bi-archive'></i> PAGAR</button>
            <span id=ap".$fila['idpago']." style='display:none'>".$fila['idpago']."</span>
            </td>
            <td> $salidat </td>";
            
           $salida.="</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<h1 class='text-center mensaje'><svg xmlns='http://www.w3.org/2000/svg' width='96' height='96' fill='currentColor' class='bi bi-question-circle' viewBox='0 0 16 16'>
        <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
        <path d='M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z'/>
      </svg><br>NO HAY DATOS</h1>";
    }


    echo $salida;

    $enlace->close();



?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
  $(document).on('click', '.ordenar', function(){
            var id=$(this).val();
            var idplato=$('#idplato'+id).text();
            var nomplaton=$('#nomplaton'+id).text();
            var precioplaton=$('#precioplaton'+id).text();
      
            
             console.log(idplato);
             console.log(nomplaton);
             console.log(precioplaton);
            
            $('#ordenar').modal('show');
            $('#idplato').val(idplato);
            $('#nomplaton').val(nomplaton);
            $('#precioplaton').val(precioplaton);
            });
            
</script>