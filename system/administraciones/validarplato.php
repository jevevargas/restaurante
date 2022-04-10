<?php

include('../../config/conexionClass.php');

$idp = $_REQUEST["idp"];
$cant = $_REQUEST["cant"];

   $response = array();

if($cant == 0){
 
    $busqueda=mysqli_query($enlace, "SELECT c.idplato, cantidad_bodega AS plato, c.id_bodega, producto_bodega, 
                                        (cantidad_bodega*cantidad_componente) AS existencia
                                    FROM componentes AS c
                                        INNER JOIN bodega AS b ON b.id_bodega = c.id_bodega
                                    WHERE c.idplato = $idp");
        if(mysqli_num_rows($busqueda) > 0){
            while($f=mysqli_fetch_array($busqueda)){
                //echo '1';
                if($f['existencia'] <= 0){
                    array_push($response, array( 'id' => 'NO',
                        'Descripcion' => $f['producto_bodega']));
                }else{
                    array_push($response, array( 'id' => 'SI',
                        'Descripcion' => $f['producto_bodega']));
                }

            }   
        }else{
            array_push($response, array( 'id' => 'vacio',
                        'Descripcion' => 'No hay componentes para el plato'));
        }
}else{
    //echo $cant;
      $busqueda=mysqli_query($enlace, "SELECT c.idplato, cantidad_componente AS plato, c.id_bodega, producto_bodega, cantidad_bodega AS                                    bodega, ($cant*cantidad_componente) AS requerido
                                        FROM componentes AS c
                                            INNER JOIN bodega AS b ON b.id_bodega = c.id_bodega
                                        WHERE c.idplato = $idp");
        if(mysqli_num_rows($busqueda) > 0){
            while($f=mysqli_fetch_array($busqueda)){
                //echo '1';
                if($f['requerido'] > $f['bodega']){
                    array_push($response, array( 'id' => 'NO',
                        'Descripcion' => $f['producto_bodega']));
                }else{
                    array_push($response, array( 'id' => 'SI',
                        'Descripcion' => $f['producto_bodega']));
                }

            }   
        }else{
            array_push($response, array( 'id' => 'vacio',
                        'Descripcion' => 'No hay componentes para el plato'));
        }
}
    

    echo json_encode($response);



?>
