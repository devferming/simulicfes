<?php
session_start();
$cerrar_sesion = $_GET['cerrar_sesion'];
if ($cerrar_sesion) {
  session_destroy();
}
include_once 'templates/header.php';
/*'microphone', 'camera', 'fullscreen', 'recording','videoquality', 'chat', 'hangup', 'raisehand'*/
?>
<body class="hold-transition login-page">
  <!--::::::::::::::::::::::::::::::::::::::-->
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/cpi_logo2.png" alt="Logo colegio" style="width: 100px; height: auto;">
      <span>SIMUL<b>ICFES</b></span>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">I.E Escuela Normal Superior de Ocaña</p>
        <form name="user_login" id="user_login" method="post" action="login-modelo.php">
          <div class="input-group mb-3">
            <input type="text" class="form-control letterandnumber minusculas" name="nickname" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control password" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="login-user" value="1">
              <button type="submit" class="btn btn-success btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!--::::::::::::::::::::::::::::::::::::::-->
  <?php
  include_once 'templates/footer.php';
  ?>