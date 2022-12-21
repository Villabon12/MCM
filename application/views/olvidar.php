<!DOCTYPE html>
<html lang="en">

<head>
  <title skip-price>My connect Mind</title>
  <meta name="description" content="MCM" />
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>images/myconnect/toro.png">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap"
      rel="stylesheet"
    />

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('body').hide();
      $('body').fadeIn(2000);
    });
  </script>


</head>

<body>

  <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>asset/css/captcha.css" rel="stylesheet">





  <!-- partial:index.partial.html -->
  <div class="cont">
    <div class="demo">
      <div class="login">
        <div class="" style="padding-top: 16px;">
          <center>
            <img src="<?= base_url() ?>images/myconnect/encabezado.png" width="240" height="120" alt="">
          </center>
        </div>
        <?php if ($this->session->flashdata("error")) { ?>
          <p><?php echo $this->session->flashdata("error") ?></p>
        <?php } ?>
        <?php if ($this->session->flashdata("exito")) { ?>
          <p><?php echo $this->session->flashdata("exito") ?></p>
        <?php } ?>
        <div class="login__form">
            <center>
              <h1 style="color: white;">Ingrese numero de cedula</h1>
            </center>
            <div class="login__row">
              <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
              </svg>
              <input type="text" class="login__input name" id="form-olvidar" placeholder="Cedula" name="cedula" required />
            </div>
            <div class="container">
              <div class="wrapper">
                <canvas id="canvas" width="200" height="70"></canvas>
                <button type="button" id="reload-button">
                  <i class="fa-solid fa-arrow-rotate-right"></i>
                </button>
              </div>
              <input type="text" class="texto" id="user-input" placeholder="Enter the text in the image" />
              <button type="button" id="submit-button">Submit</button>
            </div>
          <div class="input-group">

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- partial -->






</body>
<script src="<?=base_url()?>asset/js/captcha.js"></script>

</html>