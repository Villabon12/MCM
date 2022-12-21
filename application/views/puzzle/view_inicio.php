<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Crear Puzzle</button>

                    <div class="table-responsive">

                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col"># Ficha</th>
                                    <th scope="col">Creacion</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($puzzle as $p) { ?>
                                    <tr>
                                        <td><?= $p->codigo ?></td>
                                        <td><?= $p->tipo ?></td>
                                        <td><?= $p->valor ?></td>
                                        <td><?= $p->n_ficha ?></td>
                                        <td><?php if ($p->creacion == 1) { ?>
                                                Ya hecho
                                            <?php } else { ?>
                                                No se ha mandado a hacer
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($p->creacion == 1) { ?>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $p->id ?>"><i class="icon-magnifier"></i></button>

                                            <?php } else { ?>
                                                <a class="btn btn-success" href="<?= base_url() ?>Puzzle/cambiar/<?= $p->id ?>">Fabricado</a>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $p->id ?>"><i class="icon-magnifier"></i></button>

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
    
    <div class="content-wrapper">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col"># Ficha</th>
                                    <th scope="col">Creacion</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($puzzle as $p) { ?>
                                    <tr>
                                        <td><?= $p->codigo ?></td>
                                        <td><?= $p->tipo ?></td>
                                        <td><?= $p->valor ?></td>
                                        <td><?= $p->n_ficha ?></td>
                                        <td><?php if ($p->creacion == 1) { ?>
                                                Ya hecho
                                            <?php } else { ?>
                                                No se ha mandado a hacer
                                            <?php } ?>
                                        </td>
                                        <td><?php if ($p->creacion == 1) { ?>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $p->id ?>"><i class="icon-magnifier"></i></button>

                                            <?php } else { ?>
                                                <a class="btn btn-success" href="<?= base_url() ?>Puzzle/cambiar/<?= $p->id ?>">Fabricado</a>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $p->id ?>"><i class="icon-magnifier"></i></button>

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

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Puzzle/crearPuzzle" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Puzzle</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="hidden" name="tipo" class="form-control" value="1">

                            <div class="container">
                                <select aria-label="Default select example" class="form-control" id="" name="rompecabeza" required>
                                    <option selected>Escoger rompecabeza</option>
                                    <?php foreach ($tipo as $s) { ?>
                                        <option value="<?= $s->id ?>"><?= $s->nombre ?> - <?= $s->fichas ?> fichas</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <br>

                            <div class="container">
                                <input type="number" name="cantidad" class="form-control" placeholder="cantidad">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <button type="submit" style="background-color: #36E1F9;" class="btn">Crear</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <?php foreach ($puzzle as $p) { ?>
        <div class="modal fade" id="view<?= $p->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <img src="<?= base_url() ?><?= $p->code_qr ?>" alt="">

                </div>
            </div>
        </div>
    <?php } ?>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind 2022</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->

<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>admin_temp/js/off-canvas.js"></script>
<script src="<?= base_url() ?>admin_temp/js/misc.js"></script>
<script src="<?= base_url() ?>admin_temp/js/settings.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/clipboard/clipboard.min.js"></script>

<script src="<?= base_url() ?>admin_temp/js/dashboard.js"></script>
<!-- End custom js for this page -->

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<!-- End custom js for this page -->