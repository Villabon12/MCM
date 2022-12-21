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
                            <h4 class="m-b-0 amar">PARAMETRO ESTRATEGIA</h4>
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
                <h4 class="card-title">Parametro ESTRATEGIA</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">


                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i> Estrategia</th>
                                            <th><i class="mdi mdi-cash"></i>Robot</th>
                                            <th><i class="mdi mdi-cash"></i>Porcentaje</th>
                                            <th><i class="mdi mdi-cash"></i>Lotaje</th>
                                            <th></th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($parametro as $t) { ?>

                                            <tr>

                                                <td><?= $t->estrategia ?></td>
                                                <td><?= $t->robot ?></td>
                                                <td><?= $t->porcentaje * 100 ?>%</td>
                                                <td><?= $t->lotaje * 100 ?>%</td>

                                                <td>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modificarparametro<?= $t->id ?>">Modificar</button>
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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Configuracion por Dia</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">


                                <table id="order-listing5" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i> Dia</th>
                                            <th><i class="mdi mdi-cash"></i>Estrategia</th>
                                            <th><i class="mdi mdi-cash"></i>Hora cierre operacion</th>
                                            <th></th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($dia as $t) { ?>

                                            <tr>

                                                <td><?= $t->dia ?></td>
                                                <td><?= $t->restrategia ?></td>
                                                <td><?= $t->hora ?></td>

                                                <td>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modificarregistro<?= $t->id ?>">Modificar</button>
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
    </div>

    <?php foreach ($parametro as $t) { ?>
        <!-- Modal -->
        <div class="modal fade" id="modificarparametro<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Parametros</h5>
                    </div>

                    <form action="<?= base_url() ?>Estrategia/updEstrategia/<?= $t->id ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group mb-3">

                                <label for="">Valor</label>
                                <input type="number" class="form-control" value="<?= $t->porcentaje ?>" name="valor">

                                <label for="">Lotaje</label>
                                <input type="number" class="form-control" value="<?= $t->lotaje ?>" name="valor">

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
    <?php } ?>

    <?php foreach ($dia as $t) { ?>

        <!-- Modal -->
        <div class="modal fade" id="modificarregistro<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Parametros</h5>
                    </div>

                    <form action="<?= base_url() ?>Estrategia/updDia/<?= $t->id ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group mb-3">

                                <label for="">Valor</label>
                                <input type="number" class="form-control" value="<?= $t->hora ?>" name="valor">
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

    <?php } ?>