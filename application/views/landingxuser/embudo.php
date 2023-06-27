<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">


<div class="main-panel">
    <!-- cdn icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

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
                        <a class="btn btn-primary" type="button" style="border-radius:20px; margin:3rem;"
                            href="<?= base_url() ?>LandingUser/sett/<?= $DaCamp->idPlant ?>/<?= $DaCamp->id ?>">
                            <i class="bi bi-backspace"></i> Plantilla principal
                        </a>

                        <div class="text-center">
                            <h1>Personaliza los embudos para tu landing Page</h1> <br>
                        </div>
                        <br>
                        <br>
                        <center>
                            <h3 style="font-family: 'Righteous', cursive;    color: black;">Crea un dia de
                                notificación! </h3>
                            <br>
                            <div class="col">
                                <form action="<?= base_url() ?>LandingUser/SaveEnbudo" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" name="dia" class="form-control" placeholder="Dia"
                                                required>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="msj" class="form-control" placeholder="Mensaje"
                                                required>
                                        </div>
                                    </div> <br>
                                    <button type="submit" class="btn btn-primary"> Crear</button>
                                </form>
                            </div>
                        </center><br><br><br>
                        <div class="row">
                            <div class="col-8">
                                <h2>Personas Interesadas</h2>
                            </div>
                            <div class="col-4">
                                <h2>Dias Creados</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Dia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ListUsers as $c) { ?>
                                            <tr>
                                                <td>
                                                    <?= $c['fecha']; ?>
                                                </td>
                                                <td>
                                                    <?= $c['email'] ?>
                                                </td>
                                                <td>
                                                    <?= $c['diferencia'] ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Dia</th>
                                            <th scope="col">Mensaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ListEmbu as $c) { ?>
                                            <tr>
                                                <td>
                                                    <?= $c->dia ?>
                                                </td>
                                                <td>
                                                    <?= $c->msj ?>
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



</body>

</html>