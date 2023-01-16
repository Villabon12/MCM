<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

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
                    <div class="card-body">
                        <label for="">Valor acumulado:</label>
                        <input type="text" class="form-control" value="<?=$acumulado->valor?>" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="<?= base_url() ?>Puzzle/retiroGastos/<?= $perfil->token ?>" method="post"
                                enctype="multipart/form-data">
                                <h1 class="text-center">Retiro de billetera Puzzle</h1>
                                <center>
                                    <p>Transferir</p>
                                    <div class="form-group row mb-3">
                                        <label for=>Valor a transferir</label><br><br>
                                        <input type="number" class="form-control" name="transferir"
                                            placeholder="valor a transferir" required>
                                    </div>
                                    <button type="submit" class="btn btn-success" name="servicio">Transferencia</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </div>



    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind
                2022</span>
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