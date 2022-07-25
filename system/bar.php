<script src="../app/js/bar.js"></script>

<div class="col-md-12 bar">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>PRODUCTO</td>
                <td>CANT</td>
                <td>ORDEN</td>
                <td>NOTA</td>
                <td>MESA</td>
                <td>CLIENTE</td>
                <td>TIPO</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="tablabar"></tbody>
    </table>
</div>


<script>
$(document).on('click', '.final', function(){
var id=$(this).val();
var iddetalle=$('#iddetalle'+id).text();
$.ajax({
url:'despachar.php',
type: 'POST',
data:{'iddetalle':iddetalle},

 }); 

});



  </script>