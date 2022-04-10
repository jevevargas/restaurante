<table class="table table-bordered table-success">
    <tbody>
        
        <?php
            require_once('header.php');
               $estado = $pdo->prepare(" SELECT * FROM plato order by idplato DESC limit 0,1 ");
               $estado->execute();
               while ($result = $estado->fetch()) {
        ?>
         <tr>
          <td><?php echo $result -> nomplato;  ?></td>
          <td>$<?php echo $result -> precioplato; ?></td>
          <td><form action="composicion"method="POST">
              <input type="text" name="idplato" value="<?php  echo $result-> idplato ?>" style="display:none">
              <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> COMPOSICION</button>
          </form></td>
         </tr>
        <?php
          }
        ?>
       
    </tbody>
</table>