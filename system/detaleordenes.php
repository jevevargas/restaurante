<table class="table table-hover table-striped ">


    <tbody>
        <?php
        include('../config/conexion.php');
        session_start();
        $usu = $_SESSION['idusuario']; //echo $usu;
        $todalcaja = $pdo->prepare(" SELECT * FROM caja WHERE estadocaja = '1'  ");
        $todalcaja->execute();
        while ($resultc = $todalcaja->fetch()) {
            $inicio = $resultc->iniciocaja;   //echo $inicio;
            $final = $resultc->fincaja;  //echo $final;
        }

        date_default_timezone_set('America/El_Salvador');
        $todalazona = $pdo->prepare("SELECT * FROM pago WHERE  fechapago2  BETWEEN  '$inicio' AND '$final'  ORDER  BY orden ASC  ");
        $todalazona->execute();
        while ($resultb = $todalazona->fetch()) {
            $tipo = $resultb->tipopago;
        ?>
            <tr>
                <td class="pt-3">
                    <span class="badge badge-danger"><b>ORDEN: #<?php echo $resultb->orden; ?></b></span>

                </td>
                <td class="pt-3"><?php
                                    if ($tipo == 1) {
                                    ?>Efectivo<?php
                                            } elseif ($tipo == 2) {
                                                ?>Tarjeta<?php
                                            } elseif ($tipo == 3) {
                                                ?>Credito<?php
                                            } elseif ($tipo == 4) {
                                                ?>Cotesia<?php
                                            } elseif ($tipo == 5) {
                                                ?>Deposito<?php
                                            }
                                                ?>
                </td>
                <td class="pt-3"><i class="bi bi-currency-dollar"></i><?php echo $resultb->totalpago; ?></td>
                <td><button class="btn btn-danger btn-sm edit" value="<?php echo $resultb->orden; ?>" id="orden<?php echo $resultb->orden;  ?>"><?php echo $resultb->orden;  ?></button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>