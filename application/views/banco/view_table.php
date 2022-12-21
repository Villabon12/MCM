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
                                                    <th scope="col">Usuario</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Hash</th>
                                                    <th scope="col">Comprobante</th>
                                                    <th scope="col">Activacion</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($consigna as $B) { ?>

                                                    <tr>
                                                        <td><?= $B->fecha ?></td>
                                                        <td><?= $B->nombre ?> <?= $B->apellido1 ?></td>
                                                        <td><?= $B->user ?></td>
                                                        <td>$ <?= number_format($B->valor_inversion, 2) ?></td>
                                                        <td><?= $B->hash ?></td>
                                                        <td><a href="<?= base_url() ?>/assets/img/fotosPerfil/<?= $B->imagen ?>" target="_blank"><?= $B->imagen ?></a></td>
                                                        <td>
                                                            <?php if ($B->validar == 0) { ?>
                                                                Espera Aprobacion
                                                            <?php } else { ?>
                                                                Consignado
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($B->validar == 0) { ?>
                                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activacion<?= $B->datoosss ?>">Consignar</button>
                                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelar<?= $B->datoosss ?>">Cancelar</button>

                                                            <?php } else { ?>
                                                                <?= $B->motivo ?>
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
    <!-- FIN PARTIAL -->

    <?php foreach ($consigna as $B) { ?>
        <!-- Modal cancelar -->

        <div class="modal fade" id="cancelar<?= $B->datoosss ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="<?= base_url() ?>Banco/cancelarConsigna/<?= $B->datoosss ?>" method="post" enctype="multipart/form-data">

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

        <!-- Modal Consignar -->

        <div class="modal fade" id="activacion<?= $B->datoosss ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">


                        <div class="modal-header">

                            <h1 class="modal-title fs-5" id="exampleModalLabel">Activacion</h1>

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                        </div>

                        <div class="modal-body">

                            <p>¿Está seguro en consignarle a <?= $B->nombre ?> <?= $B->apellido1 ?>?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="<?= base_url() ?>Banco/aprobacionWallet/<?= $B->datoosss ?>" class="btn btn-primary">Consignar</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>


    <?php } ?>