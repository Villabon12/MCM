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
                                        <form action="<?= base_url() ?>Banco/transferenciaPersona/<?= $perfil->token ?>" method="post" enctype="multipart/form-data">

                                            <h1 class="text-center">Transferir de MCM a MCM</h1>
                                            <center>
                                                <p>Transferir</p>

                                                <div class="form-group row mb-3">
                                                    <label for=>Usuario a transferir</label><br><br>
                                                    <input type="text" class="form-control" name="usuario" id="user" placeholder="Usuario a transferir" required>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <button type="button" class="btn btn-dark" id="user2">Validar</button>
                                                </div>
                                                <div class="form-group row mb-3" id="add1">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Valor a transferir</label><br><br>
                                                    <input type="number" class="form-control" name="transferir" placeholder="valor a transferir" required>
                                                </div>


                                                <button type="submit" class="btn btn-success" name="servicio">Transferencia</button>
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
                                        <div class="table-responsive">

                                            <table class="table" id="order-listing">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Apellido</th>
                                                        <th scope="col">Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($historial as $B) { ?>

                                                        <tr>
                                                            <td><?= $B->fecha ?></td>
                                                            <td><?= $B->nombre ?> <?= $B->apellido ?></td>
                                                            <td><?= $B->nombre1 ?> <?= $B->apellido1 ?></td>
                                                            <td>$ <?= number_format($B->valor, 2) ?></td>
                                                            
                                                        </tr>

                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                </div>

                <!-- FIN PARTIAL -->