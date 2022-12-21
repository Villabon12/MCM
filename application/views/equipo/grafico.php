<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>
    .imgRedonda {
        width: 160px;
        height: 160px;
        border-radius: 160px;
        border: 5px solid #666;
    }
</style>
<!-- PRINCIPAL -->
<?php if ($principal != (null)) { ?>

    <?php if ($principal->img_p == (NULL)) {
        $idp = $principal->id_p;
        $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
        $principalp = "usuario.png";
    } else {
        $idp = $principal->id_p;
        $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
        $principalp = $principal->img_p;
    } ?>
<?php } else {
    $idp = 0;
    $nombrep = "No hay nada";
    $principalp = "maxresdefault.jpg";
} ?>
<?php if ($principal != (null)) { ?>

    <!-- derecha principal -->
    <?php if ($principal->img_d == (NULL)) {
        $idpd = $principal->r_d;
        $nombred = $principal->nombre_d . " " . $principal->apellido_d;
        $principalde = "usuario.png";
    } else {
        $idpd = $principal->r_d;
        $nombred = $principal->nombre_d . " " . $principal->apellido_d;
        $principalde = $principal->img_d;
    } ?>
<?php } else {
    $idpd = 0;
    $nombred = "No hay nada";
    $principalde = "maxresdefault.jpg";
} ?>
<?php if ($izquierdap != (null)) { ?>

    <!-- izquierda principal -->
    <?php if ($izquierdap->img_d == (NULL)) {
        $idpi = $izquierdap->r_d;
        $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
        $principaliz = "usuario.png";
    } else {
        $idpi = $izquierdap->r_d;
        $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
        $principaliz = $izquierdap->img_d;
    } ?>
<?php } else {
    $idpi = 0;
    $nombreiz = "No hay nada";
    $principaliz = "maxresdefault.jpg";
} ?>
<!-- DERECHA derecha-->
<?php if ($derecha != (null)) { ?>
    <?php if ($derecha->img_d == (NULL)) {
        $idpdd = $derecha->r_d;
        $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
        $derechade = "usuario.png";
    } else {
        $idpdd = $derecha->r_d;
        $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
        $derechade = $derecha->img_d;
    } ?>
<?php } else {
    $idpdd = 0;
    $nombrede = "No hay nada";
    $derechade = "maxresdefault.jpg";
} ?>
<!-- DERECHA izquierda -->
<?php if ($derechai != (null)) { ?>
    <?php if ($derechai->img_d == (NULL)) {
        $idpdi = $derechai->r_d;
        $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
        $derechaiz = "usuario.png";
    } else {
        $idpdi = $derechai->r_d;
        $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
        $derechaiz = $derechai->img_d;
    } ?>
<?php } else {
    $idpdi = 0;
    $nombreiz2 = "No hay nada";
    $derechaiz = "maxresdefault.jpg";
} ?>
<!-- IZQUIERDA derecha -->
<?php if ($izquierda != null) { ?>
    <?php if ($izquierda->img_d == (NULL)) {
        $idpid = $izquierda->r_d;
        $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
        $fotoizd = "usuario.png";
    } else {
        $idpid = $izquierda->r_d;
        $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
        $fotoizd = $izquierda->img_d;
    } ?>
<?php } else {
    $idpid = 0;
    $nombreizq = "No hay nada";
    $fotoizd = "maxresdefault.jpg";
} ?>
<!-- IZQUIERDA izquierda -->
<?php if ($izquierdad != null) { ?>
    <?php if ($izquierdad->img_d == (NULL)) {
        $idpii = $izquierdad->r_d;
        $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
        $fotoizi = "usuario.png";
    } else {
        $idpii = $izquierda->r_d;

        $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
        $fotoizi = $izquierdad->img_d;
    } ?>
<?php } else {
    $idpii = 0;

    $nombreder = "No hay nada";
    $fotoizi = "maxresdefault.jpg";
} ?>


<div class="col-md-12 grid-margin stretch-card">

    <center>
        <div class="container">
            <a href="<?= base_url() ?>Grafico/<?= $idp  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalp  ?>' class='imgRedonda' /></a>
        </div>
        <div class="container">
            <a href="<?= base_url() ?>Grafico/<?= $idpi  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principaliz  ?>' class='imgRedonda' /></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;
            <a href="<?= base_url() ?>Grafico/<?= $idpd  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalde  ?>' class='imgRedonda' /></a>

        </div>

        <div class="container">
            <a href="<?= base_url() ?>Grafico/<?= $idpii  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizi  ?>' class='imgRedonda' /></a>
            <a href="<?= base_url() ?>Grafico/<?= $idpid  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizd  ?>' class='imgRedonda' /></a>
            <a href="<?= base_url() ?>Grafico/<?= $idpdi  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechaiz  ?>' class='imgRedonda' /></a>
            <a href="<?= base_url() ?>Grafico/<?= $idpdd  ?>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechade  ?>' class='imgRedonda' /></a>

        </div>

        <br>
        <br>
        <a class="btn btn-success" href="<?= base_url() ?>MCM">Regresar</a>
    </center>
</div>
</div>