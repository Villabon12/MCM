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
                        <div class="cc-icon align-self-center"><i class="fas fa-address-card auni coloramarillo" title="Ofertar Activos"></i></div>
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
                <a class="btn btn-dark" download="reportes.txt" href="<?= base_url() ?>txt/datosbot.txt">Descargar txt</a>
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

                                            <th><i class="mdi    mdi-checkbox-multiple-blank-circle-outline"></i> Fecha</th>

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

                                            <tr>

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

                                        <?php } ?>





                                    </tbody>

                                </table>

                            </div>
                        </div>

                    </div>



                </div>


                <!-- ============================================================== -->

                <!-- End contain-fluid  -->