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
    .makeLetra {
        color: black;
    }

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


    body {
        background-color: #CCD2D5;
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
<?php if ($sett->colorBoton != null) { ?>
    <style>
        button {
            color:
                <?= $sett->colorBoton ?>
            ;
        }
    </style>
<?php } ?>

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
                                    <a class="nav-link active" aria-current="page" style="border:none;background:none;"
                                        href="<?= base_url() ?>MCMLink/make/<?= $id_plan ?>">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive; ">Links</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" style="border:none;background:none;"
                                        href="<?= base_url() ?>MCMLink/apariencia/<?= $id_plan ?>">
                                        <h4 style="font-size: 30px;font-family: 'Righteous', cursive;">Apariencias</h4>
                                    </a>
                                </li>
                                <?php if ($sett->id_plan == 2 || $sett->id_plan == 3) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" style="border:none;background:none;"
                                            href="<?= base_url() ?>LinkTree/estadisticas/<?= $id_plan ?>">
                                            <h4 style="font-size: 30px;font-family: 'Righteous', cursive;">Analisis</h4>
                                        </a>
                                    </li>
                                <?php } else {
                                # code...
                            } ?>
                            </ul>
                            <!-- <img src="<?= base_url() ?>assets/img/fotosPerfil/<?= $perfil->img_perfil ?>"
                                style="border-radius:25px;" alt="" width="50px" height="50px"> -->
                        </div>
                    </div>
                </nav>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col" style="background-color:#E7EBED;  height:200vh;"> <br><br><br>
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
                    <h3 style="font-family: 'Righteous', cursive;    color: black;">Personaliza tu plantilla
                    </h3>
                </header>
                <div class="card align-self-center" style="width: 80%;margin-bottom:2rem; border-radius: 35px;">
                    <div class="card-body">
                        <h1 class="card-title" style="font-family: 'Righteous', cursive;">Utilizar algunas de nuestras
                            plantillas gratis o Pro</h1>
                    </div>
                </div>
                <!-- Button fotirris modal -->
                <button type="button" class="btn btn-primary btn-lg bt" style="width: 80%;border-radius: 35px;"
                    data-bs-toggle="modal" data-bs-target="#subirfoto">
                    Agregar una Foto
                </button>
                <button type="button" id="botonOption" class="btn btn-primary btn-lg bt"
                    style="width: 80%;border-radius: 35px;">Personaliza
                    el color de botones</button>
                <br>
                <div id="respuesta4"></div> <br><br>
                <?php if ($sett->id_plan == 1 || $sett->id_plan == null) { ?>
                    <header style="margin-top:2rem;margin-bottom:3rem;">
                        <strong>
                            <h1 style="font-family: 'Righteous', cursive;    color: black;">Paso 4° </h1>
                        </strong>
                        <br>
                        <h3 style="font-family: 'Righteous', cursive;    color: black;">Obtiene tu link y tu codigo QR 
                        </h3>
                    </header>
                    <!-- Button para compra -->
                    <button type="button" class="btn btn-warning" id="compra" data-bs-toggle="modal" data-bs-target="#get">
                        Obtener plantilla
                    </button> <br><br>
                <?php } else {
                } ?>

                <?php if ($sett->url == null) {
                # code...
            } else { ?>
                    <div class="card" style="width: 80%; border-radius:25px;">
                        <div class="card-body">
                            <h5 class="card-title">Ahora comparte tu url con todo el mundo</h5>
                            <div class="card" style="width: 18rem; border-radius:25px; background-color:#C7E9F9;">
                                <div class="card-body">
                                    <p class="card-title" id="url">
                                        <?= $sett->url ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <br>
                    <button class="btn btn-primary" onclick="copyUrl()">Copiar URL</button><br><br><br>
                    <img src="<?= base_url() . $sett->qr ?>" alt="">
                <? } ?>
            </center>
        </div>
        <!-- Modal paquetes -->
        <div class="modal fade" id="get" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1 class="text-dark text-center" style="font-family: 'Righteous', cursive; color:'black';">
                            Conoce nuestros paquetes para empezar a utilizar este producto</h1>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mb-2 text-center " style="margin-top:2rem ;">
                            <?php foreach ($paquetes as $p) { ?>
                                <div class="col">
                                    <div class="card mb-4  " style="height:450px;">
                                        <form action="<?= base_url() ?>LinkTree/PayTemplate/<?= $p->id ?>/<?= $id_plan ?>">
                                            <div class="card-header">
                                                <h4 class=" text-dark">
                                                    <?= $p->nombre ?>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title">$
                                                    <?= $p->precio ?>
                                                    <small class="text-muted fw-light">/mo</small>
                                                </h1>
                                                <ul class="list-unstyled mt-3 mb-4 text-dark" style="height:232px;">
                                                    <li>
                                                        <?= $p->descripcion ?>
                                                    </li>
                                                </ul>
                                                <button type="submit"
                                                    class="w-100 btn btn-lg btn-outline-primary">Obtener</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal subir fotirris -->
        <div class="modal fade" id="subirfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url() ?>LinkTree/savePhoto/<?= $id_plan ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agrega una foto a tu carta
                                de
                                presentacion
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label> Selecciona la foto:</label>
                            <input type="file" name="img" class='form-control' requiered>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col making" style="height:auto;">
            <div id="contenido">
                <?php $this->load->view($contenido); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

</body>
<script>
    function copyUrl() {
        var range = document.createRange();
        range.selectNode(document.getElementById("url"));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        navigator.clipboard.writeText(window.getSelection().toString()).then(function () {
            alert("La URL ha sido copiada en el portapapeles.");
        }, function () {
            // alert("Error al copiar la URL.");
        });
        window.getSelection().removeAllRanges();
    }
</script>
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
        var id = "<?= $id_plan ?>";
        $('#botonOption').on("click", function () {
            new_input = "";
            new_input += "<div class='card' style='width: 80%;margin-top:15px; border-radius: 35px; justify-content-center align-self-center'>";
            new_input += '<div class="card-body">';
            new_input += '<form action="' + base_url + 'LinkTree/UpdateColor/' + id + '" method="post">';
            new_input += "<label>Personaliza el color de tus botones:</label> <br><br>";
            new_input += '<input type="color" value="" id="colorPicker" name="color"onchange="updateColorCode()">';
            new_input += '<span id="colorCode" style="color:black;">#000000</span> <br><br>';
            new_input += '<button type="submit" class="btn btn-primary " style="width:40%;">+</button>';
            new_input += '</form>';
            new_input += "</div>";
            new_input += "</div>";
            console.log('responde el boton');
            $("#respuesta4").html(new_input);
        });
        $('#compra').on("click", function () {
            $.ajax({

                url: base_url + "LinkTree/infoPlantilla",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (resp) {
                    if (resp.type == 1) {
                        console.log("gratis");
                    } else {
                        console.log("pago");
                    }

                    console.log(resp);
                }
            });
        })
    })
</script>
<script>
    function ventanaSecundaria() {
        window.open("https://www.myconnectmind.com/ingreso", "v entana1", "w idth=600,height=500,scrollbars=NO")
    } 
</script>

</html>