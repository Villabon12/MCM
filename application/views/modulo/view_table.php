<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <center>
            <h1>Modulos</h1>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Crear
                            Modulo</button>

                        <div class="table-responsive">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($modulo as $p) { ?>
                                    <tr>
                                        <td><?=$p->fecha_creacion?></td>
                                        <td><?= $p->titulo ?></td>
                                        <td><?= $p->descripcion ?></td>
                                        <td><?= $p->image_portada ?></td>
                                        <td>

                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#crear<?= $p->id ?>"><i class="icon-plus"></i></button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete<?= $p->id ?>"><i
                                                    class="icon-close"></i></button>
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
        <center>
            <h1>Detalles</h1>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table" id="order-listing2">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">pdf</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detalle as $p) { ?>
                                    <tr>
                                        <td><?=$p->fecha?></td>
                                        <td><?= $p->titulo ?></td>
                                        <td><?= $p->descripcion ?></td>
                                        <td>
                                            <?php if ($p->pdf == null) { ?>
                                            No hay archivos
                                            <?php } else { ?>
                                            <?= $p->pdf ?>
                                            <?php }
                                            ?>

                                        </td>
                                        <td>
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#edit<?=$p->id?>"><i class="icon-pencil"></i></button>
                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#view<?= $p->id ?>"><i class="icon-link"></i></button>
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
        <center>
            <h1>Libros</h1>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addLibro">Crear
                            Libro</button>
                        <div class="table-responsive">

                            <table class="table" id="order-listing3">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">pdf</th>
                                        <th scope="col">Autor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($libros as $p) { ?>
                                    <tr>
                                        <td><?=$p->fecha_creacion?></td>
                                        <td><?= $p->titulo ?></td>
                                        <td><?= $p->descripcion ?></td>
                                        <td>
                                            <?php if ($p->descarga == null) { ?>
                                            No hay archivos
                                            <?php } else { ?>
                                            <?= $p->descarga ?>
                                            <?php }
                                            ?>

                                        </td>
                                        <td><?= $p->autor ?></td>

                                        <td>
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#editLibro<?=$p->id?>"><i
                                                    class="icon-pencil"></i></button>
                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#viewLibro<?= $p->id ?>"><i
                                                    class="icon-link"></i></button>
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
    </div>



    <div class="modal fade" id="addLibro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/crearLibros" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Modulo</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" class="form-control" placeholder="Descripcion" id="" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="autor" class="form-control" placeholder="Autor">
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Portada:</label>
                            <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
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
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/crearModulo" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Modulo</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" class="form-control" placeholder="Descripcion" id="" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <label for="">Portada:</label>
                            <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg">
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

    <?php foreach ($detalle as $p) { ?>
    <div class="modal fade" id="view<?= $p->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir archivos</h1>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                </div>
                <form action="<?= base_url() ?>Modulo/documentoSubir/<?= $p->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <label for="">Apoyo:</label>
                            <input type="file" name="foto" class="form-control">
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

    <div class="modal fade" id="edit<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/updateDatos/<?=$p->id?>" method="post"
                    enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Seccion</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="video" class="form-control" value="<?=$p->video?>"
                                placeholder="Enlace video">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" value="<?=$p->titulo?>"
                                placeholder="Titulo">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" class="form-control" placeholder="Descripcion" id="" cols="30"
                                rows="10"><?=$p->descripcion?></textarea>
                        </div>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <button type="submit" style="background-color: #36E1F9;" class="btn">Actualizar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <?php } ?>
    <?php foreach ($libros as $p) { ?>
    <div class="modal fade" id="viewLibro<?= $p->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir archivos</h1>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                </div>
                <form action="<?= base_url() ?>Modulo/documentoSubirLibro/<?= $p->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <label for="">Apoyo:</label>
                            <input type="file" name="foto" class="form-control">
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

    <div class="modal fade" id="editLibro<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/updateDatos/<?=$p->id?>" method="post"
                    enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Seccion</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="autor" class="form-control" value="<?=$p->autor?>"
                                placeholder="Enlace video">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" value="<?=$p->titulo?>"
                                placeholder="Titulo">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" class="form-control" placeholder="Descripcion" id="" cols="30"
                                rows="10"><?=$p->descripcion?></textarea>
                        </div>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <button type="submit" style="background-color: #36E1F9;" class="btn">Actualizar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>
    <?php } ?>

    <?php foreach ($modulo as $p) { ?>

    <div class="modal fade" id="crear<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Modulo/crearDetalle/<?=$p->id?>" method="post"
                    enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Seccion</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <input type="text" name="video" class="form-control" placeholder="Enlace video">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" placeholder="Titulo">
                        </div>
                        <div class="input-group mb-3">
                            <textarea name="descripcion" class="form-control" placeholder="Descripcion" id="" cols="30"
                                rows="10"></textarea>
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

    <div class="modal fade" id="delete<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">


                <div class="modal-body">

                    <h4>¿Estás seguro en eliminar este evento?</h4>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <a href="<?=base_url()?>Modulo/eliminarModulo/<?=$p->id?>" style="background-color: #36E1F9;"
                        class="btn">Si</a>

                </div>


            </div>

        </div>

    </div>


    <?php } ?>

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

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<!-- End custom js for this page -->