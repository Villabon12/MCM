<!-- partial -->
<?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-lg 12">

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
    </div>
<?php } else { ?>
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
                                <form action="<?= base_url() ?>Puzzle/comprarPuzzle/<?= $perfil->token ?>" method="post">
                                    <h1 class="text-center">Compra tu Rompecabeza</h1>
                                    <center>
                                        <p>Compra y gana por jugar, mientras más ficha, más gordo el premio</p>
                                        <div class="container">
                                            <select aria-label="Default select example" class="form-control" id="tipo" name="tipo" required>
                                                <option selected>Escoger tipo rompecabeza</option>
                                                <?php foreach ($tipo as $s) { ?>
                                                    <option value="<?= $s->id ?>"><?= $s->nombre ?></option>
                                                    <input type="hidden" id="valor" value="<?= $s->valor ?>">
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="container" id="add">

                                        </div>
                                        <br>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#compra" class="btn btn-success" id="button" disabled>comprar</button>
                                        <p style="color: red;">Saldo disponible en tu billetera: <?= $billetera->cuenta_compra ?></p>
                                    </center>

                                    <div class="modal fade" id="compra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Compra Puzzle</h5>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="container">
                                                        <select aria-label="Default select example" class="form-control" id="domicilio" name="domicilio" required>
                                                            <option selected>Elegir..</option>
                                                            <?php foreach ($domicilio as $s) { ?>
                                                                <option value="<?= $s->id ?>"><?= $s->nombre ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="container" id="add2">

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind 2022</span>
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

            $("#tipo").on("change", function() {
                var id = $(this).val();
                var valor = parseFloat($('#valor').val());
                $.ajax({
                    url: base_url + "Puzzle/getPuzzle",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(resp) {
                        html = '';
                        if (id == 1) {
                            html = '';
                            html += '<select aria-label="Default select example" class="form-control" name="rompecabeza" required>';
                            html += '<option selected>Seleccionar Rompecabeza</option>';
                            $.each(resp, function(key, value) {
                                html += '<option value="' + value.id + '">' + value.nombre + '-' + value.fichas + ' fichas, $' + Number(parseFloat(value.valor) + valor) + '</option>';
                            })
                            html += '</select>'
                            $('#add').html(html);
                            $("button").prop('disabled', false);
                        } else {
                            html = '';
                            html += '<select aria-label="Default select example" class="form-control" name="rompecabeza" required>';
                            html += '<option selected>Seleccionar Rompecabeza</option>';
                            $.each(resp, function(key, value) {
                                html += '<option value="' + value.id + '">' + value.nombre + '-' + value.fichas + ' fichas, $' + value.valor + '</option>';
                            })
                            html += '</select>';
                            $('#add').html(html);
                            $("button").prop('disabled', false);
                        }

                    }
                })
            });

            $("#domicilio").on("change", function() {
                var id = $(this).val();
                var estado = <?=$perfil->pais_id?>;
                $.ajax({
                    url: base_url + "Puzzle/getDomicilio",
                    type: "POST",
                    data: {
                        estado: estado,
                    },
                    dataType: "json",
                    success: function(resp) {
                        html = '';
                        if (id == 2) {
                            html = '';
                            html += '<select aria-label="Default select example" class="form-control" name="municipio" required>';
                            html += '<option selected>Seleccionar Municipio</option>';
                            $.each(resp, function(key, value) {
                                html += '<option value="' + value.id + '">' + value.estadonombre+ '</option>';
                            })
                            html += '</select>';
                            html += '<input class="form-control" type="text" name="direccion" placeholder="Direccion">';
                            html += '<input class="form-control" type="text" name="nota" placeholder="observacion">';
                            
                            $('#add2').html(html);
                        } else {
                            html = '';
                            html += '<input type="hidden" name="municipio" value="0">';
                            html += '<input type="hidden" name="direccion" value="0">';
                            html += '<input type="hidden" name="nota" value="Recibe en cafeteria">';
                            html += '<p> Reclamalo en la cafeteria </p>';

                            
                            $('#add2').html(html);
                        }

                    }
                })
            });
        });
    </script>

    </body>

    </html>