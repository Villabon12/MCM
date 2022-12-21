        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                

                <?php if ($perfil->img_selfie == (NULL) || $perfil->img_cedula_back == (NULL) || $perfil->img_cedula_front == (NULL)) { ?>

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

                <?php } else { ?>
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

                                                <h2 class="m-b-0"><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h2>
                                                <p class=" m-b-0"><?= $perfil->correo ?></p>
                                                <p class="m-b-0">Numero Referir: <?= $perfil->id ?></p>
                                                <h4>tu equipo:</h4>

                                                <div class="table-responsive">

                                                    <table class="table" id="order-listing">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"># referir</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellido</th>
                                                                <th scope="col">Celular</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($team as $B) { ?>

                                                                <tr>
                                                                    <td><?php echo $B->id ?></td>
                                                                    <td><?php echo $B->nombre ?></td>
                                                                    <td><?php echo $B->apellido1 ?></td>
                                                                    <td><?php echo $B->celular ?></td>
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

                            <!-- <div class="card">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <h4>Tu equipo derecha:</h4>

                                                <div class="table-responsive">

                                                    <table class="table" id="order-listing">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"># referir</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellido</th>
                                                                <th scope="col">Celular</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($team as $B) { ?>

                                                                <tr>
                                                                    <td><?php echo $B->id ?></td>
                                                                    <td><?php echo $B->nombre ?></td>
                                                                    <td><?php echo $B->apellido1 ?></td>
                                                                    <td><?php echo $B->celular ?></td>
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

                            </div> -->


                            <div class="content-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex no-block flex-row">
                                                    <h3>proximo ingreso ubicarlo en : <?= $perfil->ubicacion ?> </h3>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificarregistro<?= $perfil->id ?>">
                                                        cambiar
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modificarregistro<?= $perfil->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de cambiar de lado ?</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <form action="<?= base_url() ?>Equipo/modificarUbica/<?= $perfil->token ?> " method="post">
                                                                    <div class="modal-body">
                                                                        <p>cambiar a <?php if ($perfil->ubicacion == "izquierda") { ?>Derecha<?php } else { ?>izquierda <?php } ?></p>
                                                                        <input type="hidden" value="<?= $perfil->ubicacion ?>" name="ubica" readonly>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary">Aceptar </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4> Link para incribir Usuarios. </h4>

                                                <a href="<?= base_url() ?>Registrar/<?= $perfil->id ?>" target="_blank"><?= base_url() ?>Registrar/<?= $perfil->id ?></a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <a href="<?= base_url() ?>Grafico/<?=$perfil->id?>" class="btn btn-info">Ver Arbol binario</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>


                        </div>

                    <?php } ?>
                    </div>
                    <!-- FIN PARTIAL -->