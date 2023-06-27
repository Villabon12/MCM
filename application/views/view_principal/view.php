<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Connect Mind</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Cormorant:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Almarai:wght@800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icon-css@4.1.7/css/flag-icons.min.css">
    <link rel="icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <style>
        body {
            background: #000;
        }

        .navbar {
            background-color: transparent !important;
            display: flex;
            justify-content: center;
        }

        .navbar-nav {
            margin-left: auto;
        }

        /* Inicio Diseño Botones Inicio e Iniciar Session */
        .boton2,
        .boton2::after {
            padding: 10px 40px;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: transparent;
            position: relative;
        }

        .boton2::after {
            --move1: inset(50% 50% 50% 50%);
            --move2: inset(31% 0 40% 0);
            --move3: inset(39% 0 15% 0);
            --move4: inset(45% 0 40% 0);
            --move5: inset(45% 0 6% 0);
            --move6: inset(14% 0 61% 0);
            clip-path: var(--move1);
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: block;
        }

        .boton2:hover::after {
            animation: boton 1s;
            text-shadow: 10 10px 10px black;
            animation-timing-function: steps(2, end);
            text-shadow: -3px -3px 0px #1df2f0, 3px 3px 0px #E94BE8;
            background-color: transparent;
            border: 3px solid rgb(0, 255, 213);
        }

        .boton2:hover {
            text-shadow: -1px -1px 0px #1df2f0, 1px 1px 0px #E94BE8;
        }

        .boton2:hover {
            background-color: transparent;
            border: 1px solid rgb(0, 255, 213);
            box-shadow: 0px 10px 10px -10px rgb(0, 255, 213);
        }

        @keyframes boton {
            0% {
                clip-path: var(--move1);
                transform: translate(0px, -10px);
            }

            10% {
                clip-path: var(--move2);
                transform: translate(-10px, 10px);
            }

            20% {
                clip-path: var(--move3);
                transform: translate(10px, 0px);
            }

            30% {
                clip-path: var(--move4);
                transform: translate(-10px, 10px);
            }

            40% {
                clip-path: var(--move5);
                transform: translate(10px, -10px);
            }

            50% {
                clip-path: var(--move6);
                transform: translate(-10px, 10px);
            }

            60% {
                clip-path: var(--move1);
                transform: translate(10px, -10px);
            }

            70% {
                clip-path: var(--move3);
                transform: translate(-10px, 10px);
            }

            80% {
                clip-path: var(--move2);
                transform: translate(10px, -10px);
            }

            90% {
                clip-path: var(--move4);
                transform: translate(-10px, 10px);
            }

            100% {
                clip-path: var(--move1);
                transform: translate(0);
            }
        }

        /* Fin Diseño Botones Inicio e Iniciar Session */

        .boton {
            background-color: rgb(1, 101, 168);
            opacity: 0.8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            width: 140px;
        }

        .boton:hover {
            opacity: 1;
        }

        .icon-bar {
            font-size: 1.3em;
            line-height: 0.1;
            position: relative;
            color: #ff9933;
        }

        .icon-bar:after,
        .icon-bar:before {
            display: block;
            content: '';
            width: 400px;
            height: 1px;
            background: #ccc;
            position: absolute;
            left: -10px;
            top: 50%;
            margin-top: -1px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border: 2px solid white;
        }

        .video-container iframe,
        .video-container object,
        .video-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .card-background {
            background-image: url('http://www.myconnectmind.com/images/prueba.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        .card-view {
            width: 290px;
            height: 304px;
            border-radius: 30px;
            border: 1px solid white;
            background: #000;
            box-shadow: 15px 15px 30px rgb(25, 25, 25),
                -15px -15px 30px rgb(60, 60, 60);
            padding: 15px;
        }

        .card-view2 {
            width: 520px;
            height: 450px;
            background: #151a22;
            border-radius: 10px;
            transition: border-radius 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0px 0px 10px 5px rgba(255, 255, 255, 0.7);
        }


        .footer-dark {
            padding: 30px 0;
            color: #f0f9ff;
            background-color: #151a22;
        }

        .footer-dark .item.social {
            text-align: center;
        }

        .footer-dark .item.social>a {
            font-size: 20px;
            width: 36px;
            height: 36px;
            line-height: 36px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
            margin: 0 8px;
            color: #fff;
            opacity: 0.75;
        }

        .footer-dark .item.social>a:hover {
            opacity: 0.9;
        }

        .footer-dark .copyright {
            text-align: center;
            padding-top: 24px;
            opacity: 0.3;
            font-size: 13px;
            margin-bottom: 0;
        }

        h1 {
            font-size: 4em;
        }

        @media screen and (max-width: 800px) {
            h1 {
                font-size: 3em;
            }
        }

        .c {
            position: relative;
            max-height: 280px;
            float: left;
            width: 380px;
            height: 240px;
            overflow: hidden;
            overflow-y: auto;
        }

        .card-home {
            position: absolute;
            margin: 20px;
            top: 0;
            animation: scroll 2000s linear infinite;
        }

        .span1 {
            min-width: 400px;
            min-height: 60px;
            display: block;
            color: white;
            margin: 5px;
        }

        @media (max-width: 1024px) {
            .span1 {
                min-width: 300px;
                min-height: 75px;
                display: block;
                color: white;
                margin: 3px;
                font-size: 130%;
            }
        }

        @keyframes scroll {

            100% {
                top: -100000px;
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: white;
            border-radius: 5px;
        }

        .my-video-iframe {
            width: 100%;
            height: 100%;
        }

        .embed-responsive {
            border: 2px solid white;
        }

        .card1 {
            width: 360px;
            height: 350px;
            background: linear-gradient(to bottom, rgba(21, 26, 34, 1) 30%, rgba(21, 26, 34, 0) 100%);
            border-color: #fff;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .number {
            position: absolute;
            top: -30px;
            left: -40px;
            width: 120px;
            height: 120px;
            background-color: #333;
            color: #fff;
            font-size: 78px;
            font-weight: bold;
            line-height: 120px;
            text-align: center;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .content {
            text-align: center;
            padding-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
        }

        h2 {
            font-size: 40px;
            margin-bottom: 10px;
            font-family: 'Almarai', sans-serif;
            color: #fff;
        }

        .p2 {
            font-size: 22px;
            font-family: 'Almarai', sans-serif;
            color: #fff;
        }

        #zoom-title {
            transition: transform 0.3s ease;
        }

        #zoom-title:hover {
            transform: scale(1.2);
        }

        .zoom-image {
            overflow: hidden;
        }

        .zoom-image img {
            transition: transform 0.3s;
        }

        .zoom-image:hover img {
            transform: scale(1.1);
        }

        #container {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- Inicio -->
    <div class="card bg-transparent border-0">
        <div class="card-body card-background" style="height: 110vh;">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <img src="https://www.myconnectmind.com/images/myconnect/encabezado2.png?w=800" alt="Logo" width="250" height="100">&nbsp;&nbsp;&nbsp;
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>">
                                <button class="boton2">inicio</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>ingreso">
                                <button class="boton2">Iniciar sesion</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <br><br><br>
            <div>
                <h4 style="text-align: center; color: white; font-family: Poppins, sans-serif; text-shadow: 2px 2px 0 #000; font-size: 110%;">
                    Tu capital, Tu expecativa</h4>
                <h1 style="text-align: center; color: white; font-family: Poppins, sans-serif;">
                    La evolución del mercado</h1>
                <a class="btn btn-secondary boton" style="width:160px; color: #fff;" href="<?= base_url() ?>ingreso">!Empieza ahora¡
                </a>
                <br>
                <h4 style="text-align: center; color: white; font-family: Poppins, sans-serif; text-shadow: 2px 2px 0 #000; font-size: 110%;">
                    La renovación del trading en el mundo</h4>
            </div>
        </div>
    </div>
    <!-- Fin -->
    <!-- Inicio Trading View -->
    <section class="ob-is-breaking-bad elementor-section elementor-top-section elementor-element elementor-element-a50bca0 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="a50bca0" data-element_type="section" data-settings="{&quot;_ob_bbad_use_it&quot;:&quot;yes&quot;,&quot;_ob_bbad_sssic_use&quot;:&quot;no&quot;,&quot;_ob_glider_is_slider&quot;:&quot;no&quot;}">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ff572ca" data-id="ff572ca" data-element_type="column" data-settings="{&quot;_ob_bbad_is_stalker&quot;:&quot;no&quot;,&quot;_ob_teleporter_use&quot;:false,&quot;_ob_column_hoveranimator&quot;:&quot;no&quot;,&quot;_ob_column_has_pseudo&quot;:&quot;no&quot;}">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-element-39c8c4c elementor-widget elementor-widget-html" data-id="39c8c4c" data-element_type="widget" data-settings="{&quot;_ob_allow_hoveranimator&quot;:&quot;no&quot;,&quot;_ob_widget_stalker_use&quot;:&quot;no&quot;}" data-widget_type="html.default">
                                <div class="elementor-widget-container">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget">
                                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                                                {
                                                    "symbols" [{
                                                            "proName": "FOREXCOM:SPXUSD",
                                                            "title": "S&P 500"
                                                        },
                                                        {
                                                            "proName": "FOREXCOM:NSXUSD",
                                                            "title": "Nasdaq 100"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:EURUSD",
                                                            "title": "EUR/USD"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:GBPUSD",
                                                            "title": "GBP/USD"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:USDJPY",
                                                            "title": "USD/JPY"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:USDCHF",
                                                            "title": "USD/CHF"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:USDCAD",
                                                            "title": "USD/CAD"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:AUDUSD",
                                                            "title": "AUD/USD"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:BTCUSD",
                                                            "title": "BTC/USD"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:ETHUSD",
                                                            "title": "ETH/USD"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:XRPUSD",
                                                            "title": "XRP/USD"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:XLMUSD",
                                                            "title": "XLM/USD"
                                                        }
                                                    ]
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Trading View -->
    <br><br>
    <!-- Inicio Presentación -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <br><br>
                <p style="line-height: 0.01; color: white; font-family: Cormorant; font-size: 4rem">Aprende a
                </p>
                <p style="line-height: 0.9; color: white; font-family:Cormorant; font-size: 4rem">aumentar tus
                </p>
                <p style="line-height: 0.08; color: white; font-family:Cormorant; font-size: 4rem">ganancias</p>
                <br>
                <span class="icon-bar">
                </span>
                <br>
                <div class="c">
                    <div class="card mb-3" style="max-width: auto; margin-top: 20px; border-radius: 25px; background-color: #d1fccb;">
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
                                    <h4 style="text-align: justify;">Compra</h4>
                                    <h4 style="text-align: justify;">Precio Señal: 1.0777</h4>
                                    <h4 style="text-align: justify;">UTC: 2023-05-23</h4>
                                    <h4 style="text-align: justify;">Hace: 15 Minutos</h4>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col">
                                    <h4 class="moneda">EUR/USD</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: auto; margin-top: 20px; border-radius: 25px; background-color: #febfb6;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col" style="text-align: left;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ff0000" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                    </svg>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col-8">
                                    <h4 style="text-align: justify;">Venta</h4>
                                    <h4 style="text-align: justify;">Precio Señal: 1.082</h4>
                                    <h4 style="text-align: justify;">UTC: 2023-05-19</h4>
                                    <h4 style="text-align: justify;">Hace: 15 Minutos</h4>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col">
                                    <h4 class="moneda">EUR/USD</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <br><br><br><br>
                <div class="video-container">
                    <iframe width="566" height="318" src="https://www.youtube.com/embed/Rlus8YcMAO0" title="PRESENTACIÓN MILLION TEAM RÁPIDA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Presentación -->
    <br><br><br><br>
    <div class="card text-center" style="border: none; background-color: transparent;">
        <div class="card-body">

        </div>
    </div>
    <div id="container">
        <h2 id="zoom-title" style="text-align: center; margin-bottom: 40px; color: #fff;">FÁCIL DE COMENZAR</h2>
    </div>
    <div class="container" style="justify-content: center; align-items: center; display: flex;">
        <center>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card1">
                        <div class="number">1</div>
                        <div class="content">
                            <h2>Adquiere</h2>
                            <p class="p2">Obten acceso a nuestra plataforma</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card1">
                        <div class="number">2</div>
                        <div class="content">
                            <h2>Accede a nuestra escuela</h2>
                            <p class="p2">Aprenderas cómo copiar las señales Fácil y rápido!</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card1">
                        <div class="number">3</div>
                        <div class="content">
                            <h2>Empieza a ganar</h2>
                            <p class="p2">Sigue nuestras señales y recomendaciones para obtener operaciones ganadoras</p>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>

    <h2 id="zoom-title" style="text-align: center; margin-bottom: 40px; color: #fff; font-weight: bold; max-width: 600px;margin: 0 auto;">
        ¿CONOCES NUESTROS BENEFICIOS?</h2>
    <div class="container" style="margin-top: 60px;">
        <div class="row">
            <div class="col-sm-6 zoom-image" style="text-align: center;">
                <img src="https://privatrading.com/wp-content/uploads/2023/03/Group-10.png" alt="" style="width: 60%; margin-top: 5px;">
                <h2 style="text-align: center; color: #fff; font-weight: bold; max-width: 600px;margin: 0 auto; margin-bottom: 20px;">
                    Operativas En vivo</h2>
                <p style="font-size: 18px; color: #fff; text-align: center;">Experimenta la emoción de operar en vivo con nuestra
                    plataforma de operativas en vivo. Únete a nuestros
                    expertos traders mientras realizan operaciones en
                    tiempo real y aprende de sus estrategias.
                    ¡Potencia tus habilidades y obtén resultados
                    reales en el trading!</p>
            </div>
            <div class="col-sm-6 zoom-image" style="text-align: center; margin-top: 50px;">
                <h2 style="text-align: center; color: #fff; font-weight: bold; max-width: 600px;margin: 0 auto; margin-bottom: 20px;">
                    Señales Binarias y Forex</h2>
                <p style="font-size: 18px; color: #fff; text-align: center;">¿Listo para tomar decisiones informadas en el
                    mundo del trading? Nuestro servicio de señales
                    de binarias y forex te proporciona las herramientas
                    necesarias para el éxito. Recibe recomendaciones
                    estratégicas y análisis en tiempo real para aprovechar
                    las oportunidades del mercado financiero.</p>
                <img src="https://devexperts.com/app/uploads/2018/12/mac-book-pro-crypto.png" alt="" style="width: 75%; margin-top: 40px;">
            </div>
        </div>
    </div>
    <!-- Inicio Eventos, Herramientas y servicios  -->
    <div class="card bg-transparent border-0">
        <div class="container ">
            <div class="card-body">
                <h1 style="text-align: center; color: white; font-family: Cormorant; font-size: 3rem;">
                    Eventos Próximos</h1>
                <br>
                <h4 style="color: white;">
                    No hay eventos próximos</h4>
                <br><br><br><br><br><br><br><br><br>
                <h1 style="text-align: center; color: white; font-family: Cormorant; font-size: 3rem;">
                    Herramientas</h1>
                <br><br>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-view2 w-100">
                            <div class="card-body">
                                <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif; text-align: center;">
                                    Convertidor de divisas</h5>
                                <br>
                                <div class="elementor-element elementor-element-9031f51 elementor-widget elementor-widget-text-editor" data-id="9031f51" data-element_type="widget" data-settings="{&quot;_ob_postman_use&quot;:&quot;no&quot;,&quot;_ob_allow_hoveranimator&quot;:&quot;no&quot;,&quot;_ob_widget_stalker_use&quot;:&quot;no&quot;}" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-text-editor elementor-clearfix">
                                            ​<iframe style="border: 2px; border-radius: 10px;" src="https://themoneyconverter.com/es/CurrencyConverter?
                                                tab=0&from=USD&to=COP&bg=ffffff" marginwidth="0" marginheight="0" scrolling="no" seamless="seamless" width="100%" height="348"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-view2 w-100">
                            <div class="card-body">
                                <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif; text-align: center;">
                                    Convertidor de divisas</h5>
                                <br>
                                <form id="contactForm" action="<?= base_url() ?>View_principal/calcular" method="post">
                                    <div class="input-group mb-3">
                                        <input type="number" name="balance" placeholder="balance" class="form-control">
                                    </div>
                                    <div class="input-group mb-3">

                                        <input type="number" name="periodo" placeholder="periodo" class="form-control">
                                        <div class="input-group mb-3">
                                        </div>

                                        <input type="number" name="ganancia" placeholder="Interes (%)" class="form-control">
                                        <div class="input-group mb-3">
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit">Calcular</button>
                                    </div>
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');

                $("#contactForm").submit(function(e) {
                    e.preventDefault();

                    data = $(this).serialize();
                    ruta = $(this).attr("action");
                    if (e) {
                        $.ajax({
                            url: ruta,
                            type: "POST",
                            data: data,
                            success: function(resp) {
                                html = resp;
                                $('#add').html(html);
                                $('#edit').modal('show');
                            }
                        });
                    }

                });
            })
        </script>
    </div>
    <br><br><br>
    <div class="container">
        <h1 style=" text-align: center; color: white; font-family: Cormorant; font-size: 3rem">
            ¡Tenemos 4 servicios!, Proximamente más</h1>
        <br><br>
        <center>
            <div class="row">
                <div class="col-sm-3" style="padding: 0;">
                    <div class="card-view">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif;">
                                Robot
                                de Binaria</h5>
                            <br>
                            <p class="card-text" style="color: white;">Nuestros más
                                capacitados
                                traders
                                y
                                programadores se unieron, lanzando este gran producto en
                                donde
                                se estima
                                una
                                ganancia minima del 5%</p>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">
                    <div class="card-view">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif;">
                                Robot
                                de Arbitraje</h5>
                            <br>
                            <p class="card-text" style="color: white;">Accede al sistema
                                algorítmico mas
                                potente
                                en el mercado ejecutando ordenes compras y ventas en los
                                diferentes
                                Exchange de
                                criptomonedas en cuestión de milisegundo obteniendo
                                beneficios
                                al
                                comparar los
                                diferentes precios de diferentes tokens en el mercado de las
                                criptomonedas</p>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">
                    <div class="card-view">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif;">
                                Robot
                                de Scalping</h5>
                            <br>
                            <p class="card-text" style="color: white;">Genera ingresos
                                pasivos
                                en el
                                mercado de
                                CFD´s, Materias primas e Índices con nuestro BOT funcionando
                                las
                                24
                                horas del
                                día los 6 días de las semana, conéctate y ten el control de
                                tu
                                dinero,
                                deposita
                                y retira por ti mismo mediante el sistema de social trading.
                            </p>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">
                    <div class="card-view">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; font-family: Poppins, sans-serif;">MCMlinks
                            </h5>
                            <br>
                            <p class="card-text" style="color: white;">Organiza, personaliza a tu estilo y
                                administra tu
                                carta de presentación para compartirla con el mundo entero.</p>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </center>
    </div>
    <br><br><br>
    <br><br><br><br><br>
    <!-- Fin Eventos, Herramientas y servicios  -->

    <!-- Inicio Modal Resultado Conversion  -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Periodos</th>
                                    <th scope="col">Balance Inicial</th>
                                    <th scope="col">Balance Final</th>
                                    <th scope="col">Beneficio Total</th>
                                    <th scope="col">Ganancia Totales</th>
                                </tr>
                            </thead>
                            <tbody id="add">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Resultado Conversion  -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="embed-responsive embed-responsive-16by9" style="width: 100%; height: 670px;">
                        <iframe id="my-video" class="embed-responsive-item my-video-iframe" src="https://www.youtube.com/embed/Rlus8YcMAO0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <script>
        var myModal = document.getElementById('exampleModal');
        var myVideo = document.getElementById('my-video');

        myModal.addEventListener('hidden.bs.modal', function(event) {
            var videoSrc = myVideo.src;
            myVideo.src = videoSrc;
        });

        myModal.addEventListener('shown.bs.modal', function(event) {
            myVideo.contentWindow.postMessage('{"event":"command","func":"seekTo","args":[0, true]}', '*');
            myVideo.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
        });
    </script>

    <!-- Inicio Footer  -->
    <div class="card footer-dark">
        <div class="card-body">
            <div style="text-align: center; padding: 15px">
                <a href="https://myconnectmind.com">
                    <img src="https://www.myconnectmind.com/images/myconnect/encabezado2.png?w=800" alt="Logo" width="250" height="auto">
                </a>
            </div>
            <div class="item social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
            <p class="copyright">© My Connect Mind&copy; 2022</p>
        </div>
    </div>
    <!-- Fin Footer  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>