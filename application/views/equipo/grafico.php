<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

<?php if ($principal->img_p == (null)) {
    $idp = $principal->id_p;
    $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
    $principalp = "usuario.png";
    $enlace = base_url()."Grafico/".$idp;
} else {
    $idp = $principal->id_p;
    $nombrep = $principal->nombre_p . " " . $principal->apellido_p;
    $principalp = $principal->img_p;
    $enlace = base_url()."Grafico/".$idp;

} ?>
<?php } else {
    $idp = 0;
    $nombrep = "No hay nada";
    $principalp = "maxresdefault.jpg";
    $enlace = "#";

} ?>
<?php if ($principal != (null)) { ?>

<!-- derecha principal -->
<?php if ($principal->img_d == (null)) {
    $idpd = $principal->r_d;
    $nombred = $principal->nombre_d . " " . $principal->apellido_d;
    $principalde = "usuario.png";
    $enlace1 = base_url()."Grafico/".$idpd ;
} else {
    $idpd = $principal->r_d;
    $nombred = $principal->nombre_d . " " . $principal->apellido_d;
    $principalde = $principal->img_d;
    $enlace1 = base_url()."Grafico/".$idpd ;

} ?>
<?php } else {
    $idpd = 0;
    $nombred = "No hay nada";
    $principalde = "maxresdefault.jpg";
    $enlace1 = '#';

} ?>
<?php if ($izquierdap != (null)) { ?>

<!-- izquierda principal -->
<?php if ($izquierdap->img_d == (null)) {
    $idpi = $izquierdap->r_d;
    $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
    $principaliz = "usuario.png";
    $enlace2 =  base_url()."Grafico/".$idpi;
} else {
    $idpi = $izquierdap->r_d;
    $nombreiz = $izquierdap->nombre_d . " " . $izquierdap->apellido_d;
    $principaliz = $izquierdap->img_d;
    $enlace2 =  base_url()."Grafico/".$idpi;
} ?>
<?php } else {
    $idpi = 0;
    $nombreiz = "No hay nada";
    $principaliz = "maxresdefault.jpg";
    $enlace2 = '#';
} ?>
<!-- DERECHA derecha-->
<?php if ($derecha != (null)) { ?>
<?php if ($derecha->img_d == (null)) {
    $idpdd = $derecha->r_d;
    $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
    $derechade = "usuario.png";
    $enlace3 =  base_url()."Grafico/".$idpdd;
} else {
    $idpdd = $derecha->r_d;
    $nombrede = $derecha->nombre_d . " " . $derecha->apellido_d;
    $derechade = $derecha->img_d;
    $enlace3 =  base_url()."Grafico/".$idpdd;
} ?>
<?php } else {
    $idpdd = 0;
    $nombrede = "No hay nada";
    $derechade = "maxresdefault.jpg";
    $enlace3 =  '#';
} ?>
<!-- DERECHA izquierda -->
<?php if ($derechai != (null)) { ?>
<?php if ($derechai->img_d == (null)) {
    $idpdi = $derechai->r_d;
    $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
    $derechaiz = "usuario.png";
    $enlace4 =  base_url()."Grafico/".$idpdi;
} else {
    $idpdi = $derechai->r_d;
    $nombreiz2 = $derechai->nombre_d . " " . $derechai->apellido_d;
    $derechaiz = $derechai->img_d;
    $enlace4 =  base_url()."Grafico/".$idpdi;
} ?>
<?php } else {
    $idpdi = 0;
    $nombreiz2 = "No hay nada";
    $derechaiz = "maxresdefault.jpg";
    $enlace4 =  '#';
} ?>
<!-- IZQUIERDA derecha -->
<?php if ($izquierda != null) { ?>
<?php if ($izquierda->img_d == (null)) {
    $idpid = $izquierda->r_d;
    $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
    $fotoizd = "usuario.png";
    $enlace5 =  base_url()."Grafico/".$idpid;
} else {
    $idpid = $izquierda->r_d;
    $nombreizq = $izquierda->nombre_d . " " . $izquierda->apellido_d;
    $fotoizd = $izquierda->img_d;
    $enlace5 =  base_url()."Grafico/".$idpid;
} ?>
<?php } else {
    $idpid = 0;
    $nombreizq = "No hay nada";
    $fotoizd = "maxresdefault.jpg";
    $enlace5 = '#';
} ?>
<!-- IZQUIERDA izquierda -->
<?php if ($izquierdad != null) { ?>
<?php if ($izquierdad->img_d == (null)) {
    $idpii = $izquierdad->r_d;
    $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
    $fotoizi = "usuario.png";
    $enlace6 =  base_url()."Grafico/".$idpii;
} else {
    $idpii = $izquierda->r_d;
    $nombreder = $izquierdad->nombre_d . " " . $izquierdad->apellido_d;
    $fotoizi = $izquierdad->img_d;
    $enlace6 =  base_url()."Grafico/".$idpii;
} ?>
<?php } else {
    $idpii = 0;
    $nombreder = "No hay nada";
    $fotoizi = "maxresdefault.jpg";
    $enlace6 =  '#';
} ?>


<div class="col-md-12 grid-margin stretch-card">

    <center>
        <div class="container">
            <a href='#' data-bs-toggle="popover" title="<?=$nombrep?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalp  ?>' class='imgRedonda' /></a>
        </div>
        <div class="container">
            <a href='#' data-bs-toggle="popover" title="<?=$nombreiz?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace2?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principaliz  ?>' class='imgRedonda' /></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;
            <a href='#' data-bs-toggle="popover" title="<?=$nombred?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace1?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $principalde  ?>' class='imgRedonda' /></a>

        </div>

        <div class="container">
            <a href='#' data-bs-toggle="popover" title="<?=$nombreder?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace6?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizi  ?>' class='imgRedonda' /></a>
            <a href='#' data-bs-toggle="popover" title="<?=$nombreizq?>" data-bs-html="true"
                data-bs-content="<a href='<?= $enlace5 ?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $fotoizd  ?>' class='imgRedonda' /></a>
            <a href='#' data-bs-toggle="popover" title="<?=$nombreiz2?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace4?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechaiz  ?>' class='imgRedonda' /></a>
            <a href='#' data-bs-toggle="popover" title="<?=$nombrede?>" data-bs-html="true"
                data-bs-content="<a href='<?=$enlace3?>' class='btn btn-success'>Ver</a>">
                <img src='<?= base_url() ?>assets/img/fotosPerfil/<?= $derechade  ?>' class='imgRedonda' /></a>

        </div>

        <br>
        <br>
        <a class="btn btn-info" href="<?= base_url() ?>Grafico/<?=$perfil2->id?>">Principio</a>
        <a class="btn btn-success" href="<?= base_url() ?>MCM">Regresar</a>
    </center>
</div>

<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind
            2022</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->

<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>admin_temp/js/off-canvas.js"></script>
<script src="<?= base_url() ?>admin_temp/js/misc.js"></script>
<script src="<?= base_url() ?>admin_temp/js/file-upload.js"></script>
<script src="<?= base_url() ?>admin_temp/js/settings.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/clipboard/clipboard.min.js"></script>

<script src="<?= base_url() ?>admin_temp/js/dashboard.js"></script>
<!-- End custom js for this page -->

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<script src="<?= base_url() ?>admin_temp/js/popover.js"></script>
<!-- End custom js for this page -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
