<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <center>
            <h1>Eventos</h1>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Crear
                            Evento</button>

                        <div class="table-responsive">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Enlace</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($evento as $p) { ?>
                                    <tr>
                                        <td><?=$p->fecha_evento?></td>
                                        <td><?= $p->evento ?></td>
                                        <td><?= $p->imagen ?></td>
                                        <td><?= $p->enlace ?></td>
                                        <td>

                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#crear<?= $p->id ?>"><i class="icon-close"></i></button>
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

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/insertEvento" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Evento</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="datetime-local" name="fecha" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Portada:</label>
                            <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="enlace" class="form-control" placeholder="Enlace" required>
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

    <?php foreach ($evento as $p) { ?>

    <div class="modal fade" id="crear<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">


                    <div class="modal-body">

                        <h4>¿Estás seguro en eliminar este evento?</h4>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <a href="<?=base_url()?>Modulo/eliminarEvento/<?=$p->id?>" style="background-color: #36E1F9;" class="btn">Si</a>

                    </div>


            </div>

        </div>

    </div>


    <?php } ?>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind
                2022</span>
        </div>
    </footer>
    <!-- partial -->
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