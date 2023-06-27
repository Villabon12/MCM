<!-- partial -->
<style>
    .contenedor {
        position: relative;
        display: table-cell;
        text-align: center;
    }


    .centrado {
        background: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #myCarousel .carousel-item .mask {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-attachment: fixed;
    }

    #myCarousel h4 {
        font-size: 50px;
        margin-bottom: 15px;
        color: #FFF;
        line-height: 100%;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    @media (max-width: 800px) {
        #myCarousel h4 {
            font-size: 30px;
        }
    }

    .col1 {
        margin-top: 100px;
        padding-left: 40px;
    }

    @media (max-width: 800px) {
        .col1 {
            margin-top: 0;
            padding-left: 0;
        }
    }

    .col2 {
        margin-top: 160px;
        padding-left: 40px;
    }

    @media (max-width: 800px) {
        .col2 {
            margin-top: 0;
            padding-left: 0;
        }
    }

    .col3 {
        margin-top: 120px;
        padding-left: 20px;
    }

    @media (max-width: 800px) {
        .col3 {
            margin-top: -35px;
            padding-left: 0;
        }
    }

    .ancho {
        width: 300px;
    }

    .img1 {
        width: 370px;
        height: 300px;
    }

    @media (max-width: 800px) {
        .img1 {
            width: 200px;
            height: 300px;
        }
    }

    .img2 {
        width: 220px;
        height: 300px;
    }

    @media (max-width: 800px) {
        .img2 {
            width: 100px;
            height: 300px;
        }
    }

    .img3 {
        width: 400px;
        height: 300px;
        margin: 0;
        margin-top: 400px;
    }

    @media (max-width: 800px) {
        .img3 {
            width: 200px;
            height: 300px;
        }
    }

    #myCarousel p {
        font-size: 18px;
        margin-bottom: 15px;
        color: #d5d5d5;
    }

    @media (max-width: 800px) {
        #myCarousel p {
            font-size: 15px;
        }
    }

    #myCarousel .carousel-item a {
        background: #F47735;
        font-size: 14px;
        color: #FFF;
        padding: 13px 32px;
        display: inline-block;
    }

    #myCarousel .carousel-item a:hover {
        background: #394fa2;
        text-decoration: none;
    }

    #myCarousel .carousel-item h4 {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    #myCarousel .carousel-item p {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
    }

    #myCarousel .carousel-item a {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    #myCarousel .carousel-item .mask img {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
        display: block;
        height: auto;
        max-width: 100%;
        margin-top: 100px;
    }

    #myCarousel h4,
    #myCarousel p,
    #myCarousel a,
    #myCarousel .carousel-item .mask img {
        -webkit-animation-duration: 1s;
        animation-duration: 1.2s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    #myCarousel .container {
        max-width: 1430px;
    }

    #myCarousel .carousel-item {
        height: 100%;
        min-height: 550px;
    }

    #myCarousel {
        position: relative;
        z-index: 1;
        background: url('../images/bannerSlider.jpg') center center no-repeat;
        background-size: cover;
    }

    .carousel-control-next,
    .carousel-control-prev {
        height: 40px;
        width: 40px;
        padding: 12px;
        top: 50%;
        bottom: auto;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, .075);
    }


    .carousel-item {
        position: relative;
        display: none;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease, -webkit-transform .6s ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-perspective: 1000px;
        perspective: 1000px;
    }

    .carousel-fade .carousel-item {
        opacity: 0;
        -webkit-transition-duration: .6s;
        transition-duration: .6s;
        -webkit-transition-property: opacity;
        transition-property: opacity
    }

    .carousel-fade .carousel-item-next.carousel-item-left,
    .carousel-fade .carousel-item-prev.carousel-item-right,
    .carousel-fade .carousel-item.active {
        opacity: 1
    }

    .carousel-fade .carousel-item-left.active,
    .carousel-fade .carousel-item-right.active {
        opacity: 0
    }

    .carousel-fade .carousel-item-left.active,
    .carousel-fade .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item-prev.active,
    .carousel-fade .carousel-item.active {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0)
    }

    @supports (transform-style:preserve-3d) {

        .carousel-fade .carousel-item-left.active,
        .carousel-fade .carousel-item-next,
        .carousel-fade .carousel-item-prev,
        .carousel-fade .carousel-item-prev.active,
        .carousel-fade .carousel-item.active {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }
    }

    .carousel-fade .carousel-item-left.active,
    .carousel-fade .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item-prev.active,
    .carousel-fade .carousel-item.active {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }



    @-webkit-keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInLeft {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    @-webkit-keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    @-webkit-keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .slideInRight {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
    }

    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
<?php if ($perfil->img_selfie == (null) || $perfil->img_cedula_back == (null) || $perfil->img_cedula_front == (null) || $perfil->fecha_nacimiento == (null)) { ?>
    <div class="main-panel">

        <div class="content-wrapper">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-body">

                        <center>

                            <i class="mdi mdi-alert-circle-outline icon-lg" style="color:red;"></i>

                            <h1>Espera un momento</h1>

                            <h2>Valida tus datos primero</h2>

                            <a href="<?= base_url() ?>Perfil" type="button" class="btn btn-success  ">validar</a>

                            <?php if ($disponibilidad != false) { ?>

                                <h3 style="color: red;">Tienes campo fecha de nacimiento vacio en tu perfil <a href="<?= base_url() ?>Perfil">Ir al
                                        perfil</a></h3>
                                <br>

                            <?php } ?>
                        </center>

                    </div>

                </div>

            </div>
        </div>

    <?php } else { ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- <marquee behavior="scroll" direction="left">
              <h2>Últimas noticias:</h2>
              
              
              <p>Se llevará acabo nueva validación de seguridad, importante, ir a perfil actualizar los campos: Celular, Correo, Fecha de nacimiento, Wallet Binance. Si no tienen actualizado los datos, afectará el ingreso a la plataforma</p>
            </marquee> -->
                <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>
                    <br>

                <?php } ?>

                <?php if ($disponibilidad != false) { ?>

                    <h3 style="color: red;">Tienes campos sin verificar en tu perfil <a href="<?= base_url() ?>Perfil">Ir al
                            perfil</a></h3>
                    <br>

                <?php } ?>
                <!-- <center>
                <div class="contenedor">
                    <img src="<?= base_url() ?>images/primer.png"
                        srcset="<?= base_url() ?>images/primer.png, <?= base_url() ?>images/primer.png 990w"
                        sizes="(max-width: 767px) 200vw, (max-width: 933px) 90vw, 420px" style="max-width: 100%;">
                    <div class="centrado"><?= $premio[1]->user ?>, directos: <?= $premio[1]->contar ?>
                        $<?= $premio[1]->total ?>
                    </div>
                </div>
                <div class="contenedor">
                    <img src="<?= base_url() ?>images/segundo.png"
                        srcset="<?= base_url() ?>images/segundo.png, <?= base_url() ?>images/segundo.png 990w"
                        sizes="(max-width: 767px) 200vw, (max-width: 933px) 90vw, 420px" style="max-width: 100%;">
                    <div class="centrado"><?= $premio[2]->user ?>, directos: <?= $premio[2]->contar ?>
                        $<?= $premio[2]->total ?>
                    </div>
                </div>
                <div class="contenedor">
                    <img src="<?= base_url() ?>images/tercer.png"
                        srcset="<?= base_url() ?>images/tercer.png, <?= base_url() ?>images/tercer.png 990w"
                        sizes="(max-width: 767px) 200vw, (max-width: 933px) 90vw, 420px" style="max-width: 100%;">
                    <div class="centrado"><?= $premio[3]->user ?>, directos: <?= $premio[3]->contar ?>
                        $<?= $premio[3]->total ?>
                    </div>
                </div>
            </center> -->
                <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" style="text-align: center;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="mask flex-center">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-md-7 col-12 sm-6 order-md-1 order-2 col1">
                                            <h4>Nuestros nuevos productos<br>
                                                Disponible ahora</h4>
                                            <!-- <p>En My Connect Mind, nos complace presentar dos servicios
                  innovadores que revolucionarán tu experiencia de inversión.
                  Ya sea que seas un trader experimentado o estés comenzando
                  en el mundo de las inversiones, estos servicios te brindarán
                  oportunidades emocionantes para obtener ganancias.
                  ¡Echa un vistazo a lo que ofrecemos!
                </p> -->
                                        </div>
                                        <div class="col-md-5 col-12 sm-6 order-md-2 order-1">
                                            <center>
                                                <img src="https://libertex.org/sites/default/files/2022-06/signals.png" class="img1" alt="slide">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mask flex-center">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-md-7 col-12 sm-6 order-md-1 order-2 col2">
                                            <h4>Binarias</h4>
                                            <p>Inversión rápida y sencilla en diversos activos <br>financieros con señales en tiempo real.</p>
                                            <a href="https://www.myconnectmind.com/Binarias_historial">Comprar</a>
                                        </div>
                                        <div class="col-md-5 col-12 sm-6 order-md-2 order-1">
                                            <center>
                                                <img src="https://www.binaryguardian.io/spa/images/inner/buysell.png" class="img2" alt="slide">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="mask flex-center">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-md-7 col-12 sm-6 order-md-1 order-2 col3">
                                            <h4>Forex</h4>
                                            <p>Acceso al mercado de divisas las 24 horas <br>del día con ejecución rápida.</p>
                                            <a href="https://www.myconnectmind.com/Reportes2/resumen_forex">Comprar</a>
                                        </div>
                                        <div class="col-md-5 col-12 sm-6 order-md-2 order-1 imgcol">
                                            <center>
                                                <img src="https://i.pinimg.com/originals/85/c3/fd/85c3fd923c80a452cc9e37e8e4916e82.png" class="img3" alt="slide">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                </div>
                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="cc-icon align-self-center"><img src="<?= base_url() ?>images/myconnect/usdt.png" alt=""></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Billetera Principal</h4>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_compra, 2) ?>
                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Billetera Equipo</h4>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_comision, 2) ?>
                                    </h5>
                                    <a href="<?= base_url() ?>Comisiones/historial" class="btn btn-dark">Ver equipo</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center">
                                <?php if ($plan_scalping == false) { ?>
                                <p style="text-transform: uppercase;">
                                    <Strong style="color:red;">Membresia no adquirida</Strong>
                                </p>
                                <?php } else { ?>

                                <p style="text-transform: uppercase;">
                                    <strong><?= $plan_scalping->descripcion ?> -- Dias restante:
                                        <?= $plan_scalping->dias ?>
                                </p></strong>
                                <?php } ?>
                                <img src="https://img.icons8.com/wired/64/000000/average-2.png" />
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Membresia Scalping</h4>
                                
                                    <a href="<?= base_url() ?>Scalping" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div> -->
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="cc-icon align-self-center">
                                    <p style="text-transform: uppercase;">
                                        <?php if ($plan_binaria == false) { ?>
                                            <Strong style="color:red;">Robot no adquirido</Strong>
                                        <?php } else { ?>
                                            <strong><?= $plan_binaria->descripcion ?> -- Dias restante: <?= $plan_binaria->dias ?>
                                    </p></strong> <?php } ?>
                                <img src="https://img.icons8.com/wired/64/000000/average-2.png" />
                                </div>
                                <div class="m-l-10 align-self-center">
                                    <h4 class="m-b-0 amar">Billetera Binaria</h4>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($total->total, 2) ?></h5>
                                    <a href="<?= base_url() ?>Binaria" class="btn btn-dark">Ir al servicio</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center"><img
                                    src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Juego</h4>
                                <h5 class="text-muted m-b-0 blan">$<?= number_format($billetera->cuenta_juego, 2) ?>
                                </h5>
                                <a href="<?= base_url() ?>Puzzle" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div> -->
                    <!-- <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="cc-icon align-self-center">
                                <?php if ($plan_arbitraje == false) { ?>
                                <p style="text-transform: uppercase;">
                                    <Strong style="color:red;">Robot no adquirido</Strong>
                                </p>
                                <?php } else { ?>

                                <p style="text-transform: uppercase;">
                                    <strong><?= $plan_arbitraje->descripcion ?> -- Dias restante:
                                        <?= $plan_arbitraje->dias ?>
                                </p></strong>
                                <?php } ?>
                                <img src="https://img.icons8.com/wired/64/000000/average-2.png" />
                            </div>
                            <div class="m-l-10 align-self-center">
                                <h4 class="m-b-0 amar">Billetera Arbitraje</h4>
                                <?php if ($arbitraje == null) { ?>
                                <h5 class="text-muted m-b-0 blan">$0.00

                                    <?php } else { ?>
                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($arbitraje->valor, 2) ?>

                                        <?php } ?>
                                    </h5>
                                    <a href="<?= base_url() ?>Arbitraje" class="btn btn-dark">Ir al servicio</a>
                            </div>

                        </div>
                    </div>
                </div> -->

                </div>

                <div class="row">
                    <?php if ($perfil->id == 6) { ?>
                        <div class="main-panel">
                            <div class="container">
                                <h1>EN CASO DE SEGURIDAD, OPRIMIR EL BOTON ROJO</h1>
                                <?php if ($validar->valor == 0) { ?>
                                    <a class="btn btn-success" href="<?= base_url() ?>Socios/encenderRobot/<?= $validar->id ?>">ENCENDER</a>
                                <?php } else { ?>
                                    <a class="btn btn-danger" href="<?= base_url() ?>Socios/apagarRobot/<?= $validar->id ?>">APAGAR</a>

                                <?php } ?>

                            </div>

                            <div class="content-wrapper">

                                <div class="row">
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="cc-icon align-self-center"><img src="<?= base_url() ?>images/myconnect/usdt.png" alt=""></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h4 class="m-b-0 amar">Billetera Brokers Total</h4>
                                                    <h5 class="text-muted m-b-0 blan">
                                                        $<?= number_format($empresa->cuenta_inversion, 2) ?></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h4 class="m-b-0 amar">Billetera Inversion</h4>
                                                    <h5 class="text-muted m-b-0 blan">$<?= number_format($total1->total, 2) ?>
                                                    </h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h4 class="m-b-0 amar">Billetera Socio</h4>
                                                    <h5 class="text-muted m-b-0 blan">
                                                        $<?= number_format($empresa->cuenta_socio, 2) ?></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="cc-icon align-self-center"><img src="https://img.icons8.com/wired/64/000000/average-2.png" /></div>
                                                <div class="m-l-10 align-self-center">
                                                    <h4 class="m-b-0 amar">Billetera Puzzle</h4>
                                                    <h5 class="text-muted m-b-0 blan">
                                                        $<?= number_format($empresa->cuenta_puzzle, 2) ?></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } ?>

                        </div>
                </div>
            <?php } ?>

            <div class="modal fade" id="inicioTerminos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: red;" id="exampleModalLabel">¡ADVERTENCIA!</h5>
                        </div>
                        <div class="modal-body">
                            <p>Los CFDs son instrumentos complejos conllevan un alto riesgo de perder dinero rápidamente
                                debido al apalancamiento.
                                El 90% de las personas pierden dinero al operar con opciones binarias y CFDs.
                                Debes considerar si comprendes como funcionan las opciones binarias y CFDs, si puedes
                                permitirte asumir el alto
                                riesgo de perder tú dinero.</p>
                            <p>Al estar registrado ya ha aceptado los términos y condiciones.</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?= base_url() ?>Socios/aceptar_terminos" method="post">
                                <input type="hidden" name="id" value="<?= $perfil->id ?>">
                                <button type="submit" class="btn btn-success">Acepto</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal Ends -->

            <!-- FIN PARTIAL -->

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect
                        Mind 2022</span>
                </div>
            </footer>
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>admin_temp/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>admin_temp/js/misc.js"></script>
    <script src="<?= base_url() ?>admin_temp/js/settings.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?= base_url() ?>admin_temp/vendors/clipboard/clipboard.min.js"></script>

    <script src="<?= base_url() ?>admin_temp/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
    <!-- End custom js for this page -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        function cambiar() {
            var pdrs = document.getElementById('file-upload').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }
    </script>

    <script>
        $(document).ready(function() {
            var base_url = "<?= base_url() ?>";
            <?php if (count($terminos) == 0) { ?>
                $('#inicioTerminos').modal('toggle')

            <?php } ?>

            $(".btn-view1").on("click", function() {
                var id = $(this).val();
                $.ajax({
                    url: base_url + "Ofertas/userData",
                    type: "POST",
                    dataType: "html",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#mCo .modal-body").html(data);
                    }
                });
            });

            (function($) {
                'use strict';
                var clipboard = new ClipboardJS('.btn-clipboard');
                clipboard.on('success', function(e) {
                    console.log(e);
                });
                clipboard.on('error', function(e) {
                    console.log(e);
                });
            })(jQuery);

            $(".btn-oferta").on("click", function() {
                var id = $(this).val();
                alertify.confirm("¿Estas seguro de aprobar?", function(e) {
                    $.ajax({
                        url: base_url + "Ofertas/updPendiente",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            alertify.success('Ok');

                            window.location.reload();
                        }
                    });
                });
            });

            $("#form-graficar").on("submit", function(e) {
                e.preventDefault();
                data = $(this).serialize();
                ruta = $(this).attr("action");
                $.ajax({
                    url: ruta,
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function(resp) {
                        html = '<div class="col-md-4 grid-margin stretch-card">';
                        html += '<div class="card">';
                        html += '<div class="card-body">';
                        html += '<h4 class="card-title">Inversion</h4>';
                        html += '<div class="table-responsive">';
                        html += '<table class="table">';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th scope="col">Fecha</th>';
                        html += '<th scope="col">Inversion</th>';
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        html += '<tr><td>' + resp["inversion"].fecha + '</td>';
                        html += '<td>' + resp["inversion"].inversion + '</td></tr>';
                        html += '<tr><td>Total: </td>';
                        html += '<tr><td>Balance: ' + Number(resp["ganancia"].ganancia - resp[
                            "perdida"].perdida).toFixed(2) + '</td></tr>';
                        html += '<tr><td>Beneficio:' + Number(resp["ganancia"].ganancia).toFixed(
                            2) + ' </td></tr>';
                        html += '<tr><td>Perdida:' + Number(resp["perdida"].perdida).toFixed(2) +
                            ' </td></tr>';
                        html += '<tr><td>Porcentaje Balance:' + Number(resp["ganancia"]
                                .porcentajeG - resp["perdida"].porcentajeP).toFixed(4) * 100 +
                            ' %</td></tr>';
                        html +=
                            '<tr><a class="btn btn-dark" href="<?= base_url() ?>Binaria">Recargar</a></tr>';
                        html += '</tbody>';
                        html += '</table>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-md-8 grid-margin stretch-card">';
                        html += '<div class="card">';
                        html += '<div class="card-body performane-indicator-card">';

                        $.each(resp["reporte"], function(key, value) {
                            html += '<div class="row">';
                            html += '<div class="col-md-4">';
                            if (value.senal == 'PUT') {
                                html += '<p style="color: red;">VENDER, ' + value.mercado +
                                    '</p>';
                            } else {
                                html += '<p style="color: blue;">COMPRAR, ' + value
                                    .mercado + '</p>';
                            }
                            html += '</div>';
                            html += '<div class="col-md-6">';
                            html += '<p style="font-size: 12.9375px;">' + value.fecha +
                                '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="row">';
                            html += '<div class="col-md-4">';
                            html += ' <p style="font-size: 11.9375px;">' + value
                                .saldo_entra + ' => ' + value.saldo_sale + '</p>';
                            html += '</div>';
                            html += '<div class="col-md-6">';
                            if (value.tipoxuser == 'ganancia') {
                                html += '<p style="color: blue;">' + value.gananciaxuser +
                                    '</p>';
                            } else {
                                html += '<p style="color: red;">' + value.gananciaxuser +
                                    '</p>';
                            }
                            html += '</div>';
                            html += '</div>';
                            html += '<br>';
                        });
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        $(".holii").html(html);
                    }

                });
            });

            // $(".btn-comprobantesub").on("click", function() {
            //     var id = $(this).val();
            //     $.ajax({
            //         url: base_url + "P2P/userData",
            //         type: "POST",
            //         dataType: "html",
            //         data: {
            //             id: id
            //         },
            //         success: function(data) {
            //             $("#mCo .modal-body").html(data);
            //             id[0].reset();
            //         }
            //     });
            // });

            $("#user").keyup(function(e) {

                $b = $(this).val();

                $("#user2").val($b);

            })

            $("#user2").on("click", function() {
                var data = $(this).val()
                $.ajax({
                    url: '<?= base_url() ?>Banco/traer_usuario',
                    type: "POST",
                    data: {
                        cedula: data
                    },

                    success: function(resp) {
                        html = '<div class="input-group mb-2">';
                        html += '<h5 style="color:black;">' + resp + '</h5>';
                        html += '</div>';
                        $('#add1').html(html);
                    }
                })
            })

            $("#button").on("click", function() {
                var data = $(this).val()
                $.ajax({
                    url: '<?= base_url() ?>Banco/codigoSeguridad',
                    type: "POST",
                    data: {
                        data: data
                    },

                    success: function(resp) {
                        html = resp;

                        $('#add').html(html);
                    }
                })
            })
            $("#button2").on("click", function() {
                var data = $(this).val()
                $.ajax({
                    url: '<?= base_url() ?>Banco/codigoSeguridad2',
                    type: "POST",
                    data: {
                        data: data
                    },

                    success: function(resp) {
                        html = resp;

                        $('#add1').html(html);
                    }
                })
            })
            $("#button3").on("click", function() {
                var data = $(this).val()
                $.ajax({
                    url: '<?= base_url() ?>Banco/codigoSeguridad3',
                    type: "POST",
                    data: {
                        data: data
                    },

                    success: function(resp) {
                        html = resp;

                        $('#add2').html(html);
                    }
                })
            })



        });
    </script>

    <script>
        $('#myCarousel').carousel({
            interval: 3000,
        })
    </script>


    </body>

    </html>