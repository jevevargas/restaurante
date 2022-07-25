<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
            
                                <td style="font-size:12px">PRODUCTO</td>
                                <td style="font-size:12px">CANTIDAD</td>
                                <td style="font-size:12px">FECHA</td>
                                <td style="font-size:12px">FACTURA</td>
                                <td style="font-size:12px">PROVEEDOR</td>
                                <td style="font-size:12px">PRECIO</td>
                            </tr>
                        </thead>
                  <tbody>
                    <?php
                        include('../config/conexion.php');

                        $fechabode=$_REQUEST['fechabode'];
                        $estado = $pdo->prepare(" SELECT * FROM movbode LEFT JOIN bodega ON movbode.id_bodega = bodega.id_bodega WHERE fechamovbodecorta='$fechabode' ");
                        $estado->execute();
                        while ($result = $estado->fetch()) {
                    ?>
                    <tr>
                        <td style="font-size:12px"><?php  echo $result -> producto_bodega; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> canmovbod; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> fechamovbod; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> factura; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> proveedor; ?></td>
                        <td style="font-size:12px"><?php  echo $result -> costomov; ?></td>   
                    </tr>
                    <?php } ?>

                  </tbody>
                    </table>