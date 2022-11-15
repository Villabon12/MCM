<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <!-- ============================================================== -->

        <!-- Container fluid  -->

        <!-- ============================================================== -->
        <center>
            <div class="col-lg-6 col-md-6 ppbtn">
                <div class="card cc-widget">

                    <button class="buttomo">
                        <div class="cc-icon align-self-center"><i class="fas fa-address-card auni coloramarillo" title="Ofertar Activos"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">PARAMETRO BINARIA</h4>
                        </div>
                        <div class="buttomo__horizontal"></div>
                        <div class="buttomo__vertical"></div>
                    </button>

                    <!-- <div class="card-body">
                            <div class="d-flex no-block flex-row">
                                <div class="cc-icon align-self-center"><i class="icon-basket auni coloramarillo" title="BTC"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">OFERTAR MIS ACTIVOS</h4>
                                </div>
                            </div>
                            <div id="spark1" class="sparkchart"></div>
                        </div> -->
                </div>
            </div>
        </center>
        <br><br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Parametro Binaria</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">


                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i> Porcentaje Deseado</th>

                                            <th><i class="mdi mdi-cash"></i> Hora inicio no operar</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Hora fin no operar</th>
                                            <th></th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($parametro as $t) { ?>

                                            <tr>

                                                <td><?= $t->porcen_deseado ?></td>

                                                <td><?= $t->h_inicio_no_operar ?></td>

                                                <td><?= $t->h_fin_no_operar ?></td>
                                                <td>
                                                    <?php if ($perfil->tipo == 'Ultra') { ?>
                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modificarregistro<?= $t->id ?>">Modificar</button>
                                                    <?php } ?>
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modificarregistro<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Parametros</h5>
                                                            </div>

                                                            <form action="<?= base_url() ?>Binaria/updParametros/<?= $t->id ?>" method="post">
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Porcentaje deseado %</label>
                                                                        <input type="number" class="form-control" value="<?= $t->porcen_deseado ?>" name="porcentaje">
                                                                    </div>
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Hora inicio no operar (Entero)</label>
                                                                        <input type="number" class="form-control" value="<?= $t->h_inicio_no_operar ?>" name="hora_inicio">
                                                                    </div>
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Hora fin no operar (Entero)</label>
                                                                        <input type="number" class="form-control" value="<?= $t->h_fin_no_operar ?>" name="hora_fin">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Aceptar </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    </div>


    <!-- ============================================================== -->

    <!-- End contain-fluid  -->