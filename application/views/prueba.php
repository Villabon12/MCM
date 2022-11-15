<div class="main-panel">
    <div class="content-wrapper">
        <style>
            .imgRedonda {
                width: 75px;
                height: 75px;
                border-radius: 160px;
                border: 5px solid #666;
            }
        </style>
        <!-- PRINCIPAL -->
        <?php if ($principal->img_p == (NULL)) {
            $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
            $principalp = "usuario.png";
        } else {
            $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
            $principalp = $principal->img_p;
        } ?>
        <!-- derecha principal -->
        <?php if ($principal->img_d == (NULL)) {
            $nombred = $principal->nombre_d . " " . $principal->apellido_d;
            $principalde = "usuario.png";
        } else {
            $nombred = $principal->nombre_d . " " . $principal->apellido_d;
            $principalde = $principal->img_d;
        } ?>

        <!-- izquierda principal -->
        <?php if ($izquierdap->img_d == (NULL)) {
            $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
            $principaliz = "usuario.png";
        } else {
            $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
            $principaliz = $izquierdap->img_d;
        } ?>
        <!-- DERECHA derecha-->
        <?php if ($derecha != (null)) { ?>
            <?php if ($derecha->img_d == (NULL)) {
                $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
                $derechade = "usuario.png";
            } else {
                $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
                $derechade = $derecha->img_d;
            } ?>
        <?php } else {
            $nombrede = "No hay nada";
            $derechade = "maxresdefault.jpg";
        } ?>
        <!-- DERECHA izquierda -->
        <?php if ($derechai != (null)) { ?>
            <?php if ($derechai->img_d == (NULL)) {
                $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
                $derechaiz = "usuario.png";
            } else {
                $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
                $derechaiz = $derechai->img_d;
            } ?>
        <?php } else {
            $nombreiz2 = "No hay nada";
            $derechaiz = "maxresdefault.jpg";
        } ?>
        <!-- IZQUIERDA derecha -->
        <?php if ($izquierda != (null)) { ?>
            <?php if ($izquierda->img_d == (NULL)) {
                $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
                $fotoizd = "usuario.png";
            } else {
                $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
                $fotoizd = $izquierda->img_d;
            } ?>
        <?php } else {
            $nombreizq = "No hay nada";
            $fotoizd = "maxresdefault.jpg";
        } ?>
        <!-- IZQUIERDA izquierda -->
        <?php if ($izquierdad != (null)) { ?>
            <?php if ($izquierdad->img_d == (NULL)) {
                $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
                $fotoizi = "usuario.png";
            } else {
                $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
                $fotoizi = $izquierdad->img_d;
            } ?>
        <?php } else {
            $nombreder = "No hay nada";
            $fotoizi = "maxresdefault.jpg";
        } ?>


        <center>
            <div class="container">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalp  ?>' class='imgRedonda' />
            </div>
            <div class="container">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalde  ?>' class='imgRedonda' />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principaliz  ?>' class='imgRedonda' />
            </div>

            <div class="container">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechade  ?>' class='imgRedonda' />
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechaiz  ?>' class='imgRedonda' />
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizd  ?>' class='imgRedonda' />
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizi  ?>' class='imgRedonda' />
            </div>

        </center>
    </div>