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
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellido</th>
                                                    <th scope="col">Usuario</th>
                                                    <th scope="col">Binaria</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($binaria as $B) { ?>
                                                    <tr>
                                                        <td><?= $B->nombre ?></td>
                                                        <td><?= $B->apellido1 ?></td>
                                                        <td><?= $B->user ?></td>
                                                        <td>
                                                            <?php if ($B->activo == null) { ?>
                                                                No tiene comprado el robot
                                                            <?php } else { ?>
                                                                ya compró el robot
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($B->activo == 1) { ?>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cancelar<?= $B->id ?>">Activar</button>
                                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#activo<?= $B->id ?>">Comprar</button>
                                                            <?php } ?>

                                                        </td>
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
            </div>
        </div>
    </div>
    <?php foreach ($binaria as $B) { ?>

        <!-- Modal cancelar -->

        <div class="modal fade" id="cancelar<?= $B->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="<?= base_url() ?>Ultra/activar" method="post" enctype="multipart/form-data">

                        <div class="modal-header">

                            <h1 class="modal-title fs-5" id="exampleModalLabel">Activacion de servicio</h1>

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                        </div>

                        <div class="modal-body">

                            <p>¿Esta seguro que quiere activar el servicio a <?= $B->nombre ?> <?= $B->apellido1 ?></p>
                            <input type="hidden" class="form-control" name="id" value="<?= $B->id ?>">

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                            <button type="submit" style="background-color: #36E1F9;" class="btn ">Activar</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="modal fade" id="activo<?= $B->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="<?= base_url() ?>Binaria/comprarBinaria/<?= $B->token ?>" method="post" enctype="multipart/form-data">

                        <div class="modal-header">

                            <h1 class="modal-title fs-5" id="exampleModalLabel">Compra de servicio</h1>

                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                        </div>

                        <div class="modal-body">

                            <p>¿Esta seguro que quiere comprar el servicio a <?= $B->nombre ?> <?= $B->apellido1 ?></p>
                            <select aria-label="Default select example" style="width:450px" class="text-center" id="robot" name="robot" required>
                                <option selected>Selecciona Valor</option>
                                <?php foreach ($servicio as $s) { ?>
                                    <option value="<?= $s->id ?>"><?= $s->descripcion ?> $<?= $s->precio ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                            <button type="submit" style="background-color: #36E1F9;" class="btn ">Activar</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    <?php } ?>
    <!-- FIN PARTIAL -->