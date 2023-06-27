<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
<div class="main-panel">

    <?php if ($perfil->img_perfil == (NULL)) {

        $perfil->img_perfil = "usuario.png";
    } else {

        $perfil->img_perfil = $perfil->img_perfil;
    } ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <div class="content-wrapper">
        <?php if ($this->session->flashdata("error")) { ?>

            <p>
                <?php echo $this->session->flashdata("error") ?>
            </p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p>
                <?php echo $this->session->flashdata("exito") ?>
            </p>

        <?php } ?>
        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-body">

                        <div class="text-center">
                            <h1>Señales Binarias</h1> <br>
                        </div>
                        <br>
                        <?php if ($info == null) { ?>
                            <!-- Button Señales Binarias modal -->
                            <center>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay">
                                    Adquirir Servicio Señales Binarias
                                </button>
                            </center>
                            <!-- Modal -->
                            <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= base_url() ?>Reportes2/PayServicio">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Adquire el servicio de señales binarias para poder acceder a las señales en
                                                tiempo real, pruebalo totalmente gratis por 15 días.
                                                Posteriormente el servicio tiene un costo de 20 USD mensuales.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Adquirir</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?php if ($diferencia < 15 & $info->estado == 0) { ?>
                                <center>
                                    <h2>
                                        Dia
                                        <?= $diferencia ?> de 15
                                    </h2><br>
                                </center>
                                <div id="registros-container"></div>
                            <?php } ?>
                            <?php if ($diferencia > 14 & $info->estado == 0) { ?>
                                <center>
                                    <h2>
                                        Dia
                                        <?= $diferencia ?> de 15
                                    </h2><br>
                                    <h2>
                                        Prueba Gratis Terminada
                                    </h2><br>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#payOf">
                                        Adquirir Servicio Señales Binarias
                                    </button>
                                </center>
                                <!-- Modal -->
                                <div class="modal fade" id="payOf" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= base_url() ?>Reportes2/PayServicioOF">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Adquire el servicio de señales binarias para poder acceder a las señales en
                                                    tiempo real,el servicio de señales binarias tiene un costo de 20 USD
                                                    mensuales.Solo por hoy 15 USD.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Pagar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($info->estado == 1) { ?>
                                <center>
                                    <h2>
                                        Servicio Activo hasta la fecha
                                        <?= $fecha_formateada ?>
                                    </h2><br>
                                </center>
                                <div id="registros-container"></div>
                            <?php } ?>
                        <?php } ?>
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
<script src="<?= base_url() ?>admin_temp/js/file-upload.js"></script>
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
<script src="<?= base_url() ?>admin_temp/js/popover.js"></script>
<!-- End custom js for this page -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


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
    function cambiar() {
        var pdrs = document.getElementById('file-upload').files[0].name;
        document.getElementById('info').innerHTML = pdrs;
    }
</script>

<script>
    $(document).ready(function () {
        var fecha = moment($('#fechaa').val(), "YYYY-MM-DD").format("YYYY-MM-DD");
        console.log(fecha);
        // Actualizamos el valor del input de tipo "date"
        document.getElementsByName("fecha_nacimiento")[0].value = fecha;
        var base_url = "<?= base_url() ?>";



    });
</script>

<script>
    function actualizarRegistros() {
        $.ajax({
            url: '/Reportes2/getNuevosRegistros', // URL del controlador que se encarga de cargar los nuevos registros
            method: 'GET',
            success: function (data) {
                $('#registros-container').html(data); // Actualiza el contenido del contenedor con los nuevos registros
            },
            complete: function () {
                setTimeout(actualizarRegistros, 5000); // Vuelve a llamar a la función cada 5 segundos para actualizar los registros
            }
        });
    }

    $(document).ready(function () {
        actualizarRegistros();
    });
</script>


</body>

</html>