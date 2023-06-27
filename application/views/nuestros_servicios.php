<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>My connect Mind</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url() ?>landing/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?= base_url() ?>landing/css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="<?= base_url() ?>landing/css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <style>
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 350px;
            height: 800px;
            padding: 20px 1px;
            margin: 10px 0;
            text-align: center;
            position: relative;
            cursor: pointer;
            box-shadow: 0 10px 15px -3px rgba(33, 150, 243, .4), 0 4px 6px -4px rgba(33, 150, 243, .4);
            border-radius: 10px;
            background-color: #6B6ECC;
            background: linear-gradient(45deg, #04051dea 0%, #2b566e 100%);
            margin-top: 50px;
        }

        .content {
            padding: 20px;
        }

        .content .price {
            color: white;
            font-weight: 800;
            font-size: 50px;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.42);
        }

        .content .description {
            color: rgba(255, 255, 255, 0.6);
            margin-top: 10px;
            font-size: 14px;
            text-align: justify;
        }

        .content .title {
            font-weight: 800;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.64);
            margin-top: 10px;
            font-size: 25px;
            letter-spacing: 1px;
            line-height: 1;
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

        .card-container {
            width: 350px;
            height: 450px;
            position: relative;
            border-radius: 10px;
            margin: 0;
        }

        .card-container::before {
            content: "";
            z-index: -1;
            position: absolute;
            inset: 0;
            background: linear-gradient(-45deg, #fc00ff 0%, #00dbde 100%);
            transform: translate3d(0, 0, 0) scale(0.95);
            filter: blur(20px);
        }

        .card2 {
            width: 350px;
            height: 450px;
            border-radius: inherit;
            overflow: hidden;
            margin-top: 20px;
        }

        .card2 .img-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-position: center;
            transition: scale 0.6s, rotate 0.6s, filter 1s;
        }

        .card2 .img-content svg {
            width: 50px;
            height: 50px;
            fill: #212121;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .card2 .content2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 10px;
            color: #e8e8e8;
            padding: 20px;
            line-height: 1.5;
            border-radius: 5px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(50px);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .card2 .content2 .heading {
            font-size: 32px;
            font-weight: 700;
        }

        .card2:hover .content2 {
            opacity: 1;
            transform: translateY(0);
        }

        .card2:hover .img-content {
            scale: 2.5;
            rotate: 30deg;
            filter: blur(7px) brightness(0.5);
        }
    </style>
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="<?= base_url() ?>landing/images/loading.gif" alt="" /></div>
    </div>
    <!-- end loader -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a class="active" href="<?= base_url() ?>ingreso">Iniciar Sesion</a>
        <a class="active" href="<?= base_url() ?>">Inicio</a>
        <a class="active" href="<?= base_url() ?>nuestros_servicios">Nuestros Servicios</a>
        <a class="active" href="<?= base_url() ?>aprende_con_nosotros">Aprende con nosotros</a>
    </div>
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="head-top">
            <div class="container-fluid">
                <div class="row d_flex">
                    <div class="col-sm-3">
                        <div class="logo">
                            <img src="<?= base_url() ?>images/myconnect/encabezado2.png?w=600" alt="">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <!-- <ul class="social_icon text_align_right d_none">
                            <li> <a href="Javascript:void(0)"><i class="fa fa-facebook-f"></i></a></li>
                            <li> <a href="Javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li> <a href="Javascript:void(0)"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li> <a href="Javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            <li> <a href="Javascript:void(0)"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="col-sm-4">
                        <ul class="email text_align_right">
                            <!-- <li class="d_none"><a href="Javascript:void(0)"><i class="fa fa-user"
                                        aria-hidden="true"></i></a></li>
                            <li class="d_none"> <a href="Javascript:void(0)"><i class="fa fa-search"
                                        style="cursor: pointer;" aria-hidden="true"></i></a> </li> -->
                            <li>
                                <button class="openbtn" onclick="openNav()"><img src="<?= base_url() ?>landing/images/menu_btn.png"></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <center style="margin-top: 200px; margin-bottom: 100px;">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card-container">
                        <div class="card2">
                            <div class="img-content" style="background-image: url('../images/senales.png'); background-size: 300px 250px; background-color: #041334; background-repeat: no-repeat;">
                                <h2 style="margin-top: -360px; font-weight: 700;">SEÑALES EN VIVO</h2>
                            </div>
                            <div class="content2">
                                <p class="heading">SEÑALES EN VIVO</p>
                                <p>
                                    Con nuestro servicio de señales, podrás maximizar
                                    tus ganancias, minimizar tus riesgos y aprovechar
                                    las oportunidades de trading más rentables. Acompañamos
                                    a cada cliente en su camino hacia el éxito financiero,
                                    proporcionando una experiencia de trading única, confiable
                                    y transparente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card-container">
                        <div class="card2">
                            <div class="img-content" style="background-image: url('https://vfxalert.com/img/phone-img2.png'); background-size: 300px 300px; background-color: #041334; background-repeat: no-repeat;">
                                <h2 style="margin-top: -360px; font-weight: 700;">OPERATIVAS EN VIVO</h2>
                            </div>
                            <div class="content2">
                                <p class="heading">OPERATIVAS EN VIVO</p>
                                <p>
                                    Durante nuestras Operativas en Vivo, podrás ver,
                                    aprender y replicar las estrategias utilizadas
                                    por nuestros profesionales, quienes compartirán
                                    contigo sus análisis de mercado, decisiones de
                                    trading y responderán a tus preguntas en el momento
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card-container">
                        <div class="card2">
                            <div class="img-content" style="background-image: url('https://www.adaoncloud.com/es/wp-content/uploads/sites/2/2021/02/landing-amp-vector-01-1.png'); background-size: 300px 300px; background-color: #041334; background-repeat: no-repeat;">
                                <h2 style="margin-top: -360px; font-weight: 700;">LANDING DINAMICAS Y PERSONALIZABLES</h2>
                            </div>
                            <div class="content2">
                                <p class="heading">LANDING DINAMICAS Y PERSONALIZABLES</p>
                                <p>
                                    Este módulo ha sido creado para empoderarte,
                                    permitiéndote diseñar y modificar tus propias
                                    páginas de aterrizaje para eventos o emprendimientos.
                                    Ya sea que estés organizando una conferencia, lanzando
                                    un nuevo producto o promoviendo tu última iniciativa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card-container">
                        <div class="card2">
                            <div class="img-content" style="background-image: url('https://cdn-icons-png.flaticon.com/512/3076/3076404.png'); background-size: 300px 300px; background-color: #041334; background-repeat: no-repeat;">
                                <h2 style="margin-top: -360px; font-weight: 700;">MCMLINKS</h2>
                            </div>
                            <div class="content2">
                                <p class="heading">MCMLINKS</p>
                                <p>
                                    Organiza, personaliza a tu estilo y administra
                                    tu carta de presentación para compartirla con el mundo entero.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>
    <div class="container" style="text-align: center; display: flex; align-items: center; justify-content: center;">
        <div class="row">
            <div class="col-sm-4" style="padding-left: 30px; padding-right: 30px;">
                <div class="card">
                    <div class="content">
                        <div class="title">Señales Binarias</div>
                        <div class="title" style="margin-top: 20px;">1 Mes</div>
                        <div class="price">$15.00</div>
                        <div class="description">Nuestro Paquete de Servicio de Señales Binarias por un mes es la opción ideal para aquellos que desean explorar y aprovechar las oportunidades del mercado financiero de manera efectiva. Obtén acceso completo a nuestras señales binarias altamente precisas durante un mes completo. Nuestro equipo de expertos en análisis de mercado y estrategias te proporcionará información actualizada y recomendaciones confiables para maximizar tus posibilidades de éxito. Aprovecha al máximo tus inversiones con nuestro paquete de un mes y toma decisiones informadas en el emocionante mundo del trading de opciones binarias.</div>
                    </div>
                    <button style="margin-top: 50px;">
                        Comprar
                    </button>
                </div>
            </div>
            <div class="col-sm-4" style="padding-left: 30px; padding-right: 30px;">
                <div class="card">
                    <div class="content">
                        <div class="title">Señales Binarias</div>
                        <div class="title" style="margin-top: 20px;">4 Meses</div>
                        <div class="price">$50.00</div>
                        <div class="description">Nuestro Paquete de Servicio de Señales Binarias por cuatro meses está diseñado para aquellos que buscan una experiencia de trading a largo plazo y un enfoque más sólido en el mercado financiero. Durante cuatro meses, recibirás nuestras señales binarias precisas y oportunas, respaldadas por el análisis exhaustivo de nuestro equipo de expertos. Obtén una visión profunda de las tendencias del mercado y las oportunidades comerciales potenciales para maximizar tus ganancias. Con nuestro paquete de cuatro meses, estarás equipado con las herramientas necesarias para tomar decisiones estratégicas y lograr resultados consistentes en el mundo del trading de opciones binarias.</div>
                    </div>
                    <button>
                        Comprar
                    </button>
                </div>
            </div>
            <div class="col-sm-4" style="padding-left: 30px; padding-right: 30px;">
                <div class="card">
                    <div class="content">
                        <div class="title">Señales Binarias</div>
                        <div class="title" style="margin-top: 20px;">6 Meses</div>
                        <div class="price">$70.00</div>
                        <div class="description">Nuestro Paquete de Servicio de Señales Binarias por seis meses es la opción ideal para aquellos que desean un compromiso a largo plazo con el trading de opciones binarias. Durante medio año, recibirás nuestras señales binarias de alta calidad, respaldadas por un análisis exhaustivo del mercado. Nuestro equipo de expertos se dedica a proporcionarte información precisa y oportuna para ayudarte a tomar decisiones comerciales informadas. Con nuestro paquete de seis meses, tendrás la tranquilidad de contar con un soporte constante y una visión a largo plazo del mercado financiero. Maximiza tus oportunidades de ganancias y aprovecha al máximo tu experiencia en el emocionante mundo del trading de opciones binarias.</div>
                    </div>
                    <button>
                        Comprar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <a class="logo_bottom" href="index.html">My connect Mind</a>
                    </div>
                    <div class="col-md-3 col-sm-6">

                    </div>
                </div>
                <div class=" copyright text_align_center ">
                    <div class=" container ">
                        <div class=" row ">
                            <div class=" col-md-12 ">
                                <p class="copyright">&copy; My Connect Mind 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src=" <?= base_url() ?>landing/js/jquery.min.js "></script>
    <script src=" <?= base_url() ?>landing/js/bootstrap.bundle.min.js "></script>
    <script src=" <?= base_url() ?>landing/js/jquery-3.0.0.min.js "></script>
    <script src=" <?= base_url() ?>landing/js/custom.js "></script>
</body>
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

</html>