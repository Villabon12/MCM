<!-- partial -->
<?php if ($perfil->img_selfie == (null) || $perfil->img_cedula_back == (null) || $perfil->img_cedula_front == (null)) { ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="col-lg-12">

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

    <?php } else { ?>
    <div class="main-panel">

        <div class="content-wrapper">
            <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>
            <br>

            <?php } ?>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$modulo[0]->titulo1?></h4>
                        <div class="mt-4">
                            <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                                <?php foreach ($modulo as $m) { ?>
                                <div class="card">
                                    <div class="card-header" role="tab" id="heading-4">
                                        <h6 class="mb-0">
                                            <a data-bs-toggle="collapse" href="#collapse-<?=$m->id?>"
                                                aria-expanded="false" aria-controls="collapse-4"> <?=$m->titulo?>
                                            </a>
                                        </h6>
                                    </div>

                                    <div id="collapse-<?=$m->id?>" class="collapse" role="tabpanel"
                                        aria-labelledby="heading-4" data-bs-parent="#accordion-2">
                                        <div class="card-body"> <?=$m->descripcion?> <br> <a class="btn btn-dark"
                                                href="<?=base_url()?>Modulo/Videos/<?=$m->id?>">Ver video</a></div>
                                    </div>

                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>


        <!-- Modal Ends -->

        <!-- FIN PARTIAL -->

        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect
                    Mind 2022</span>
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

<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

</html>