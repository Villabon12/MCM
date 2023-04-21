<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Viaoda+Libre&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- cdn icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300:400);

        body {
            margin: 0;
        }

        .header {
            position: relative;
            text-align: center;
            background: linear-gradient(60deg, rgba(84, 58, 183, 1) 0%, rgba(0, 172, 193, 1) 100%);
            color: white;
        }

        .inner-header {
            height: 65vh;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .flex {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .form {
            display: flex;
            flex-direction: column;
            background: transparent;
            max-width: 370px;
        }

        .form div {
            display: flex;
            column-gap: 0.5rem;
            width: 355px;
        }

        .form div input {
            outline: none;
            line-height: 1.5rem;
            font-size: 0.875rem;
            color: rgb(255 255 255);
            padding: 0.5rem 0.875rem;
            border: 1px solid rgba(253, 253, 253, 0.363);
            border-radius: 0.375rem;
            background-color: #44b3fb;
            flex: 1 1 auto;
        }

        .form div input::placeholder {
            color: white;
        }

        .form div input:focus {
            border: 1px solid rgb(99 102 241);
        }

        .form div button {
            color: #fff;
            font-weight: 600;
            font-size: 0.875rem;
            line-height: 1.25rem;
            padding: 0.625rem 0.875rem;
            background: #052a3d;
            border-radius: 0.375rem;
            border: none;
            outline: none;
        }

        .p1 {
            font-size: 2.5rem;
            width: 550px;
        }

        @media screen and (max-width: 600px) {
            .p1 {
                font-size: 1.6rem;
                width: 385px;
            }
        }

        .p2 {
            font-size: 1.2rem;
            width: 550px;
        }

        @media screen and (max-width: 600px) {
            .p2 {
                font-size: 1rem;
                width: 355px;
            }
        }

        .p3 {
            font-size: 1.2rem;
        }

        @media screen and (max-width: 600px) {
            .p3 {
                font-size: 1rem;
            }
        }

        .h-t {
            font-size: 2.5rem;
        }

        @media screen and (max-width: 800px) {
            .h-t {
                font-size: 2.5rem;
            }
        }

        @media screen and (max-width: 600px) {
            .menu-icon {
                display: block;
                margin-bottom: 10px;
                text-align: center;
            }
        }

        .h-t2 {
            font-size: 2.5rem;
        }

        @media screen and (max-width: 800px) {
            .h-t2 {
                font-size: 1rem;
            }
        }

        .card-background {
            background-image: url('http://www.myconnectmind.com/images/header.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .card-background2 {
            background-image: url('http://www.myconnectmind.com/images/view2.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .card {
            --background: #fff;
            --cardShadow: rgba(32, 33, 37, .1);
            --cardShadowHover: rgba(32, 33, 37, .06);
            --cardShadowActive: rgba(32, 33, 37, .55);
            --cardBorder: #dbdce0;
            --cardBorderActive: #1a73e8;
            --textColor: #202125;
            --linkColor: #1967d2;
            --ratingColor: #faab00;
        }

        @media (prefers-color-scheme: dark) {
            .card {
                --background: #3c4043;
                --cardShadow: rgba(0, 0, 0, .28);
                --cardShadowHover: rgba(0, 0, 0, .16);
                --cardShadowActive: rgba(0, 0, 0, .55);
                --cardBorder: #202125;
                --cardBorderActive: #8ab4f8;
                --textColor: #e9eaee;
                --linkColor: #8ab4f8;
            }
        }

        .card2 {
            width: 17em;
            height: 27em;
            aspect-ratio: 2/3;
            background: var(--background);
            color: var(--textColor);
            border: 1px solid var(--cardBorder);
            padding: 25px;
            box-shadow: 8px 8px 0 var(--cardShadow);
            transition: box-shadow .5s, transform .5s;
            border-radius: 8px;
            display: inline-block;
        }

        .card2:hover {
            transform: translate(-2px, -4px);
            box-shadow: 16px 16px 0 var(--cardShadowHover);
        }

        .card2:active {
            transform: translate(-2px, -4px);
            border: 2px solid var(--cardBorderActive);
            box-shadow: 4px 4px 0 var(--cardShadowActive);
        }

        .card2>.title,
        .card2>.description {
            margin-bottom: 0.7em;
            cursor: default;
            user-select: none;
        }

        .card2>.title {
            margin-top: 1.5em;
            font-weight: bold;
        }

        .card2>.description {
            line-height: 1.5em;
            min-height: 6em;
        }

        .card2>.rating {
            font-size: 1.5em;
            margin-bottom: 0.8em;
            color: var(--ratingColor);
            font-weight: bold;
            position: relative;
            width: max-content;
        }

        .card2>.rating:before {
            content: "☆☆☆☆☆";
        }

        .card2>.rating:after {
            content: "★★★★★";
            position: absolute;
            left: 0;
            z-index: 0;
            width: calc(var(--rating) * 1%);
            overflow: hidden;
        }

        .card2>.link {
            margin-bottom: 1rem;
            color: var(--linkColor);
            font-size: .8em;
            font-weight: 600;
        }

        /* Optional ~ Link the whole card */
        .card2>.link::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .card2>.link:after {
            content: "↗";
            display: inline-block;
            margin-left: .3em;
            transition: transform .3s ease-in-out;
        }

        .card2:hover>.link:after {
            transform: translate(.2em, -.2em);
        }

        .card2 .img {
            width: 7em;
            height: 7em;
            background: white;
            border-radius: 15px;
            margin-top: 10px;
        }

        .container2 {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 350px;
            border-radius: 10px;
        }

        .card-2 {
            position: relative;
            background: #333;
            width: 250px;
            height: 350px;
            border-radius: 10px;
            padding: 2rem;
            color: #aaa;
            box-shadow: 0 .25rem .25rem rgba(0, 0, 0, 0.2),
                0 0 1rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-2__image-container {
            margin: -2rem -2rem 1rem -2rem;
        }

        .card-2__line {
            opacity: 0;
            animation: LineFadeIn .8s .8s forwards ease-in;
        }

        .card-2__image {
            opacity: 0;
            animation: ImageFadeIn .8s 1.4s forwards;
        }

        .card-2__title {
            color: white;
            margin-top: 35px;
            margin-bottom: 10px;
            font-weight: 800;
            letter-spacing: 0.01em;
        }

        .card-2__content {
            margin-top: -1rem;
            opacity: 0;
            animation: ContentFadeIn .8s 1.6s forwards;
        }

        .card-2__svg {
            position: absolute;
            left: 0;
            top: 115px;
        }

        @keyframes LineFadeIn {
            0% {
                opacity: 0;
                d: path("M 0 300 Q 0 300 0 300 Q 0 300 0 300 C 0 300 0 300 0 300 Q 0 300 0 300 ");
                stroke: #fff;
            }

            50% {
                opacity: 1;
                d: path("M 0 300 Q 50 300 100 300 Q 250 300 350 300 C 350 300 500 300 650 300 Q 750 300 800 300");
                stroke: #888BFF;
            }

            100% {
                opacity: 1;
                d: path("M -2 100 Q 50 200 100 250 Q 250 400 350 300 C 400 250 550 150 650 300 Q 750 450 802 400");
                stroke: #545581;
            }
        }

        @keyframes ContentFadeIn {
            0% {
                transform: translateY(-1rem);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes ImageFadeIn {
            0% {
                transform: translate(-.5rem, -.5rem) scale(1.05);
                opacity: 0;
                filter: blur(2px);
            }

            50% {
                opacity: 1;
                filter: blur(2px);
            }

            100% {
                transform: translateY(0) scale(1.0);
                opacity: 1;
                filter: blur(0);
            }
        }

        .cont3 {
            width: 90%;
            justify-content: center;
            align-items: center;
            background: rgba(93, 109, 126, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 12px;
            padding: 40px;
            margin-bottom: 40px;
        }

        .cont4 {
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .cont5 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-family: 'Poppins',
                sans-serif;
            line-height: 1.3em;
            margin-right: 20px;
            text-align: center;
            font-weight: 500;
            width: 300px;
        }

        @media only screen and (max-width: 768px) {
            .cont4 {
                flex-direction: column;
            }

            .cont5 {
                margin-right: 0;
                margin-bottom: 20px;
                width: 100%;
            }
        }

        .cont6 {
            width: 90%;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 12px;
            padding: 40px;

        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .text {
            padding-left: 100px;
            font-size: 19px;
        }

        @media screen and (max-width: 600px) {
            .text {
                padding-left: 1px;
                font-size: 19px;
            }
        }
    </style>
</head>

<body>
    <div class="card bg-transparent border-0">
        <div class="card-body card-background" style="height: 100vh;">
            <button class="btn btn-primary" type="button" style="border-radius:20px; margin:3rem;"
                data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <i class="bi bi-list" style="font-size:30px;"></i>
            </button>

            <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
                aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="<?= base_url() ?>LandingUser/sett/<?= $id_plant ?>">
                                    Diseñar</a></li>
                            <li class="list-group-item">Analisis</li>
                            <li class="list-group-item"><a href="<?= base_url() ?>LandingUser/setemb">Embudo</a></li>
                            <li class="list-group-item">Atras</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 mb-2 text-center">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <br><br><br><br><br>
                        <?php if ($tools->logo != null) { ?>
                            <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->logo ?>"
                                style="float: left; width: 163px; height: 43px; line-height: 1;">
                        <?php } else { ?>
                            <img src="https://www.myconnectmind.com/images/myconnect/encabezado2.png"
                                style="float: left; width: 163px; height: 43px; line-height: 1;">
                        <?php } ?>
                        <button type="button" class="btn btn-primary" style="border:none;background:none;"
                            data-bs-toggle="modal" data-bs-target="#Setpic" value="pic1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">

                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />

                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />

                            </svg>
                        </button>
                        <br><br>
                        <p class="p1" style="text-align: justify; line-height: 1; font-family: Poppins, sans-serif;">
                            <?php if ($tools->t1 != null) { ?>
                                <?= $tools->t1 ?>
                            <?php } else { ?>
                                CÓMO FIRMAR +15 SOCIOS
                                A LA SEMANA HACIENDO
                                UNA SOLA LLAMADA
                            <?php } ?>
                            <!-- Button t1 -->
                            <button type="button" class="btn btn-primary" style="border:none;background:none;"
                                data-bs-toggle="modal" data-bs-target="#miModal" value="t1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </p>
                        <p class="p2" style="text-align: justify; font-family: Roboto, sans-serif;">
                            <?php if ($tools->d1 != null) { ?>
                                <?= $tools->d1 ?>
                            <?php } else { ?>
                                En este evento de 4 clases gratuitas te enseñaré el paso a paso para firmar +15
                                socios a la semana haciendo una sola llamada, incluso si aún no tienes
                                resultados y crees que has intentado de todo.
                            <?php } ?>
                            <!-- Button d1 -->
                            <button type="button" class="btn btn-primary" style="border:none;background:none;"
                                data-bs-toggle="modal" data-bs-target="#miModal" value="d1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </p>
                        <form class="form" action="<?= base_url() ?>LandingUser/embudo/<?= $id_plant ?>" method="post">
                            <div>
                                <input placeholder="Escriba su correo electronico" type="email"  style="color:black;" name="email" id="email"
                                    required>
                                <button id="_form_3_submit" class="_submit" type="submit">Registrarme</button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card rounded-0 border-0">
        <div class="card-body" style="padding: 0;">
            <div class="card rounded-0 border-0" style="background-color: #f3f4f5;">
                <div class="card-body">
                    <div class="container" style="width: 70%;">
                        <h1 clas="h-t" style="font-family: Poppins, sans-serif; text-align: justify;">
                            <?php if ($tools->t2 != null) { ?>
                                <?= $tools->t2 ?>&nbsp;
                            <?php } else { ?>
                                LA REBELIÓN DEL NETWORK MARKETING&nbsp;
                            <?php } ?>
                            <!-- Button t2 -->
                            <button type="button" class="btn btn-primary"
                                style="border:none;background:none; color: black;" data-bs-toggle="modal"
                                data-bs-target="#miModal" value="t2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </h1>
                        <p class="p3" style="text-align: center; line-height: 1.1em">
                            <?php if ($tools->d2 != null) { ?>
                                <?= $tools->d2 ?>
                            <?php } else { ?>
                                Llega para revelar cómo +132 networkeres han aplicado el método PVIP y han logrado firmar
                                +15 socios a la semana... ¿Te gustaría tener los mismos resultados?&nbsp;
                            <?php } ?>
                            <!-- Button d2 -->
                            <button type="button" class="btn btn-primary"
                                style="border:none;background:none; color: black;" data-bs-toggle="modal"
                                data-bs-target="#miModal" value="d2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </p>
                    </div>
                </div>
                <div class="container">
                    <center>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            <?php foreach ($cards as $c) { ?>

                                <div class="col">
                                    <div class="card2">
                                        <div class="img">
                                            <img src="<?= base_url() ?>/assets/img/landing/Cards/<?= $c->img ?>"
                                                alt="imagen" class="img-fluid">
                                        </div>
                                        <div class="card-body">
                                            <p class="description" style="margin-top: 30px;">
                                                <?= $c->descripcion ?>&nbsp;
                                            </p>
                                            <center> <a href="<?= $c->link ?>" class="btn btn-primary btn-sm" type="button"
                                                    style="width:60%;"> Mas Info </a></center>
                                            <p style="margin-top: 10px;">
                                                <?= $c->fecha ?>
                                            </p>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary"
                            style="width:40%; margin-top: 10px; margin-bottom: 20px;" data-bs-toggle="modal"
                            data-bs-target="#aggcard">
                            Agrega card
                        </button>
                        <center>
                </div>
                <div class="card rounded-0 border-0">
                    <div class="card-body card-background2">
                        <div class="container cont6">
                            <h1 class="h-t2" style="font-family: Poppins, sans-serif; text-align: justify;">
                                <?php if ($tools->t3 != null) { ?>
                                    <?= $tools->t3 ?>
                                <?php } else { ?>
                                    EL NETWORK MARKETING NO SERÁ EL MISMO DESPUÉS DEL EVENTO DE LA REBELIÓN DIGITAL
                                <?php } ?>
                                <!-- Button t3 -->
                                <button type="button" class="btn btn-primary" style="border:none;background:none;"
                                    data-bs-toggle="modal" data-bs-target="#miModal" value="t3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            </h1>
                            <p class="p3" style="text-align: justify; line-height: 1.1em;">
                                <?php if ($tools->d3 != null) { ?>
                                    <?= $tools->d3 ?>
                                <?php } else { ?>
                                    A veces miramos a
                                    otros líderes
                                    tener resultados y pensamos, ¿qué están haciendo ellos, que yo no estoy haciendo? -
                                    Ahora,
                                    tú serás el próximo caso de éxito de tu negocio gracias a el método que aprenderás que
                                    ha
                                    permitido que más de 1232 personas firmen 15 socios a la semana haciendo una sola
                                    llamada
                                <?php } ?>
                                <!-- Button d3 -->
                                <button type="button" class="btn btn-primary" style="border:none;background:none;"
                                    data-bs-toggle="modal" data-bs-target="#miModal" value="d3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card rounded-0 border-0" style="background-color: #f3f4f5;">
                    <div class="card-body">
                        <h1 class="h-t2"
                            style="font-family: Poppins, sans-serif; text-align: center; margin-bottom: 50px;">
                            <?php if ($tools->t4 != null) { ?>
                                <?= $tools->t4 ?>
                            <?php } else { ?>
                                ¿QUIÉN SOY Y POR QUÉ PUEDO AYUDARTE?
                            <?php } ?>
                            <!-- Button t4 -->
                            <button type="button" class="btn btn-primary"
                                style="border:none;background:none; color:black;" data-bs-toggle="modal"
                                data-bs-target="#miModal" value="t4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </h1>
                        <div class="container cont3">
                            <div class="row">
                                <div class="col-md-6 text">
                                    <br>
                                    <p>
                                        <?php if ($tools->descripcion != null) { ?>
                                            <?= $tools->descripcion ?>
                                        <?php } else { ?>
                                            Mi nombre es Gigi Toneatti <br> <br>He ayudado a +832 networkers sin
                                            resultados
                                            firmar
                                            +15 socios a la semana y tener un negocio rentable. <br><br> Ello, aplicando
                                            el
                                            mismo
                                            método que me ha permitido facturar +$150.000 USD dólares. <br><br> Mi
                                            misión es
                                            que tú
                                            aprendas el paso a paso del método PVIP completamente GRATIS y seas el
                                            próximo
                                            caso de
                                            éxito. <br><br> Regístrate al entrenamiento y recibe GRATIS mi guía para
                                            aplicar
                                            efectivos secretos de Internet para tener en tu negocio de red de marcadeo.
                                        <?php } ?>
                                        <!-- Button desc -->
                                        <button type="button" class="btn btn-primary"
                                            style="border:none;background:none; color:black;" data-bs-toggle="modal"
                                            data-bs-target="#miModal" value="desc">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square align-middle"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <?php if ($tools->img3 != null) { ?>
                                            <img src="<?= base_url() ?>/assets/img/landing/Pics/<?= $tools->img3 ?>"
                                                width="272" height="420">
                                        <?php } else { ?>
                                            <img style="margin-top: 50px;"
                                                src="https://vilmanunez.com/wp-content/uploads/2020/10/VN-Co%CC%81mo-hacer-una-buena-presentacio%CC%81n-de-resultados-de-auditori%CC%81a-u%CC%81ltimas-horas.png"
                                                width="272" height="420">
                                        <?php } ?>
                                        <button type="button" class="btn btn-primary"
                                            style="border:none;background:none;color:black;" data-bs-toggle="modal"
                                            data-bs-target="#Setpic3" value="pic3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square align-middle"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 50px; margin-top: 30px;">
                        <h1 class="h-t2" style="font-family: Poppins, sans-serif; text-align: center;">
                            ÍNDICANOS TU CORREO PARA RESERVAR TU LUGAR PARA LAS <b style="color: #44b3fb;">CLASES
                                GRATIS DEL 13 AL 16 DE
                                FEBRERO</b></h1>
                        <br>
                        <center>
                            <form class="form" action="<?= base_url() ?>LandingUser/embudo/<?= $id_plant ?>"
                                method="post">
                                <div>
                                    <input placeholder="Escriba su correo electronico" style="color:black;" type="email" name="email"
                                        id="email" required>
                                    <button id="_form_5_submit" class="button" class="_submit"
                                        type="submit">Registrarme</button>
                                </div>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="aggcard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url() ?>LandingUser/saveCard/<?= $id_plant ?>" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Imagen :</label>
                                <input type="file" name="img" class="form-control" required>
                                <label for="">Descripcion :</label>
                                <input type="text" name="descri" class="form-control" required>
                                <label for="">Link para informacion :</label>
                                <input type="text" name="link" class="form-control" required>
                                <label for="">Fecha :</label>
                                <input type="date" name="fecha" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal  Modificar Campos-->
            <div class="modal" tabindex="-1" role="dialog" id="miModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() ?>LandingUser/saveData/<?= $id_plant ?>" method="post" required>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Campo°</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            <!-- Modal  Modificar logo-->
            <div class="modal" tabindex="-1" role="dialog" id="Setpic">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() ?>LandingUser/Setimg/<?= $id_plant ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Modifica el Logo</label>
                                <input type="file" class="form-control" name="img" required>
                                <input type="hidden" value="1" name="op">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal  Modificar imagen 2-->
            <div class="modal" tabindex="-1" role="dialog" id="Setpic2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() ?>LandingUser/Setimg/<?= $id_plant ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Modifica la imagen</label>
                                <input type="file" class="form-control" name="img" required>
                                <input type="hidden" value="2" name="op">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal  Modificar imagen 3-->
            <div class="modal" tabindex="-1" role="dialog" id="Setpic3">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url() ?>LandingUser/Setimg/<?= $id_plant ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Modifica la imagen</label>
                                <input type="file" class="form-control" name="img" required>
                                <input type="hidden" value="3" name="op">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    $("#miModal").on("show.bs.modal", function (event) {
                        console.log("hola");
                        var boton = $(event.relatedTarget);
                        var opcion = boton.val();

                        if (opcion == "t1") {
                            var input = $('<input>').attr({ type: 'text', name: 't1', class: 'form-control', placeholder: 'Modifique el titulo 1º', required: true });
                        } if (opcion == "d1") {
                            var input = $('<input>').attr({ type: 'text', name: 'd1', class: 'form-control', placeholder: 'Modifique la descripcion 1º', required: true });
                        } if (opcion == "t2") {
                            var input = $('<input>').attr({ type: 'text', name: 't2', class: 'form-control', placeholder: 'Modifique el titulo 2º', required: true });
                        } if (opcion == "d2") {
                            var input = $('<input>').attr({ type: 'text', name: 'd2', class: 'form-control', placeholder: 'Modifique la descripcion 2º', required: true });
                        } if (opcion == "t3") {
                            var input = $('<input>').attr({ type: 'text', name: 't3', class: 'form-control', placeholder: 'Modifique el titulo 3º', required: true });
                        } if (opcion == "d3") {
                            var input = $('<input>').attr({ type: 'text', name: 'd3', class: 'form-control', placeholder: 'Modifique la descripcion 3º', required: true });
                        } if (opcion == "t4") {
                            var input = $('<input>').attr({ type: 'text', name: 't4', class: 'form-control', placeholder: 'Modifique el titulo 4º', required: true });
                        } if (opcion == "t5") {
                            var input = $('<input>').attr({ type: 'text', name: 't5', class: 'form-control', placeholder: 'Modifique el titulo 5º', required: true });
                        } if (opcion == "desc") {
                            var input = $('<input>').attr({ type: 'text', name: 'descripcion', class: 'form-control', placeholder: 'Modifique la descripcion', required: true });
                        }
                        // Actualiza el contenido del cuerpo del modal
                        var modal = $(this);
                        modal.find('.modal-body').html(input);
                    })
                });
            </script>
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
            media="screen">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>
</body>

</html>