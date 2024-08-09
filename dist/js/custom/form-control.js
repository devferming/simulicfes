//$(document).ready(function () {
$(function() {
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
  /*Validador de inputs de la información del acudiente*/
  $("#acu_par").on("change", function () {
    console.log('cvlick')
    var parent = $(this).val();
    if (parent == "MADRE") {
      console.log("Es madre");
      var mad_tdo = $("#mad_tdo").val();
      var mad_ndo = $("#mad_ndo").val();
      var mad_edo = $("#mad_edo").val();
      var mad_1ap = $("#mad_1ap").val();
      var mad_2ap = $("#mad_2ap").val();
      var mad_1no = $("#mad_1no").val();
      var mad_2no = $("#mad_2no").val();
      var mad_dir = $("#mad_dir").val();
      var mad_tmo = $("#mad_tmo").val();
      var mad_mai = $("#mad_mai").val();
      var mad_tlo = $("#mad_tlo").val();
      $("#acu_tdo").val(mad_tdo);
      $("#acu_ndo").val(mad_ndo);
      $("#acu_edo").val(mad_edo);
      $("#acu_1ap").val(mad_1ap);
      $("#acu_2ap").val(mad_2ap);
      $("#acu_1no").val(mad_1no);
      $("#acu_2no").val(mad_2no);
      $("#acu_dir").val(mad_dir);
      $("#acu_tmo").val(mad_tmo);
      $("#acu_tlo").val(mad_mai);
      $("#acu_mai").val(mad_tlo);
      $("#mad_tdo").attr("readonly", true);
      $("#mad_ndo").attr("readonly", true);
      $("#mad_edo").attr("readonly", true);
      $("#mad_1ap").attr("readonly", true);
      $("#mad_2ap").attr("readonly", true);
      $("#mad_1no").attr("readonly", true);
      $("#mad_2no").attr("readonly", true);
      $("#mad_dir").attr("readonly", true);
      $("#mad_tmo").attr("readonly", true);
      $("#mad_tlo").attr("readonly", true);
      $("#mad_mai").attr("readonly", true);
      $("#pad_tdo").attr("readonly", false);
      $("#pad_ndo").attr("readonly", false);
      $("#pad_edo").attr("readonly", false);
      $("#pad_1ap").attr("readonly", false);
      $("#pad_2ap").attr("readonly", false);
      $("#pad_1no").attr("readonly", false);
      $("#pad_2no").attr("readonly", false);
      $("#pad_dir").attr("readonly", false);
      $("#pad_tmo").attr("readonly", false);
      $("#pad_tlo").attr("readonly", false);
      $("#pad_mai").attr("readonly", false);
    } else if (parent == "PADRE") {
      
      var pad_tdo = $("#pad_tdo").val();
      var pad_ndo = $("#pad_ndo").val();
      var pad_edo = $("#pad_edo").val();
      var pad_1ap = $("#pad_1ap").val();
      var pad_2ap = $("#pad_2ap").val();
      var pad_1no = $("#pad_1no").val();
      var pad_2no = $("#pad_2no").val();
      var pad_dir = $("#pad_dir").val();
      var pad_tmo = $("#pad_tmo").val();
      var pad_tlo = $("#pad_tlo").val();
      var pad_mai = $("#pad_mai").val();
      $("#acu_tdo").val(pad_tdo);
      $("#acu_ndo").val(pad_ndo);
      $("#acu_edo").val(pad_edo);
      $("#acu_1ap").val(pad_1ap);
      $("#acu_2ap").val(pad_2ap);
      $("#acu_1no").val(pad_1no);
      $("#acu_2no").val(pad_2no);
      $("#acu_dir").val(pad_dir);
      $("#acu_tmo").val(pad_tmo);
      $("#acu_tlo").val(pad_tlo);
      $("#acu_mai").val(pad_mai);
      $("#pad_tdo").attr("readonly", true);
      $("#pad_ndo").attr("readonly", true);
      $("#pad_edo").attr("readonly", true);
      $("#pad_1ap").attr("readonly", true);
      $("#pad_2ap").attr("readonly", true);
      $("#pad_1no").attr("readonly", true);
      $("#pad_2no").attr("readonly", true);
      $("#pad_dir").attr("readonly", true);
      $("#pad_tmo").attr("readonly", true);
      $("#pad_tlo").attr("readonly", true);
      $("#pad_mai").attr("readonly", true);
      $("#mad_tdo").attr("readonly", false);
      $("#mad_ndo").attr("readonly", false);
      $("#mad_edo").attr("readonly", false);
      $("#mad_1ap").attr("readonly", false);
      $("#mad_2ap").attr("readonly", false);
      $("#mad_1no").attr("readonly", false);
      $("#mad_2no").attr("readonly", false);
      $("#mad_dir").attr("readonly", false);
      $("#mad_tmo").attr("readonly", false);
      $("#mad_tlo").attr("readonly", false);
      $("#mad_mai").attr("readonly", false);
    } else {
      $("#acu_tdo").val("");
      $("#acu_ndo").val("");
      $("#acu_edo").val("");
      $("#acu_1ap").val("");
      $("#acu_2ap").val("");
      $("#acu_1no").val("");
      $("#acu_2no").val("");
      $("#acu_dir").val("");
      $("#acu_tmo").val("");
      $("#acu_tlo").val("");
      $("#acu_mai").val("");
      $("#mad_tdo").attr("readonly", false);
      $("#mad_ndo").attr("readonly", false);
      $("#mad_edo").attr("readonly", false);
      $("#mad_1ap").attr("readonly", false);
      $("#mad_2ap").attr("readonly", false);
      $("#mad_1no").attr("readonly", false);
      $("#mad_2no").attr("readonly", false);
      $("#mad_dir").attr("readonly", false);
      $("#mad_tmo").attr("readonly", false);
      $("#mad_tlo").attr("readonly", false);
      $("#mad_mai").attr("readonly", false);
      $("#pad_tdo").attr("readonly", false);
      $("#pad_ndo").attr("readonly", false);
      $("#pad_edo").attr("readonly", false);
      $("#pad_1ap").attr("readonly", false);
      $("#pad_2ap").attr("readonly", false);
      $("#pad_1no").attr("readonly", false);
      $("#pad_2no").attr("readonly", false);
      $("#pad_dir").attr("readonly", false);
      $("#pad_tmo").attr("readonly", false);
      $("#pad_tlo").attr("readonly", false);
      $("#pad_mai").attr("readonly", false);
    }
  });
  $("#acu_tdo").on("click", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_tdo").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_tdo").val(valor);
    }
  });
  $("#acu_ndo").on("blur", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_ndo").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_ndo").val(valor);
    }
  });
  $("#acu_edo").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_edo").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_edo").val(valor);
    }
  });
  $("#acu_1ap").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_1ap").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_1ap").val(valor);
    }
  });
  $("#acu_2ap").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_2ap").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_2ap").val(valor);
    }
  });
  $("#acu_1no").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_1no").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_1no").val(valor);
    }
  });
  $("#acu_2no").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_2no").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_2no").val(valor);
    }
  });
  $("#acu_dir").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_dir").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_dir").val(valor);
    }
  });
  $("#acu_tmo").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_tmo").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_tmo").val(valor);
    }
  });
  $("#acu_tlo").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_tlo").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_tlo").val(valor);
    }
  });
  $("#acu_mai").on("keyup", function (event) {
    var valor = $(this).val();
    var acudiente = $("#acu_par").val();
    if (acudiente == "MADRE") {
      $("#mad_mai").val(valor);
    } else if (acudiente == "PADRE") {
      $("#pad_mai").val(valor);
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
  /*Validador de formularios parametros de talleres y simulacros*/
  $('#guardar-taller').on('submit', function(e) {
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
        success: function(data){
          var resultado = data;
          console.log(data);
          
          if(resultado.respuesta == 'exito'){
            $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Guia cargada exitosamente",
              showConfirmButton: false,
              timer: 1500,
            });
            
            
            window.location.href = 'av-asignaciones-lista.php?grado='+resultado.grado;
          } else if (resultado.respuesta == 'exito2') {
            $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;')
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Guia cargada exitosamente",
                showConfirmButton: false,
                timer: 1500,
              });
              window.location.href = 'av-asignaciones-lista-2.php?grado='+resultado.grado+'&materia='+resultado.materia+'&code='+resultado.grado;
          } else if (resultado.respuesta == 'exito3') {
            $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;')
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Carga exitosa",
              showConfirmButton: false,
              timer: 1500,
            });
            window.location.reload();
        } else if (resultado.respuesta == 'error1') {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Solo se admiten archivos de imagen, PDF, o Word',
          });
      } else if (resultado.respuesta == 'error2') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un error al subir los archivos, vuelva a intentar',
        });
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
  $('#guardar-simul').on('submit', function(e) {
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
        success: function(data){
          var resultado = data;
          console.log(data);
          
          if(resultado.respuesta == 'exito'){
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
  $('#respuestas_simulacro').on('submit', function(e) {
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
          success: function(data){
            var resultado = data;
            console.log(data);
            
            if(resultado.respuesta == 'exito'){
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
  $('#respuestas_simulacro2').on('submit', function(e) {
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
        success: function(data){
          var resultado = data;
          console.log(data);
          
          if(resultado.respuesta == 'exito'){
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
