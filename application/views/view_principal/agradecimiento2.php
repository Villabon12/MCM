<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>¡GARCIAS POR TU REGISTRO!</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <link rel="icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <!-- cdn icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <style>
        .container {

            text-align: center;

        }



        .container2 {

            text-align: center;

            width: 46%;

            margin: auto;

        }



        @media (max-width: 768px) {

            .container2 {

                width: 90%;

            }

        }



        h2 {

            font-size: 58px;

            font-family: 'Bebas Neue', cursive;

            margin-top: -2px;

            margin-bottom: 0;

            color: #fff;

        }



        .h2 {

            font-size: 39px;

            font-family: 'Bebas Neue', cursive;

            margin-top: 10px;

            margin-bottom: 0;

        }



        @media (max-width: 768px) {

            .h2 {

                font-size: 2em;

            }

        }



        p {

            font-family: 'Playfair Display', serif;

            font-size: 30px;

            margin-top: 1px;

            margin-bottom: 25px;

            line-height: 1;

            color: #fff;

        }



        .p {

            font-size: 21px;

            font-family: 'Playfair Display', serif;

            margin-top: 5px;

            line-height: 1;

        }



        @media (max-width: 768px) {

            .p {

                font-size: 1em;

            }

        }



        b {

            color: red;

        }



        .b {

            color: red;

            font-family: 'Bebas Neue', cursive;

            font-size: 38px;

            margin-top: 15px;

            margin-bottom: 20px;

            line-height: 1;

        }



        @media (max-width: 768px) {

            .b {

                font-size: 1.9em;

            }

        }



        img {

            margin-top: -1%;

            border: 2px solid white;

        }



        @media (max-width: 768px) {

            img {

                width: 90%;

                height: 60%;

            }

        }



        .button-p {

            height: 64px;

            border-radius: 10px;

            box-shadow: rgba(255, 0, 245, 0) 0px 0px 20px 0px;

            background: #32A909;

            width: 40%;

            border: 1px solid green;

            cursor: pointer;

            color: #fff;

            font-size: 24px;

            font-family: 'Playfair Display', serif;

            font-weight: 600;

            margin-bottom: 20px;

            display: flex;

            align-items: center;

            flex-direction: row;

            justify-content: center;

            flex-direction: column;

            text-decoration: none;

            text-decoration-line: none;

        }



        @media (max-width: 768px) {

            .button-p {

                font-size: 16px;

            }

        }



        .button-p:hover {

            text-decoration: none;

            text-decoration-line: none;

            color: #fff;
        }

        @media (max-width: 768px) {
            .button-p {
                width: 90%;
            }
        }

        body {
            background: linear-gradient(60deg, rgba(84, 58, 183) 0%, rgba(0, 172, 193) 100%);
            height: 110vh;
        }
    </style>
</head>

