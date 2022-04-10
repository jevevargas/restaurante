$(document).ready(function () {
  DetalleVenta();
  contenidoPlato();
  formCliente();
});


setInterval(function(){
  DetalleVenta();

},1000
);



function mayus(e) {
  e.value = e.value.toUpperCase();
}

function DetalleVenta() {
  var idmesa = $("#idmesa").val(),
    orden = $("#orden").val();

   
  $.ajax({
    url: "detalleventa.php",
    type: "POST",
    dataType: "html",
    data: { idmesa: idmesa, orden: orden },
  }).done(function (r) {
    $("#DetalleVenta").html(r);
  });
}

function contenidoPlato() {
  var idmesa = $("#idmesa").val();
  // alert(ultimafecha);
  $.ajax({
    url: "detalleplato.php",
    type: "POST",
    dataType: "html",
    data: { idmesa: idmesa },
  }).done(function (r) {
    $("#contenidoPlato").html(r);
  });
}

function formCliente() {
  var idmesa = $("#idmesa").val();

  // alert(ultimafecha);
  $.ajax({
    url: "formCliente.php",
    type: "POST",
    dataType: "html",
    data: { idmesa: idmesa },
  }).done(function (r) {
    $("#formCliente").html(r);
  });
}

function cliente() {
  var cliente = document.getElementById("cliente").value;

  if (cliente == "") {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });

    Toast.fire({
      icon: "warning",
      title: "EL CAMPO CLIENTE ES OBLIGATORIO",
    });
  }

  if (cliente != "") {
    var idmesa = $("#idmesa").val(),
      cliente = $("#cliente").val(),
      direccion = $("#direccion").val(),
      telefono = $("#telefono").val(),
      dui = $("#dui").val();

    $.ajax({
      url: "icliente.php", // Es importante que la ruta sea correcta si no, no se va a ejecutar
      method: "POST",
      data: {
        idmesa: idmesa,
        cliente: cliente,
        direccion: direccion,
        telefono: telefono,
        dui: dui,
      },
      beforeSend: function () {},
      success: function () {
        $("#cliente").val("");
        $("#direccion").val("");
        $("#telefono").val("");
        $("#dui").val("");

        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: toast => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });

        Toast.fire({
          icon: "success",
          title: "CLIENTE AGREGADO",
        });
        DetalleVenta();
        contenidoPlato();
        formCliente();
        //citadoctor();
      },
    });
  }
}

function nuevoplato() {
  var nomplato = document.getElementById("nomplato").value;
  var descplato = document.getElementById("descplato").value;
  var precioplato = document.getElementById("precioplato").value;

  if (nomplato == "") {
    $("#nomplato").addClass("is-invalid");
  }

  if (descplato == "") {
    $("#descplato").addClass("is-invalid");
  }

  if (precioplato == "") {
    $("#precioplato").addClass("is-invalid");
  }

  if (nomplato != "" && desc != "" && precioplato != "") {
    var nomplato = $("#nomplato").val(),
      precioplato = $("#precioplato").val(),
      cat = $("#cat").val(),
      imp = $("#imp").val(),
      clave = $("#clave").val(),
      desc = $("#descplato").val();

    $.ajax({
      url: "iplato.php",
      type: "POST",
      data: {
        nomplato: nomplato,
        precioplato: precioplato,
        cat: cat,
        imp: imp,
        clave: clave,
        desc: desc,
      },
      beforeSend: function () {},

      success: function (respuesta) {
        //alert(respuesta);
        $("#clave").val("");
        $("#desc").val("");
        $("#nomplato").val("");
        $("#precioplato").val("");

        if (respuesta == 1) {
          Swal.fire(
            "PLATO AGREGADO",

            "",
            "success"
          );
        } else {
          Swal.fire(
            "NO ESTAS AUTORIZADO",

            "",
            "error"
          );
        }
        DetalleVenta();
        contenidoPlato();
      },
    });
  }
}

function editarcliente() {
  var nombree = $("#nombree").val(),
    duie = $("#duie").val(),
    telefonoe = $("#telefonoe").val(),
    direccione = $("#direccione").val(),
    idcliente = $("#idcliente").val();

  $.ajax({
    url: "acliente.php", // Es importante que la ruta sea correcta si no, no se va a ejecutar
    method: "POST",
    data: {
      nombree: nombree,
      duie: duie,
      telefonoe: telefonoe,
      direccione: direccione,
      idcliente: idcliente,
    },
    beforeSend: function () {},
    success: function () {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: toast => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      Toast.fire({
        icon: "success",
        title: "CLIENTE EDITADO",
      });
      DetalleVenta();
      contenidoPlato();
      formCliente();
      //citadoctor();
    },
  });
}

// venta y tabla de venta
