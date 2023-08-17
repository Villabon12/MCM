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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
  <style>
    iframe {
      display: block;
      border: none;
      margin: 0;
      padding: 0;
    }

    #tabla_historial_wrapper .dataTables_wrapper .dataTables_paginate .paginate_button {
      background-color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.page-item:not(.disabled) .page-link {
      color: #000;
      background-color: #FFFFFF;
      border-color: #000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.previous.disabled .page-link {
      color: #D0D0D0;
      background-color: #FFFFFF;
      border-color: #D0D0D0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:not(.disabled) {
      background: transparent !important;
      border-color: transparent !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next:not(.disabled) {
      background: transparent !important;
      border-color: transparent !important;
    }

    .dataTables_wrapper .dataTable td,
    .dataTables_wrapper .dataTable th {
      background-color: #ffffff;
      padding: 0;
    }

    table.dataTable {
      border-collapse: collapse;
      border-spacing: 0 !important;
      border: none !important;
    }

    table.dataTable thead th,
    table.dataTable tbody td {
      border: none !important;
    }


    @media (max-width: 576px) {
      .align-self-start {
        align-self: flex-start !important;
      }
    }

    .par {
      text-align: right;
    }

    @media (max-width: 800px) {
      .par {
        text-align: left;
      }
    }

    @media (max-width: 800px) {
      .margenes {
        padding: 20px !important;
      }
    }

    @media (max-width: 800px) {
      .del {
        display: none !important;
      }
    }

    .dataTables_scrollHead {
      display: none !important;
    }

    @media (max-width: 800px) {
      .navbar-nav {
        max-width: 500px;
        margin: 0 auto;
      }

      .navbar-collapse {
        justify-content: center !important;
        text-align: center !important;
      }
    }

    .card-view {
      background-image: url('<?= base_url("images/cube.jpg") ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
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
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Bienvenido
          <?= $perfil->nombre ?>
          <?= $perfil->apellido1 ?>
        </h5>
        <ul class="navbar-nav navbar-nav-right ml-auto">
          <a style="color:black;" href="<?= base_url() ?>Socios/cheque/<?= $perfil->id ?>">
            <h6 style="    padding-left: 8px;">Ganancia total $
              <?= $valor ?> USDT
            </h6>
          </a>

          <!-- <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a>Peticiones</li> -->
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="icon-speech icon-lg"></i>
              <span class="count">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="<?= base_url() ?>Modulo/Videos/1">
                <div class="preview-thumbnail" style="background-color: black;">
                  <img src="<?= base_url() ?>images/LOGO.png" alt="image" class="img-sm profile-pic">
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
                <img class="img-md rounded-circle" src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>" width="100" height="100">
                <p class="mb-1 mt-3">
                  <?= $perfil->nombre ?>
                  <?= $perfil->apellido1 ?>
                </p>
                <p class="font-weight-light text-muted mb-0">
                  <?= $perfil->correo ?>
                </p>
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
              <a class="nav-link" data-bs-toggle="collapse" href="#parametro" aria-expanded="false" aria-controls="parametro">
                <span class="menu-title">Parametros en general</span>
                <i class=" icon-screen-desktop menu-icon"></i>
              </a>
              <div class="collapse" id="parametro">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Configuraciones">Configuraciones</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tickets" aria-expanded="false" aria-controls="tickets">
                <span class="menu-title">Tickets</span>
                <i class=" icon-bubbles menu-icon"></i>
              </a>
              <div class="collapse" id="tickets">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Ticket/empresa">Ticket empresa</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item nav-category"><span class="nav-link">Señales</span></li>

            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#senalBiUl" aria-expanded="false" aria-controls="senalBiUl">
                <span class="menu-title">Servicios Binarias</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="senalBiUl">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Reportes2/Admin">Reportes</a>
                  </li>
                </ul>
              </div>
            </li> -->

            <li class="nav-item nav-category"><span class="nav-link">Servicios</span></li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#activar" aria-expanded="false" aria-controls="activar">
                <span class="menu-title">Servicios Binarias</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="activar">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Ultra/servicio_binaria">Activar</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#scalpingAdmin" aria-expanded="false" aria-controls="activar">
                <span class="menu-title">Servicios Scalping</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="scalpingAdmin">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Scalping/registrar">Añadir fondeo</a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#arbitrajeAdmin" aria-expanded="false"
                aria-controls="activar">
                <span class="menu-title">Servicios Arbitraje</span>
                <i class=" icon-check menu-icon"></i>
              </a>
              <div class="collapse" id="arbitrajeAdmin">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Ultra/servicio_arbitraje">Robot de
                      arbitraje</a></li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#puzzle" aria-expanded="false" aria-controls="puzzle">
                <span class="menu-title">Puzzle</span>
                <i class=" icon-game-controller menu-icon"></i>
              </a>
              <div class="collapse" id="puzzle">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/administracion">Administracion
                      Puzzle</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/acumuladoValor">Gastos</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle/parametros_general">Parametro
                      General</a></li>
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
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo/Administracion">Administracion
                      Modulo</a></li>
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
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Banco/consignaciones_user">Validar
                      consignacion</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/inversionValidar">Validar
                      Inversion binaria</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Socios/validarRetiroBinaria">Validar
                      Retiros Binaria</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Socios/validarRetiros">Validar Retiros
                      Billetera principal</a></li>
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
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Estrategia/parametros">Parametro</a>
                  </li>
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
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/reportesRobot">Reportes
                      Robot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/parametroBinaria">Parametros
                      Robot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria/disponibilidadBinaria">Disponibilidad Robot</a></li>
                </ul>
              </div>
            </li>
          <?php } ?>

          <?php if ($perfil->tipo == 'Editor') { ?>
            <li class="nav-item nav-category"><span class="nav-link">Modulos</span></li>

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#modulosa" aria-expanded="false" aria-controls="puzzle">
                <span class="menu-title">Modulo</span>
                <i class=" icon-game-controller menu-icon"></i>
              </a>
              <div class="collapse" id="modulosa">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo/Administracion">Administracion
                      Modulo</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Modulo/evento">Añadir Evento</a></li>
                </ul>
              </div>
            </li>
          <?php } ?>
          <li class="nav-item nav-category"><span class="nav-link">Dashboard</span></li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="" href="<?= base_url() ?>MCM">
              <span class="menu-title">Inicio</span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>

          <li class="nav-item nav-category"><span class="nav-link">Servicios</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#serviciosMa" aria-expanded="false" aria-controls="serviciosMa">
              <span class="menu-title">Servicios Manuales</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="serviciosMa">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binarias_historial">Señales Binarias</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Reportes2/resumen_forex">Señales Forex</a></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>En_vivo_binarias">En Vivo Binarias</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>En_vivo_forex">En Vivo Forex</a></li> -->
              </ul>
            </div>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#serviciosAu" aria-expanded="false" aria-controls="serviciosAu">
              <span class="menu-title">Servicios Automaticos</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="serviciosAu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Scalping">Servicio Scalping</a></li>
                 <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Arbitraje">Servicio Arbitraje</a></li> 
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Binaria">Servicio binaria</a></li>
              </ul>
            </div>
          </li> -->

          <!-- <li class="nav-item nav-category"><span class="nav-link">MARKETING</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#marketing" aria-expanded="false" aria-controls="marketing">
              <span class="menu-title">Marketing</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="marketing">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>LandingUser/home">Crear Landing</a> </li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>LinkTree/choose">MCMLink</a> </li>
              </ul>
            </div>
          </li> -->

          <!-- <li class="nav-item nav-category"><span class="nav-link">JUEGOS</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#juegos" aria-expanded="false" aria-controls="juegos">
              <span class="menu-title">Juegos</span>
              <i class="icon-size-actual menu-icon"></i>
            </a>
            <div class="collapse" id="juegos">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Puzzle">Rompecabeza</a> </li>
              </ul>
            </div>
          </li> -->

          <li class="nav-item nav-category"><span class="nav-link">Escuela Formación</span></li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#modulo" aria-expanded="false" aria-controls="modulo">
              <span class="menu-title">Escuela</span>
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
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Historial">Historial consignaciones</a>
                </li>
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

          <!-- <li class="nav-item nav-category"><span class="nav-link">Equipo</span></li>

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
                <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>Comisiones/historial">Comisiones
                    historial</a></li>
              </ul>
            </div>
          </li> -->

          <!-- <li class="nav-item nav-category"><span class="nav-link">Reportes</span></li>

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
          </li> -->


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