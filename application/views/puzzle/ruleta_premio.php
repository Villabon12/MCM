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
        <?php } else if ($puzzle->activo == 2) { ?>
            <div class="container">
                <canvas id="wheel"></canvas>
                <button id="spin-btn">Spin</button>
                <img src="<?= base_url() ?>juegos/image/spinner-arrow-.svg" alt="spinner-arrow" />
            </div>
            <div id="final-value">
                <p>Click en spin para ganar</p>
            </div>
        <?php } else { ?>

        <?php } ?>

    </div>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
    <script src="<?= base_url() ?>juegos/js/confeti.js"></script>
    <script src="<?= base_url() ?>juegos/js/script.js"></script>




</body>

</html>