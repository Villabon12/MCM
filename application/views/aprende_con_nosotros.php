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
            background-color: rgba(0, 0, 0, 0.2);
            border: none;
            padding: 20px;
            width: 70%;
        }

        @media (max-width: 800px) {
            .card {
                width: 100%;
            }
        }

        .card-content {
            color: white;
        }

        .h1 {
            font-size: 50px;
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
    <div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="card">
            <div class="card-content">
                <h1 class="text-center h1" style=" font-weight: bold; margin-bottom: 50px;">APRENDE CON NOSOTROS</h1>
                <p class="text-center" style="text-align: justify; margin-bottom: 20px;">¡Saludos a todos los usuarios!<br><br>

                    En este mensaje, quiero destacar la importancia de aprender a leer y comprender señales en los mercados financieros, tanto binarias como en Forex. Estas señales pueden ofrecer oportunidades emocionantes para invertir de manera exitosa.<br><br>

                    Las señales binarias implican analizar patrones y tendencias en datos numéricos, mientras que las señales de Forex se basan en factores económicos, políticos y fundamentales. Aprender a interpretar estas señales puede permitirnos tomar decisiones informadas en nuestras operaciones financieras.<br><br>

                    El aprendizaje en la lectura de señales requiere tiempo, paciencia y estudio constante. Existen numerosos recursos disponibles, como libros, cursos en línea y comunidades de operadores, que pueden ayudarte en este proceso.<br><br>

                    Recuerda que el aprendizaje es continuo y que, con práctica y dedicación, puedes desarrollar habilidades sólidas en la lectura de señales y tomar decisiones más informadas en tus inversiones.<br><br>

                    ¡Te animo a aprovechar todas las oportunidades para aprender y mejorar tus habilidades en la lectura de señales binarias y Forex! ¡Mucho éxito en tus esfuerzos y que tus inversiones sean prósperas!</p>
                <img src="https://www.myconnectmind.com/images/myconnect/encabezado2.png" style="width: 163px; height: 43px; line-height: 1;">
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