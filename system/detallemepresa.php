<?php
            require_once('../config/conexion.php');
            date_default_timezone_set('America/El_Salvador');
            $sql = "SELECT * FROM empresa"; 
            $query =$pdo -> prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetchAll(PDO::FETCH_OBJ); 

            if($query -> rowCount() > 0)   { 
                $todalventa = $pdo->prepare(" SELECT * FROM empresa ");
                $todalventa->execute();
                while ($resultventa = $todalventa->fetch()) {  
                ?>
                <div class="col-md-12"><p><i class="bi bi-house-fill"></i> <input type="text" value="<?php echo $resultventa -> empresa; ?>" class="in" id="nome"></p></div>

                <div class="col-md-12"><p><i class="bi bi-geo-alt-fill"></i><input type="text" class="in" value="<?php echo $resultventa -> direccion; ?>" id="dire"> </p></div>

                <div class="col-md-12"><p><i class="bi bi-telephone-inbound-fill"></i> <input type="text" class="in" value="<?php echo $resultventa -> telefono; ?>" id="tele"></p></div>

                <div class="col-md-12"><p><i class="bi bi-whatsapp"></i> <input type="text" class="in" value="<?php echo $resultventa -> whatsapp; ?>" id="whate"></p></div>

                <div class="col-md-12"><p><i class="bi bi-bootstrap-reboot"></i> <input type="text" class="in" value="<?php echo $resultventa -> giro; ?>" id="giroe"></p></div>

                <div class="col-md-12"><p><i class="bi bi-card-heading"></i> <input type="text" class="in" value="<?php echo $resultventa -> nit; ?>"
                 id="nite"></p></div>

                <div class="col-md-12"><p><i class="bi bi-card-heading"></i> <input type="text" class="in" value="<?php echo $resultventa -> ncr; ?>" id="ncre"></p></div>

                <div class="col-md-12"><p><i class="bi bi-check-circle-fill"></i> <input type="text" class="in" value="<?php echo $resultventa -> resolucion; ?>" id="rese"></p></div>

                <div class="col-md-12"><p><i class="bi bi-folder-fill"></i> <input type="text" class="in" value="<?php echo $resultventa -> autorizacion; ?>" id="aue"></p></div>

                <div class="col-md-12"><p><i class="bi bi-qr-code"></i> <input type="text" class="in" value="<?php echo $resultventa -> serie; ?>" id="sere"></p></div>

                 <center><button class="btn btn-success" onclick="actempre()">Actualizar</button></center>
                <?php
                }
                ?>
            
             <?php   
            }elseif($query -> rowCount() == 0){
               ?>
               <div class="row">
                <div class="form-group col-md-12">
                    <input type="text" id="nomempresa" class="form-control" placeholder="Nombre de la empresa">
                </div>
                <div class="form-group col-md-12">
                    <input type="text" id="dirempresa" class="form-control" placeholder="Direccion de la empresa">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="telempresa" class="form-control" placeholder="Telefono">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="what" class="form-control" placeholder="Whatsapp">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="giro" class="form-control" placeholder="Giro">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="nit" class="form-control" placeholder="NIT">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="ncr" class="form-control" placeholder="NCR">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="resolucion" class="form-control" placeholder="Resolucion">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="autorizacion" class="form-control" placeholder="Autorizacion">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" id="serie" class="form-control" placeholder="Serie">
                </div>
                <div class="col-md-12"><center><button class="btn btn-success">Ingresar</button></center></div>
                
            </div>
               <?php 
            }

            ?>
        