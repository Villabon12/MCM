<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


  <style>
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
    }

    @media (max-width: 800px) {
      .col1 {
        margin-top: 0;
      }
    }

    .col2 {
      margin-top: 130px;
    }

    @media (max-width: 800px) {
      .col2 {
        margin-top: 0;
      }
    }

    .col3 {
      margin-top: 90px;
    }

    @media (max-width: 800px) {
      .col3 {
        margin-top: -35px;
      }
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

    .carousel-caption h3 {
      color: #fff;
      font-size: 24px;
      /* Estilos adicionales para el título */
    }

    .image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* Ajusta el nivel de transparencia aquí */
      backdrop-filter: blur(8px);
      /* Ajusta el nivel de desenfoque aquí */
    }
  </style>
</head>

<body>
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
                <p>Inversión rápida y sencilla en diversos activos financieros con señales en tiempo real.</p>
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
                <p>Acceso al mercado de divisas las 24 horas del día con ejecución rápida.</p>
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

  <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 400px; width: 100%">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="image-overlay"></div>
        <img src="https://st3.depositphotos.com/6879548/14242/i/600/depositphotos_142427166-stock-photo-stock-exchange-green-and-red.jpg" height="400px" width="100%">
        <div class="carousel-caption">
          <h1 style="font-family: 'Righteous', cursive;">Nuestros nuevos productos<br>
            Disponible ahora</h1>
        </div>
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div> -->

  <!-- Modal -->
  <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?= base_url() ?>Reportes2/PayServicio">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Servicio Señales</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Adquire el servicio de señales binarias para poder acceder a las señales en
            tiempo real, pruebalo totalmente gratis por 15 días.
            Posteriormente el servicio tiene un costo de 20 USD mensuales.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Adquirir</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!--slide end-->

  <!-- Optional JavaScript; choose one of the two! -->
  <script>
    $('#myCarousel').carousel({
      interval: 3000,
    })
  </script>

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>