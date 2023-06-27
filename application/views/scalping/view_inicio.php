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



    <?php if ($activo == 0) { ?>
    <div class="main-panel">
        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <div class="content-wrapper">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="<?= base_url() ?>Scalping/comprarScalping/<?= $perfil->token ?>"
                                    method="post">
                                    <h1 class="text-center">Robot Scalping</h1>
                                    <center>
                                        <p>Adquiere el servicio por una pequeña compra</p>
                                        <select aria-label="Default select example" style="width:450px"
                                            class="text-center" id="robot" name="robot" required>
                                            <option selected>Selecciona Valor</option>
                                            <?php foreach ($servicio as $s) { ?>
                                            <option value="<?= $s->id ?>"><?= $s->descripcion ?> $<?= $s->precio ?>
                                            </option>
                                            <?php } ?>
                                        </select>

                                        <button type="submit" class="btn btn-success" name="servicio">comprar</button>

                                        <p style="color: red;">Saldo disponible en tu billetera:
                                            <?= $billetera->cuenta_compra ?></p>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <style>
        .tamaño {
            position: relative;
            width: 40%;
            padding-right: 10px;
            padding-left: 10px;
        }

        .tamaño2 {
            position: relative;
            width: 100%;
            padding-right: 10px;
            padding-left: 10px;
        }
        </style>
        <div class="main-panel">
            <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

            <?php } ?>
            <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

            <?php } ?>

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="col-md-12">
                                    <center>
                                        <h4>Paso N1</h4>
                                        <p>Ingresa al siguiente enlace y sigue el paso a paso del video. --> <a
                                                href="https://one.exness-track.com/a/6yh5nc9y4h" target="_blank"
                                                rel="noopener noreferrer">PASO N1</a></p>
                                        <div
                                            style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">
                                            <video style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                                controls>
                                                <source src="<?=base_url()?>videos/PASO1.mp4" type="video/mp4">
                                                Tu navegador no soporta la etiqueta de video.
                                            </video>
                                        </div>
                                        <br><br>
                                        <h4>Paso N2</h4>
                                        <p>Ingresa al siguiente enlace y sigue el paso a paso del video. --> <a
                                                href="https://social-trading.exness.com/strategy/11864697" target="_blank"
                                                rel="noopener noreferrer">PASO N2</a></p>
                                        <div
                                            style="position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;">
                                            <video style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                                controls>
                                                <source src="<?=base_url()?>videos/PASO2.mp4" type="video/mp4">
                                                Tu navegador no soporta la etiqueta de video.
                                            </video>
                                        </div>

                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
            <?php } ?>

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect
                        Mind
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