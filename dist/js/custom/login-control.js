//$(document).ready(function () {
$(function() {
  //::::::::::::::LOGIN:::::::::::::::::::::::::::::://
  $("#user_login").on("submit", function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        var resultado = data;
        //console.log(data);
        if (resultado.respuesta == "aprobado") {
          if (resultado.nivel == 1) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Logín Correcto",
              text: "Bienvenido(a) " + resultado.usuario + ".",
              showConfirmButton: false,
              timer: 2000,
            });
            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
          } else if (resultado.nivel == 2) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Logín Correcto",
              text: "Bienvenido(a) " + resultado.usuario + ".",
              showConfirmButton: false,
              timer: 2000,
            });
            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
          } else if (resultado.nivel == 3) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Logín Correcto",
              text: "Bienvenido(a) " + resultado.usuario + ".",
              showConfirmButton: false,
              timer: 2000,
            });
            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
          } else if (resultado.nivel == 4) {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Logín Correcto",
              text: "Bienvenido(a) " + resultado.usuario + ".",
              showConfirmButton: false,
              timer: 2000,
            });
            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
          }
        } else if (resultado.respuesta == 'bloqueado') {
          Swal.fire({
            icon: 'error',
            title: 'Notificación...',
            text: 'Usuario bloqueado',
            //footer: '<a href>¿Porque ocurrió esto?</a>'
          })
        } else if (resultado.respuesta == 'advertencia') {
          Swal.fire({
            icon: 'warning',
            title: '¡Password Incorrecto!',
            text: 'El Password que estas introduciendo es incorrecto, por favor intenta de nuevo'
            //footer: '<a href>¿Porque ocurrió esto?</a>'
          })
        } else if (resultado.respuesta == 'nouser') {
          Swal.fire({
            icon: 'warning',
            title: '¡Usuario Incorrecto!',
            text: 'EL usuario que estas utilizando no se encuentra registrado'
            //footer: '<a href>¿Porque ocurrió esto?</a>'
          })
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Algo salió mal",
            showConfirmButton: true,
            timer: 2000,
          });
        }
      },
    });
  });
});
