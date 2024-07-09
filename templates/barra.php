<body class="sidebar-mini layout-navbar-fixed layout-fixed layout-footer-fixed text-sm sidebar-collapse" style="height: auto;" cz-shortcut-listen="true">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="usuario-actualizar2.php?id=<?php echo $_SESSION['id'];?>" class="nav-link">Mis datos</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="login.php?cerrar_sesion=true" class="nav-link">Cerrar Sesión</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php?cerrar_sesion=true" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->