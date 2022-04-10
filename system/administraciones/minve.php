<?php  
$cantidad=$_REQUEST['cantidad'];
$id_producto=$_REQUEST['id_producto'];
$id_concepto=$_REQUEST['concepto'];
$num_ref=$_REQUEST['referencia'];
$val = false;

$descripcion = "";
$existencia_anterior = 0;
$existencia_actual = 0;
$num_mov = 0;

date_default_timezone_set('America/El_Salvador');


$fecha = Date('Y-m-d H:i:s');
$fecha2 = Date('Y-m-d');
$signo = 0;

include('../../config/conexionClass.php');

if($id_concepto == 1 || $id_concepto == 4 || $id_concepto == 2){
	$signo = 1;
    switch($id_concepto){
        case 1:
            $descripcion = "COMPRA";
            break;
        case 2:
            $descripcion = "anulacion de venta";
            break;
        case 4:
            $descripcion = "entrada a preparacion";
            break;
        default:
            $descripcion = "";
            break;
    }
}else{
	$signo = -1;
    switch($id_concepto){
        case 3:
            $descripcion = " VENTA PREPARADA";
            break;
        case 5:
            $descripcion = "SALIDA A PREPARACION";
            break;
        case 6:
            $descripcion = "VENTA DIRECTA";
            break;
        default:
            $descripcion = "";
            break;
    }
}

if($id_concepto == 5 || $id_concepto == 1 || $id_concepto == 6 || $id_concepto == 2){  //1 COMPRA || 5 SALIDA A PREPARACION //6 VENTA DIRECTA
	$busqueda=mysqli_query($enlace, "select producto_bodega, cantidad_bodega FROM bodega WHERE id_bodega = '$id_producto' ");
    while($f=mysqli_fetch_array($busqueda)){
    	$existencia_anterior = $f['cantidad_bodega'];
    	$descripcion = $f['producto_bodega'];
    }

}elseif($id_concepto == 3 || $id_concepto == 4){  // 3 VENTA PREPARADA || 2 anulacion de venta || 4 entrada a preparacion
	$busqueda=mysqli_query($enlace, "select nomplato FROM plato WHERE idplato = '$id_producto' ");
    while($f=mysqli_fetch_array($busqueda)){
    	//$existencia_anterior = $f['cantidad_bodega'];
    	$descripcion = $f['nomplato'];
    }
    $busqueda=mysqli_query($enlace, "select existencia from minve where  id_producto = '$id_producto' and CONVERT(fecha_elab, DATE) = '$fecha2' order by id_minve desc LIMIT 1");
    while($f=mysqli_fetch_array($busqueda)){
    	$existencia_anterior = isset($f['existencia']) ? $f['existencia'] : 0;
    }

}

	$busqueda=mysqli_query($enlace, "SELECT (num_mov+1) as num_mov FROM minve ORDER BY id_minve DESC LIMIT 1 ");
    while($f=mysqli_fetch_array($busqueda)){
    	$num_mov = $f['num_mov'];//isset($f['num_mov']) ? $f['num_mov'] : 0;
    	//$num_mov += 1; 
    }

    if($signo == 1){
    	$existencia_actual = $existencia_anterior + $cantidad;
    }else{
    	$existencia_actual = $existencia_anterior - $cantidad;   //-1  -   -1
    }

    $sql = "INSERT INTO minve (id_producto, descripcion, id_concepto, referencia, num_mov, cantidad_minve, signo, existencia, fecha_elab) VALUES ( '".$id_producto."', '".$descripcion."', '".$id_concepto."', '".$num_ref."', '".$num_mov."',  '".$cantidad."', '".$signo."', '".$existencia_actual."', '".$fecha."')";

	$result = mysqli_query($enlace, $sql);
	if($result === false){
	    echo "Error en la ejecucion ". $sql;
	}else{
		 //echo "Registro agregado satisfactoriamente " .$sql;
        $val = true;
	}

    //actualizar bodega
    if($id_concepto == 5 || $id_concepto == 6){  //5 = salida a preparacion de bodega  || 6 venta de bodega
        $sql = "UPDATE bodega set cantidad_bodega = '$existencia_actual' WHERE id_bodega = '$id_producto'";

        $result = mysqli_query($enlace, $sql);
        if($result === false){
            echo "Error en la ejecucion ". $sql;
        }else{
             echo "movimiento realizado satisfactoriamente " .$sql   ;
        }
    }else if($id_concepto == 2){
        $sql = "UPDATE bodega set cantidad_bodega = '$existencia_actual' WHERE id_bodega = '$id_producto'";

        $result = mysqli_query($enlace, $sql);
        if($result === false){
            echo "Error en la ejecucion ". $sql;
        }else{
             echo "movimiento realizado satisfactoriamente " .$sql   ;
        }
    }
    
    
   


?>