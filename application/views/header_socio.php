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
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/style.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
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
        <a class="navbar-brand brand-logo-mini"><img style="width: 100px;" src="<?= base_url() ?>images/myconnect/encabezado2.png" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Bienvenido <?= $perfil->nombre ?> <?= $perfil->apellido1 ?></h5> 
        <ul class="navbar-nav navbar-nav-right ml-auto">
          <a style="color:black;" href="<?=base_url()?>Socios/generar_imagen/<?= $perfil->id ?>"><h6 style="    padding-left: 8px;">Ganancia total $<?= $valor ?> USDT</h6></a>

          <!-- <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a>Peticiones</li> -->
          <li class="nav-item dropdown">
              <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-speech icon-lg"></i>
                <span class="count">1</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="<?=base_url()?>Modulo/Videos/1">
                  <div class="preview-thumbnail" style="background-color: black;">
                    <img src="<?=base_url()?>images/LOGO.png" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Million Team</p>
                    <p class="font-weight-light small-text"> Subió un video </p>
                  </div>
                </a>
                
              </div>
            </li>

          <li class="nav-item dropdown dropdown d-xl-inline-flex ">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle ms-2" src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil  ?>" width="100" height="100">
                <p class="mb-1 mt-3"><?= $perfil->nombre ?> <?= $perfil->apellido1 ?></p>
                <p class="font-weight-light text-muted mb-0"><?= $perfil->correo ?></p>
              </div>
              <a class="dropdown-item" href="<?= base_url() ?>Perfil"><i class="dropdown-item-icon icon-user text-primary"></i> Mi Perfil</a>

              <a class="dropdown-item" href="<?= base_url() ?>Login/session_dest"><i class="dropdown-item-icon icon-power text-primary"></i>Cerrar Sesion</a>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <?php if ($perfil->tipo == 'Ultra') { ?>
            <li class="nav-item nav-category"><span class="nav-link">Ultra</span></li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="<?= base_url() ?>Configuraciones">
                <span class="menu-title">Parametros en general</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="<?= base_url() ?>Ticket/empresa">
                <span class="menu-title">Tickets</span>
                <i class=" icon-bubbles menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#activar" aria-expanded="false" aria-controls="activar">
                <span class="menu-title">Activacion servicios</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="activar">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Ultra/servicio_binaria">Robot de binaria</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#puzzle" aria-expanded="false" aria-controls="puzzle">
                <span class="menu-title">Puzzle</span>
                <i class=" icon-game-controller menu-icon"></i>
              </a>
              <div class="collapse" id="puzzle">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/administracion">Administracion Puzzle</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/acumuladoValor">Gastos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/parametros_general">Parametro General</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#modulosa" aria-expanded="false" aria-controls="puzzle">
                <span class="menu-title">Modulo</span>
                <i class=" icon-game-controller menu-icon"></i>
              </a>
              <div class="collapse" id="modulosa">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo/Administracion">Administracion Modulo</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Validaciones</span></li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#validar" aria-expanded="false" aria-controls="validar">
                <span class="menu-title">Validaciones</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="validar">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Banco/consignaciones_user">Validar consignacion</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/inversionValidar">Validar Inversion binaria</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Socios/validarRetiroBinaria">Validar Retiros Binaria</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Socios/validarRetiros">Validar Retiros Billetera principal</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">Estrategias</span></li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#estrategia" aria-expanded="false" aria-controls="estrategia">
                <span class="menu-title">Estrategia</span>
                <i class=" icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="estrategia">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Estrategia">Funcionamiento</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Estrategia/parametros">Parametro</a></li>
                </ul>
              </div>
            </li>
          <?php } ?>

          <?php if ($perfil->tipo == 'SocioAdmin' || $perfil->tipo == 'Ultra') { ?>
            <li class="nav-item nav-category"><span class="nav-link">Reportes</span></li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <span class="menu-title">Reportes Binaria</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/reportesRobot">Reportes Robot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/parametroBinaria">Parametros Robot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/disponibilidadBinaria">Disponibilidad Robot</a></li>
                </ul>
              </div>
            </li>
          <?php } ?>
          <li class="nav-item nav-category"><span class="nav-link">Dashboard</span></li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="<?= base_url() ?>MCM">
              <span class="menu-title">Inicio</span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>
          <li class="nav-item nav-category"><span class="nav-link">Servicios</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#servicios" aria-expanded="false" aria-controls="servicios">
              <span class="menu-title">Servicios</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="servicios">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria">Servicio binaria</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle">Rompecabeza</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Scalping">Servicio Scalping</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Arbitraje">Servicio Arbitraje</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category"><span class="nav-link">Modulos</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#modulo" aria-expanded="false" aria-controls="modulo">
              <span class="menu-title">Modulos</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="modulo">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo">Videos Apoyo</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo/Libros">Libros</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category"><span class="nav-link">Bancos</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Banco" aria-expanded="false" aria-controls="Banco">
              <span class="menu-title">Banco</span>
              <i class=" icon-diamond menu-icon"></i>
            </a>
            <div class="collapse" id="Banco">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Banco">Banco</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Retiros">Retiros</a></li>
              </ul>
              <?php if ($perfil->tipo == 'Ultra') { ?>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Transferencia">Transferencias</a></li>
                </ul>
              <?php } ?>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Historial">Historial consignaciones</a></li>
              </ul>
            </div>
          </li>

          <!-- <li class="nav-item nav-category"><span class="nav-link">Puzzle</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#puzzle" aria-expanded="false" aria-controls="ticket">
              <span class="menu-title">Puzzle</span>
              <i class="icon-game-controller menu-icon"></i>
            </a>
            <div class="collapse" id="puzzle">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle">Comprar rompecabeza</a></li>
              </ul>
            </div>
          </li> -->

          <li class="nav-item nav-category"><span class="nav-link">Equipo</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Equipo" aria-expanded="false" aria-controls="Equipo">
              <span class="menu-title">Equipo</span>
              <i class=" icon-people menu-icon"></i>
            </a>
            <div class="collapse" id="Equipo">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Equipo">Árbol Referidos</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Comisiones/historial">Comisiones historial</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category"><span class="nav-link">Reportes</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#grafico" aria-expanded="false" aria-controls="grafico">
              <span class="menu-title">Reportes</span>
              <i class=" icon-chart menu-icon"></i>
            </a>
            <div class="collapse" id="grafico">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Reportes">Graficos</a></li>
              </ul>
            </div>
          </li>


          <li class="nav-item nav-category"><span class="nav-link">Ticket</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ticket" aria-expanded="false" aria-controls="ticket">
              <span class="menu-title">Ticket</span>
              <i class="icon-bubbles menu-icon"></i>
            </a>
            <div class="collapse" id="ticket">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Ticket">Crear ticket</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>