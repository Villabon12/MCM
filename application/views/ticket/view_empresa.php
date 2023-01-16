<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table" id="order-listing">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Pregunta</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ticket as $t) { ?>
                                    <tr>
                                        <td><?= $t->fecha ?></td>
                                        <td><?= $t->estado ?></td>
                                        <td><?=$t->user?></td>
                                        <td><?= $t->pregunta ?></td>
                                        <td><?php if ($t->estado == 'en proceso') { ?>
                                                <button class="btn btn-info" id="valor<?= $t->id ?>" data-bs-toggle="modal" data-bs-target="#view<?= $t->id ?>" value="<?= $t->id ?>"><i class="icon-magnifier"></i></button>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#terminar<?= $t->id ?>">Terminar</button>
                                                <script>
                                                    $(document).ready(function() {

                                                        var base_url = "<?= base_url() ?>";

                                                        $("#valor<?= $t->id ?>").on("click", function() {
                                                            id = $(this).val();
                                                            $.ajax({
                                                                url: base_url + "Ticket/detalle",
                                                                type: "POST",
                                                                data: {
                                                                    id: id
                                                                },
                                                                dataType: "json",
                                                                success: function(resp) {
                                                                    html = '';
                                                                    $.each(resp, function(key, value) {
                                                                        if (value.tipo == 'receptor') {
                                                                            html += '<div class="d-flex flex-row justify-content-end mb-4">';
                                                                            html += '    <div class="p-3 me-3 border" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">';
                                                                            html += '        <p class="small mb-0">' + value.mensaje + '</p>';
                                                                            html += '    </div>';
                                                                            html += '    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">';
                                                                            html += '</div>';

                                                                        } else {

                                                                            html + '<div class="d-flex flex-row justify-content-start mb-4">';
                                                                            html += '   <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;">';
                                                                            html += '    <div class="p-3 ms-3 border" style="border-radius: 15px; background-color: #fbfbfb;">';
                                                                            html += '         <p class="small mb-0">' + value.mensaje + '</p>';
                                                                            html += '    </div>';
                                                                            html += '</div>';

                                                                        }


                                                                    });

                                                                    $(".pruebaaa").html(html);
                                                                }

                                                            });
                                                        });
                                                    });
                                                </script>
                                            <?php } else { ?>


                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($ticket as $t) { ?>
        <div class="modal fade" id="view<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <section style="background-color: #eee;">
                        <div class="container py-5">

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4">

                                    <div class="card" id="chat1" style="border-radius: 15px;">
                                        <form action="<?= base_url() ?>Ticket/inserDetalleEmpresa" method="post">
                                            <input type="hidden" name="id" value="<?= $t->id ?>">
                                            <input type="hidden" name="usuario" value="<?= $t->usuario_id ?>">
                                            <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                                <i class="fas fa-angle-left"></i>
                                                <p class="mb-0 fw-bold">Chat MCM</p>
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="card-body pruebaaa">



                                            </div>
                                            <div class="form-outline">
                                                <input type="text" class="form-control" name="motivo" placeholder="escribe tu mensaje">
                                                <button class="btn btn-dark" type="submit">Enviar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="modal fade" id="terminar<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <p>¿Deseas cerrar este ticket?</p>
                    </div>
                    <div class="modal-footer">

                        <a href="<?= base_url() ?>Ticket/cambiarEstado/<?= $t->id ?>" class="btn btn-success">Terminar</a>
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

<!-- endinject -->
<!-- Plugin js for this page -->
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