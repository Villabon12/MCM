<!-- partial -->
<?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-lg 12">

                <div class="card">

                    <div class="card-body">

                        <center>

                            <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>

                            <h1>Espera un momento</h1>

                            <h2>Valida tus datos primero</h2>

                            <a href="<?= base_url() ?>Perfil" type="button" class="btn btn-success  ">validar</a>

                        </center>

                    </div>

                </div>

            </div>
        </div>
    </div>
<?php } else { ?>



    <?php if ($activo == 0) { ?>
        <div class="main-panel">
            <?php if ($this->session->flashdata("error")) { ?>

                <p><?php echo $this->session->flashdata("error") ?></p>

            <?php } ?>
            <?php if ($this->session->flashdata("exito")) { ?>

                <p><?php echo $this->session->flashdata("exito") ?></p>

            <?php } ?>

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="col-md-12">
                                    <form action="<?= base_url() ?>Binaria/comprarBinaria/<?= $perfil->token ?>" method="post">
                                        <h1 class="text-center">Robot Binaria</h1>
                                        <center>
                                            <p>Adquiere el servicio por una pequeña compra</p>
                                            <select aria-label="Default select example" style="width:450px" class="text-center" id="robot" name="robot" required>
                                                <option selected>Selecciona Valor</option>
                                                <?php foreach ($servicio as $s) { ?>
                                                    <option value="<?= $s->id ?>"><?= $s->descripcion ?> $<?= $s->precio ?></option>
                                                <?php } ?>
                                            </select>
                                            <button type="submit" class="btn btn-success" name="servicio">comprar</button>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <style>
            .tamaño {
                position: relative;
                width: 40%;
                padding-right: 10px;
                padding-left: 10px;
            }
            .tamaño2 {
                position: relative;
                width: 100%;
                padding-right: 10px;
                padding-left: 10px;
            }
            
        </style>
        <div class="main-panel">
            <?php if ($this->session->flashdata("error")) { ?>

                <p><?php echo $this->session->flashdata("error") ?></p>

            <?php } ?>
            <?php if ($this->session->flashdata("exito")) { ?>

                <p><?php echo $this->session->flashdata("exito") ?></p>

            <?php } ?>

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="col-md-12">
                                    <form action="<?= base_url() ?>Binaria/invertirBinaria/<?= $perfil->token ?>" method="post">
                                        <h1 class="text-center">Robot Binaria</h1>
                                        <center>
                                            <p>Inversion</p>
                                            <input type="number" class="form-control" placeholder="Valor a invertir" name="inversion"><br>
                                            <button type="submit" class="btn btn-success" name="servicio">Invertir</button>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Inversion</h4>
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Inversion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($inversion as $B) { ?>

                                                <tr>
                                                    <td><?= $B->fecha ?></td>
                                                    <td><?= $B->inversion ?></td>

                                                </tr>

                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <td>Total: </td>
                                                <td><?= number_format($total->total, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Balance día: </td>
                                                <td><?= number_format($ganancia->ganancia - $perdida->perdida, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Beneficio hoy: </td>
                                                <td><?= number_format($ganancia->ganancia, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Perdida hoy: </td>
                                                <td><?= number_format($perdida->perdida, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deposito: </td>
                                                <td><?= number_format($deposito->deposito, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Retiro: </td>
                                                <td><?= number_format($retiro->retiro, 2) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 tamaño2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body performane-indicator-card">

                                <?php if ($perfil->id == '11') { ?>
                                    <?php if (count($inversion) >= 1) { ?>
                                        <?php foreach ($reportes as $r) { ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php if ($r->senal == 'PUT') { ?>
                                                        <p>VENDER, <?= $r->mercado ?></p>
                                                    <?php } else { ?>
                                                        <p>COMPRAR, <?= $r->mercado ?></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <p style="font-size: 12.9375px;"><?= $r->fecha ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p style="font-size: 11.9375px;"><?= $r->saldo_entra ?> => <?= $r->saldo_sale ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php if ($r->tipoxuser == 'ganancia') { ?>
                                                        <p style="color: blue;"><?= $r->gananciaxuser ?></p>
                                                    <?php } else { ?>
                                                        <p style="color: red;"><?= $r->gananciaxuser ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <br>

                                        <?php } ?>

                                    <?php } else { ?>

                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                        <td>ROBOT INICIA DESDE EL 16 NOVIEMBRE, ESPERANOS CON PACIENCIA</td>
                                        <td></td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    <?php } ?>


    <!-- FIN PARTIAL -->