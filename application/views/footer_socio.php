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