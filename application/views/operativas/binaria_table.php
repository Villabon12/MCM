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
                            <h1>Gestiona Tus link de telegram para Operativa en vivo Binarias</h1> <br>
                        </div>
                        <h5>
                            Recomendaciones: Los link no se pueden eliminar , solo se pondran modificar<br>
                        </h5> <br>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Sett</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $c) { ?>
                                    <tr>
                                        <td>
                                            <?= $c->mes ?>
                                        </td>
                                        <td>
                                            <a href="<?= $c->link ?>"><?= $c->link ?></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modi<?= $c->id ?>">
                                                <i class="bi bi-gear"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal set -->
                                    <div class="modal fade" id="modi<?= $c->id ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?= base_url() ?>Operativas/SaveLink/<?= $c->id ?>"
                                                    method="post">

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica Link
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="">Link</label>
                                                        <input type="text" class="form-control" name="link"
                                                            value="<?= $c->link ?>" required>
                                                        <input type="hidden" class="form-control" name="servicio"
                                                            value="<?= $c->servicio ?>" >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
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