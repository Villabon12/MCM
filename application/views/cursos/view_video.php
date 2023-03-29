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
            <div class="row ">
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="col-lg-12">
                        <center>
                            <h2><?=$modulo->titulo?></h2>
                            <?php if ($modulo->pdf == null) { ?>

                            <?php } else { ?>

                            <a class="btn btn-dark" download="<?=$modulo->pdf?>"
                                href="<?= base_url() ?>modulo/documento/<?=$modulo->pdf?>">Descargar
                                Apoyo</a> <br> <br>
                            <?php } ?>

                        </center>

                        <div class="embed-responsive embed-responsive-16by9 container">
                            <iframe class="embed-responsive-item" src="<?=$modulo->video?>" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="col-12">
                        <?php foreach ($detalle as $m ) { ?>
                        <div class="card">
                            <div class="card-body">
                                <a href="<?=base_url()?>Modulo/Videos/<?=$m->id?>">
                                    <h4 class="card-title"><?=$m->titulo?></h4>
                                </a>
                            </div>
                        </div>

                        <?php  } ?>
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