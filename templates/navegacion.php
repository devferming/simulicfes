<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-olive elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link navbar-success text-lg">
    <img src="dist/img/cpi_logo.png" alt="Sistema CPI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIMULICFES</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!--<div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>-->
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>
        <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
          <!-- Modulo de Matrículas -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Gestión Matrícula
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="matricula-grados.php" class="nav-link">
                  <i class="fa-solid fa-list-ol nav-icon"></i>
                  <p>Grados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="matricula-nueva.php" class="nav-link">
                  <i class="far fas fa-user-plus nav-icon"></i>
                  <p>Matricular</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fas fa-users nav-icon"></i>
                  <p>Matriculados
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <?php

                  try {
                    $stmt = $conn->prepare("SELECT * FROM grados");
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                  } catch (\Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($datos_grado = $resultado->fetch_assoc()) { ?>
                    <li class="nav-item">
                      <a href="matricula-lista.php?grado=<?php echo $datos_grado['gdo_id'] ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo $datos_grado['gdo_des_grado'] ?></p>
                      </a>
                    </li>
                  <?php } ?>

                </ul>
              </li>
              <?php if ($_SESSION['id'] == 1) : ?>
                <li class="nav-item">
                  <a href="pages/charts/flot.html" class="nav-link">
                    <i class="far fas fa-users nav-icon"></i>
                    <p>Accesos
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="accesos.php" class="nav-link" target="_blank">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Crea</p>
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
            </ul>
          </li><!-- / Modulo de Matrículas -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) : ?>
          <!-- Modulo Simulacros Coordinador -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Simulacro ICFES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <?php

            try {
              $stmt = $conn->prepare("SELECT * FROM grados");
              $stmt->execute();
              $resultado = $stmt->get_result();
            } catch (\Exception $e) {
              $error = $e->getMessage();
              echo $error;
            }

            while ($datos_grado = $resultado->fetch_assoc()) { ?>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p><?php echo $datos_grado['gdo_des_grado'] ?></p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="preifces-param.php?grado=<?php echo $datos_grado['gdo_id'] ?>" class="nav-link">
                        <i class="far fas fa-plus nav-icon"></i>
                        <p>Cargar Prueba</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="preifces-lista.php?grado=<?php echo $datos_grado['gdo_id'] ?>" class="nav-link">
                        <i class="far fas fa-th-list nav-icon"></i>
                        <p>Pruebas Cargadas</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            <?php } ?>

          </li><!-- / Modulo Simulacros Coordinador -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] == 3) : ?>
          <!-- Modulo Simulacros Docentes -->
          <li class="nav-item has-treeview">
            
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Simulacro ICFES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <?php

              try {
                $stmt = $conn->prepare("SELECT * FROM grados");
                $stmt->execute();
                $resultado = $stmt->get_result();
              } catch (\Exception $e) {
                $error = $e->getMessage();
                echo $error;
              }

              while ($datos_grado = $resultado->fetch_assoc()) {
                $gcode = $datos_grado['gdo_id'];
                $gdes = $datos_grado['gdo_des_grado'];

                if (in_array($gdes, $_SESSION['users_grados'])) { ?>
                  <li class="nav-item">
                    <a href="preifces-lista3.php?grado=<?php echo $gcode ?>" class="nav-link">
                      <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                      <p><?php echo $gdes ?></p>
                    </a>
                  </li>
                <?php } ?>
              <?php } ?>

            </ul>

          </li><!-- / Modulo Simulacros Docentess -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] == 4 && $_SESSION['alum_grado'] !== 97 && $_SESSION['alum_grado'] !== 98 && $_SESSION['alum_grado'] !== 99) : ?>
          <!-- Modulo Simulacros Estudiantes -->
          <li class="nav-item has-treeview">
            <a href="preifces-lista2.php?grado=<?php echo $_SESSION['alum_grado']; ?>" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Simulacro ICFES
              </p>
            </a>
          </li><!-- / Modulo Simulacros Estudiantes -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] == 1) : ?>
          <!-- Modulo de usuarios -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="usuario-nuevo.php" class="nav-link">
                  <i class="far fas fa-user-plus nav-icon"></i>
                  <p>Registrar Usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="usuario-lista.php" class="nav-link">
                  <i class="far fas fa-user-check nav-icon"></i>
                  <p>Usuarios registrados</p>
                </a>
              </li>
            </ul>
          </li><!-- / Modulo de usuarios -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] == 4) : ?>
          <!-- Modulo de gestión de datos personales estudiantes -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Mis Datos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--
            <li class="nav-item">
              <a href="usuario-actualizar2.php?id=<?php echo $_SESSION['id']; ?>" class="nav-link">
                <i class="far fas fa-folder-open nav-icon"></i>
                <p>Datos Institucionales</p>
              </a>
            </li>
              -->
              <li class="nav-item">
                <a href="#" class="dropdown-item logins_form nav-link" id_log="<?php echo $_SESSION['id']; ?>" onclick="desplegar(<?php echo $_SESSION['id']; ?>);">
                  <i class="far fas fa-lock nav-icon"></i>
                  <p>Datos de acceso</p>
                </a>
              </li>
            </ul>
          </li><!-- / Modulo de gestión de datos personales -->
        <?php endif; ?>

        <?php if ($_SESSION['nivel'] !== 4) : ?>
          <!-- Modulo de gestión de datos personales -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Mis Datos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="usuario-actualizar2.php?id=<?php echo $_SESSION['id']; ?>" class="nav-link">
                  <i class="far fas fa-folder-open nav-icon"></i>
                  <p>Datos Institucionales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="dropdown-item logins_form nav-link" id_log="<?php echo $_SESSION['id']; ?>" onclick="desplegar(<?php echo $_SESSION['id']; ?>);">
                  <i class="far fas fa-lock nav-icon"></i>
                  <p>Datos de acceso</p>
                </a>
              </li>
            </ul>
          </li><!-- / Modulo de gestión de datos personales -->
        <?php endif; ?>

        <!-- Cerrar Sesión -->
        <li class="nav-item has-treeview">
          <a href="login.php?cerrar_sesion=true" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Cerrar Sesión
            </p>
          </a>
        </li><!-- / Cerrar Sesión -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>