<body>
    <?php if ($edicion == true) { ?>
        <button class="btn btn-primary" type="button" style="border-radius:20px; margin:3rem;" data-bs-toggle="offcanvas"
            data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
            <i class="bi bi-list" style="font-size:30px;"></i>
        </button>
    <?php } ?>
    <div class="container">
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
            aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <a
                                href="<?= base_url() ?>LandingUser/sett/<?= $DaCamp->idPlant ?>/<?= $DaCamp->id ?>">Plantilla
                                Principal</a></li>
                        <?php if ($DaCamp->idPaquete > 1) { ?>
                            <li class="list-group-item"> <a
                                    href="<?= base_url() ?>LandingUser/analisis/<?= $DaCamp->id ?>">Analisis</a></li>
                        <?php } ?>

                        <li class="list-group-item"><a
                                href="<?= base_url() ?>LandingUser/Settag/<?= $DaCamp->id ?>">Plantilla
                                Agradecimiento</a></li>
                        <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/setemb">Embudo</a></li>
                        <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/home">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata("error")) { ?>
            <p>
                <?php echo $this->session->flashdata("error") ?>
            </p>
        <?php } ?>
        <h2 style=margin-top:2rem;>
            <?php if ($tools->t1a != null) { ?>
                <?= $tools->t1a ?>
            <?php } else { ?>
                ¡GRACIAS POR REGISTRARTE EN MI BLOG!
            <?php } ?>
            <?php if ($edicion == true) { ?>
                <!-- Button t1a -->
                <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal"
                    data-bs-target="#miModal" value="t1a">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
            <?php } ?>
        </h2>
        <p>
            <?php if ($tools->d1a != null) { ?>
                <?= $tools->d1a ?>
            <?php } else { ?>
                Aún te falta 1 PASO para asegurar tu cupo
            <?php } ?>
            <?php if ($edicion == true) { ?>
                <!-- Button d1a -->
                <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal"
                    data-bs-target="#miModal" value="d1a">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
            <?php } ?>
        </p>

        <?php if ($tools->imgag != null) { ?>
            <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->imgag ?>" width="640" height="360" alt="">
        <?php } else { ?>
            <img src="" width="640" height="360" alt="">
        <?php } ?>

        <?php if ($edicion == true) { ?>
            <!-- Button imagen -->
            <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal"
                data-bs-target="#Setpic3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square"
                    viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
            </button>
        <?php } ?>
        <h2 class="h2">
            <?php if ($tools->t2a != null) { ?>
                <?= $tools->t2a ?>
            <?php } else { ?>
                EL EVENTO SERÁ DEl
                13 AL 16 DE FEBRERO
            <?php } ?>
            <?php if ($edicion == true) { ?>
                <!-- Button t2a -->
                <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal"
                    data-bs-target="#miModal" value="t2a">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
            <?php } ?>
        </h2>
        <div class="container2">
            <p class="p">
                <?php if ($tools->d2a != null) { ?>
                    <?= $tools->d2a ?>
                <?php } else { ?>
                    Manten pendiente de tu correo electrónico, ya que en breve te enviaremos la información de cómo tener
                    mas informaciòn
                <?php } ?>
                <?php if ($edicion == true) { ?>
                    <!-- Button d2a -->
                    <button type="button" class="btn btn-primary" style="border:none;background:none;"
                        data-bs-toggle="modal" data-bs-target="#miModal" value="d2a">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </button>
                <?php } ?>
            </p>
        </div>
        <?php if ($edicion == true) { ?>

            <?php if ($DaCamp->estado != 1) { ?>
                <button type="button" class="btn btn-warning" id="compra" data-bs-toggle="modal" data-bs-target="#get">
                    Obtener plantilla
                </button>
            <?php } ?>
            <?php if ($DaCamp->url != null) { ?>
                <center>
                    <div class="card" style="width: 70%; border-radius:25px;">
                        <div class="card-body">
                            <h5 class="card-title">Ahora comparte tu url con todo el mundo</h5>
                            <div class="card" style="width: 18rem; border-radius:25px; background-color:#C7E9F9;">
                                <div class="card-body">
                                    <p class="card-title text-dark" id="url">
                                        <?= $DaCamp->url ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <br>
                    <button class="btn btn-warning" style="width: 70%; " onclick="copyUrl()">Copiar
                        URL</button><br><br><br>
                </center>
            <?php } ?>
        <?php } ?>
      

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Modificar Campos-->
    <div class="modal" tabindex="-1" role="dialog" id="miModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/saveDataagr/<?= $DaCamp->id ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Campo°</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Modificar imagen agradecimiento -->
    <div class="modal" tabindex="-1" role="dialog" id="Setpic3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/Setimg/<?= $DaCamp->id ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Modifica la imagen</label>
                        <input type="file" class="form-control" name="img" required>
                        <input type="hidden" value="4" name="op">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Comprar-->
    <div class="modal fade" id="get" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-dark text-center" style="font-family: 'Righteous', cursive; color:'black';">
                        Conoce nuestros paquetes para empezar a utilizar este producto</h1>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mb-2 text-center " style="margin-top:2rem ;">
                        <?php foreach ($paquetes as $p) { ?>
                            <div class="col">
                                <div class="card mb-4  " style="height:450px;">
                                    <form action="<?= base_url() ?>LandingUser/PayLanding/<?= $p->id ?>">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
        crossorigin="anonymous"></script>
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
    $(document).ready(function () {
        $("#miModal").on("show.bs.modal", function (event) {
            console.log("hola");
            var boton = $(event.relatedTarget);
            var opcion = boton.val();

            if (opcion == "t1a") {
                var input = $('<input>').attr({ type: 'text', name: 't1a', class: 'form-control', placeholder: 'Modifique el titulo ', required: 'required' });
            } if (opcion == "d1a") {
                var input = $('<input>').attr({ type: 'text', name: 'd1a', class: 'form-control', placeholder: 'Modifique la descripcion ', required: 'required' });
            } if (opcion == "t2a") {
                var input = $('<input>').attr({ type: 'text', name: 't2a', class: 'form-control', placeholder: 'Modifique el titulo ', required: 'required' });
            } if (opcion == "d2a") {
                var input = $('<input>').attr({ type: 'text', name: 'd2a', class: 'form-control', placeholder: 'Modifique la descripcion ', required: 'required' });
            }
            // Actualiza el contenido del cuerpo del modal
            var modal = $(this);
            modal.find('.modal-body').html(input);
        })
    });
</script>


</html>