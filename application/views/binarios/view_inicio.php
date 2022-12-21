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
                                    <form action="<?= base_url() ?>Binaria/comprarBinaria/<?= $perfil->token ?>" method="post">
                                        <h1 class="text-center">Robot Binaria</h1>
                                        <center>
                                            <p>Adquiere el servicio por una pequeña compra</p>
                                            <select aria-label="Default select example" style="width:450px" class="text-center" id="robot" name="robot" required>
                                                <option selected>Selecciona Valor</option>
                                                <?php foreach ($servicio as $s) { ?>
                                                    <option value="<?= $s->id ?>"><?= $s->descripcion ?> $<?= $s->precio ?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" class="btn btn-success" disabled name="servicio">comprar</button>
                                            <p style="color: red;">Saldo disponible en tu billetera: <?= $billetera->cuenta_compra ?></p>
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
                                        <form action="<?= base_url() ?>Binaria/invertirBinaria/<?= $perfil->token ?>" id="form-fondeo" method="post">
                                            <h1 class="text-center">Robot Binaria</h1>
                                            <center>
                                                <p>Inversion</p>
                                                <input type="number" class="form-control" placeholder="Valor a invertir" name="inversion"><br>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fondeoAceptar">Invertir</button>
                                                <p style="color: red;">Saldo disponible en tu billetera: <?= $billetera->cuenta_compra ?></p>
                                            </center>
                                            <div class="modal fade" id="fondeoAceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" style="color: red;" id="exampleModalLabel">¡ADVERTENCIA!</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Los CFDs son instrumentos complejos conllevan un alto riesgo de perder dinero rápidamente debido al apalancamiento.
                                                                El 90% de las personas pierden dinero al operar con opciones binarias y CFDs.
                                                                Debes considerar si comprendes como funcionan las opciones binarias y CFDs, si puedes permitirte asumir el alto
                                                                riesgo de perder tú dinero.</p>
                                                            <p>¿Acepta el riesgo al fondear por medio de esta web?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                                <input type="hidden" name="terminos" value="<?= $perfil->id ?>">
                                                                <button type="submit" class="btn btn-success" form="form-fondeo">Acepto</button>
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
                <center>
                    <div class="container">
                        <h1>PORCENTAJE GANADO MENSUAL DE LA INVERSION</h1>
                        <?php if ($mesInicial == null) {  ?>
                            <h3><strong><?= number_format(0) ?> %</strong></h3>

                        <?php } else { ?>
                            <h3><strong><?= number_format((($gananciaMes->ganancia - $perdidaMes->perdida) / $mesInicial->valor_antiguo) * 100, 2) ?> %</strong></h3>
                            <!-- <p>(<?=$gananciaMes->ganancia ?> - <?=$perdidaMes->perdida ?>)/ <?=$mesInicial->valor_antiguo?></p> -->

                        <?php } ?>
                    </div>

                </center>
                <div class="content-wrapper">
                    <div class="row holii">
                        <div class="container">
                            <form id="form-graficar" action="<?= base_url() ?>Binaria/jsonConsulta" method="post">
                                <div class="row" style="padding-bottom: 27px;">
                                    <div class="col-md-3">
                                        <label for="form-label">Desde: </label>
                                        <input type="date" name="fecha" id="fecha">

                                    </div>
                                    <div class="col-md-3">
                                        <label for="form-label">Hasta: </label>
                                        <input type="date" name="fecha2" id="fecha2">

                                    </div>
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>

                            </form>

                        </div>

                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Inversion</h4>
                                    <div class="table-responsive">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col">Inversion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($inversion as $B) { ?>

                                                    <tr>
                                                        <td><?= $B->fecha ?></td>
                                                        <td><?= $B->inversion ?></td>

                                                    </tr>

                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td>Balance día: </td>
                                                    <?php if ($ganancia == null) { ?>
                                                        <td>0</td>
                                                    <?php } else { ?>
                                                        <td><?= number_format($ganancia->ganancia - $perdida->perdida, 2) ?></td>
                                                    <?php } ?>

                                                </tr>
                                                <tr>
                                                    <td>Beneficio hoy: </td>
                                                    <?php if ($ganancia == null) { ?>
                                                        <td>0</td>
                                                    <?php } else { ?>
                                                        <td><?= number_format($ganancia->ganancia, 2) ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td>Perdida hoy: </td>
                                                    <?php if ($perdida == null) { ?>
                                                        <td>0</td>
                                                    <?php } else { ?>
                                                        <td><?= number_format($perdida->perdida, 2) ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td>Porcentaje hoy: </td>
                                                    <?php if ($porcentajehoyG == null) { ?>
                                                        <td>0</td>
                                                    <?php } else { ?>
                                                        <td><?= number_format(($porcentajehoyG->ganancia - $porcentajehoyP->perdida) * 100, 3) ?> %</td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td>Deposito: </td>
                                                    <td><?= number_format($deposito->deposito, 2) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Retiro: </td>
                                                    <td><?= number_format($retiro->retiro, 2) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body performane-indicator-card">

                                    <?php if (count($inversion) >= 1) { ?>
                                        <?php foreach ($reportes as $r) { ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php if ($r->senal == 'PUT') { ?>
                                                        <p style="color: red;">VENDER, <?= $r->mercado ?></p>
                                                    <?php } else { ?>
                                                        <p style="color: blue;">COMPRAR, <?= $r->mercado ?></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="font-size: 12.9375px;"><?= $r->fecha ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p style="font-size: 11.9375px;"><?= $r->saldo_entra ?> => <?= $r->saldo_sale ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($r->tipoxuser == 'ganancia') { ?>
                                                        <p style="color: blue;"><?= $r->gananciaxuser ?></p>
                                                    <?php } else { ?>
                                                        <p style="color: red;"><?= $r->gananciaxuser ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <br>

                                        <?php } ?>

                                    <?php } else { ?>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
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
    function cambiar() {
        var pdrs = document.getElementById('file-upload').files[0].name;
        document.getElementById('info').innerHTML = pdrs;
    }
</script>

<script>
    $(document).ready(function() {
        var base_url = "<?= base_url() ?>";

        $("#form-graficar").on("submit", function(e) {
            e.preventDefault();
            data = $(this).serialize();
            ruta = $(this).attr("action");
            $.ajax({
                url: ruta,
                type: "POST",
                data: data,
                dataType: "json",
                success: function(resp) {
                    html = '<div class="col-md-4 grid-margin stretch-card">';
                    html += '<div class="card">';
                    html += '<div class="card-body">';
                    html += '<h4 class="card-title">Inversion</h4>';
                    html += '<div class="table-responsive">';
                    html += '<table class="table">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th scope="col">Fecha</th>';
                    html += '<th scope="col">Inversion</th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';
                    html += '<tr><td>' + resp["inversion"].fecha + '</td>';
                    html += '<td>' + resp["inversion"].inversion + '</td></tr>';
                    html += '<tr><td>Total: </td>';
                    html += '<tr><td>Balance: ' + Number(resp["ganancia"].ganancia - resp["perdida"].perdida).toFixed(2) + '</td></tr>';
                    html += '<tr><td>Beneficio:' + Number(resp["ganancia"].ganancia).toFixed(2) + ' </td></tr>';
                    html += '<tr><td>Perdida:' + Number(resp["perdida"].perdida).toFixed(2) + ' </td></tr>';
                    html += '<tr><td>Porcentaje Balance:' + Number(resp["ganancia"].porcentajeG - resp["perdida"].porcentajeP).toFixed(4) * 100 + ' %</td></tr>';
                    html += '<tr><a class="btn btn-dark" href="<?= base_url() ?>Binaria">Recargar</a></tr>';
                    html += '</tbody>';
                    html += '</table>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col-md-8 grid-margin stretch-card">';
                    html += '<div class="card">';
                    html += '<div class="card-body performane-indicator-card">';

                    $.each(resp["reporte"], function(key, value) {
                        html += '<div class="row">';
                        html += '<div class="col-md-4">';
                        if (value.senal == 'PUT') {
                            html += '<p style="color: red;">VENDER, ' + value.mercado + '</p>';
                        } else {
                            html += '<p style="color: blue;">COMPRAR, ' + value.mercado + '</p>';
                        }
                        html += '</div>';
                        html += '<div class="col-md-6">';
                        html += '<p style="font-size: 12.9375px;">' + value.fecha + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="row">';
                        html += '<div class="col-md-4">';
                        html += ' <p style="font-size: 11.9375px;">' + value.saldo_entra + ' => ' + value.saldo_sale + '</p>';
                        html += '</div>';
                        html += '<div class="col-md-6">';
                        if (value.tipoxuser == 'ganancia') {
                            html += '<p style="color: blue;">' + value.gananciaxuser + '</p>';
                        } else {
                            html += '<p style="color: red;">' + value.gananciaxuser + '</p>';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '<br>';
                    });
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    $(".holii").html(html);
                }

            });
        });

    });
</script>



</body>

</html>