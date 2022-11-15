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
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Crear Ticket</button>

                    <div class="table-responsive">

                        <table class="table" id="">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Pregunta</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Ticket/add" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear ticket</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="input-group mb-3">

                            <input type="textarea" class="form-control" name="motivo">

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