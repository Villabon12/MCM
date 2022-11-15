<!-- partial -->
<?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="col-lg-12">

        <div class="card">

          <div class="card-body">

            <center>

              <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>

              <h1>Espera un momento</h1>

              <h2>Valida tus datos primero</h2>

              <a href="<?= base_url() ?>Perfil" type="button" class="btn btn-success  ">validar</a>

            </center>

          </div>

        </div>

      </div>
    </div>

  <?php } else { ?>
    <div class="main-panel">

      <div class="content-wrapper">
        <?php if ($this->session->flashdata("exito")) { ?>

          <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <br>

        <div class="row">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="cc-icon align-self-center"><img src="<?= base_url() ?>images/myconnect/usdt.png" alt=""></div>
                <div class="m-l-10 align-self-center">
                  <h4 class="m-b-0 amar">Billetera Principal</h4>
                  <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_compra, 2) ?></h5>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                <div class="m-l-10 align-self-center">
                  <h4 class="m-b-0 amar">Billetera Comisiones</h4>
                  <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_comision, 2) ?></h5>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                <div class="m-l-10 align-self-center">
                  <h4 class="m-b-0 amar">Billetera Binaria</h4>
                  <h5 class="text-muted m-b-0 blan">$<?= number_format($total->total, 2) ?></h5>
                </div>

              </div>
            </div>
          </div>
          <?php if ($perfil->id == 6) { ?>
            <div class="main-panel">
              <div class="container">
                <h1>EN CASO DE SEGURIDAD, OPRIMIR EL BOTON ROJO</h1>
                <?php if ($validar->valor == 0) { ?>
                  <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderRobot/<?= $validar->id ?>">ENCENDER</a>
                <?php } else { ?>
                  <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarRobot/<?= $validar->id ?>">APAGAR</a>

                <?php } ?>

              </div>
        
              <div class="content-wrapper">

                <div class="row">
                  <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="cc-icon align-self-center"><img src="<?= base_url() ?>images/myconnect/usdt.png" alt=""></div>
                        <div class="m-l-10 align-self-center">
                          <h4 class="m-b-0 amar">Billetera Brokers Total</h4>
                          <h5 class="text-muted m-b-0 blan">$<?= number_format($empresa->cuenta_inversion, 2) ?></h5>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                        <div class="m-l-10 align-self-center">
                          <h4 class="m-b-0 amar">Billetera Inversion</h4>
                          <h5 class="text-muted m-b-0 blan">$<?= number_format($total1->total, 2) ?></h5>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                        <div class="m-l-10 align-self-center">
                          <h4 class="m-b-0 amar">Billetera Socio</h4>
                          <h5 class="text-muted m-b-0 blan">$<?= number_format(($empresa->cuenta_inversion - $total1->total), 2) ?></h5>
                        </div>

                      </div>
                    </div>
                  </div>

                </div>

              </div>
            <?php } ?>

            </div>
        </div>
      <?php } ?>



      <!-- FIN PARTIAL -->