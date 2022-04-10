<?php


    $idp = $_REQUEST['idp'];
    $cant = $_REQUEST['cant'];
    $hora=date('Y-m-d H:i:s');
    $fecha=date('ymd');

   


	require('../../config/conexionClass.php');


/*$busqueda=mysqli_query($enlace, "select * from detalle_pedido where id_detalle_pedido='$ipp' ");
        while($f=mysqli_fetch_array($busqueda)){
        $plato=$f['id_plato'];
        $cant=$f['cantidad'];	
        }


$comp=mysqli_query($enlace, "select * from compocicion where id_plato='$plato' ");
        while($f=mysqli_fetch_array($comp)){
        $comp=$f['id_compocicion'];
        $cant_comp=$f['cantidad_compocicion'];
        $id_bodega=$f['id_bodega'];	
        }

$cantfin=$cant*$cant_comp;
 foreach ($comp as $elemento) {
 	echo 
 }

   $feu = "UPDATE bodega set  cantidad_bodega='$cantfin' WHERE id_bodega='$id_bodega' " ;*/



   //$fe = "UPDATE detalle_pedido set despachar='1', fecha_despacho='$hora' WHERE id_detalle_pedido='$idp' " ;

   // $result2 = mysqli_query($enlace, $fe);

$respuesta = array();
$hoy = date("Y-m-d", strtotime($fecha));
$comp=mysqli_query($enlace, "SELECT c.idplato, cantidad_componente AS plato, c.id_bodega, producto_bodega, cantidad_bodega AS bodega, ($cant*cantidad_componente) AS requerido
    FROM componentes AS c
    INNER JOIN bodega AS b ON b.id_bodega = c.id_bodega
    WHERE c.idplato = $idp ");
        while($f=mysqli_fetch_array($comp)){
         // echo $f['bodega'];
          /*if($f['refe'] != NULL){
            $inicio = substr($f['refe'], 8);
            $fin = substr($f['refe'], -3) + 1;
            echo $fin;
            $refer = $inicio.$fin;
           }else{*/
              $refer = 'RC'.$fecha.'001';
          // } 
          array_push($respuesta, array('idplato' => $f['idplato'],
                          'plato' => $f['plato'],
                          'id_bodega' =>  $f['id_bodega'] ,
                          'requerido' => $f['requerido'],
                          'referencia' => $refer
           ));
          
        }

        
   echo json_encode($respuesta);
 //$result3 = mysqli_query($enlace, $feu);   







 



      ?> 
      
