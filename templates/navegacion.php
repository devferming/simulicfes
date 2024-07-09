<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-olive elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link navbar-success text-lg">
    <img src="dist/img/cpi_logo.png" alt="Sistema CPI Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIMULICFES</span>
  </a>
  <?php include_once 'funciones/enigma.php'; ?>
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
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=97" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pre Jardín</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=98" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jardín</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=99" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Transición</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=1" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Primero</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=2" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Segundo</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=3" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tercero</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=4" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cuarto</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=5" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Quinto</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=6" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Sexto</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=7" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Séptimo</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=8" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Octavo</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=9" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Noveno</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=10" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Décimo</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="matricula-lista.php?grado=11" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Undécimo</p>
                    </a>
                  </li>
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
                      <a href="prueba461834.php" class="nav-link" target="_blank">
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
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Primero</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=1" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=1" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Segundo</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=2" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=2" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Tercero</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=3" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=3" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Cuarto</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=4" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=4" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Quinto</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=5" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=5" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Sexto</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=6" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=6" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Séptimo</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=7" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=7" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Octavo</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=8" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=8" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Noveno</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=9" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=9" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Décimo</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=10" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=10" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Undécimo</p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="preifces-param.php?grado=11" class="nav-link">
                      <i class="far fas fa-plus nav-icon"></i>
                      <p>Cargar Prueba</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="preifces-lista.php?grado=11" class="nav-link">
                      <i class="far fas fa-th-list nav-icon"></i>
                      <p>Pruebas Cargadas</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
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
              <?php if ($_SESSION['users_1ro'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=1" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Primero</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_2do'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=2" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Segundo</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_3ro'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=3" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Tercero</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_4to'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=4" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Cuarto</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_5to'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=5" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Quinto</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_6to'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=6" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Sexto</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_7mo'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=7" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Séptimo</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_8vo'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=8" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Octavo</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_9no'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=9" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Noveno</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_10mo'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=10" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Décimo</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['users_11mo'] == 'SI') : ?>
                <li class="nav-item">
                  <a href="preifces-lista3.php?grado=11" class="nav-link">
                    <i class="far fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Undécimo</p>
                  </a>
                </li>
              <?php endif; ?>
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