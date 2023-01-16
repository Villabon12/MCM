<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gira y gana</title>
    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url() ?>juegos/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
</head>

<body>
    <div class="wrapper">
        <?php if ($this->session->flashdata("error")) { ?>

        <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>

        <p><?php echo $this->session->flashdata("exito") ?></p>

        <?php } ?>
        <?php if ($puzzle->activo == 1) { ?>
        <form action="<?= base_url() ?>Puzzle/vincular/<?= $puzzle->codigo ?>" method="post">
            <div class="container">
                <input class="form-control" type="number" name="cedula" placeholder="Digite cedula">
                <br>
                <button class="btn btn-success" type="submit">Enviar</button>
            </div>
        </form>
        <?php } elseif ($puzzle->activo == 2) { ?>
        <div class="container">
            <canvas id="wheel"></canvas>
            <button id="spin-btn">Spin</button>
            <img src="<?= base_url() ?>juegos/image/spinner-arrow-.svg" alt="spinner-arrow" />
        </div>
        <div id="final-value">
            <p>Click en spin para ganar</p>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Premio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>100% Acumulado</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><?=$recompensa->porcentaje * 100?>% de la compra</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>30% del acumulado</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>10% del acumulado</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><?=$recompensa->porcentaje * 100?>% de la compra</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><?=$recompensa->porcentaje * 100?>% de la compra</td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="" id="valuePremio" value="<?=$recompensa->porcentaje * 100?>">
                <input type="hidden" name="" id="tokenPremio" value="<?= $puzzle->codigo ?>">
            </div>
        </div>
        <?php } else { ?>

        <?php } ?>

    </div>

    <!-- Chart JS -->
    <script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js">
    </script>
    <!-- Script -->
    <script src="<?= base_url() ?>juegos/js/confeti.js"></script>
    <script src="<?= base_url() ?>juegos/js/script.js"></script>

    <script>
    $('#spin-btn').on('click', function() {
        var base_url = "<?= base_url() ?>";
        var token = $('#tokenPremio').val();
        $.ajax({
            url: base_url + "Puzzle/reclamarPremio/" + token,
            success: function(resp) {
                console.log(resp);
            }
        });
    })
    </script>


</body>

</html>