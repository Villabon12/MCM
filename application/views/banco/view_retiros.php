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
                                <form action="<?= base_url() ?>Banco/realizarRetiroInversion" id="retiroCuenta" method="post" enctype="multipart/form-data">

                                    <h1 class="text-center">Billetera de Binaria a Wallet principal</h1>
                                    <center>
                                        <p>Transferencia</p>

                                        <div class="form-group row mb-3">
                                            <label for=>Inversiones a retirar</label><br><br>
                                            <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <?php if ($inversion == null) { ?>
                                                <p style="color: red;">Saldo a favor: 0</p>

                                            <?php } else { ?>
                                                <p style="color: red;">Saldo a favor: <?= $inversion->inversion ?></p>

                                            <?php } ?>
                                        </div>
                                        <!-- <div class="form-group row mb-3">
                                            <button type="button" class="btn btn-dark" id="button" value="1">Codigo seguridad</button>
                                        </div>
                                        <div class="form-group row mb-3" id="add">

                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for=>Codigo de seguridad</label><br><br>
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                        </div> -->


                                        <button type="button" data-bs-toggle="modal" data-bs-target="#retiroInversion" class="btn btn-success" name="servicio">Retiro</button>
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
                                <form action="<?= base_url() ?>Banco/realizarRetiroComision" id="retiroComision" method="post" enctype="multipart/form-data">

                                    <h1 class="text-center">Billetera de Equipo a Wallet principal</h1>
                                    <center>
                                        <p>Transferencia</p>

                                        <div class="form-group row mb-3">
                                            <label for=>Valor a retirar</label><br><br>
                                            <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <p style="color: red;">Saldo a favor: <?=$billetera->cuenta_comision?></p>
                                        </div>
                                        <!-- <div class="form-group row mb-3">
                                            <button type="button" class="btn btn-dark" id="button2" value="1">Codigo seguridad</button>
                                        </div>
                                        <div class="form-group row mb-3" id="add1">

                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for=>Codigo de seguridad</label><br><br>
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                        </div> -->


                                        <button type="button" data-bs-toggle="modal" data-bs-target="#retiroEquipo" class="btn btn-success" name="servicio">Retiro</button>
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
                                <form action="<?= base_url() ?>Banco/realizarRetiroWallet" id="retiroPrincipal" method="post" enctype="multipart/form-data">

                                    <h1 class="text-center">Retiro de tu wallet principal</h1>
                                    <center>
                                        <p>Retiro de tu wallet principal</p>
                                        <div class="form-group row mb-3">
                                            <label for=>Wallet de tu billetera (USDT TRC 20)</label><br><br>
                                            <input type="text" class="form-control" name="wallet" placeholder="Billetera (USDT TRC 20)" required>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label for=>Valor a retirar</label><br><br>
                                            <input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <p style="color: red;">Saldo a favor: <?=$billetera->cuenta_compra?></p>
                                        </div>
                                        <!-- <div class="form-group row mb-3">
                                            <button type="button" class="btn btn-dark" id="button3" value="1">Codigo seguridad</button>
                                        </div>
                                        <div class="form-group row mb-3" id="add2">

                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for=>Codigo de seguridad</label><br><br>
                                            <input type="text" class="form-control" name="codigo" placeholder="Codigo" required>
                                        </div> -->



                                        <button type="button" data-bs-toggle="modal" data-bs-target="#retiroWallet" class="btn btn-success" name="servicio">Retiro</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="retiroInversion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                    </div>

                    <div class="modal-body">
                        <p>Estas apunto de retirar de tu billetera de Binaria, Recuerda que te descuentan el <?= ($binaria->valor) * 100 ?> % </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="retiroCuenta">Aceptar </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="retiroEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                    </div>

                    <div class="modal-body">
                        <p>Estas apunto de retirar de tu billetera de Comisiones, Recuerda que te descuentan el <?= ($equipo->valor) * 100 ?> % </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="retiroComision">Aceptar </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="retiroWallet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                    </div>

                    <div class="modal-body">
                        <p>Estas apunto de retirar de tu billetera Principal, Recuerda que contamos con el tiempo del broker</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="retiroPrincipal">Aceptar </button>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>


    <!-- FIN PARTIAL -->