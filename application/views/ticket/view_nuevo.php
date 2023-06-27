<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>
        <?php if ($perfil->id == 6) {
            $form = base_url()."Ticket/inserDetalleEmpresa/$id";
        } else {
        $form = base_url()."Ticket/inserDetalle/$id";
        }
        ?>
        <form method="post" action="<?=$form?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="inputMessage">Mensaje</label>
                <textarea name="mensaje" id="inputMessage" rows="12" class="form-control markdown-editor"
                    data-auto-save-name="client_ticket_open"></textarea>
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <label for="inputAttachments">Adjuntos</label>
                </div>
                <div class="col-sm-9">
                    <input type="file" name="video" id="inputAttachments" class="form-control" />
                </div>

                <div class="col-xs-12 ticket-attachments-message text-muted">
                    Extensiones de archivo permitidas: .jpg, .gif, .jpeg, .png, .pdf, .web, .mp4 (Max file size: 1024MB)
                </div>
            </div>

            <div id="customFieldsContainer">
            </div>

            <div id="autoAnswerSuggestions" class="well hidden"></div>

            <div class="text-center margin-bottom">
            </div>

            <p class="text-center">
                <input type="submit" id="openTicketSubmit" value="Enviar" class="btn btn-primary disable-on-click" />
                <a href="<?=base_url()?>Ticket/detalle/<?=$id?>" class="btn btn-default">Cancelar</a>
            </p>

        </form>
    </div>
</div>


<!-- Plugin js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
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