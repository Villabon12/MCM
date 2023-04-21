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
                            <h1>Haz tu Propia LandingPage para tu envento o emprendimiento en 6 simples pasos!</h1> <br>
                        </div>
                        <h5>
                            1) Crea una Campaña con su respetivo Nombre .<br> <!-- 1) Crea una Campaña con su respetivo Nombre .<br> -->
                            2) Escoge la plantilla que mas se relacione a tu estilo.<br>
                            3) Personaliza tu plantilla ,agrega titulos,subtitulos y descripciones. <br>
                            4) Agrega Multimedia,agrega fotos,cartas informativas y descripciones. <br>
                            5) Conoce nuestros planes y escoges el que mejor se te acomode.<br>
                            6) Obtienes tu link personalizado  para que puedas compartirlo con todo el
                            mundo<br>
                        </h5> <br>
                        <br>
                        <center>
                            <h1 style="font-family: 'Righteous', cursive;    color: black;">Paso 1° </h1>
                            <br>

                            <h3 style="font-family: 'Righteous', cursive;    color: black;">Crea una Campaña </h3>
                            <br>
                            <div class="col">
                                <form action="<?= base_url() ?>LandingUser/campana" method="POST">
                                    <label for="basic-url" class="form-label">Selecione un nombre para su campaña o
                                        Emprendimiento</label>
                                    <input type="text" class="form-control" name="campana"
                                        placeholder="Tranding en automatizacion" aria-describedby="basic-addon2"
                                        required> <br>
                                    <button type="submit" class="btn btn-primary"> Ir paso 2º</button>
                                </form>
                            </div>
                        </center><br><br><br>
                        <h2>Campañas Creadas</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha Creaciòn</th>
                                    <th scope="col">Campaña</th>
                                    <th scope="col">url</th>
                                    <th scope="col">fecha Vence</th>
                                    <th scope="col">Organizar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($campana as $c) { ?>
                                    <tr>
                                        <td>
                                            <?= $c->fechaCreacion ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>LandingUser/sett/<?= $c->idPlant ?>/<?= $c->id ?>">
                                                <?= $c->campana ?></a>
                                        </td>
                                        <td>
                                            <?= $c->url ?>
                                        </td>
                                        <td>
                                            <?= $c->fechaVence ?>
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
                                                <form action="<?= base_url() ?>LandingUser/Upnmae/<?=$c->id?>" method="post">
                                                
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica Campaña
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Nombre Campaña</label>
                                                    <input type="text" class="form-control" name="campana"
                                                        value="<?= $c->campana ?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios </button>
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