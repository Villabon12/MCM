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



<link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



<table id="tabla_historial" class="table table-striped" style="width:100%; overflow-x: auto;">
</table>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>



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


<table id="tabla_historial" class="table table-striped" style="width:100%; overflow-x: auto;">
</table>

<script>
    $(document).ready(function () {
        var tabla = $('#tabla_historial').DataTable({
            "ajax": "<?= base_url() ?>reportes2/getnuevosregistroshistorial",
            "columns": [{
                "data": "card",
                "render": function (data, type, row, meta) {
                    if (meta.row % 3 === 2) {
                        return '<div class="card border-0"><img style="width:100%; height:100%;  backdrop-filter: blur(10px);" src="https://www.myconnectmind.com/assets/img/landing/FotoSenal.PNG"></div>';
                    } else {
                        var html = '<div class="card ">';
                        html += '<p class="card-text">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<div class="card-body" style="border: 4px solid green; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">' : '<div class="card-body" style="border: 4px solid red; border-radius: 25px; margin-bottom: 20px; padding: 30px; padding-top: 12px;">') + '</p>';
                        html += '<div class="row">';
                        html += '<div class="col" style="padding-right: 0;">';
                        html += '<p class="card-text" style="margin-top: 0;">' + (row.senal == 'compra' || row.senal == 'Compra' ? '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:green"></i>' : '<i class="bi bi-arrow-up-circle" style="font-size: 48px;color:red"></i>') + '</p>';
                        html += '</div>';
                        html += '<div class="col">';
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