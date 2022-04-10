<?php
  //error_reporting(E_ERROR);
 include('../config/conexionClass.php');

//  $orden=$_REQUEST['orden']; // echo $orden;
    $salida = "";
    // $orden = "";

    $query = "SELECT nomplato,GROUP_CONCAT(DISTINCT producto_bodega), bodega.id_bodega, plato.precioplato, plato.estadoplato, plato.idplato,descplato FROM plato INNER JOIN componentes ON componentes.idplato=plato.idplato
    INNER JOIN bodega ON componentes.id_bodega=bodega.id_bodega WHERE  estadoplato='1' AND compocicion='1' GROUP BY nomplato LIMIT 6";

    if (isset($_POST['consulta'])) {
    	$q = $enlace->real_escape_string($_POST['consulta']);
    	$query = "SELECT nomplato,GROUP_CONCAT(DISTINCT producto_bodega), bodega.id_bodega, plato.precioplato, plato.estadoplato, plato.idplato,descplato FROM plato INNER JOIN componentes ON componentes.idplato=plato.idplato
        INNER JOIN bodega ON componentes.id_bodega=bodega.id_bodega WHERE estadoplato='1'  AND compocicion='1' AND nomplato  LIKE '%$q%' ";
    }

    $resultado = $enlace->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='table table-hover table-striped table-bordered'>
    			<thead>
    				<tr id='titulo'>
    					<td style='text-align:center'>ID</td>
    					<td style='text-align:center'>PLATO</td>
    					<td style='text-align:center'>INGREDIENTES</td>
    					<td style='text-align:center'>PRECIO</td>
                        <td style='text-align:center'>DESCRIPCION</td>
                        <td style='text-align:center'></td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    		<td style='text-align:center; font-size:12px;'>
              <button class='btn btn-light btn-sm btn-block' data-toggle='modal' data-target='' value=" .$fila['idplato'].">".$fila['id_bodega']."</button>
			</td>

    		<td style='text-align:center; font-size:12px;'>
			<button class='btn btn-light btn-sm btn-block nom' data-toggle='modal' data-target='#nom' value=" .$fila['idplato'].">".$fila['nomplato']."</button>
			</td>

    		<td style='text-align:center; font-size:12px;'>
            <form action='composicion' method='POST'>
               <input type='text' value='" .$fila['idplato']."' name='idplato' style='display:none'>
               <button type='submit' class='btn btn-warning btn-sm btn-block' value=" .$fila['idplato'].">".$fila['GROUP_CONCAT(DISTINCT producto_bodega)']."</button>
            </form>
			
			</td>
            <td style='text-align:center' >
            <button class='btn btn-light btn-sm btn-block precio' data-toggle='modal' data-target='#precio' value=" .$fila['idplato'].">".$fila['precioplato']."</button>
			</td>
    		<td style='text-align:center' >
            <button class='btn btn-light btn-sm btn-block desci' data-toggle='modal' data-target='#desci' value=" .$fila['idplato'].">".$fila['descplato']."</button>
			
			</td>
            <td style='text-align:center' >
            <button class='btn btn-light btn-sm btn-block desactivar' data-toggle='modal' data-target='#desactivar' value=" .$fila['idplato']."><i class='bi bi-toggle-on' style='color:#A3D900;font-size:25px;'></i></button>

			<span id='nome".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
            <span id='preciop".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
            <span id='ipdesc".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
            <span id='desacti".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
			</td>
            
              ";

                      $salida.="
    				</tr>";

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
  $(document).on('click', '.nom', function(){
            var id=$(this).val();
            var nome=$('#nome'+id).text();

             console.log(nome);

            $('#nom').modal('show');
            $('#nome').val(nome);
  });


  $(document).on('click', '.precio', function(){
            var id=$(this).val();
            var preciop=$('#preciop'+id).text();

             console.log(preciop);

            $('#precio').modal('show');
            $('#preciop').val(preciop);
  });


  $(document).on('click', '.desci', function(){
            var id=$(this).val();
            var ipdesc=$('#ipdesc'+id).text();

             console.log(ipdesc);

            $('#desci').modal('show');
            $('#ipdesc').val(ipdesc);
  });

  $(document).on('click', '.desactivar', function(){
            var id=$(this).val();
            var desacti=$('#desacti'+id).text();

             console.log(ipdesc);

            $('#desactivar').modal('show');
            $('#desacti').val(desacti);
  });
      
      
            
</script>