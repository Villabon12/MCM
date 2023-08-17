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
                                        href="<?= base_url() ?>Perfil">Ir al
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
                                <div class="col-md-12">
                                    <form action="<?= base_url() ?>Banco/retirosGeneral" id="retiroCuenta" method="post"
                                        enctype="multipart/form-data">

                                        <h1 class="text-center">Retiros de billetera</h1>
                                        <center>
                                            <p>Transferencia</p>

                                            <div class="form-group row mb-3">
                                                <label for=>Billetera a retirar</label><br><br>
                                                <select class="form-control billeteras" id="billeteras">
                                                    <option selected>Elige billetera...</option>
                                                     <option value="1">Billetera Binaria</option> 
                                                    <option value="2">Billetera Comision</option>
                                                    <option value="3">Billetera Juegos</option>
                                                </select>
                                            </div>
                                            <div id="ocultar" style="display: none;">
                                                <div class="form-group row mb-3">
                                                    <button type="button" class="btn btn-dark" id="button3" value="<?= $perfil->correo ?>">Codigo
                                                        seguridad</button>
                                                </div>
                                                <div class="form-group row mb-3" id="add2">

                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for=>Codigo de seguridad</label><br><br>
                                                    <input type="text" class="form-control" name="codigo"
                                                        placeholder="Codigo" required>
                                                </div>
                                            </div>
                                            <div class="add">

                                            </div>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($inversion == null) { ?>
                    <input type="hidden" id="inversion" value="0">
                <?php } else { ?>
                    <input type="hidden" id="inversion" value="<?= $inversion->inversion ?>">
                <?php } ?>
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">
                            </div>
                        </div>


                    </div>
                </div>


                <div class="modal fade" id="retiroInversion" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                            </div>

                            <div class="modal-body">
                                <p>Estas apunto de retirar de tu billetera de Binaria, Recuerda que te descuentan el
                                    <?= ($binaria->valor) * 100 ?> %
                                </p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="retiroCuenta">Aceptar </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="retiroEquipo" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                            </div>

                            <div class="modal-body">
                                <p>Estas apunto de retirar de tu billetera de Comisiones, Recuerda que te descuentan el
                                    <?= ($equipo->valor) * 100 ?> %
                                </p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="retiroCuenta">Aceptar </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="retiroJuego" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                            </div>

                            <div class="modal-body">
                                <p>Estas apunto de retirar de tu billetera de Juegos, Recuerda que te descuentan el
                                    <?= ($juego->valor) * 100 ?> %
                                </p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="retiroCuenta">Aceptar </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="retiroWallet" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Aceptacion de terminos</h5>
                            </div>

                            <div class="modal-body">
                                <p>Estas apunto de retirar de tu billetera Principal, Recuerda que contamos con el tiempo
                                    del
                                    broker
                                </p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="retiroPrincipal">Aceptar </button>
                            </div>
                        </div>
                    </div>
                </div>

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
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>";

        $("#billeteras").on("change", function () {
            var div = document.getElementById("ocultar");
            if (div.style.display === "none") {
                div.style.display = "block";
            }
            var id = $(this).val();
            var inversion = $('#inversion').val();
            html = '';
            if (id == 1) {
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Inversiones a retirar</label><br><br>';
                html +=
                    '<input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<p style="color: red;">Saldo a favor: ' + inversion + '</p>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<h6 style="color: red;">Se pasa automaticamente  a solicitud de retiro</h6> <br> ';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Wallet Binance</label><br><br>';
                html +=
                    '<input type="text" class="form-control"value=" <?= $perfil->wallet_binance ?> " name="wallet" placeholder="<?= $perfil->wallet_binance ?>" required readonly>';
                html += '</div>';
                html +=
                    '<button type="button" data-bs-toggle="modal" data-bs-target="#retiroInversion" class="btn btn-success" name="servicio">Retiro</button>';
                html += '</div>';
                html += '<input type="hidden" name="billetera" value="' + id + '">';
                $('.add').html(html);
            } else if (id == 2) {
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Valor a retirar</label><br><br>';
                html +=
                    '<input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<p style="color: red;">Saldo a favor: <?= $billetera->cuenta_comision ?></p>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Wallet Binance</label><br><br>';
                html +=
                    '<input type="text" class="form-control" value=" <?= $perfil->wallet_binance ?> " name="wallet" placeholder="<?= $perfil->wallet_binance ?>" required readonly>';
                html += '</div>';
                html +=
                    '<button type="button" data-bs-toggle="modal" data-bs-target="#retiroEquipo" class="btn btn-success" name="servicio">Retiro</button>';
                html += '</div>';
                html += '<input type="hidden" name="billetera" value="' + id + '">';

                $('.add').html(html);
            } else {
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Valor a retirar</label><br><br>';
                html +=
                    '<input type="number" class="form-control" name="retiro" placeholder="Valor a Retirar" required>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<p style="color: red;">Saldo a favor: <?= $billetera->cuenta_juego ?></p>';
                html += '</div>';
                html += '<div class="form-group row mb-3">';
                html += '<label for=>Wallet Binance</label><br><br>';
                html +=
                    '<input type="text" class="form-control"value=" <?= $perfil->wallet_binance ?> " name="wallet" placeholder="<?= $perfil->wallet_binance ?>" required readonly>';
                html += '</div>';
                html +=
                    '<button type="button" data-bs-toggle="modal" data-bs-target="#retiroJuego" class="btn btn-success" name="servicio">Retiro</button>';
                html += '</div>';
                html += '<input type="hidden" name="billetera" value="' + id + '">';

                $('.add').html(html);
            }
        });

        $("#button3").on("click", function () {
            var data = $(this).val()
            $.ajax({
                url: '<?= base_url() ?>Whatsapp/Alternativa',
                type: "POST",
                data: {
                    id: data
                },

                success: function (resp) {
                    html = resp;

                    $('#add2').html(html);
                }
            })
        })

        $("#button4").on("click", function () {
            var data = $(this).val()
            $.ajax({
                url: '<?= base_url() ?>Whatsapp/Alternativa',
                type: "POST",
                data: {
                    id: data
                },

                success: function (resp) {
                    html = resp;

                    $('#add3').html(html);
                }
            })
        })
    });
</script>