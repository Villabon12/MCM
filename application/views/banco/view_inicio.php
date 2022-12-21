        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>

                    <div class="col-lg 12">

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

                <?php } else { ?>
                    <?php if ($this->session->flashdata("error")) { ?>

                        <p><?php echo $this->session->flashdata("error") ?></p>

                    <?php } ?>
                    <?php if ($this->session->flashdata("exito")) { ?>

                        <p><?php echo $this->session->flashdata("exito") ?></p>

                    <?php } ?>
                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <form action="<?= base_url() ?>Banco/consignar/<?= $perfil->token ?>" method="post" enctype="multipart/form-data">

                                            <h1 class="text-center">Recarga de banco Wallet</h1>
                                            <center>
                                                <p>Recarga tu wallet principal</p>
                                                <label for="">Billetera (USDT TRC 20) Binance</label>
                                                <div class="card card-inverse-secondary">
                                                    <div class="card-body">
                                                        <p id="clipboardExample3">
                                                            TYfaVgc9CixZHSjFT45wPdMfL3LRXsjJ6V
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="button" class="btn btn-info btn-clipboard" data-clipboard-action="copy" data-clipboard-target="#clipboardExample3">Copiar billetera</button>
                                                </div>
                                                <div class="container mt-3">
                                                    <img src="<?=base_url()?>assets/img/qrLeo.jpg" width="50%">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=" sube un archivo">Comprobante (Pantallazo)</label><br><br>
                                                    <input type="file" class="form-control" aria-label="img" aria-describedby="basic-addon1" name="img" require>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Hash</label><br><br>
                                                    <input type="text" class="form-control" name="hash" placeholder="Hash" require><br>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Valor Recargado</label><br><br>
                                                    <input type="number" class="form-control" name="recarga" placeholder="Valor a Recargar" require><br>
                                                </div>

                                                <button type="submit" class="btn btn-success" name="servicio">Recargar</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <!-- FIN PARTIAL -->