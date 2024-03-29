<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">



<link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">



<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

<script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>



<!-- DataTable -->

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

<script src="https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"></script>

<!-- Fin DataTable -->



<div class="main-panel">



    <?php if ($perfil->img_perfil == (NULL)) {



        $perfil->img_perfil = "usuario.png";

    } else {



        $perfil->img_perfil = $perfil->img_perfil;

    } ?>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



    <div class="content-wrapper">

        <?php if ($this->session->flashdata("error")) { ?>



            <p>

                <?php echo $this->session->flashdata("error") ?>

            </p>



        <?php } ?>

        <?php if ($this->session->flashdata("exito")) { ?>



            <p>

                <?php echo $this->session->flashdata("exito") ?>

            </p>



        <?php } ?>

        <div class="row">



            <div class="col-12">



                <div class="card">



                    <div class="card-body margenes">
                        <div class="text-center">
                            <h1>Señales Binarias</h1> <br>
                        </div>

                        <br>
                        <center>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay">

                                Adquirir Servicio Señales Binarias VIP

                            </button> <br><br>
                            <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-cols-1 row-cols-md-2 mb-4 text-center"
                                                style="margin-top:2rem ;">
                                                <?php foreach ($paquetes as $p) { ?>
                                                    <div class="col">
                                                        <div class="card text-center" style="margin-top:15px;">
                                                            <div class="card-body">
                                                                <form
                                                                    action="<?= base_url() ?>Reportes2/PayServicioOF/<?= $p->id ?>">
                                                                    <h5 class="card-title">
                                                                        <?= $p->nombre ?>
                                                                    </h5>
                                                                    <p class="card-text">$
                                                                        <?= $p->precio ?> M/o
                                                                    </p>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">comprar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </center>

                        <?php if ($info == null || $info->estado == 0) { ?>

                            <!-- Button Señales Binarias modal -->



                            <center style="margin-top: 15px;">
                                <div class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Cargando...</span>
                                    </div>
                                </div>
                            </center>

                            <!-- Modal -->

                            <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent"
                                style="padding: 0; margin-bottom: 20px;">

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                                    <span class="navbar-toggler-icon"></span>

                                </button>

                                <div class="collapse navbar-collapse" id="navbarNav">

                                    <ul class="navbar-nav">

                                        <li class="nav-item">

                                            <a class="nav-link" href="<?= base_url() ?>Binarias_historial"
                                                style="font-size: 20px;">Historial</a>

                                        </li>

                                        <li class="nav-item active">

                                            <a class="nav-link" href="<?= base_url() ?>Binarias_iq"
                                                style="font-size: 20px;">IQ</a>

                                        </li>

                                    </ul>

                                </div>

                            </nav>
                            <table id="tabla_historial" class="table table-striped" style="width:100%; overflow-x: auto;">
                            </table>
                        <?php } else { ?>
                            <?php if ($info->estado == 1 && $info->fechaVen >= $fechaActual) { ?>
                                <center>
                                    <h3>Servicio Activo hasta la fecha
                                        <?= $info->fechaVen ?>
                                    </h3><br>

                                </center>
                                <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent"
                                    style="padding: 0; margin-bottom: 20px;">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url() ?>Binarias_historial"
                                                    style="font-size: 20px;">Historial</a>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href="<?= base_url() ?>Binarias_iq"
                                                    style="font-size: 20px;">IQ</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                <center style="margin-bottom: 20px; margin-top: 15px;">
                                    <div class="text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only" style="color:black">Cargando...</span>
                                        </div>
                                    </div>
                                </center>
                                <table id="tabla_historial2" class="table table-striped" style="width:100%; overflow-x: auto;">
                                </table>
                            <?php } else if ($info->estado == 1 && $info->fechaVen <= $fechaActual) { ?>
                                    <!-- Button Señales Binarias modal -->


                                    <center>

                                        <h3>Servicio caducado la fecha
                                        <?= $info->fechaVen ?>
                                        </h3><br><br><br>

                                    </center>


                                    <center style="margin-top: 15px;">
                                        <div class="text-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Cargando...</span>
                                            </div>
                                        </div>
                                    </center>
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent"
                                        style="padding: 0; margin-bottom: 20px;">

                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

                                            <span class="navbar-toggler-icon"></span>

                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarNav">

                                            <ul class="navbar-nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?= base_url() ?>Binarias_historial"
                                                        style="font-size: 20px;">Historial</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="<?= base_url() ?>Binarias_iq"
                                                        style="font-size: 20px;">IQ</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <!-- Modal -->
                                    <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    <?php foreach ($paquetes as $p) { ?>
                                                            <div class="col-4">
                                                                <div class="card text-center">
                                                                    <div class="card-body">
                                                                        <form
                                                                            action="<?= base_url() ?>Reportes2/PayServicioOF/<?= $p->id ?>">
                                                                            <h5 class="card-title">
                                                                            <?= $p->nombre ?>
                                                                            </h5>
                                                                            <p class="card-text">$
                                                                            <?= $p->precio ?> M/o
                                                                            </p>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">comprar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="tabla_historial" class="table table-striped" style="width:100%; overflow-x: auto;">
                                    </table>
                            <?php } ?>

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>



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



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
    $(document).ready(function () {
        var tabla = $('#tabla_historial').DataTable({
            "ajax": "<?= base_url() ?>reportes2/getnuevosregistroshistorial",
            "columns": [{
                "data": "card",
                "render": function (data, type, row, meta) {
                    if (meta.row % 2) {
                        if (row.senal == 'compra' || row.senal == 'Compra') {
                            return `
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="https://www.myconnectmind.com/assets/img/landing/FotoSenal.PNG" style="height:250px ;filter: blur(5px);" class="d-block w-100 " alt="...">
            <div class="carousel-caption ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>
            </div>
        </div>
    </div>
</div>
`;
                        } else {
                            return `
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="https://www.myconnectmind.com/assets/img/landing/FotoSenal4.PNG" style="height:250px ;filter: blur(5px);" class="d-block w-100 " alt="...">
            <div class="carousel-caption ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>
            </div>
        </div>
    </div>
</div>
`;
                        }

                    } else {
                        var html = '<div class="card ">';
                        html += '<p class="card-text">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<div class="card-body" style="border: 4px solid green; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">' : '<div class="card-body" style="border: 4px solid red; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">') + '</p>';
                        html += '<div class="row">';
                        html += '<div class="col" style="padding-right: 0;">';
                        html += '<p class="card-text" style="margin-top: 0;">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:green"></i>' : '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:red"></i>') + '</p>';

                        html += '</div>';
                        html += '<div class="col">';
                        if (row.tiempo != '3 Minutos') {
                            html += '</h3>Ahora</h3>';
                        }
                        html += '<h3>';
                        html += row.senal + '</br>';
                        html += 'Precio Señal :' + row.precio + '</br>';
                        html += 'UTC :' + moment.utc(row.fecha).format('YYYY-MM-DD') + '</br>';
                        html += 'Hace :' + row.diferencia_minutos + ' Minutos</br>';
                        html += '</h3>';
                        html += '</div>';
                        html += '<div class="col del">';
                        html += '</div>';
                        html += '<div class="col del">';
                        html += '</div>';
                        html += '<div class="col del">';
                        html += '</div>';
                        html += '<div class="col del">';
                        html += '</div>';
                        html += '<div class="col par">';
                        html += ' <h2> ' + row.par + '</h2>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        return html;
                    }
                }
            }],
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "pageLength": 4,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "pagingType": "simple",
            "order": [],
            "language": {
                "paginate": {
                    "previous": "<i class='bi bi-caret-left' style='font-size: 20px;'></i>",
                    "next": "<i class='bi bi-caret-right' style='font-size: 20px;'></i>"
                }
            },
            "ordering": false,
            "responsive": true,
            "border": false
        });

        setInterval(function () {
            tabla.ajax.reload(null, false);
        }, 5000);
    });
</script>
<script>

    $('#tabla-historial').DataTable().columns.adjust().responsive.recalc();

</script>





<script>

    function cambiar() {

        var pdrs = document.getElementById('file-upload').files[0].name;

        document.getElementById('info').innerHTML = pdrs;

    }

</script>



<script>

    $(document).ready(function () {

        var fecha = moment($('#fechaa').val(), "YYYY-MM-DD").format("YYYY-MM-DD");

        console.log(fecha);

        // Actualizamos el valor del input de tipo "date"

        document.getElementsByName("fecha_nacimiento")[0].value = fecha;

        var base_url = "<?= base_url() ?>";







    });

</script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>



<!-- srcipt funcional -->

<script>
    $(document).ready(function () {
        var tabla = $('#tabla_historial2').DataTable({
            "ajax": "<?= base_url() ?>reportes2/getnuevosregistroshistorial",
            "columns": [{
                "data": "card",
                "render": function (data, type, row) {
                    var html = '<div class="card ">';
                    html += '<p class="card-text">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<div class="card-body" style="border: 4px solid green; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">' : '<div class="card-body" style="border: 4px solid red; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">') + '</p>';
                    html += '<div class="row">';
                    html += '<div class="col" style="padding-right: 0;">';
                    html += '<p class="card-text" style="margin-top: 0;">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:green"></i>' : '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:red"></i>') + '</p>';

                    html += '</div>';
                    html += '<div class="col">';
                    html += '<h3>';
                    if (row.tiempo != '3 Minutos') {
                        html += '<h3>Ahora</h3>';
                    }
                    html += row.senal + '</br>';
                    html += 'Precio Señal :' + row.precio + '</br>';
                    html += 'UTC :' + moment.utc(row.fecha).format('YYYY-MM-DD') + '</br>';
                    html += 'Hace :' + row.diferencia_minutos + ' Minutos</br>';
                    html += '</h3>';
                    html += '</div>';
                    html += '<div class="col del">';
                    html += '</div>';
                    html += '<div class="col del">';
                    html += '</div>';
                    html += '<div class="col del">';
                    html += '</div>';
                    html += '<div class="col del">';
                    html += '</div>';
                    html += '<div class="col par">';
                    html += ' <h2> ' + row.par + '</h2>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    return html;
                }
            }],
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "pageLength": 4,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "pagingType": "simple",
            "order": [],
            "language": {
                "paginate": {
                    "previous": "<i class='bi bi-caret-left' style='font-size: 20px;'></i>",
                    "next": "<i class='bi bi-caret-right' style='font-size: 20px;'></i>"
                }
            },
            "ordering": false,
            "responsive": true,
            "border": false
        });

        setInterval(function () {
            tabla.ajax.reload(null, false);
        }, 5000);
    });
</script>

<script>

    $('#tabla-historial2').DataTable().columns.adjust().responsive.recalc();

</script>
</body>



</html>