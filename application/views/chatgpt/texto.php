<!-- partial -->
<!-- partial -->

    <div class="main-panel">
       
            <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

            <?php } ?>
            <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

            <?php } ?>

            <div class="content-wrapper">

                <div class="row">
                    <form action="<?=base_url()?>Login/prueba" id="form-graficar" method="post">
                        <textarea name="texto" id="" cols="30" rows="10"></textarea>
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </form>
                </div>
                <div class="row algo" id="">

                </div>
            </div>

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


    // $("#form-graficar").on("submit", function(e) {
    //     e.preventDefault();
    //     data = $(this).serialize();
    //     ruta = $(this).attr("action");
    //     $.ajax({
    //         url: ruta,
    //         type: "POST",
    //         data: data,
    //         success: function(resp) {
    //             html = 'Aqui va la respues' + resp;

    //             $("#algo").html(html);
    //         }

    //     });
    // });

});
</script>



</body>

</html>