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
        <a class="active" href="<?= base_url() ?>login/nuestros_servicios">Nuestros Servicios</a>

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
                                <button class="openbtn" onclick="openNav()"><img
                                        src="<?= base_url() ?>landing/images/menu_btn.png"></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->
    <!-- start slider section -->
    <div id="top_section" class=" banner_main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container-fluid">
                                    <div class="carousel-caption relative">
                                        <div class="row d_flex">
                                            <div class="col-md-6">
                                                <div class="con_img">
                                                    <figure><img width="1445" height="443"
                                                            src="https://privatrading.com/wp-content/uploads/2023/03/signals.png"
                                                            class="attachment-full size-full wp-image-10197 wd-lazy-load wd-lazy-blur wd-loaded"
                                                            alt="" decoding="async" loading="lazy"
                                                            srcset="https://privatrading.com/wp-content/uploads/2023/03/signals.png 1445w, https://privatrading.com/wp-content/uploads/2023/03/signals-400x123.png 400w, https://privatrading.com/wp-content/uploads/2023/03/signals-1300x399.png 1300w, https://privatrading.com/wp-content/uploads/2023/03/signals-768x235.png 768w, https://privatrading.com/wp-content/uploads/2023/03/signals-860x264.png 860w, https://privatrading.com/wp-content/uploads/2023/03/signals-430x132.png 430w, https://privatrading.com/wp-content/uploads/2023/03/signals-700x215.png 700w, https://privatrading.com/wp-content/uploads/2023/03/signals-350x107.png 350w"
                                                            sizes="(max-width: 1445px) 100vw, 1445px"
                                                            data-wood-src="https://privatrading.com/wp-content/uploads/2023/03/signals.png"
                                                            data-srcset="https://privatrading.com/wp-content/uploads/2023/03/signals.png 1445w, https://privatrading.com/wp-content/uploads/2023/03/signals-400x123.png 400w, https://privatrading.com/wp-content/uploads/2023/03/signals-1300x399.png 1300w, https://privatrading.com/wp-content/uploads/2023/03/signals-768x235.png 768w, https://privatrading.com/wp-content/uploads/2023/03/signals-860x264.png 860w, https://privatrading.com/wp-content/uploads/2023/03/signals-430x132.png 430w, https://privatrading.com/wp-content/uploads/2023/03/signals-700x215.png 700w, https://privatrading.com/wp-content/uploads/2023/03/signals-350x107.png 350w">
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bluid">
                                                    <h1>Señales <br> Binarias y Forex</h1>
                                                    <p>¿Listo para tomar decisiones informadas en el mundo del trading?
                                                        Nuestro servicio de señales de binarias y forex te proporciona
                                                        las herramientas necesarias para el éxito. Recibe
                                                        recomendaciones estratégicas y análisis en tiempo real para
                                                        aprovechar las oportunidades del mercado financiero.
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container-fluid">
                                    <div class="carousel-caption relative">
                                        <div class="row d_flex">
                                            <div class="col-md-6">
                                                <div class="con_img">
                                                    <figure>
                                                        <img decoding="async" width="539" height="981"
                                                            src="https://privatrading.com/wp-content/uploads/2023/03/Group-10.png"
                                                            class="attachment-full size-full wp-image-10290 wd-lazy-load wd-lazy-blur wd-loaded"
                                                            alt="" loading="lazy"
                                                            srcset="https://privatrading.com/wp-content/uploads/2023/03/Group-10.png 539w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-165x300.png 165w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-440x800.png 440w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-430x783.png 430w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-350x637.png 350w"
                                                            sizes="(max-width: 429px) 80vw, 539px"
                                                            data-wood-src="https://privatrading.com/wp-content/uploads/2023/03/Group-10.png"
                                                            data-srcset="https://privatrading.com/wp-content/uploads/2023/03/Group-10.png 539w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-165x300.png 165w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-440x800.png 440w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-430x783.png 430w, https://privatrading.com/wp-content/uploads/2023/03/Group-10-350x637.png 350w">
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bluid">
                                                    <h1>Operativas<br> En vivo</h1>
                                                    <p>
                                                        Experimenta la emoción de operar en vivo con nuestra plataforma
                                                        de operativas en vivo. Únete a nuestros expertos traders
                                                        mientras realizan operaciones en tiempo real y aprende de sus
                                                        estrategias. ¡Potencia tus habilidades y obtén resultados reales
                                                        en el trading!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end slider section -->
    <!-- wallet -->
    <div class="wallet">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div id="wa_hover" class="wallet_box text_align_center" style="height:100%;">
                        <i>
                            <img width="1445" style="height:200px;" height="443"
                                src="https://privatrading.com/wp-content/uploads/2023/03/signals.png"
                                class="attachment-full size-full wp-image-10197 wd-lazy-load wd-lazy-blur wd-loaded"
                                alt="" decoding="async" loading="lazy"
                                srcset="https://privatrading.com/wp-content/uploads/2023/03/signals.png 1445w, https://privatrading.com/wp-content/uploads/2023/03/signals-400x123.png 400w, https://privatrading.com/wp-content/uploads/2023/03/signals-1300x399.png 1300w, https://privatrading.com/wp-content/uploads/2023/03/signals-768x235.png 768w, https://privatrading.com/wp-content/uploads/2023/03/signals-860x264.png 860w, https://privatrading.com/wp-content/uploads/2023/03/signals-430x132.png 430w, https://privatrading.com/wp-content/uploads/2023/03/signals-700x215.png 700w, https://privatrading.com/wp-content/uploads/2023/03/signals-350x107.png 350w"
                                sizes="(max-width: 1445px) 100vw, 1445px"
                                data-wood-src="https://privatrading.com/wp-content/uploads/2023/03/signals.png"
                                data-srcset="https://privatrading.com/wp-content/uploads/2023/03/signals.png 1445w, https://privatrading.com/wp-content/uploads/2023/03/signals-400x123.png 400w, https://privatrading.com/wp-content/uploads/2023/03/signals-1300x399.png 1300w, https://privatrading.com/wp-content/uploads/2023/03/signals-768x235.png 768w, https://privatrading.com/wp-content/uploads/2023/03/signals-860x264.png 860w, https://privatrading.com/wp-content/uploads/2023/03/signals-430x132.png 430w, https://privatrading.com/wp-content/uploads/2023/03/signals-700x215.png 700w, https://privatrading.com/wp-content/uploads/2023/03/signals-350x107.png 350w">
                        </i>
                        <h3>Señales en vivo</h3>
                        <p>
                            Con nuestro servicio de señales, podrás maximizar tus ganancias, minimizar tus riesgos y
                            aprovechar las oportunidades de trading más rentables. Acompañamos a cada cliente en su
                            camino hacia el éxito financiero, proporcionando una experiencia de trading única, confiable
                            y transparen </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div id="wa_hover" class="wallet_box text_align_center">
                        <i><img src="https://thundermarkets.com/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Ftelegram-signals.60848823.png&w=1200&q=75"
                                style="height:200px;" alt="#" /></i>
                        <h3>Operativas en Vivo</h3>
                        <p> Durante nuestras Operativas en Vivo, podrás ver, aprender y replicar las estrategias
                            utilizadas por nuestros profesionales, quienes compartirán contigo sus análisis de mercado,
                            decisiones de trading y responderán a tus preguntas en el momento. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div id="wa_hover" class="wallet_box text_align_center">
                        <i><img src="https://delio-lm.com/assets/img/landing-page-dinamicas.png" style="height:200px;"
                                alt="#" /></i>
                        <h3>Landing Dinamicas y personalizables </h3>
                        <p>Este módulo ha sido creado para empoderarte, permitiéndote diseñar y modificar tus propias
                            páginas de aterrizaje para eventos o emprendimientos. Ya sea que estés organizando una
                            conferencia, lanzando un nuevo producto o promoviendo tu última iniciativa</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div id="wa_hover" class="wallet_box text_align_center">
                        <i><img src="https://www.hloom.com/images/banner-cover-letter-format.png" style="height:200px;"
                                alt="#" /></i>
                        <h3>MCMlinks</h3>
                        <p>Organiza, personaliza a tu estilo y administra tu carta de presentación para compartirla con
                            el mundo entero. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wallet -->
    <!-- about -->
    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about_border">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="titlepage text_align_left">
                                    <h2>Acerca de Nosotros!</h2>
                                </div>
                                <div class="about_text">
                                    <p>En My connect Mind, somos una empresa dedicada a brindar servicios
                                        especializados en el mundo del trading. Nuestro enfoque principal se centra en
                                        ofrecer señales de binarias y forex altamente precisas, respaldadas por el
                                        análisis exhaustivo de nuestro equipo de expertos. Nos esforzamos por
                                        proporcionar a nuestros clientes información oportuna y confiable, ayudándoles a
                                        tomar decisiones informadas y maximizar su potencial de ganancias.

                                        Además de nuestras señales, también ofrecemos emocionantes operativas en vivo. A
                                        través de nuestra plataforma interactiva, puedes unirte a nuestros expertos
                                        traders mientras realizan operaciones en tiempo real. Esta experiencia te
                                        permitirá aprender de su experiencia, estrategias y técnicas, y potenciar tus
                                        habilidades de trading. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about_img">
                                    <figure><img class="img_responsive" src="<?= base_url() ?>landing/images/about2.png"
                                            alt="#" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    <!-- graf -->
    <br><br>
    <!-- Inicio Eventos, Herramientas y servicios  -->
    <div class="col-md-12">
        <div class="titlepage text_align_center">
            <h2>Herramientas</h2>
        </div>
    </div>
    <div class="card bg-transparent border-0">
        <div class="container ">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card card-view2 w-100">
                            <div class="card-body">
                                <h5 class="card-title"
                                    style="color: black; font-family: Poppins, sans-serif; text-align: center;">
                                    Convertidor de divisas</h5>
                                <br>
                                <div class="elementor-element elementor-element-9031f51 elementor-widget elementor-widget-text-editor"
                                    data-id="9031f51" data-element_type="widget"
                                    data-settings="{&quot;_ob_postman_use&quot;:&quot;no&quot;,&quot;_ob_allow_hoveranimator&quot;:&quot;no&quot;,&quot;_ob_widget_stalker_use&quot;:&quot;no&quot;}"
                                    data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-text-editor elementor-clearfix">
                                            ​<iframe style="border: 2px; border-radius: 10px;" src="https://themoneyconverter.com/es/CurrencyConverter?
                                                tab=0&from=USD&to=COP&bg=ffffff" marginwidth="0" marginheight="0"
                                                scrolling="no" seamless="seamless" width="100%" height="348"></iframe>
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
                                <h5 class="card-title"
                                    style="color: black; font-family: Poppins, sans-serif; text-align: center;">
                                    Convertidor de divisas</h5>
                                <br>
                                <form id=" contactForm" action="<?= base_url() ?>Login/calcular" method="post">
                                    <div class="input-group mb-3">
                                        <input type="number" name="balance" placeholder="balance" class="form-control">
                                    </div>
                                    <div class="input-group mb-3">

                                        <input type="number" name="periodo" placeholder="periodo" class="form-control">
                                        <div class="input-group mb-3">
                                        </div>

                                        <input type="number" name="ganancia" placeholder="Interes (%)"
                                            class="form-control">
                                        <div class="input-group mb-3">
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit">Calcular</button>
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
            $(document).ready(function () {
                $('#exampleModal').modal('show');

                $("#contactForm").submit(function (e) {
                    e.preventDefault();

                    data = $(this).serialize();
                    ruta = $(this).attr("action");
                    if (e) {
                        $.ajax({
                            url: ruta,
                            type: "POST",
                            data: data,
                            success: function (resp) {
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

    myModal.addEventListener('hidden.bs.modal', function (event) {
        var videoSrc = myVideo.src;
        myVideo.src = videoSrc;
    });

    myModal.addEventListener('shown.bs.modal', function (event) {
        myVideo.contentWindow.postMessage('{"event":"command","func":"seekTo","args":[0, true]}', '*');
        myVideo.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
    });
</script>

</html>