<!-- partial -->
<!-- partial -->
<?php if ($perfil->img_selfie == (null) || $perfil->img_cedula_back == (null) || $perfil->img_cedula_front == (null) || $perfil->fecha_nacimiento == (null)) { ?>
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

                        <?php if ($disponibilidad != false) { ?>

                        <h3 style="color: red;">Tienes campo fecha de nacimiento vacio en tu perfil <a
                                href="<?=base_url()?>Perfil">Ir al
                                perfil</a></h3>
                        <br>

                        <?php } ?>
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
            <br>
            <div class="d-flex justify-content-between">
                <div>
                    <select class="form-control" id="categoria">
                        <option value="">Elegir categoria...</option>
                        <?php foreach ($categoria as $c) { ?>
                        <option value="<?=$c->id?>"><?=$c->categoria?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <?php if ($membresia != false) { ?>
                    <a class="btn btn-dark" href="<?=base_url()?>Cursos/Administracion">Administrar mis Cursos</a>
                    <?php } else { ?>
                    <a class="btn btn-dark" href="<?=base_url()?>Cursos/membresia">Quiero crear mi curso</a>
                    <?php } ?>
                </div>
            </div>
            <br> <br>

            <div class="card-columns">

                <?php foreach ($cursos as $m ) { ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?=$m->titulo?></h4>
                        <p class="card-text"> <?=$m->descripcion?> </p>
                        <img src="<?=base_url()?>cursos/imagen/<?=$m->imagen?>"
                            srcset="<?= base_url() ?>cursos/imagen/<?=$m->imagen?> 500w, <?= base_url() ?>cursos/imagen/<?=$m->imagen?> 840w"
                            sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" style="max-width: 100%;"
                            alt="Imagen post">
                        <br><br>
                        <p>Con este enlace puedes vender este curso: <a href="<?=base_url()?>"><?=base_url()?></a></p>
                        <center><br><br><a class="btn btn-dark""
                                href=" #">Comprar curso</a></center>
                    </div>
                </div>

                <?php  } ?>

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

<script>
$(document).ready(function() {

    var base_url = "<?= base_url() ?>";

    $('#categoria').on('change',function() {
        var id = $(this).val();

        window.location.href = base_url + "Cursos/index/" + id;

    })

});
</script>

</body>

</html>