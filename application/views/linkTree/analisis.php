<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
    <title>Create MCMLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="description" content="List all your links on one website.">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&amp;display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />
</head>

<style>
    label {
        color: black;
    }

    p {
        color: black;
    }

    .card-title {
        color: black;
    }
</style>

<body style="background-color:#CCD2D5;">
    <div class="card" style="width: 100%;">
        <div class="card-body" style="padding:0px; height: 70px;">
            <h5 class="card-title">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?= base_url() ?>MCM" style="border:none;background:none;">
                            <img style="width: 40px; height: 60px; " style="z-index:1;"
                                src="<?= base_url() ?>images/myconnect/toro.png" alt="logo" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarScroll">
                            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                                style="--bs-scroll-height: 100px;">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>MCMLink/make/<?= $id_plan ?>">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive; ">Links</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>MCMLink/apariencia/<?= $id_plan ?>">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive;">Apariencias</h4>
                                    </a>
                                </li>
                                <?php if ($sett->id_plan == 2 || $sett->id_plan == 3) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page"
                                            href="<?= base_url() ?>LinkTree/analisis/<?= $id_plan ?>">
                                            <h4 style="font-size: 30px;font-family: 'Righteous', cursive;">Analisis</h4>
                                        </a>
                                    </li>
                                <?php } else {
                                # code...
                            } ?>

                            </ul>
                        </div>
                    </div>
                </nav>
            </h5>
        </div>
    </div>

    <?php if ($this->session->flashdata("error")) { ?>
        <p>
            <?php echo $this->session->flashdata("error") ?>
        </p>
    <?php } ?>
    <center>
        <header style="margin-top:3rem;margin-bottom:4rem;">
            <strong>
                <h1 style="font-family: 'Righteous', cursive;    color: black;">Personalizar Tu carta de
                    presentación</h1>
            </strong>
        </header>
        <div class="row row-cols-1 row-cols-md-2 mb-2 text-center" style="margin-top:2rem ;">
            <div class="col">
                <div class="card align-self-center" style="width: 80%;margin:auto; border-radius: 35px;">
                    <div class="card-body">
                        <h3 class="card-title" style="font-family: 'Righteous', cursive;"> Views:
                            <?= $sett->contador ?>
                        </h3>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card align-self-center" style="width: 80%;margin:auto; ; border-radius: 35px;">
                    <div class="card-body">
                        <h3 class="card-title" style="font-family: 'Righteous', cursive;">Plan Adquirido
                            :
                            <?= $sett2->nombre ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </center>

    <?php if ($sett->id_plan == 3) { ?>
        <div class="card" style="width: 90%; border-radius:25px;margin:auto;margin-top:2rem; margin-bottom:15px;">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-family: 'Righteous', cursive; margin-bottom:30px;">Analisis
                    Detallado territorio</h5>
                <div class="table-responsive">
                    <table class="table" id="order-listing">
                        <thead>
                            <tr>
                                <th scope="col">Pais</th>
                                <th scope="col">#Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($general as $g) { ?>
                                <tr>
                                    <td>
                                        <button type="submit" id="paisSearch<?= $g->pais ?>" value="<?= $g->pais ?>"
                                            class="text-dark" style="border:none;background:none;" data-bs-toggle="modal"
                                            data-bs-target="#info<?= $g->pais ?>">
                                            <?= $g->pais ?>
                                        </button>
                                    </td>
                                    <td>
                                        <?= $g->num ?>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="info<?= $g->pais ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" style="font-family: 'Righteous', cursive;"
                                                    id="exampleModalLabel">Analisis profundo</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row row-cols-2 row-cols-md-2 mb-2 text-center"
                                                    style="margin-top:2rem ;">
                                                    <div class="col">
                                                        <h4><b>Departamento<b></h4>
                                                    </div>
                                                    <div class="col">
                                                        <h4><b>#views<b></h4>
                                                    </div>
                                                </div>
                                                <div id="dataout"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        var base_url = "<?= base_url() ?>";
                                        $('#paisSearch<?= $g->pais ?>').on("click", function () {
                                            var id = $(this).val();
                                            $.ajax({
                                                url: base_url + "LinkTree/infoCiudad",
                                                type: "POST",
                                                data: {
                                                    id: id
                                                },
                                                dataType: "json",
                                                success: function (resp) {
                                                    $.each(resp, function (key, value) {
                                                        new_input = '<div class="row row-cols-2 row-cols-md-2 mb-2 text-center" style="margin-top:10px ;">';
                                                        new_input += '<div class="col">';
                                                        new_input += '<h4> ' + value.departamento + ' -> <h4>';
                                                        new_input += '</div>';
                                                        new_input += '<div class="col">';
                                                        new_input += '<h4> ' + value.num + '<h4>';
                                                        new_input += '</div>';
                                                        new_input += '</div>';
                                                        $("#dataout").append(new_input);
                                                    });

                                                    console.log(resp);
                                                }
                                            });
                                        })
                                    })
                                </script>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?><br><br>
        <center>
            <div class="carousel-inner" style=" margin-bottom:2rem;">
                <div class="carousel-item active">
                    <img src="<?= base_url() ?>assets/img/muestra/preview.PNG" style="opacity :0.5" alt="" width="90%"
                        height="100%">
                    <div class="carousel-caption d-none d-md-block">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#BuyPro">
                            Comprar Pro
                        </button>
                    </div>
                </div>
            </div>
        </center>
    <?php } ?>
    <!-- Modal -->
    <div class="modal fade" id="BuyPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="<?= base_url() ?>LinkTree/PayTemplate/3/<?= $sett->id_template ?>" method="get">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion pago</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="subnmit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

</body>
<script>
    function updateColorCode() {
        var colorPicker = document.getElementById("colorPicker");
        var colorCode = document.getElementById("colorCode");
        colorCode.innerHTML = colorPicker.value;
    }
</script>


<script>
    const carSld = document.getElementById("carrusel-slides");
    const carSlds = document.querySelector("#carrusel-slides .slide");
</script>

</html>