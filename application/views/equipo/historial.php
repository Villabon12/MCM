        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <?php if ($this->session->flashdata("error")) { ?>

                    <p><?php echo $this->session->flashdata("error") ?></p>

                <?php } ?>
                <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>

                <?php } ?>


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
                                                            <th scope="col">Usuario</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col">Detalle</th>
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($comision as $B) { ?>

                                                            <tr>
                                                                <td><?= $B->fecha ?></td>
                                                                <td><?= $B->user ?></td>
                                                                <td>$ <?= number_format($B->valor, 2) ?></td>
                                                                <td><?= $B->detalle ?></td>
                                                                
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
                </div>
            </div>
            <!-- FIN PARTIAL -->