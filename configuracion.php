<?php $nivel = 2;

require_once '../funciones/configuracion.php';
require_once  SESIONES;

if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 5 || $_SESSION['nivel'] == 3) :

  require_once FUNCIONES;

  // Templates
  require_once HEADER;
  require_once BARRA;
  require_once NAVEGACION;
  // Modulo

  $config_id = 1;
  $stmt = $conn->prepare("SELECT * FROM siscpi_configuracion WHERE id=?");
  $stmt->bind_param("i", $config_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $datos = $result->fetch_assoc();
  $config = json_decode($datos['datos'], true);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="fa fa-user-plus"></i>
              Configuración General
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid cajon form-customizado" data-modelo="../modelos/configuracion-modelo.php" id="mat_nueva">

        <div class="card card-navy">
          <div class="card-header">

            <h3 class="card-title"><i class="fa fa-user"></i> Datos del usuario</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">


            <fieldset class="fiel-custom">
              <legend>Notas regulares</legend>
              <div class="row">

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P1: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nreg1" id="nreg1" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P2: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nreg2" id="nreg2" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P3: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nreg3" id="nreg3" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P4: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nreg4" id="nreg4" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

              </div>
            </fieldset>

            <br>

            <fieldset class="fiel-custom">
              <legend>Novedades</legend>
              <div class="row">

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P1: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nnov1" id="nnov1" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P2: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nnov2" id="nnov2" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P3: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nnov3" id="nnov3" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P4: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nnov4" id="nnov4" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

              </div>
            </fieldset>

            <br>

            <fieldset class="fiel-custom">
              <legend>Convivencia</legend>
              <div class="row">

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P1: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="ncon1" id="ncon1" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P2: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="ncon2" id="ncon2" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P3: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="ncon3" id="ncon3" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P4: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="ncon4" id="ncon4" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P5: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="ncon5" id="ncon5" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

              </div>
            </fieldset>

            <br>

            <fieldset class="fiel-custom">
              <legend>ICFES</legend>
              <div class="row">

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P1: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nicf1" id="nicf1" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P2: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nicf2" id="nicf2" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P3: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nicf3" id="nicf3" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P4: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nicf4" id="nicf4" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

              </div>
            </fieldset>

            <br>

            <fieldset class="fiel-custom">
              <legend>Boletines</legend>
              <div class="row">

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P1: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nbol1" id="nbol1" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P2: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nbol2" id="nbol2" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P3: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nbol3" id="nbol3" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P4: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nbol4" id="nbol4" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <label class="form-check-label">
                      <span>P5: &nbsp </span>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=0 name="nbol5" id="nbol5" data-tipo="solonumero">
                      </div>
                    </label>
                  </div>
                </div>

              </div>
            </fieldset>


          </div><!-- /.container-fluid -->
        </div>

        <div class="card-footer">
          <input type="hidden" name="cmd" id="cmd" value="configuracion">
          <input type="hidden" name="user-id" id="user-id" value="<?php echo $_SESSION['logid'] ?>">
          <button type="button" class="btn btn-success" id="btn-submit">Actualizar</button>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

  // Footer
  require_once FOOTER;

  ?>

  <script>
    const checkboxes = document.querySelectorAll(".form-check-input");
    checkboxes.forEach((checkbox) => {
      checkbox.onclick = (event) => {
        const checkboxValue = event.target.checked;
        if (checkboxValue) {
          checkbox.setAttribute("checked", "checked");
          event.target.value = 1;
        } else {
          checkbox.removeAttribute("checked");
          event.target.value = 0;
        }
      };
    })

    const consultaConfiguracion = async () => {

      try {

        let data = {
          'cmd': 'configuracion-consulta',
          'user_id': <?php echo $_SESSION['logid'] ?>
        };

        const response = await fetch('../modelos/configuracion-modelo.php', {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data),
        });

        const dataServer = await response.json();

        if (dataServer.respuesta === 'exito') {

          const datos = JSON.parse(dataServer.datos['datos'])

          Object.entries(datos).forEach(([key, val]) => {

            const crrVal = Number(val);
            input = document.querySelector(`#${key}`);

            if (crrVal > 0) {
              input.setAttribute('checked', true);
              input.value = crrVal;
            }


          })

        }

        if (dataServer.respuesta === 'error') {
          console.log('Errorazo');
        }

      } catch (error) {
        console.error(error);
      }

    }

    consultaConfiguracion()
  </script>

<?php

endif;

?>