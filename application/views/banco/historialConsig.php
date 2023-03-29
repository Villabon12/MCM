        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <?php if ($this->session->flashdata("error")) { ?>

                    <p><?php echo $this->session->flashdata("error") ?></p>

                <?php } ?>
                <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>

                <?php } ?>

                <center><h1>Historial Consignacion</h1> </center>

                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">

                                                <table class="table" id="order-listing">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Apellido</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col">Hash</th>
                                                            <th scope="col">Comprobante</th>
                                                            <th scope="col">Activacion</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($consigna as $B) { ?>

                                                            <tr>
                                                                <td><?= $B->fecha ?></td>
                                                                <td><?= $B->nombre ?></td>
                                                                <td><?= $B->apellido1 ?></td>
                                                                <td>$ <?= number_format($B->valor_inversion, 2) ?></td>
                                                                <td><?= $B->hash ?></td>
                                                                <td><a href="<?= base_url() ?>/assets/img/fotosPerfil/<?= $B->imagen ?>" target="_blank"><?= $B->imagen ?></a></td>
                                                                <td>
                                                                    <?php if ($B->validar == 0) { ?>
                                                                        Espera Aprobacion
                                                                    <?php } else { ?>
                                                                        Consignado
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?= $B->motivo ?>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN PARTIAL -->

            <div class="content-wrapper">
                
                <center><h1>Historial Retiro</h1> </center>
                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">

                                                <table class="table" id="order-listing2">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Apellido</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col">Wallet_binance</th>
                                                            <th scope="col">Comprobante</th>
                                                            <th scope="col">Aprobar</th>
                                                            <th scope="col">Motivo</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($retira as $B) { ?>

                                                            <tr>
                                                                <td><?= $B->fecha ?></td>
                                                                <td><?= $B->nombre ?></td>
                                                                <td><?= $B->apellido1 ?></td>
                                                                <td>$ <?= number_format($B->valor, 2) ?></td>
                                                                <td><?= $B->wallet_binance ?></td>
                                                                <td><a href="<?= base_url() ?>/asset/images/confirmacion/<?= $B->comprobante ?>" target="_blank"><?= $B->comprobante ?></a></td>
                                                                <td>
                                                                    <?php if ($B->aprobar == 0) { ?>
                                                                        Espera Aprobacion
                                                                    <?php } else { ?>
                                                                        Consignado
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?= $B->motivos ?>
                                                                </td>
                                                                <td><a href="<?=base_url()?>Banco/cheque/<?=$B->id?>" class="btn btn-success" target="_blank"><i class="icon-paper-clip"></i></a></td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN PARTIAL -->