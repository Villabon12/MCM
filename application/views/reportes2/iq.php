<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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
                        <center>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay">
                                Adquirir Servicio Señales Binarias VIP
                            </button><br><br>
                        </center>

                        <!-- Modal -->
                        <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php foreach ($paquetes as $p) { ?>
                                                <div class="col-4">
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <form
                                                                action="<?= base_url() ?>Reportes2/PayServicio/<?= $p->precio ?>">
                                                                <h5 class="card-title">
                                                                    <?= $p->nombre ?>
                                                                </h5>
                                                                <p class="card-text">$
                                                                    <?= $p->precio ?> M/o
                                                                </p>
                                                                <button type="submit"
                                                                    class="btn btn-primary">comprar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($info == null || $info->estado == 0) { ?>


                        <?php } else { ?>
                            <?php if ($info->estado == 1 && $info->fechaVen >= $fechaActual) { ?>
                                <center>
                                    <h3>Servicio Activo hasta la fecha
                                        <?= $info->fechaVen ?>
                                    </h3><br>
                                </center>
                            <?php } else if ($info->estado == 1 && $info->fechaVen <= $fechaActual) { ?>
                                    <center>
                                        <h3>Servicio caducado la fecha
                                        <?= $info->fechaVen ?>
                                        </h3><br><br><br>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay">
                                            Adquirir Servicio Señales Binarias VIP
                                        </button>
                                    </center>

                            <?php } ?>
                        <?php } ?>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent"
                            style="padding: 0; margin-bottom: 20px;">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">

                                <ul class="navbar-nav">

                                    <li class="nav-item">

                                        <a class="nav-link" href="<?= base_url() ?>Binarias_historial"
                                            style="font-size: 20px;">Historial</a>

                                    </li>

                                    <li class="nav-item active">

                                        <a class="nav-link" href="<?= base_url() ?>Binarias_iq"
                                            style="font-size: 20px;">IQ</a>

                                    </li>

                                </ul>

                            </div>

                        </nav>

                        <div class="row">
                            <div class="col-3">
                                <center style="margin-bottom: 20px; margin-top: 15px;">
                                    <div class="text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only" style="color:black">Cargando...</span>
                                        </div>
                                    </div>
                                </center>

                                <?php if ($info == null || $info->estado == 0) { ?>
                                    <div id="registros-container"></div>
                                <?php } else { ?>
                                    <?php if ($info->estado == 1 && $info->fechaVen >= $fechaActual) { ?>
                                        <div id="registros-container2"></div>
                                    <?php } else if ($info->estado == 1 && $info->fechaVen <= $fechaActual) { ?>
                                            <div id="registros-container"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-9">
                                <iframe src="https://iqoption.com/es" style="width: 100%; height: 600px;"></iframe>
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


<!-- End plugin js for this page -->



<!-- Custom js for this page -->

<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>

<script src="<?= base_url() ?>admin_temp/js/popover.js"></script>

<!-- End custom js for this page -->

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>







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

            url: '/Reportes2/getNuevosRegistrosIq', // URL del controlador que se encarga de cargar los nuevos registros

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

<script>

    function actualizarRegistros2() {

        $.ajax({
            url: '/Reportes2/getNuevosRegistrosIq2', // URL del controlador que se encarga de cargar los nuevos registros
            method: 'GET',
            success: function (data) {
                $('#registros-container2').html(data); // Actualiza el contenido del contenedor con los nuevos registros
            },
            complete: function () {
                setTimeout(actualizarRegistros, 5000); // Vuelve a llamar a la función cada 5 segundos para actualizar los registros
            }
        });
    }

    $(document).ready(function () {
        actualizarRegistros2();
    });
</script>


</body>



</html>