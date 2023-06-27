<link rel="stylesheet" href="<?= base_url() ?>ticket/css/card.css">

<div class="main-panel">
    <div class="content-wrapper">
        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>
        <?php if ($detalle == false || $detalle[0]->estado != 'terminado' ) { ?>
        <a class="btn btn-success" href="<?=base_url()?>Ticket/nuevoDetalle/<?= $id ?>">Responder</a>
        <?php }else{ ?>
        <div class="alert alert-warning" role="alert"> Este ticket ha dado por terminado. </div>
        <?php } ?>
        <?php if ($detalle != false) { ?>
        <?php foreach ($detalle as $d) { ?>
        <div class="ticket-reply markdown-content staff">
            <div class="date">
                <?=$d->fecha?>
            </div>
            <div class="user">
                <i class="icon-user"></i>
                <span class="name">
                    <?php if ($d->tipo == 'emisor') {  ?>
                    <?=$d->user?>
                    <span class="label requestor-type-operator">
                        <strong>Usuario</strong>
                    </span>
                    <?php } else { ?>
                    <?=$d->user2?>
                    <span class="label requestor-type-operator">
                        <strong>Empresa</strong>
                    </span>
                    <?php } ?>
                </span>
                <span class="type">
                    <br>
                </span>
            </div>
            <div class="message">

                <p><?=$d->mensaje?></p>
                <?php if ($d->adjunto != null) { ?>
                <div class="attachments">
                    <strong>Adjuntos</strong>
                    <ul>
                        <li>
                            <i class="far fa-file"></i>
                            <a href="<?=base_url()?>ticket/video/<?=$d->adjunto?>">
                                <?=$d->adjunto?>
                            </a>
                        </li>
                    </ul>
                </div>

                <?php } ?>
            </div>
            <br><br>
        </div>
        <?php } ?>

        <?php } ?>



        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind
                    2022</span>
            </div>
        </footer>
    </div>

    <!-- partial -->

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
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