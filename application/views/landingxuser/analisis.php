<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                            <h1>Gestiona El comportamiento de tu campaña :<br>
                                <?= $DaCamp->campana ?>
                            </h1> <br>
                        </div>
                        <br>
                        <br>
                        <div class="row row-cols-1 row-cols-md-2 mb-2 text-center" style="margin-top:2rem ;">
                            <div class="col">
                                <div class="card align-self-center text-bg-secondary"
                                    style="width: 80%;margin:auto; border-radius: 35px;">
                                    <div class="card-body">
                                        <h3 class="card-title" style="font-family: 'Righteous', cursive;"> Views:
                                            <?= $DaCamp->contador ?>
                                        </h3>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card align-self-centert text-bg-primary"
                                    style="width: 80%;margin:auto; ; border-radius: 35px;">
                                    <div class="card-body">
                                        <h3 class="card-title" style="font-family: 'Righteous', cursive;">Plan Adquirido
                                            :
                                            <?= $DaCamp->nombrePaquete ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($DaCamp->idPaquete <= 3) { ?>
                            <h5 class="card-title text-center"
                                style="font-family: 'Righteous', cursive; margin-bottom:30px;">Analisis
                                Detallado territorio</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pais</th>
                                            <th scope="col">#Views</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($general as $g) { ?>
                                            <tr>
                                                <td>
                                                    <button type="submit" id="paisSearch<?= $g->pais ?>" value="<?= $g->pais ?>"
                                                        class="text-dark" style="border:none;background:none;"
                                                        data-bs-toggle="modal" data-bs-target="#info<?= $g->pais ?>">
                                                        <?= $g->pais ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?= $g->num ?>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="info<?= $g->pais ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                style="font-family: 'Righteous', cursive;"
                                                                id="exampleModalLabel">Analisis profundo</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row row-cols-2 row-cols-md-2 mb-2 text-center"
                                                                style="margin-top:2rem ;">
                                                                <div class="col">
                                                                    <h4><b>Departamento<b></h4>
                                                                </div>
                                                                <div class="col">
                                                                    <h4><b>#views<b></h4>
                                                                </div>
                                                            </div>
                                                            <div id="dataout"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    var base_url = "<?= base_url() ?>";
                                                    $('#paisSearch<?= $g->pais ?>').on("click", function () {
                                                        console.log("click");
                                                        var id = $(this).val();
                                                        var idCamp = <?=  $DaCamp->id ?>;
                                                       
                                                        $.ajax({
                                                            url: base_url + "LandingUser/infoCiudad",
                                                            type: "POST",
                                                            data: {
                                                                id: id,
                                                                idCamp:idCamp
                                                            },
                                                            dataType: "json",
                                                            success: function (resp) {
                                                                $.each(resp, function (key, value) {
                                                                    new_input = '<div class="row row-cols-2 row-cols-md-2 mb-2 text-center" style="margin-top:10px ;">';
                                                                    new_input += '<div class="col">';
                                                                    new_input += '<h4> ' + value.departamento + '  <h4>';
                                                                    new_input += '</div>';
                                                                    new_input += '<div class="col">';
                                                                    new_input += '<h4> ' + value.num + '<h4>';
                                                                    new_input += '</div>';
                                                                    new_input += '</div>';
                                                                    $("#dataout").append(new_input);
                                                                });

                                                                console.log(resp);
                                                            }
                                                        });
                                                    })
                                                })
                                            </script>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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