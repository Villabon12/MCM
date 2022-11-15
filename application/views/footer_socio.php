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

        $(".btn-cancelarOferta").on("click", function() {
            var id = $(this).val();
            alertify.confirm("¿Estas seguro de Cancelar?", function(e) {
                $.ajax({
                    url: base_url + "Ofertas/cancelarOferta",
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