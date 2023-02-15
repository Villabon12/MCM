<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">


        <!-- ============================================================== -->

        <!-- Container fluid  -->

        <!-- ============================================================== -->

        <br><br>
        <div class="col-12">
            <center>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Añadir Fondeo</button>
            </center>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">

                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi    mdi-checkbox-multiple-blank-circle-outline"></i> Fecha
                                            </th>

                                            <th><i class="mdi mdi-cash"></i> Usuario</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Valor</th>

                                            <th><i class="mdi mdi-basket-unfill"></i>Beneficio</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($reportes as $t) { ?>
                                        <td><?=$t->fecha?></td>
                                        <td><?=$t->user?></td>
                                        <td><?=$t->valor?></td>
                                        <td><?=$t->papa?> <?=$t->papap?></td>


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


    <!-- Modal añadir -->

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Scalping/fondoScalping" class="forms-sample" method="post"
                    enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Usuario: </label>
                            <select class="form-control" name="usuario">
                                <?php foreach($usuarios as $u){ ?>
                                    <option value="<?=$u->id?>"><?=$u->nombre?> <?=$u->apellido1?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Valor: </label>
                            <input type="text" class="form-control" name="valor" placeholder="Valor">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        <button type="submit" style="background-color: #36E1F9;" class="btn ">Insertar</button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- ============================================================== -->

    <!-- End contain-fluid  -->