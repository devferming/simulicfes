//$(document).ready(function () {
$(function () {
  /*Mascaras de entrada para campos de formulario*/
  $(".bloquear").on("paste", function (e) {
    e.preventDefault();
  });
  $(".bloquear").on("copy", function (e) {
    e.preventDefault();
  });
  $(".letter").on("keypress", function (event) {
    var regex = new RegExp("^[a-zA-ZÑñáéíóúüÁÉÍÓÚÜ ]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".nickname").on("keypress", function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".number").on("keypress", function (event) {
    var regex = new RegExp("^[0-9. ]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".number2").on("keypress", function (event) {
    var regex = new RegExp("^[0-9 ]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".letterandnumber").on("keypress", function (event) {
    var regex = new RegExp("[a-zA-Z0-9]");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".password").on("keypress", function (event) {
    var regex = new RegExp("[a-zA-Z0-9 *.#!+-]");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".direccion").on("keypress", function (event) {
    var regex = new RegExp("^[a-zA-ZÑñáéíóúüÁÉÍÓÚÜ0-9 #-]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".jsdatetime").on("keypress", function (event) {
    var regex = new RegExp("^[a-zA-ZÑñáéíóúüÁÉÍÓÚÜ0-9 #-:]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".correo").on("keypress", function (event) {
    var regex = new RegExp("^[a-zA-Z0-9 @_.-]+$");
    var key = String.fromCharCode(
      !event.charCode ? event.which : event.charCode
    );
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  });
  $(".number").on("keyup", function () {
    var nid = $(this).attr("id");
    separador = document.getElementById(nid);
    separador.addEventListener(
      "keyup",
      (e) => {
        var entrada = e.target.value.split(".").join("");
        entrada = entrada.split("").reverse();
        var salida = [];
        var aux = "";
        var paginador = Math.ceil(entrada.length / 3);
        for (let i = 0; i < paginador; i++) {
          for (let j = 0; j < 3; j++) {
            ("123 4");
            if (entrada[j + i * 3] != undefined) {
              aux += entrada[j + i * 3];
            }
          }
          salida.push(aux);
          aux = "";
          e.target.value = salida.join(".").split("").reverse().join("");
        }
      },
      false
    );
  });
  
  /*Asignador de nivel de acceso según el Rol*/
  $("#user_rol").on("change ", function (event) {
    var rol = $(this).val();
    if (rol == "RECTOR(A)") {
      $("#nivel").attr("value", 1);
    } else if (rol == "COORDINADOR(A)") {
      $("#nivel").attr("value", 1);
    } else if (rol == "SECRETARIA") {
      $("#nivel").attr("value", 2);
    } else if (rol == "DOCENTE") {
      $("#nivel").attr("value", 3);
    }
  });
  /*Repetir password*/
  $("#reg-user").attr("disabled", true);

  $("#repetir-password").on("keyup", function () {
    var password_nuevo = $("#password").val();
    var largo2 = $("#password").val().length;
    if (largo2 < 8) {
      $("#resultado-password").text("Introduzca un password válido");
      $("#resultado-password-contenedor")
        .attr("style", "display:block")
        .addClass("invalid-password")
        .removeClass("valid-password");
      $("#password").addClass("is-invalid").removeClass("is-valid");
      $("#repetir-password").addClass("is-invalid").removeClass("is-valid");
      $("#reg-user").attr("disabled", true);
    }
    if (largo2 >= 8) {
      if ($(this).val() == password_nuevo) {
        $("#resultado-password").text("El password coincide");
        $("#resultado-password-contenedor")
          .attr("style", "display:block")
          .addClass("valid-password")
          .removeClass("invalid-password");
        $("#resultado-password-contenedor2").attr("style", "display:none");
        $("#password").addClass("is-valid").removeClass("is-invalid");
        $("#repetir-password").addClass("is-valid").removeClass("is-invalid");
        $("#reg-user").attr("disabled", false);
      } else {
        $("#resultado-password").text("El password no coincide");
        $("#resultado-password-contenedor")
          .attr("style", "display:block")
          .addClass("invalid-password")
          .removeClass("valid-password");
        $("#password").addClass("is-invalid").removeClass("is-valid");
        $("#repetir-password").addClass("is-invalid").removeClass("is-valid");
        $("#reg-user").attr("disabled", true);
      }
    }
  });

  $("#password").on("keyup", function () {
    var password_nuevo2 = $("#repetir-password").val();
    var largo = $(this).val().length;
    if (largo < 8) {
      $("#resultado-password2").text("Se requieren mínimo 8 caracteres");
      $("#resultado-password-contenedor2")
        .attr("style", "display:block")
        .addClass("invalid-password")
        .removeClass("valid-password");
      $("#resultado-password").text("El password no coincide");
      $("#resultado-password-contenedor")
        .attr("style", "display:block")
        .addClass("invalid-password")
        .removeClass("valid-password");
      $("#password").addClass("is-invalid").removeClass("is-valid");
      $("#repetir-password").addClass("is-invalid").removeClass("is-valid");
      $("#reg-user").attr("disabled", true);
    }
    if (largo >= 8) {
      $("#resultado-password2").text("");
      if ($(this).val() == password_nuevo2) {
        $("#resultado-password").text("El password coincide");
        $("#resultado-password-contenedor")
          .attr("style", "display:block")
          .addClass("valid-password")
          .removeClass("invalid-password");
        $("#resultado-password-contenedor2").attr("style", "display:none");
        $("#password").addClass("is-valid").removeClass("is-invalid");
        $("#repetir-password").addClass("is-valid").removeClass("is-invalid");
        $("#reg-user").attr("disabled", false);
      } else {
        $("#resultado-password").text("El password no coincide");
        $("#resultado-password-contenedor")
          .attr("style", "display:block")
          .addClass("invalid-password")
          .removeClass("valid-password");
        $("#password").addClass("is-invalid").removeClass("is-valid");
        $("#repetir-password").addClass("is-invalid").removeClass("is-valid");
        $("#reg-user").attr("disabled", true);
      }
    }
  });

  /*Establece display block si el usuario a registrar es un Docente*/
  $("#user_rol").on("change", function () {
    var rol = $(this).val();
    if (rol == "DOCENTE") {
      $("#perfil_docente").attr("style", "display:block");
      $("#user_materia").val("");
      $("#user_dgrupo").val("");
      $("#ipj").val("");
      $("#ij").val("");
      $("#itrans").val("");
      $("#iprimero").val("");
      $("#isegundo").val("");
      $("#itercero").val("");
      $("#icuarto").val("");
      $("#iquinto").val("");
      $("#isexto").val("");
      $("#iseptimo").val("");
      $("#ioctavo").val("");
      $("#inoveno").val("");
      $("#idecimo").val("");
      $("#iundecimo").val("");
    } else {
      $("#perfil_docente").attr("style", "display:none");
      $("#user_materia").val("N/A");
      $("#user_dgrupo").val("N/A");
      $("#ipj").val("N/A");
      $("#ij").val("N/A");
      $("#itrans").val("N/A");
      $("#iprimero").val("N/A");
      $("#isegundo").val("N/A");
      $("#itercero").val("N/A");
      $("#icuarto").val("N/A");
      $("#iquinto").val("N/A");
      $("#isexto").val("N/A");
      $("#iseptimo").val("N/A");
      $("#ioctavo").val("N/A");
      $("#inoveno").val("N/A");
      $("#idecimo").val("N/A");
      $("#iundecimo").val("N/A");
    }
  });

  /*Validador de formularios general*/

  (function () {
    "use strict";
    window.addEventListener(
      "load",
      function () {
        var forms = document.getElementsByClassName("needs-validation");
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener(
            "submit",
            function (event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              } else {
                event.preventDefault();
                var datos2 = $(".needs-validation").attr("id");
                var datos = $("#" + datos2).serializeArray();
                $.ajax({
                  data: datos,
                  url: $(this).attr("action"),
                  type: "post",
                  dataType: "json",
                  success: function (data) {
                    var resultado = data;
                    if (resultado.respuesta == "exito") {
                      Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Operación realizada correctamente",
                        showConfirmButton: false,
                        timer: 1500,
                      });
                      $("#" + datos2)[0].reset();
                      $("#" + datos2).removeClass("was-validated");
                      location.reload();
                    } else {
                      Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Algo salió mal",
                        showConfirmButton: true,
                      });
                    }
                  },
                });
              }
              form.classList.add("was-validated");
            },
            false
          );
        });
      },
      false
    );
  })();

  /*Validador de formularios parametros de simulacros*/

  $('#guardar-simul').on('submit', function (e) {
    e.preventDefault();
    $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:flex;');
    var datos = new FormData(this);
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        var resultado = data;
        console.log(data);

        if (resultado.respuesta == 'exito') {
          $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Prueba cargada exitosamente",
            showConfirmButton: false,
            timer: 1500,
          });
          location.reload();

          // window.location.href = 'av-asignaciones-lista.php?grado='+resultado.grado;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error',
          })
        }
      }
    });
  });

  $('#respuestas_simulacro').on('submit', function (e) {
    e.preventDefault();

    $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:flex;');
    var datos = new FormData(this);
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        var resultado = data;
        console.log(data);

        if (resultado.respuesta == 'exito') {
          $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Respuestas guardadas con exito",
            showConfirmButton: false,
            timer: 1500,
          });

          //window.location.href = 'preifces-lista2.php?grado='+resultado.grado;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error',
          })
        }

      }

    });
    $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');


  });

  $('#respuestas_simulacro2').on('submit', function (e) {
    e.preventDefault();
    var datos = new FormData(this);
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        var resultado = data;
        console.log(data);

        if (resultado.respuesta == 'exito') {
          $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Simulacro Actualizado",
            showConfirmButton: false,
            timer: 1500,
          });


          //window.location.href = 'av-asignaciones-lista.php?grado='+resultado.grado;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error',
          })
        }
      }
    });
  });
});
