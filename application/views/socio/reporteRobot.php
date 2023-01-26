<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">


        <!-- ============================================================== -->

        <!-- Container fluid  -->

        <!-- ============================================================== -->
        <center>
            <div class="col-lg-6 col-md-6 ppbtn">
                <div class="card cc-widget">

                    <button class="buttomo">
                        <div class="cc-icon align-self-center"><i class="fas fa-address-card auni coloramarillo"
                                title="Ofertar Activos"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 amar">REPORTES ROBOT</h4>
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
        <div class="col-12">
            <center>
                <a class="btn btn-dark" download="reportes.txt" href="<?= base_url() ?>txt/datosbot.txt">Descargar
                    txt</a>
                <?php if ($Encender->valor2 == 1) { ?>
                    <a class="btn btn-inverse-info" href="<?= base_url() ?>Binaria/configuracion/0">Robot Encendido</a>
                <?php }else{ ?>
                    <a class="btn btn-inverse-danger" href="<?= base_url() ?>Binaria/configuracion/1">Robot Apagado</a>
                <?php } ?>

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Insertar reporte</button>
            </center>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reporte Robots</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="table-responsive">

                                <table id="order-listing" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="theadaos">

                                        <tr>

                                            <th><i class="mdi    mdi-checkbox-multiple-blank-circle-outline"></i> Fecha
                                            </th>

                                            <th><i class="mdi mdi-cash"></i> Señal</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Mercado</th>

                                            <th><i class="mdi mdi-basket-unfill"></i> Saldo anterior</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Saldo actual</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Porcentaje</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Diferencia</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Valor entrada</th>

                                            <th><i class="mdi mdi-cash-multiple"></i> Valor salida</th>
                                            <th><i class="mdi mdi-cash-multiple"></i> Estrategia</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($reportes as $t) { ?>

                                        <?php if (($t->saldo_final - $t->saldo_inicial) < 0) { ?>
                                        <tr style="color: red;">

                                            <td><?= $t->fecha ?></td>

                                            <td><?= $t->señal ?></td>

                                            <td><?= $t->mercado ?></td>

                                            <td><?= $t->saldo_inicial ?></td>

                                            <td><?= $t->saldo_final ?></td>
                                            <td><?= $t->porcentajeregistrado ?>%</td>

                                            <td><?= $t->saldo_final - $t->saldo_inicial ?></td>

                                            <td><?= $t->precio_entrada ?></td>

                                            <td><?= $t->precio_salida ?></td>
                                            <td><?= $t->estrategia ?></td>

                                        </tr>
                                        <?php  } else { ?>
                                        <tr style="color: blue;">

                                            <td><?= $t->fecha ?></td>

                                            <td><?= $t->señal ?></td>

                                            <td><?= $t->mercado ?></td>

                                            <td><?= $t->saldo_inicial ?></td>

                                            <td><?= $t->saldo_final ?></td>
                                            <td><?= $t->porcentajeregistrado ?>%</td>

                                            <td><?= $t->saldo_final - $t->saldo_inicial ?></td>

                                            <td><?= $t->precio_entrada ?></td>

                                            <td><?= $t->precio_salida ?></td>
                                            <td><?= $t->estrategia ?></td>

                                        </tr>
                                        <?php }  ?>



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
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Balance mensual General</label>
                        <input type="text" class="form-control" value="<?= number_format($balanceTotalMes->resta, 2) ?>"
                            disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="">Balance mensual repartido a cliente</label>
                        <input type="text" class="form-control"
                            value="<?= number_format($balanceMensualRepartido->repartir, 2) ?>" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="">Utilidad mensual Empresa</label>
                        <input type="text" class="form-control"
                            value="<?= number_format($balanceTotalMes->resta - $balanceMensualRepartido->repartir, 2) ?>"
                            disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal añadir -->

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form action="<?= base_url() ?>Ultra/insertReporte" class="forms-sample" method="post" enctype="multipart/form-data">

                    <div class="modal-header">

                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir</h1>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Señal: </label>
                            <input type="text" class="form-control" name="senal" placeholder="Put o Call">
                        </div>
                        <div class="form-group">
                            <label for="">Mercado: </label>
                            <input type="text" class="form-control" name="mercado" placeholder="EURUSD o Cualquiera">
                        </div>
                        <div class="form-group">
                            <label for="">Saldo inicial: </label>
                            <input type="text" class="form-control" name="saldo_inicial" placeholder="Valor inicial del capital (Antes operar)">
                        </div>
                        <div class="form-group">
                            <label for="">Saldo final: </label>
                            <input type="text" class="form-control" name="saldo_final" placeholder="Valor final del capital (Despues operar)">
                        </div>
                        <div class="form-group">
                            <label for="">Porcentaje Registrado: </label>
                            <input type="text" class="form-control" name="porcentaje"
                                placeholder="Porcentaje que reparte broker">
                        </div>
                        <div class="form-group">
                            <label for="">Precio entrada: </label>
                            <input type="text" class="form-control" name="precio_entrada" placeholder="Precio donde entró la operación">
                        </div>
                        <div class="form-group">
                            <label for="">Precio salida: </label>
                            <input type="text" class="form-control" name="precio_salida" placeholder="Preció donde salió la operación">
                        </div>
                        <div class="form-group">
                            <label for="">Monto Apostado: </label>
                            <input type="text" class="form-control" name="porcentaje_a" placeholder="Monto apostado">
                        </div>
                            <input type="hidden" class="form-control" value="6" name="tipo" placeholder="tipo">
                        <div class="form-group">
                            <label for="">Estado: </label> 
                            <input type="text" class="form-control" name="estado" placeholder="Activo = 1; Inactivo = 0">
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