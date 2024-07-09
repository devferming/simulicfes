<footer class="main-footer text-sm">
  <strong>Copyright &copy; 2024 I.E Escuela Normal Superior de Ocaña</strong> Desarrollado por: <a href="https://www.linkedin.com/in/devferming/"><strong>Fermín Gutiérrez</strong></a>
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
  </div>
</footer>
<div class="modal fade" id="modal-login-lista">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Datos de acceso</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" name="logins_actualizar" id="logins_actualizar" method="post" action="usuario-modelo.php" class="needs-validation" novalidate autocomplete="on">
          <div class="row">
            
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nombre</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                  </div>
                  <input type="text" class="form-control letter bloquear" name="user_nombre_l" id="user_nombre_l" readonly required>
                </div>
              </div>
            </div> <!-- col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nickname</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                  </div>
                  <input type="text" class="form-control nickname minusculas bloquear" name="user_nick_l" id="user_nick_l" required>
                </div>
              </div>
            </div> <!-- col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                  </div>
                  <input type="password" class="form-control password bloquear" name="user_password_l" id="password" required>
                  <div id="resultado-password-contenedor2" style ="display:none">
                  <span id="resultado-password2">Este campo es obligatorio.</span> 
                  </div>
                </div>
              </div>
            </div> <!-- col -->
            <div class="col-sm-6">
              <div class="form-group">
                <label>Confirmar Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                  </div>
                  <input type="password" class="form-control password bloquear" name="user_password2" id="repetir-password" required>
                  <div id="resultado-password-contenedor" style ="display:none">
                  <span id="resultado-password">Este campo es obligatorio.</span> 
                  </div>
                </div>
              </div>
            </div> <!-- col -->
          </div>
          <!-- /.row -->
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id_login_l" id="id_login_l" value="">
            <input type="hidden" name="user" value="login_act">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" id="reg-user">Actualizar</button>
          </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="swal2-container swal2-center swal2-backdrop-show cortina" style="overflow-y: auto; display:none;" id="cortina-de-espera">
<div class="preloader"></div>
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="dist/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="dist/js/plugins.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables/dataTables.responsive.min.js"></script>
<script src="plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables/dataTables.buttons.min.js"></script>
<script src="plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables/buttons.html5.min.js"></script>
<script src="plugins/datatables/buttons.print.min.js"></script>
<script src="plugins/datatables/buttons.colVis.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Custom's -->
<script src="dist/js/custom/apps-control.js"></script>
<script src="dist/js/custom/form-control.js"></script>
<script src="dist/js/custom/login-control.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
   // $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  })
  function desplegar(v) {
    var id_login = v;
    datos = {
      id_user: id_login,
      user: "login",
    };
    $.ajax({
      data: datos,
      url: "usuario-modelo.php",
      type: "post",
      dataType: "json",
      success: function (data) {
        var resultado = data;
        $("#user_nombre_l").val(resultado.nombre);
        $("#user_nick_l").val(resultado.nickname);
        $("#id_login_l").val(resultado.id);
        $("#modal-login-lista").modal("show");
      },
    });
  }
</script>
</body>
</html>
