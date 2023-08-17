<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($edicion == true) { ?>
        <title>Make</title>
    <?php } else { ?>
        <title>
            <?= $DaCamp->campana ?>
        </title>
    <?php } ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="<?= base_url() ?>images/myconnect/toro.png" />

    <style>
        body {
            margin: 0;
        }

        .container {
            width: 90%;
            margin-top: 80px;
            margin-bottom: 60px;
        }

        @media (max-width: 756px) {
            .container {
                padding-right: 0;
                width: 100%;
                max-width: 100%;
                padding: 0;
            }
        }

        .container3 {
            width: 90%;
            margin-top: 60px;
            margin-bottom: 60px;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 42px;
            width: 100%;
            color: white;
            margin-top: 40px;
            line-height: 1.1em;
            text-transform: uppercase;
        }

        p {
            color: white;
            font-size: 19px;
            margin-bottom: 30px;
            margin-top: 10px;
            min-width: 100px;
            font-weight: 500;
            text-align: justify;
            font-family: 'Poppins-b', sans-serif;
            line-height: 1.1em;
        }

        .p {
            color: white;
            font-size: 14px;
            font-family: 'Poppins-b', sans-serif;
            line-height: 1.1em;
        }

        .p2 {
            padding-right: 80px;
            font-size: 22px;
            text-align: justify;
        }

        @media screen and (max-width: 800px) {
            .p2 {
                padding-right: 0;
                font-size: 18px;
            }
        }

        #email {
            width: 100%;
            padding: 20px;
            border-radius: 12px;
        }

        #_form_3_submit {
            width: 100%;
            margin-top: 15px;
            padding: 20px;
            border-radius: 12px;
            background: #ED0C0A;
            border: none;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            margin-bottom: 20px;
            cursor: pointer;
            border: 1px solid red;
        }

        #email2 {
            width: 40%;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        @media (max-width: 756px) {
            #email2 {
                width: 80%;
            }
        }

        #_form_4_submit {
            width: 40%;
            margin-top: 15px;
            padding: 20px;
            border-radius: 12px;
            background: #ED0C0A;
            border: none;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            margin-bottom: 15px;
            cursor: pointer;
            border: 1px solid red;
        }

        @media (max-width: 756px) {
            #_form_4_submit {
                width: 80%;
                font-size: 16px;
            }
        }

        .point {
            display: flex;
            flex-direction: row;
        }

        .icon {
            display: flex;
            flex-direction: row;
            margin-right: 30px;
            align-items: center;
            justify-content: center;
        }

        @media only screen and (max-width: 600px) {
            .point {
                flex-direction: column;
            }

            .icon {
                margin-right: 0;
                margin-bottom: -25px;
            }
        }

        .card-background {
            background-image: url('http://t1.gstatic.com/images?q=tbn:ANd9GcTRr6gUyI7Fr3maAhguCKgbQkMkdSTwDF0N37W8QbKht19j4-3B');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
        }

        .card-background2 {
            background-image: url('https://prospeccionvip.com/funnel/g/rg/img/fondo2.webp');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 1;
        }

        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        .marquee {
            width: 100%;
            height: 60px;
            background-color: #e9c804;
            color: #1d1104;
            overflow: hidden;
            position: relative;
        }

        .marquee:before,
        .marquee:after {
            position: absolute;
            top: 0;
            width: 10rem;
            height: 100%;
            content: "";
            z-index: 1;
        }

        .marquee:before {
            left: 0;
            background: linear-gradient(to right, #111 0%, transparent 100%);
        }

        .marquee:after {
            right: 0;
            background: linear-gradient(to left, #111 0%, transparent 100%);
        }

        .marquee-content {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            text-align: center;
            height: 100%;
            max-height: 100%;
            white-space: nowrap;
            font-family: 'Audiowide', cursive;
            font-weight: 700;
            font-size: 2.5em;
        }

        .marquee-content img {
            width: 100%;
            border: 2px solid #eee;
        }

        .h-t {
            max-width: 820px;
            margin: 0 auto;
            text-align: justify;
            font-size: 38px;
            margin-bottom: 20px;
            font-family: 'Audiowide', cursive;
            margin-top: 40px;
            color: white;
        }

        @media screen and (max-width: 800px) {
            .h-t {
                font-size: 30px;
                text-align: center;
            }
        }

        .h-t2 {
            max-width: 820px;
            margin: 0 auto;
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
            font-family: 'Audiowide', cursive;
            margin-top: 20px;
            color: white;
        }

        .content3 {
            width: 100%;
            height: 80vh;
            background-image: url(https://prospeccionvip.com/funnel/g/rg/img/fondo3.webp);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-size: cover;
            animation: slide 10s infinite;
        }

        .cont3 {
            width: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 4, 4, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 12px;
            padding: 40px;
        }

        @media (max-width: 800px) {
            .cont3 {
                width: 95%;
                max-width: 100%;
                padding: 20px;
            }
        }

        .cajas {
            margin-top: 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            max-width: 80%;
        }

        @media only screen and (max-width: 768px) {
            .cajas {
                display: flex;
                flex-direction: column;
            }
        }

        .caja1,
        .caja2,
        .caja3 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.3em;
            margin-right: 20px;
            text-align: center;
            font-weight: 500;
        }

        .icon3 {
            color: red;
            font-size: 80px;
            margin-bottom: 15px;
        }

        .cajas2 {
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            max-width: 85%;
        }

        @media only screen and (max-width: 800px) {
            .locas {
                width: 95%;
                max-width: 95%;
            }
        }

        .locas {
            background: #202124;
            padding: 40px;
            border-radius: 12px;
        }

        @media only screen and (max-width: 768px) {
            .locas {
                width: 100%;
                padding: 15px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        }

        .caja31 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.3em;
            margin-right: 30px;
        }

        @media only screen and (max-width: 800px) {
            .caja31 {
                margin: 0;
            }
        }

        .card2 {
            width: 17em;
            height: 24.5em;
            background-color: #000;
            border-radius: 1rem;
            border: #212121 0.2rem solid;
            transition: all 0.4s ease-in;
            box-shadow: 0.4rem 0.4rem 0.6rem #00000040;
        }

        .card2:hover {
            transform: translateY(-1rem);
            border: red 0.2em solid;
            border-radius: 2.5rem 2.5rem;
        }

        .card2 span {
            font-weight: bold;
            color: white;
            text-align: center;
            display: block;
            font-size: 1em;
            margin-top: 10px;
        }

        .card2 button {
            padding: 0.3em 1.7em;
            display: block;
            margin: auto;
            border-radius: 10px;
            border: none;
            font-weight: bold;
            background: #ffffff;
            color: rgb(0, 0, 0);
            transition: .4s ease-in-out;
            width: 50%;
            height: 40px;
        }

        .card2 button:hover {
            background: red;
            color: white;
            cursor: pointer;
        }

        .card2 .info {
            font-weight: 400;
            color: white;
            display: block;
            text-align: center;
            font-size: 0.90em;
            margin: 1em;
            font-family: Poppins, sans-serif;
            margin-top: 20px;
        }

        .card2 .img {
            width: 10em;
            height: 10em;
            background: white;
            border-radius: 15px;
            margin: auto;
        }

        button {
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            border: none;
            outline: none;
            color: rgb(255 255 255);
            text-transform: uppercase;
            font-weight: 700;
            font-size: .75rem;
            padding: 0.75rem 1.5rem;
            background-color: rgb(33 150 243);
            border-radius: 0.5rem;
            width: 90%;
            text-shadow: 0px 4px 18px #2c3442;
        }

        .col-sm-12, 
        .col-md-6, 
        .col-lg-6 {
            margin-top: 30px;
            margin-bottom: 60px;
        }

        @media only screen and (max-width: 800px) {
            .col-sm-12, 
            .col-md-6, 
            .col-lg-6 {
                margin-top: 0;
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="card card-background rounded-0 border-0">
        <div class="card-body">
            <?php if ($edicion == true) { ?>
                <button class="btn btn-primary" type="button" style="margin: 1px; width: 60px; height: 50px; background-color: transparent; border-color: transparent;" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            <?php } ?>
            <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="<?= base_url() ?>LandingUser/sett/<?= $id_plant ?>">Plantilla Principal</a>
                            </li>
                            <?php if ($DaCamp->idPaquete > 1) { ?>
                                <li class="list-group-item"> <a href="<?= base_url() ?>LandingUser/analisis/<?= $DaCamp->id ?>">Analisis</a></li>
                            <?php } ?>
                            <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/Settag/<?= $DaCamp->id ?>">Plantilla
                                    Agradecimiento</a></li>
                            <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/setemb">Embudo</a></li>
                            <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/home">Atras</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <?php if ($tools->logo != null) { ?>
                            <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->logo ?>" style="float: left; width: 163px; height: 43px; line-height: 1;">
                        <?php } else { ?>
                            <img src="https://www.myconnectmind.com/images/myconnect/encabezado2.png" style="float: left; width: 163px; height: 43px; line-height: 1;">
                        <?php } ?>
                        <?php if ($edicion == true) { ?>
                            <button type="button" class="btn btn-primary" style="border:none;background:none; width:20px;" data-bs-toggle="modal" data-bs-target="#Setpic" value="pic1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        <?php } ?>
                        <br>
                        <h1>
                            <?php if ($tools->t1 != null) { ?>
                                <?= $tools->t1 ?>
                            <?php } else { ?>
                                CÓMO FIRMAR +15 SOCIOS
                                A LA SEMANA HACIENDO
                                UNA SOLA LLAMADA
                            <?php } ?>
                            <?php if ($edicion == true) { ?>
                                <!-- Button t1 -->
                                <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="t1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            <?php } ?>
                        </h1>
                        <p><?php if ($tools->d1 != null) { ?>
                                <?= $tools->d1 ?>
                            <?php } else { ?>
                                En este evento de 4 clases gratuitas te enseñaré el paso a paso para firmar +15
                                socios a la semana haciendo una sola llamada, incluso si aún no tienes
                                resultados y crees que has intentado de todo.
                            <?php } ?>
                            <?php if ($edicion == true) { ?>
                                <!-- Button d1 -->
                                <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="d1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            <?php } ?>
                        </p>
                        <form class="form" <?php if ($edicion == true) { ?> action="<?= base_url() ?>LandingUser/embudo/<?= $DaCamp->id ?>" <?php } else { ?> action="<?= base_url() ?>LandingUser/SendEmail/<?= $DaCamp->ulrname ?>" <?php } ?> method="post">
                            <input type="text" id="email" name="email" placeholder="Escriba su correo electrónico" required="" data-name="email">
                            <button id="_form_3_submit" class="_submit" type="submit">
                                QUIERO RESERVAR MI LUGAR
                            </button>
                        </form>

                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <center>
                            <div class="img2">
                                <?php if ($tools->img2 != null) { ?>
                                    <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->img2 ?>" width="500px" height="500px" class="img-fluid">
                                <?php } else { ?>
                                    <img src="http://www.myconnectmind.com/images/imagen1.png" width="500px" height="500px" class="img-fluid">
                                <?php } ?>
                                <?php if ($edicion == true) { ?>
                                    <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#Setpic2" value="pic2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">

                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />

                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />

                                        </svg>
                                    </button>
                                <?php } ?>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="marquee">
        <div class="marquee-content">
            <marquee loop="<?= $tools->loops ?>">
                <?php if ($tools->branding != null) { ?>
                    <?= $tools->branding ?>
                <?php } else { ?>
                    LA REBELIÓN DEL NETWORK MARKETING
                <?php } ?>
            </marquee>
        </div>
    </div>
    <div class="card card-background2 rounded-0 border-0">
        <?php if ($edicion == true) { ?>
            <p>
                Modificar Marquee
                <!-- Button marquee -->
                <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="branding">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
            </p>
        <?php } ?>
        <?php if ($edicion == true) { ?>
            <p style="margin-top: -40px;">
                Modificar Bucle
                <!-- Button marquee -->
                <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="loops">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
            </p>
        <?php } ?>
        <div class="card-body">
            <div class="container2">
                <h1 class="h-t">
                    <?php if ($tools->t2 != null) { ?>
                        <?= $tools->t2 ?>&nbsp;
                    <?php } else { ?>
                        LA REBELIÓN DEL NETWORK MARKETING&nbsp;
                    <?php } ?>
                    <?php if ($edicion == true) { ?>
                        <!-- Button t2 -->
                        <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="t2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    <?php } ?>
                </h1>
                <p style="max-width: 830px; margin: 0 auto; text-align: center;">
                    <?php if ($tools->d2 != null) { ?>
                        <?= $tools->d2 ?>
                    <?php } else { ?>
                        Llega para revelar cómo +132 networkeres han aplicado el método PVIP y han logrado firmar
                        +15 socios a la semana... ¿Te gustaría tener los mismos resultados?&nbsp;
                    <?php } ?>
                    <?php if ($edicion == true) { ?>
                        <!-- Button d2 -->
                        <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="d2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    <?php } ?>
                </p>
            </div>
            <center>
                <div class="container3">
                    <div class="row">
                        <?php foreach ($cards as $c) { ?>
                            <div class="col-sm-3">
                                <div class="card2">
                                    <br>
                                    <div class="img">
                                        <img src="<?= base_url() ?>/assets/img/landing/Cards/<?= $c->img ?>" alt="imagen" class="img-fluid" style="border-radius: 5px;" width="100" height="100">
                                    </div>
                                    <p class="info">
                                        <?= $c->descripcion ?>&nbsp;
                                    </p>
                                    <button><a href="" style="width:60%; text-decoration: none; color: black;"> Mas Info
                                        </a></button>
                                    <span>
                                        <?= $c->fecha ?>
                                    </span>
                                    <br>
                                </div>
                                <br>
                            </div>
                            <br>
                        <?php } ?>
                    </div>
                    <?php if ($edicion == true) { ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" style="width:40%; margin-bottom: 40px; margin-top: 30px" data-bs-toggle="modal" data-bs-target="#aggcard">
                            Agrega card
                        </button>
                    <?php } ?>
                </div>
            </center>
        </div>
    </div>
    <div class="content3">
        <div class="cont3">
            <div>
                <h2 style="font-family: 'Audiowide', cursive; color: white;">
                    <?php if ($tools->t3 != null) { ?>
                        <?= $tools->t3 ?>
                    <?php } else { ?>
                        EL NETWORK MARKETING NO SERÁ EL MISMO DESPUÉS DEL EVENTO DE LA REBELIÓN DIGITAL
                    <?php } ?>
                    <?php if ($edicion == true) { ?>
                        <!-- Button t3 -->
                        <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="t3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    <?php } ?>
                </h2>
                <p style="font-size: 21px;">
                    <?php if ($tools->d3 != null) { ?>
                        <?= $tools->d3 ?>
                    <?php } else { ?>
                        A veces miramos a
                        otros líderes
                        tener resultados y pensamos, ¿qué están haciendo ellos, que yo no estoy haciendo? - Ahora,
                        tú serás el próximo caso de éxito de tu negocio gracias a el método que aprenderás que ha
                        permitido que más de 1232 personas firmen 15 socios a la semana haciendo una sola llamada
                    <?php } ?>
                    <?php if ($edicion == true) { ?>
                        <!-- Button d3 -->
                        <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="d3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
    <div class="card rounded-0 border-0" style="background-color: black;">
        <div class="card-body">

            <center>
                <h1 class="h-t2">
                    <?php if ($tools->t5 != null) { ?>
                        <?= $tools->t5 ?>
                    <?php } else { ?>
                        ¿QUIÉN SOY Y POR QUÉ PUEDO AYUDARTE?
                    <?php } ?>
                    <?php if ($edicion == true) { ?>
                        <!-- Button t4 -->
                        <button type="button" class="btn btn-primary" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#miModal" value="t4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    <?php } ?>
                </h1>
                </h1>
                <div class="cajas2 locas">
                    <div class="caja31">
                        <p class="p2">
                            <?php if ($tools->descripcion != null) { ?>
                                <?= $tools->descripcion ?>
                            <?php } else { ?>
                                Mi nombre es Gigi Toneatti <br> <br>He ayudado a +832 networkers sin resultados
                                firmar
                                +15 socios a la semana y tener un negocio rentable. <br><br> Ello, aplicando el
                                mismo
                                método que me ha permitido facturar +$150.000 USD dólares. <br><br> Mi misión es
                                que tú
                                aprendas el paso a paso del método PVIP completamente GRATIS y seas el próximo
                                caso de
                                éxito. <br><br> Regístrate al entrenamiento y recibe GRATIS mi guía para aplicar
                                efectivos secretos de Internet para tener en tu negocio de red de marcadeo.
                            <?php } ?>
                        </p>
                        <?php if ($edicion == true) { ?>
                            <!-- Button desc -->
                            <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#miModal" value="desc">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        <?php } ?>
                        </p>
                    </div>
                    <div class="caja4">
                        <?php if ($tools->img3 != null) { ?>
                            <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->img3 ?>" width="272" height="420">
                        <?php } else { ?>
                            <img src="https://vilmanunez.com/wp-content/uploads/2020/10/VN-Co%CC%81mo-hacer-una-buena-presentacio%CC%81n-de-resultados-de-auditori%CC%81a-u%CC%81ltimas-horas.png" width="272" height="420">
                        <?php } ?>
                        <?php if ($edicion == true) { ?>
                            <button type="button" class="btn btn-primary" style="border:none;background:none;width:20px;" data-bs-toggle="modal" data-bs-target="#Setpic3" value="pic3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <h2 style="color: white; margin-top: 50px; max-width: 80%; font-family: 'Audiowide', cursive;">ÍNDICANOS TU CORREO PARA MAYOR INFORMACION</h2>
                <form class="form" <?php if ($edicion == true) { ?> action="<?= base_url() ?>LandingUser/embudo/<?= $DaCamp->id ?>" <?php } else { ?> action="<?= base_url() ?>LandingUser/SendEmail/<?= $DaCamp->ulrname ?>" <?php } ?> method="post">
                    <input type="text" id="email2" name="email" placeholder="Escriba su correo electrónico" required="" data-name="email">
                    <br>
                    <button id="_form_4_submit" class="_submit" type="submit">
                        QUIERO RESERVAR MI LUGAR
                    </button>
                </form>

            </center>
        </div>
        <?php if ($edicion == true) { ?>

            <a href="<?= base_url() ?>LandingUser/Settag/<?= $DaCamp->id ?>" class="btn btn-primary" style="width: 100%; border-radius: 0px; margin-top: 40px">Personalizar Plantilla Agradecimiento</a> <br>

        <?php } ?>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="aggcard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/saveCard/<?= $id_plant ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Imagen :</label>
                        <input type="file" name="img" class="form-control">
                        <label for="">Descripcion :</label>
                        <input type="text" name="descri" class="form-control">
                        <label for="">Link para informacion :</label>
                        <input type="text" name="link" class="form-control">
                        <label for="">Fecha :</label>
                        <input type="date" name="fecha" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" style="width: 100%">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  Modificar Campos-->
    <div class="modal" tabindex="-1" role="dialog" id="miModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/saveData/<?= $id_plant ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Campo°</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Modificar logo-->
    <div class="modal" tabindex="-1" role="dialog" id="Setpic">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/Setimg/<?= $DaCamp->id ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Modifica el Logo</label>
                        <input type="file" class="form-control" name="img" required>
                        <input type="hidden" value="1" name="op">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Modificar imagen 2-->
    <div class="modal" tabindex="-1" role="dialog" id="Setpic2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/Setimg/<?= $DaCamp->id ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Modifica la imagen</label>
                        <input type="file" class="form-control" name="img" required>
                        <input type="hidden" value="2" name="op">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Modificar imagen 3-->
    <div class="modal" tabindex="-1" role="dialog" id="Setpic3">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url() ?>LandingUser/Setimg/<?= $DaCamp->id ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Modifica la imagen</label>
                        <input type="file" class="form-control" name="img" required>
                        <input type="hidden" value="3" name="op">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="marquee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 style="color: #000;" class="modal-title fs-5" id="exampleModalLabel">Modificar Marquee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="marquee-text">Texto</label>
                            <input type="text" class="form-control" id="marquee-text" placeholder="Escribe el nuevo texto">
                        </div>
                        <div class="form-group">
                            <label for="marquee-loop">Loop</label>
                            <input type="number" class="form-control" id="marquee-loop" placeholder="Escribe el nuevo valor de loop">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 100%">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarMarquee()" style="width: 100%">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function copyUrl() {
            var range = document.createRange();
            range.selectNode(document.getElementById("url"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            navigator.clipboard.writeText(window.getSelection().toString()).then(function() {
                alert("La URL ha sido copiada en el portapapeles.");
            }, function() {
                // alert("Error al copiar la URL.");
            });
            window.getSelection().removeAllRanges();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#miModal").on("show.bs.modal", function(event) {
                console.log("hola");
                var boton = $(event.relatedTarget);
                var opcion = boton.val();

                if (opcion == "t1") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 't1',
                        class: 'form-control',
                        placeholder: 'Modifique el titulo 1º',
                        required: 'required'
                    });
                }
                if (opcion == "d1") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 'd1',
                        class: 'form-control',
                        placeholder: 'Modifique la descripcion 1º',
                        required: 'required'
                    });
                }
                if (opcion == "t2") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 't2',
                        class: 'form-control',
                        placeholder: 'Modifique el titulo 2º',
                        required: 'required'
                    });
                }
                if (opcion == "d2") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 'd2',
                        class: 'form-control',
                        placeholder: 'Modifique la descripcion 2º',
                        required: 'required'
                    });
                }
                if (opcion == "t3") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 't3',
                        class: 'form-control',
                        placeholder: 'Modifique el titulo 3º',
                        required: 'required'
                    });
                }
                if (opcion == "d3") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 'd3',
                        class: 'form-control',
                        placeholder: 'Modifique la descripcion 3º',
                        required: 'required'
                    });
                }
                if (opcion == "t4") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 't5',
                        class: 'form-control',
                        placeholder: 'Modifique el titulo 5º',
                        required: 'required'
                    });
                }
                if (opcion == "desc") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 'descripcion',
                        class: 'form-control',
                        placeholder: 'Modifique la descripcion',
                        required: 'required'
                    });
                }
                if (opcion == "branding") {
                    var input = $('<input>').attr({
                        type: 'text',
                        name: 'branding',
                        class: 'form-control',
                        placeholder: 'Modifique branding',
                        required: 'required'
                    });
                }
                if (opcion == "loops") {
                    var input = $('<input>').attr({
                        type: 'number',
                        name: 'loops',
                        class: 'form-control',
                        placeholder: 'Modifique loop',
                        required: 'required'
                    });
                }
                // Actualiza el contenido del cuerpo del modal
                var modal = $(this);
                modal.find('.modal-body').html(input);
            })
        });
    </script>

    <script>
        function validarValor() {
            var valor = parseInt($('input[name="loops"]').val());
            if (valor === 0 || valor > 9) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El valor debe estar entre 1 y 9',
                })
                return false;
            }
            return true;
        }

        $('form').on('submit', function() {
            return validarValor();
        });
    </script>

    <script>
        const root = document.documentElement;
        const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
        const marqueeContent = document.querySelector("ul.marquee-content");

        root.style.setProperty("--marquee-elements", marqueeContent.children.length);

        for (let i = 0; i < marqueeElementsDisplayed; i++) {
            marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
        }
    </script>
</body>

</html>