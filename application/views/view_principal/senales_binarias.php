<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial</title>
    <link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .moneda {
            text-align: right;
        }

        @media screen and (max-width: 600px) {
            .moneda {
                text-align: left;
            }
        }

        @media screen and (max-width: 600px) {
            .col-8 {
                max-width: 500px;
            }
        }

        table.dataTable.no-footer {
            border-bottom: none;
        }

        table.dataTable thead th,
        table.dataTable tbody td {
            border: none;
        }

        .bi-caret-left,
        .bi-caret-right {
            font-size: 30px;
        }

        .paginate_button {
            background-color: transparent !important;
        }
    </style>
</head>

<body>

    <section>
        <div class="container" style="text-align:center;">
            <h1>Señales binarias</h1>
            <h3 style="margin-top: 20px;">Dia 10 de 15</h3>
            <div style="margin-top: 40px; text-align:center;">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid" style="padding: 0;">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-link" href="<?= base_url() ?>view_principal/resumen" style="font-size: 20px;">Resumen</a>
                                <a class="nav-link" href="<?= base_url() ?>view_principal/senales_binarias" style="font-size: 20px;">Historial</a>
                                <a class="nav-link" href="#" style="font-size: 20px;">IQ</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <table id="TablaHistorial">
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($senales as $senal) : ?>
                        <tr>
                            <td style="padding: 0;">
                                <div class="card border-success border-4 mb-3" style="max-width: auto; margin-top: 20px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col" style="text-align: left;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#198754" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                                                </svg>
                                            </div>
                                            <div class="col">
                                            </div>
                                            <div class="col-8">
                                                <h4 style="text-align: justify;">Venta</h4>
                                                <h4 style="text-align: justify;">Precio Señal:<?php echo $senal['precio']; ?></h4>
                                                <h4 style="text-align: justify;">UTC:<?php echo $senal['fecha']; ?></h4>
                                                <h4 style="text-align: justify;">Hace:<?php echo $senal['minutos_transcurridos']; ?> Minutos</h4>
                                            </div>
                                            <div class="col">
                                            </div>
                                            <div class="col">
                                                <h4 class="moneda"><?php echo $senal['par']; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#TablaHistorial').DataTable({
                "pageLength": 4,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "pagingType": "simple",
                "order": [],
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-caret-left'></i>",
                        "next": "<i class='bi bi-caret-right'></i>"
                    }
                },
                "drawCallback": function(settings) {
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.toggle(this.api().page.info().pages > 1);
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>