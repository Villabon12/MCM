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

    .bt {
        margin-top: 1rem;
    }

    .gol {
        justify-content: center;
        margin-left: 80px;
    }


    .slides {
        width: 100%;
        /* card * 4 + margin * 4 */
        display: flex;
        overflow-x: scroll;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        transition: all .5s ease;
    }

    .slides .slide {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        margin-right: 15px;
        margin-left: 15px;
        border-radius: 10px;
        background: #eee;
        transition: transform 0.5s;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
        transform: translateX(0px);
    }
</style>

<body style="background-color:#CCD2D5;">
    <div class="card" style="width: 100%;">
        <div class="card-body" style="padding:0px; height: 70px;">
            <h5 class="card-title">
                <nav class="navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?= base_url() ?>MCMLink" style="border:none;background:none;">
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
                                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>MCMLink/make/"
                                        style="border:none;background:none;">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive; ">Links</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="<?= base_url() ?>MCMLink/apariencia/"
                                        style="border:none;background:none;">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive;">Apariencias</h4>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </nav>
            </h5>
        </div>
    </div>

    <div class="row">

        <div class="col" style="background-color:#E7EBED;  height:200hv;"> <br><br><br>
            <?php if ($this->session->flashdata("error")) { ?>
                <p>
                    <?php echo $this->session->flashdata("error") ?>
                </p>
            <?php } ?>
            <center>
                <header style="margin-top:2rem;margin-bottom:3rem;">
                    <strong>
                        <h1 style="font-family: 'Righteous', cursive;    color: black;">Paso 3° </h1>
                    </strong>
                    <br>
                    <h3 style="font-family: 'Righteous', cursive;    color: black;">Agrega y administra tu contenido
                    </h3>
                </header>
            </center>
            <div class="card align-self-center" style="width: 80%;margin:auto; border-radius: 35px;">
                <div class="card-body">
                    <form action="<?= base_url() ?>LandingUser/saveData" method="POST">
                        <div class="mb-3">
                            <label for="t1" class="form-label">Titulo 1°</label>
                            <input type="text" value="<?= $tools->t1 ?>" name="t1" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripcion 1°</label>
                            <input type="text" value="<?= $tools->d1 ?>" name="d1" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label for="t1" class="form-label">Titulo 2°</label>
                            <input type="text" value="<?= $tools->t2 ?>" name="t2" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label for="t1" class="form-label">Descripcion 2°</label>
                            <input type="text" value="<?= $tools->d2 ?>" name="d2" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label for="t1" class="form-label">Titulo 3°</label>
                            <input type="text" value="<?= $tools->t3 ?>" name="t3" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label for="t1" class="form-label">Descripcion 3°</label>
                            <input type="text" value="<?= $tools->d3 ?>" name="d3" class="form-control" id="t1">
                        </div>
                        <div class="mb-3">
                            <label for="t1" class="form-label">Titulo 4°</label>
                            <input type="text" value="<?= $tools->t4 ?>" name="t4" class="form-control" id="t1">
                        </div>
                        <center> <button type="submit" class="btn btn-primary text-center">Submit</button> </center>
                    </form>
                </div>
            </div>
            <div class="card align-self-center" style="width: 80%;margin-bottom:2rem; border-radius: 35px;">
                <div class="card-body">
                    <h1 class="card-title">Organiza tu carta de presentación</h1>
                    <p class="card-text">En estos momentos Tienes
                        Links.
                    </p>
                </div>
            </div>

        </div>

        <div class="col making" style="height:auto;">
            <div id="contenido" style="margin-top:8rem;">
                <center>
                    <strong>
                        <h1 style="font-family: 'Righteous', cursive;    color: black;">COMO SE VERIA TU LANDINGPAGE
                        </h1>
                    </strong>
                    <br><br><br>
                    <video width="500" height="300" controls>
                        <source src="<?= base_url() ?>assets\img\landing\muestra1.mp4" type="video/mp4">
                        Tu navegador no admite el elemento de video.
                    </video>
                    <br><br><br><br><br>

                    <button class="btn btn-warning" style="width:80%,border-radius:20px">Ver como va tu
                        landingPafe</button>
                </center>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

</body>

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<script>
    function updateColorCode() {
        var colorPicker = document.getElementById("colorPicker");
        var colorCode = document.getElementById("colorCode");
        colorCode.innerHTML = colorPicker.value;
    }
</script>
<script>
    $(document).ready(function () {
        var base_url = "<?= base_url() ?>";
        var id = "1";
        $('#newDescripcion').on("click", function () {

            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:10px;border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/Updatedata/' + id + '" method="post">';
            new_input += "<Label>Agrega Tu descripciòn</Label><br><br>";
            new_input += "<input class='form-control' name='descripcion' type='text' placeholder='Soy estudiante de Arte de la Universidad...'style='width:80%;' requiered > <br>";
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div>";
            console.log('responde el boton');
            $('#respuesta4').hide("fast"); //muestro mediante id
            $('#respuesta').hide("fast"); //muestro mediante id
            $('#respuesta3').hide("fast"); //muestro mediante id
            $('#respuesta2').show("fast"); //muestro mediante id
            $("#respuesta2").html(new_input);
        });
        $('#newProfesion').on("click", function () {
            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:10px; border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/Updatedata/' + id + '" method="post">';
            new_input += "<Label>Agrega Tu Profesion</Label><br><br>";
            new_input += "<input class='form-control' name='profesion' type='text' placeholder='Ingeniero de Software'style='width:80%;' requiered > <br>";
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div> <br>";
            console.log('responde el boton');
            $('#respuesta4').hide("fast"); //muestro mediante id
            $('#respuesta2').hide("fast"); //muestro mediante id
            $('#respuesta').hide("fast"); //muestro mediante id
            $('#respuesta3').show("fast"); //muestro mediante id
            $("#respuesta3").html(new_input);
        });
        $('#otrico').on("click", function () {
            console.log('holi');

        });
    })
</script>

<script>
    const carSld = document.getElementById("carrusel-slides");
    const carSlds = document.querySelector("#carrusel-slides .slide");



</script>

</html>