<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Connect Mind</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />
</head>

<body>
    <div class="container-scroller">
        <?php if ($perfil->img_perfil == (NULL)) {

      $perfil->img_perfil = "usuario.png";
    } else {

      $perfil->img_perfil = $perfil->img_perfil;
    } ?>

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo">
                    <img src="<?= base_url() ?>images/myconnect/encabezado2.png" alt="logo" class="logo-dark" />
                </a>
                <a class="navbar-brand brand-logo-mini"><img style="width: 100px;"
                        src="<?= base_url() ?>images/myconnect/encabezado2.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Bienvenido <?= $perfil->nombre ?>
                    <?= $perfil->apellido1 ?></h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">

                    <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a>Peticiones
                    </li>

                    <li class="nav-item dropdown dropdown d-xl-inline-flex ">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle ms-2"
                                src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle"
                                    src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil  ?>"
                                    width="100" height="100">
                                <p class="mb-1 mt-3"><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></p>
                                <p class="font-weight-light text-muted mb-0"><?= $perfil->correo ?></p>
                            </div>

                            <a class="dropdown-item" href="<?= base_url() ?>Login/session_dest"><i
                                    class="dropdown-item-icon icon-power text-primary"></i>Cerrar Sesion</a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category"><span class="nav-link">Dashboard</span></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="<?= base_url() ?>Investor">
                            <span class="menu-title">Inicio</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item nav-category"><span class="nav-link">Equipo</span></li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#Equipo" aria-expanded="false"
                            aria-controls="Equipo">
                            <span class="menu-title">Equipo</span>
                            <i class=" icon-people menu-icon"></i>
                        </a>
                        <div class="collapse" id="Equipo">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="<?= base_url() ?>Investor/comisiones">Comisiones historial</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>