<!DOCTYPE html>

<html lang="en">



<head>

  <title skip-price>My Connect Mind</title>

  <meta name="description" content="Tiindo" />

  <meta charset="UTF-8">

  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>images/myconnect/toro.png">


  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>

  <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">
  <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $('body').hide();

      $('body').fadeIn(2000);

    });
  </script>
</head>



<body>

  <!-- partial:index.partial.html -->

  <div class="cont">


    <div class="demoreg">

      <div class="login marg">

        <h1 style="color: yellow;">REGÍSTRATE</h1>
        <?php if ($this->session->flashdata("error")) { ?>

          <p><?php echo $this->session->flashdata("error") ?></p>

        <?php } ?>


        <form class="form" action="<?= base_url() ?>Login/registrarNew/<?= $perfil->id ?>" method="post">

          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="Nombre" name="nombre" required />

          </div>

          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="Apellido" name="apellido1" required />

          </div>
          <div class="login__row">

            <input type="text" class="login__input name plac" placeholder="ID Number" name="cedula" required />

          </div>

          <div class="login__row">

            <input type="email" class="login__input pass plac" placeholder="Email" name="correo" id="email" required />
            <div id="verificar1"></div>
          </div>

          <div class="login__row">

            <input type="tel" class="login__input pass plac" placeholder="Teléfono" name="celular" required />

          </div>

          <div class="login__row">
            <select aria-label="Default select example" class="form-control" style="width:450px" class="text-center" id="pais" name="pais" required>
              <option selected>Seleccionar país</option>
              <?php foreach ($pais as $d) { ?>
                <option value="<?= $d->id ?>"><?= $d->paisnombre ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="login__row" id="ciudad">
          </div>
          <div class="login__row">

            <input type="text" class="login__input pass plac" placeholder="usuario" name="user" id="user" required />
            <div id="verificar2"></div>
          </div>

          <div class="login__row">

            <input type="password" class="login__input pass plac" placeholder="Contraseña" name="contrasena" required />

          </div>

          <div class="login__row">

            <input type="password" class="login__input pass plac" placeholder="Confirmación de contraseña" name="contrasena1" required />

          </div>
          <!-- <div class="login__row">

          <input type="checkbox" name="terminos" value="1" required>
          <h4 style="color: white;text-align: left;">My Connect Mind no se hace responsable de la forma que utilice su dinero</h4><br>
          </div> -->
          <button type="submit" class="login__submit">Registrarse</button>

          <p class="login__signup">¿Ya tienes Cuenta? &nbsp;<a href="<?= base_url() ?>ingreso">Login</a></p>

        </form>

      </div>

    </div>
  </div>

  </div>

  <!-- partial -->
</body>

<script src="<?= base_url() ?>asset/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.js"></script>

<script>
  $(document).ready(function() {
    var base_url = "<?= base_url() ?>";

    $("#pais").on("change", function() {
      var id = $(this).val()
      $.ajax({
        url: base_url + "Login/getCiudad",
        type: "POST",
        data: {
          id: id
        },
        dataType: "json",
        success: function(resp) {
          html = "";
          html += '<select aria-label="Default select example" style="width:450px" class="text-center" name="ciudad" required>';
          html += '<option selected>Seleccionar estado</option>';
          $.each(resp, function(key, value) {
            html += '<option value="' + value.id + '">' + value.estadonombre + '</option>';
          })
          html += '</select>'
          $('#ciudad').html(html);
        }
      })
    });

    $("#email").keyup(function() {
      var email = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Login/validarCorreo',
        type: "POST",
        data: {
          email: email
        },
        success: function(resp) {
          html = '<h2 style="color:red;">' + resp + '</h2>';
          $('#verificar1').html(html);
        }
      })
    });

    $("#user").keyup(function() {
      var usuario = $(this).val()
      $.ajax({
        url: '<?= base_url() ?>Login/validarUser',
        type: "POST",
        data: {
          usuario: usuario
        },
        success: function(resp) {
          html = '<h2 style="color:red;">' + resp + '</h2>';
          $('#verificar2').html(html);
        }
      })
    })
  });
</script>

</html>