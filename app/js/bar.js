$(document).ready(function () {
    tablabar();

  });


  setInterval(function(){
    tablabar();
  
  },1000
  );

  function tablabar() {
  
    $.ajax({
      url: "tablabar.php",
      type: "POST",
      dataType: "html",
      data: {  },
    }).done(function (r) {
      $("#tablabar").html(r);
    });
  }