<div class="main-panel">
    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>

            <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

            <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Dia de la semana para reportar en estrategia Manual (Rojo está encendido)</h1>
                        <?php foreach ($manual as $s) { ?>
                            <?php if ($s->estado == 0) { ?>
                                <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } else { ?>
                                <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Dia de la semana para reportar en estrategia Automatico (Rojo está encendido)</h1>
                        <?php foreach ($automatico as $s) { ?>
                            <?php if ($s->estado == 0) { ?>
                                <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } else { ?>
                                <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Dia de la semana para reportar en estrategia Telegram (Rojo está encendido)</h1>
                        <?php foreach ($telegram as $s) { ?>
                            <?php if ($s->estado == 0) { ?>
                                <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } else { ?>
                                <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Dia de la semana para reportar en estrategia Quotex (Rojo está encendido)</h1>
                        <?php foreach ($quotex as $s) { ?>
                            <?php if ($s->estado == 0) { ?>
                                <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } else { ?>
                                <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h1>Dia de la semana para reportar en estrategia IQ (Rojo está encendido)</h1>
                        <?php foreach ($iq as $s) { ?>
                            <?php if ($s->estado == 0) { ?>
                                <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } else { ?>
                                <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarDia/<?= $s->id ?>"><?= $s->dia ?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>