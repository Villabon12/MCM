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
                            <h4 class="m-b-0 amar">PARAMETRO GENERAL</h4>
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
                <h4 class="card-title">Parametro General</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">


                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i> Descripcion</th>

                                            <th><i class="mdi mdi-cash"></i>Valor</th>
                                            <th></th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($parametro as $t) { ?>

                                            <tr>

                                                <td><?= $t->descripcion ?></td>

                                                <td><?= $t->valor ?></td>

                                                <td>
                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modificarregistro<?= $t->id ?>">Modificar</button>
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modificarregistro<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Parametros</h5>
                                                            </div>

                                                            <form action="<?= base_url() ?>Socios/updGeneral/<?= $t->id ?>" method="post">
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" value="<?= $t->valor ?>" name="valor">
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

    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Costo de servicios</h4>
                <button class="btn btn-success">Añadir Servicio</button>
                <br><br>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">


                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi mdi-checkbox-multiple-blank-circle-outline"></i> Descripcion</th>

                                            <th><i class="mdi mdi-cash"></i>Precio</th>
                                            <th><i class="mdi mdi-cash"></i>Robot</th>
                                            <th><i class="mdi mdi-cash"></i>Dias</th>
                                            <th></th>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($servicios as $t) { ?>

                                            <tr>

                                                <td><?= $t->descripcion ?></td>

                                                <td><?= $t->precio ?></td>
                                                <td><?= $t->robot ?></td>
                                                <td><?= $t->dias ?></td>

                                                <td>
                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modificarCosto<?= $t->id ?>">Modificar</button>
                                                </td>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modificarCosto<?= $t->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modificar Parametros</h5>
                                                            </div>

                                                            <form action="<?= base_url() ?>Socios/updCosto/<?= $t->id ?>" method="post">
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Precio</label>
                                                                        <input type="number" class="form-control" value="<?= $t->precio ?>" name="precio">
                                                                    </div>
                                                                  
                                                                    <div class="form-group mb-3">

                                                                        <label for="">Dias</label>
                                                                        <input type="number" class="form-control" value="<?= $t->dias ?>" name="dias">
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