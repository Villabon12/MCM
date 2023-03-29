<!-- partial -->
<style>
.contenedor {
    position: relative;
    display: table-cell;
    text-align: center;
}


.centrado {
    background: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
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
    <div class="main-panel">

        <div class="content-wrapper">
            <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>
            <br>

            <?php } ?>

            <?php if ($disponibilidad != false) { ?>

            <h3 style="color: red;">Tienes campos sin verificar en tu perfil <a href="<?=base_url()?>Perfil">Ir al
                    perfil</a></h3>
            <br>

            <?php } ?>
            <div class="contenedor">
                    <img src="<?=base_url()?>images/primer.png"
                        srcset="<?=base_url()?>images/primer.png, <?=base_url()?>images/primer.png 840w"
                        sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" style="max-width: 40%;">
                        <div class="centrado"><?=$premio[1]->user?>, directos: <?=$premio[1]->contar?> $<?=$premio[1]->total?></div>
            </div>
            <div class="contenedor">
                    <img src="<?=base_url()?>images/segundo.png"
                        srcset="<?=base_url()?>images/segundo.png, <?=base_url()?>images/segundo.png 840w"
                        sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" style="max-width: 40%;">
                        <div class="centrado"><?=$premio[2]->user?>, directos: <?=$premio[2]->contar?> $<?=$premio[2]->total?></div>
            </div>
            <div class="contenedor">
                    <img src="<?=base_url()?>images/tercer.png"
                        srcset="<?=base_url()?>images/tercer.png, <?=base_url()?>images/tercer.png 840w"
                        sizes="(max-width: 767px) 80vw, (max-width: 933px) 90vw, 840px" style="max-width: 40%;">
                        <div class="centrado"><?=$premio[3]->user?>, directos: <?=$premio[3]->contar?> $<?=$premio[3]->total?></div>
            </div>
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center"><img src="<?= base_url() ?>images/myconnect/usdt.png"
                                    alt=""></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Principal</h4>
                                <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_compra, 2) ?>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                          <div class="cc-icon align-self-center">
                              <p>Servicio Gratuito 93 dias restante</p>
                              <img
                                    src="https://img.icons8.com/wired/64/000000/average-2.png" />
                                  </div>
                            <div class="m-l-10 align-self-center">

                                <h4 class="m-b-0 amar">Billetera Equipo</h4>
                                <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_comision, 2) ?>
                                </h5>
                                <a href="<?=base_url()?>Comisiones/historial" class="btn btn-dark">Ver equipo</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center"><img
                                    src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Binaria</h4>
                                <h5 class="text-muted m-b-0 blan">$<?= number_format($total->total, 2) ?></h5>
                                <a href="<?=base_url()?>Binaria" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center"><img
                                    src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Juego</h4>
                                <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_juego, 2) ?>
                                </h5>
                                <a href="<?=base_url()?>Puzzle" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center"><img
                                    src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Arbitraje</h4>
                                <?php if ($arbitraje == null) { ?>
                                <h5 class="text-muted m-b-0 blan">$0.00

                                    <?php }else{ ?>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($arbitraje->valor, 2) ?>

                                        <?php } ?>
                                    </h5>
                                    <a href="<?=base_url()?>Arbitraje" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php if ($perfil->id == 6) { ?>
                <div class="main-panel">
                    <div class="container">
                        <h1>EN CASO DE SEGURIDAD, OPRIMIR EL BOTON ROJO</h1>
                        <?php if ($validar->valor == 0) { ?>
                        <a class="btn btn-success"
                            href="<?= base_url() ?>Socios/encenderRobot/<?= $validar->id ?>">ENCENDER</a>
                        <?php } else { ?>
                        <a class="btn btn-danger"
                            href="<?= base_url() ?>Socios/apagarRobot/<?= $validar->id ?>">APAGAR</a>

                        <?php } ?>

                    </div>

                    <div class="content-wrapper">

                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="cc-icon align-self-center"><img
                                                src="<?= base_url() ?>images/myconnect/usdt.png" alt=""></div>
                                        <div class="m-l-10 align-self-center">
                                            <h4 class="m-b-0 amar">Billetera Brokers Total</h4>
                                            <h5 class="text-muted m-b-0 blan">
                                                $<?= number_format($empresa->cuenta_inversion, 2) ?></h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="cc-icon align-self-center"><img
                                                src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                        <div class="m-l-10 align-self-center">
                                            <h4 class="m-b-0 amar">Billetera Inversion</h4>
                                            <h5 class="text-muted m-b-0 blan">$<?= number_format($total1->total, 2) ?>
                                            </h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="cc-icon align-self-center"><img
                                                src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                        <div class="m-l-10 align-self-center">
                                            <h4 class="m-b-0 amar">Billetera Socio</h4>
                                            <h5 class="text-muted m-b-0 blan">
                                                $<?= number_format($empresa->cuenta_socio, 2) ?></h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="cc-icon align-self-center"><img
                                                src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                        <div class="m-l-10 align-self-center">
                                            <h4 class="m-b-0 amar">Billetera Puzzle</h4>
                                            <h5 class="text-muted m-b-0 blan">
                                                $<?= number_format($empresa->cuenta_puzzle, 2) ?></h5>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php } ?>

                </div>
            </div>
            <?php } ?>

            <div class="modal fade" id="inicioTerminos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: red;" id="exampleModalLabel">¡ADVERTENCIA!</h5>
                        </div>
                        <div class="modal-body">
                            <p>Los CFDs son instrumentos complejos conllevan un alto riesgo de perder dinero rápidamente
                                debido al apalancamiento.
                                El 90% de las personas pierden dinero al operar con opciones binarias y CFDs.
                                Debes considerar si comprendes como funcionan las opciones binarias y CFDs, si puedes
                                permitirte asumir el alto
                                riesgo de perder tú dinero.</p>
                            <p>Al estar registrado ya ha aceptado los términos y condiciones.</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?= base_url() ?>Socios/aceptar_terminos" method="post">
                                <input type="hidden" name="id" value="<?= $perfil->id ?>">
                                <button type="submit" class="btn btn-success">Acepto</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal Ends -->

            <!-- FIN PARTIAL -->

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect
                        Mind 2022</span>
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
    <?php if (count($terminos) == 0) { ?>
    $('#inicioTerminos').modal('toggle')

    <?php } ?>

    $(".btn-view1").on("click", function() {
        var id = $(this).val();
        $.ajax({
            url: base_url + "Ofertas/userData",
            type: "POST",
            dataType: "html",
            data: {
                id: id
            },
            success: function(data) {
                $("#mCo .modal-body").html(data);
            }
        });
    });

    (function($) {
        'use strict';
        var clipboard = new ClipboardJS('.btn-clipboard');
        clipboard.on('success', function(e) {
            console.log(e);
        });
        clipboard.on('error', function(e) {
            console.log(e);
        });
    })(jQuery);

    $(".btn-oferta").on("click", function() {
        var id = $(this).val();
        alertify.confirm("¿Estas seguro de aprobar?", function(e) {
            $.ajax({
                url: base_url + "Ofertas/updPendiente",
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    alertify.success('Ok');

                    window.location.reload();
                }
            });
        });
    });

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
                html += '<tr><td>Balance: ' + Number(resp["ganancia"].ganancia - resp[
                    "perdida"].perdida).toFixed(2) + '</td></tr>';
                html += '<tr><td>Beneficio:' + Number(resp["ganancia"].ganancia).toFixed(
                    2) + ' </td></tr>';
                html += '<tr><td>Perdida:' + Number(resp["perdida"].perdida).toFixed(2) +
                    ' </td></tr>';
                html += '<tr><td>Porcentaje Balance:' + Number(resp["ganancia"]
                        .porcentajeG - resp["perdida"].porcentajeP).toFixed(4) * 100 +
                    ' %</td></tr>';
                html +=
                    '<tr><a class="btn btn-dark" href="<?= base_url() ?>Binaria">Recargar</a></tr>';
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
                        html += '<p style="color: red;">VENDER, ' + value.mercado +
                            '</p>';
                    } else {
                        html += '<p style="color: blue;">COMPRAR, ' + value
                            .mercado + '</p>';
                    }
                    html += '</div>';
                    html += '<div class="col-md-6">';
                    html += '<p style="font-size: 12.9375px;">' + value.fecha +
                        '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="row">';
                    html += '<div class="col-md-4">';
                    html += ' <p style="font-size: 11.9375px;">' + value
                        .saldo_entra + ' => ' + value.saldo_sale + '</p>';
                    html += '</div>';
                    html += '<div class="col-md-6">';
                    if (value.tipoxuser == 'ganancia') {
                        html += '<p style="color: blue;">' + value.gananciaxuser +
                            '</p>';
                    } else {
                        html += '<p style="color: red;">' + value.gananciaxuser +
                            '</p>';
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

    // $(".btn-comprobantesub").on("click", function() {
    //     var id = $(this).val();
    //     $.ajax({
    //         url: base_url + "P2P/userData",
    //         type: "POST",
    //         dataType: "html",
    //         data: {
    //             id: id
    //         },
    //         success: function(data) {
    //             $("#mCo .modal-body").html(data);
    //             id[0].reset();
    //         }
    //     });
    // });

    $("#user").keyup(function(e) {

        $b = $(this).val();

        $("#user2").val($b);

    })

    $("#user2").on("click", function() {
        var data = $(this).val()
        $.ajax({
            url: '<?= base_url() ?>Banco/traer_usuario',
            type: "POST",
            data: {
                cedula: data
            },

            success: function(resp) {
                html = '<div class="input-group mb-2">';
                html += '<h5 style="color:black;">' + resp + '</h5>';
                html += '</div>';
                $('#add1').html(html);
            }
        })
    })

    $("#button").on("click", function() {
        var data = $(this).val()
        $.ajax({
            url: '<?= base_url() ?>Banco/codigoSeguridad',
            type: "POST",
            data: {
                data: data
            },

            success: function(resp) {
                html = resp;

                $('#add').html(html);
            }
        })
    })
    $("#button2").on("click", function() {
        var data = $(this).val()
        $.ajax({
            url: '<?= base_url() ?>Banco/codigoSeguridad2',
            type: "POST",
            data: {
                data: data
            },

            success: function(resp) {
                html = resp;

                $('#add1').html(html);
            }
        })
    })
    $("#button3").on("click", function() {
        var data = $(this).val()
        $.ajax({
            url: '<?= base_url() ?>Banco/codigoSeguridad3',
            type: "POST",
            data: {
                data: data
            },

            success: function(resp) {
                html = resp;

                $('#add2').html(html);
            }
        })
    })



});
</script>



</body>

</html>