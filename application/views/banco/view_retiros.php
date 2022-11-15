        <!-- partial -->

        <?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
            <div class="main-panel">
                <div class="content-wrapper">

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
                </div>
            </div>

        <?php } else { ?>


            <div class="main-panel">
                <?php if ($this->session->flashdata("error")) { ?>

                    <p><?php echo $this->session->flashdata("error") ?></p>

                <?php } ?>
                <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>

                <?php } ?>
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <form action="<?= base_url() ?>Banco/realizarRetiroInversion" method="post" enctype="multipart/form-data">

                                            <h1 class="text-center">Retiro de tu Inversion</h1>
                                            <center>
                                                <p>Retiro de tu Inversion</p>

                                                <div class="form-group row mb-3">
                                                    <label for=>Inversiones a retirar</label><br><br>
                                                    <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <button type="button" class="btn btn-dark" id="button" value="1">Codigo seguridad</button>
                                                </div>
                                                <div class="form-group row mb-3" id="add">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Codigo de seguridad</label><br><br>
                                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                                </div>


                                                <button type="submit" class="btn btn-success" name="servicio">Retiro</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <form action="<?= base_url() ?>Banco/realizarRetiroComision" method="post" enctype="multipart/form-data">

                                            <h1 class="text-center">Retiro de tu Comision</h1>
                                            <center>
                                                <p>Retiro de tu Comision</p>

                                                <div class="form-group row mb-3">
                                                    <label for=>Valor a retirar</label><br><br>
                                                    <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <button type="button" class="btn btn-dark" id="button2" value="1">Codigo seguridad</button>
                                                </div>
                                                <div class="form-group row mb-3" id="add1">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Codigo de seguridad</label><br><br>
                                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                                </div>


                                                <button type="submit" class="btn btn-success" name="servicio">Retiro</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-body">
                                    <div class="col-md-12">
                                        <form action="<?=base_url()?>Banco/realizarRetiroWallet" method="post" enctype="multipart/form-data">

                                            <h1 class="text-center">Retiro de tu wallet principal</h1>
                                            <center>
                                                <p>Retiro de tu wallet principal</p>
                                                <div class="form-group row mb-3">
                                                    <label for=>Wallet de tu billetera Binance (USDT TRC 20)</label><br><br>
                                                    <input type="text" class="form-control" name="wallet" placeholder="Billetera (binance)" required>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label for=>Valor a retirar</label><br><br>
                                                    <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <button type="button" class="btn btn-dark" id="button3" value="1">Codigo seguridad</button>
                                                </div>
                                                <div class="form-group row mb-3" id="add2">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Codigo de seguridad</label><br><br>
                                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                                </div>
                                                


                                                <button type="submit" class="btn btn-success" name="servicio">Retiro</button>
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