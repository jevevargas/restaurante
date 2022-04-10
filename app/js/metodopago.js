$(document).ready(function(){
    $("#buscar").on("click", function(){
      var inicial = $("#inicial").val(),
          tipopago = $("#tipopago").val(),
          final = $("#final").val();
        $.ajax({
            type: "POST",
            url: "tablatipopago.php",
            data:{inicial:inicial,final:final,tipopago:tipopago},
            success: function(respuesta){
                $("#resultado").html(respuesta);
            }
        })
    })
});