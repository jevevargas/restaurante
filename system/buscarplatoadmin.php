<?php
  //error_reporting(E_ERROR);
 include('../config/conexionClass.php');

//  $orden=$_REQUEST['orden']; // echo $orden;
    $salida = "";
    // $orden = "";

    $query = "SELECT * FROM plato WHERE estadoplato='1' AND compocicion='0'  ORDER By idplato LIMIT 4";

    if (isset($_POST['consulta'])) {
    	$q = $enlace->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM plato WHERE estadoplato='1' AND compocicion='0' AND nomplato  LIKE '%$q%' ";
    }

    $resultado = $enlace->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='table table-hover table-striped table-bordered'>
    			<thead>
    				<tr id='titulo'>
    				
    					<td style='text-align:center'>PLATO</td>
    					<td style='text-align:center'>PRECIO</td>
    					<td style='text-align:center'>DESC</td>
                        <td style='text-align:center'></td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    		
    		<td style='text-align:center; font-size:12px;'>
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['nomplato']."</button>
			</td>

    		<td style='text-align:center; font-size:12px;'>
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['precioplato']."</button>
			</td>

    		<td style='text-align:center' >
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['descplato']."</button>
			<span id='idplato".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
			<span id='nomplaton".$fila['idplato']."' style='display:none'>".$fila['nomplato']."</span>
			<span id='precioplaton".$fila['idplato']."' style='display:none'>".$fila['precioplato']."</span>
			</td>
            <td>
            <form action='composicion' method='POST'>
              <input type='text' name='idplato' value='".$fila['idplato']."' style='display:none'>
              <button type='submit' class='btn btn-success btn-sm'><i class='bi bi-plus-circle'></i> COMPO.</button>
          </form>
            </td>
              ";
                      $salida.="
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<h1 class='text-center mensaje'><i class='bi bi-question-circle-fill'  style='color:#63BE09; font-size:60px;'></i><br>NO HAY DATOS</h1>";
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