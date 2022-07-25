<?php
    include('../config/conexion.php');

     date_default_timezone_set('America/El_Salvador');

    $todalventa = $pdo->prepare(" SELECT * FROM venta left join orden ON venta.orden=orden.orden LEFT JOIN cliente ON orden.idcliente=cliente.idcliente LEFT JOIN mesa ON orden.idmesa=mesa.idmesa LEFT JOIN plato ON venta.idplato=plato.idplato WHERE impresion='1' AND impresionplato='2' AND despachar='0' ORDER BY idventa DESC ");
    $todalventa->execute();
    while ($resultventa = $todalventa->fetch()) {  
        $mesas=$resultventa->nombremesa;
        $tipo=$resultventa->tipoatencion;
        $idmesa=$resultventa->idmesa;
    ?>
    <tr>
    <td><?php  echo $resultventa->idventa; ?></td>
    <td><?php  echo $resultventa->nomorden; ?></td>
    <td style="font-size:20px;"><b>(<?php  echo $resultventa->cantidadorden; ?>)</b></td>
    <td><b>#<?php  echo $resultventa->orden; ?></b> </td>
    <td><?php  echo $resultventa->descorden; ?></td>
    <td><?php echo $resultventa->nombremesa; ?></td>
    <td><?php  echo $resultventa->nomcliente; ?></td>
    <td><?php  if($tipo==1){ ?><i class="bi bi-truck"></i> Domicilio<?php }elseif($tipo==2){ ?><i class="bi bi-hourglass-split"></i> Recoger<?php }  ?></td>
    <td>
        <?php 
          if($idmesa==''){
              ?><a href="ticketbar.php?venta=<?php  echo $resultventa->idventa; ?>&&orden=<?php echo $resultventa->orden; ?>" class="btn btn-primary btn-sm" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer"></i></a><?php
          }else{
              ?><a href="ticketbar2.php?venta=<?php  echo $resultventa->idventa; ?>&&orden=<?php echo $resultventa->orden; ?>" class="btn btn-info btn-sm" onclick="window.open(this.href, this.target, 'width=800,height=500'); return false;"><i class="bi bi-printer"></i></a><?php
          }
        ?>

        <button class="btn btn-danger btn-sm final"  data-toggle="modal" data-target="#final" value="<?php echo $resultventa->idventa; ?>">Despachar</button>
        <span id="iddetalle<?php  echo $resultventa->idventa;  ?>" style="display:none"><?php  echo $resultventa->idventa;  ?></span>
    </td>
    </tr>

   <?php } ?>