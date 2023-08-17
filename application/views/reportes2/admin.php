<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

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

        <center>
            <h1>Señales Binarias</h1>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addSenal">Crear
                            Señal</button>
                        <br><br>
                        <div class="table-responsive">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th scope="col">Par</th>
                                        <th scope="col">Señal</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Diferencia</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reporte as $p) { ?>
                                        <tr>
                                            <td>
                                                <?= $p['fecha'] ?>
                                            </td>
                                            <td>
                                                <?= $p['par'] ?>
                                            </td>
                                            <td>
                                                <?= $p['senal'] ?>
                                            </td>
                                            <td>
                                                <?= $p['precio'] ?>
                                            </td>
                                            <td>
                                                <?= $p['diferencia'] ?> Min
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#deleteSenal<?= $p['id'] ?>">
                                                    X
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal delete -->
                                        <div class="modal fade" id="deleteSenal<?= $p['id'] ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Señal</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Esta seguro de eliminar la señal <?= $p['par'] ?>  de la fecha <?= $p['fecha'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addSenal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Reportes2/SaveReport" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Señal</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="par" class="form-control" placeholder="Par">
                        </div>
                        <div class="input-group mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Señal</label> </br><br>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="Default select example" style="width:80%;"
                                name="senal">
                                <option value="compra">Compra</option>
                                <option value="venta">Venta</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="precio" class="form-control" placeholder="Precio" step="0.01">
                        </div>
                        <div class="input-group mb-3">
                            <input type="datetime-local" name="fecha" class="form-control" placeholder="Fecha">
                        </div>


                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <button type="submit" style="background-color: #36E1F9;" class="btn">Crear</button>

                    </div>

                </form>

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


<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<!-- End custom js for this page -->