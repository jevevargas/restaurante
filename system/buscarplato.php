
<?php
  //error_reporting(E_ERROR);
 include('../config/conexionClass.php');

//  $orden=$_REQUEST['orden']; // echo $orden;
    $salida = "";
    // $orden = "";

    $query = "SELECT * FROM plato WHERE estadoplato='1'  ORDER By idplato LIMIT 5";

    if (isset($_POST['consulta'])) {
    	$q = $enlace->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM plato WHERE estadoplato='1' AND nomplato  LIKE '%$q%' ";
    }

    $resultado = $enlace->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='table   table-bordered'>
    			<thead>
    				<tr id='titulo'>
    					<td style='text-align:center'>ID</td>
    					<td style='text-align:center'>PLATO</td>
    					<td style='text-align:center'>PRECIO</td>
    					<td style='text-align:center'>DESC</td>
                   
              
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    		<td style='text-align:center; font-size:12px;'>
              <button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['idplato']."</button>
			</td>

    		<td style='text-align:center; font-size:12px;'>
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['nomplato']."</button>
			</td>

    		<td style='text-align:center; font-size:12px;'>
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['precioplato']."</button>
			</td>

    		<td style='text-align:center' >
			<button class='btn btn-light btn-sm btn-block ordenar' data-toggle='modal' data-target='#ordenar' value=" .$fila['idplato'].">".$fila['descplato']."</button>
			<span id='idp".$fila['idplato']."' style='display:none'>".$fila['idplato']."</span>
			<span id='nomplaton".$fila['idplato']."' style='display:none'>".$fila['nomplato']."</span>
			<span id='precioplaton".$fila['idplato']."' style='display:none'>".$fila['precioplato']."</span>
         <span id='impplato".$fila['idplato']."' style='display:none'>".$fila['impresionplato']."</span>
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



<script>
	
$(document).ready(function () {
   $("#alertFalta").hide();
   //URL = "administraciones/validarplato.php";  
   var idp = "";
  //$(document).on('click', '.ordenar', function(){
   $(".ordenar").click(function (){
      var id=$(this).val();
      idp=$('#idp'+id).text();
      var nomplaton=$('#nomplaton'+id).text();
      var precioplaton=$('#precioplaton'+id).text();
      var impplato=$('#impplato'+id).text();
      
      
      console.log("id: "+idp);
         //console.log(nomplaton);
         //console.log(precioplaton);
      
      // $('#ordenar').modal('show');
      $('#idp').val(idp);
      $('#nomplaton').val(nomplaton);
      $('#precioplaton').val(precioplaton);
      $('#impplato').val(impplato);
      validar(idp);
  });
  
  //var idp=$('#idp'+id).text();
  
  function validar(idp){
   //alert(idp);
   $.ajax({
      type: "POST",
      data: { 
      "idp" : idp,
      "cant": 0
      },

      url: "administraciones/validarplato.php",
      success: function(datosObt) {
      var arregloDatos = JSON.parse(datosObt);
      var conteo = 0, mensaje = "";
      if(arregloDatos.length > 0 ){
         for (var i = 0; arregloDatos.length > i; i++) {
            if(arregloDatos[i].id === "vacio"){
               conteo = -1;
               mensaje = arregloDatos[i].Descripcion;
            }else if(arregloDatos[i].id === "NO"){
               conteo += 1;
            }
         }
         if(conteo < 0){
            //alert(mensaje);
            $('#ordenar').modal('hide');
            $('#AgregarOrden').prop( "disabled", true );
            $("#alertFalta").show(600).html(mensaje);

               setTimeout(function(){

                  $("#alertFalta").hide(600).html("");

               }, 3000);
         }else if(conteo > 0){
            //alert("No hay existencias de algún componente para crear el plato");
            $('#ordenar').modal('hide');
               $('#AgregarOrden').prop( "disabled", true );
            $("#alertFalta").show(600).html("No hay existencias de algún componente para crear el plato!!!");

               setTimeout(function(){

                  $("#alertFalta").hide(600).html("");

               }, 3000);
         }else{
            $('#ordenar').modal('show');
            $('#AgregarOrden').prop( "disabled", false );
               $("#alertFalta").hide();
         }

      }else{

      }

      },
      error: function(e) { // Si no ha podido conectar con el servidor
         // Código en caso de fracaso en el envío
         console.log(e);
      }
      });
  }


});

</script>