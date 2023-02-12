        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <?php if ($this->session->flashdata("error")) { ?>

                    <p><?php echo $this->session->flashdata("error") ?></p>

                <?php } ?>
                <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>

                <?php } ?>


                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">

                                                <table class="table" id="order-listing">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Apellido</th>
                                                            <th scope="col">Usuario</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col">Wallet a consignar</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($retiros as $B) { ?>

                                                            <tr>
                                                                <td><?= $B->fecha ?></td>
                                                                <td><?= $B->nombre ?></td>
                                                                <td><?= $B->apellido1 ?></td>
                                                                <td><?= $B->user ?></td>
                                                                <td>$ <?= number_format($B->valor, 2) ?></td>
                                                                <td><?= $B->wallet_binance ?></td>
                                                                <td>
                                                                    <?php if ($B->aprobar == 0) { ?>
                                                                        <button data-bs-toggle="modal" data-bs-target="#pagar<?= $B->id ?>" class="btn btn-primary">Pago realizado</button>
                                                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelar<?= $B->id ?>">Cancelar</button>


                                                                    <?php } else { ?>
                                                                        <?= $B->motivos ?>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($retiros as $B) { ?>
                <!-- Modal cancelar -->

                <div class="modal fade" id="cancelar<?= $B->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <form action="<?= base_url() ?>Socios/cancelarRetiro/<?= $B->id ?>" method="post" enctype="multipart/form-data">

                                <div class="modal-header">

                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Motivo Cancelacion</h1>

                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                                </div>

                                <div class="modal-body">

                                    <div class="input-group mb-3">

                                        <input type="textarea" class="form-control" name="motivo">

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                    <button type="submit" style="background-color: #36E1F9;" class="btn ">Cancelar</button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
                <div class="modal fade" id="pagar<?= $B->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <form action="<?= base_url() ?>Socios/aprobarRetiros/<?= $B->id ?>" method="post" enctype="multipart/form-data">

                                <div class="modal-header">

                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comprobante</h1>

                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                                </div>

                                <div class="modal-body">

                                    <div class="input-group mb-3">

                                        <input type="file" class="form-control" aria-label="img" aria-describedby="basic-addon1" name="img" require>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                    <button type="submit" style="background-color: #36E1F9;" class="btn ">Pagar</button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            <?php } ?>



            <!-- FIN PARTIAL -->