<!DOCTYPE html>

<html lang="en">



<head>

    <title skip-price>My Connect Mind</title>

    <meta name="description" content="MCM" />

    <meta charset="UTF-8">

    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>images/myconnect/toro.png">



    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>

    <link rel="stylesheet" href="<?= base_url() ?>asset/css/style.css">

    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">






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

    <!-- partial:index.partial.html -->

    <div class="cont">

        <div class="demo">

            <div class="login">
                <div class="container" style="padding-top: 65px;">

                    <center>
                        <img src="<?=base_url()?>images/myconnect/encabezado.png" width="240" height="120" alt="">

                    </center>
                </div>

                <div class="login__form">

                    <?php if ($this->session->flashdata("error")) { ?>

                    <p><?php echo $this->session->flashdata("error") ?></p>

                    <?php } ?>
                    <?php if ($this->session->flashdata("exito")) { ?>

                    <p><?php echo $this->session->flashdata("exito") ?></p>

                    <?php } ?>

                    <form class="form" action="<?= base_url() ?>Login/validaAcceso" method="post">

                        <div class="login__row">

                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">

                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />

                            </svg>

                            <input type="text" class="login__input name" placeholder="Correo" name="user" id="user" required />

                        </div>

                        <div class="login__row">

                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">

                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />

                            </svg>

                            <input type="password" class="login__input pass" placeholder="Contraseña" name="pass"
                                required />

                        </div>
                        <div class="container">
                            <button type="button" id="button" class="btn btn-info">Codigo seguridad</button>
                        </div>
                        <div class="mensaje"></div>

                        <div class="login__row">

                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">

                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />

                            </svg>

                            <input type="text" class="login__input pass" placeholder="Codigo seguridad" name="codigo"
                                required />

                        </div>

                        <button type="submit" class="login__submit">Iniciar Sesion</button>
                        <p class="login__signup">¿Olvidaste la contraseña? &nbsp;<a
                                href="<?= base_url() ?>Login/recuperar">Olvidar clave</a></p>

                    </form>

                </div>

            </div>



        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>asset/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>

    <script>

    $(document).ready(function() {
        var base_url = "<?= base_url() ?>";

        $("#button").on("click", function() {
            var id = $('#user').val()
            $.ajax({
                url: base_url + "Whatsapp/codigo_seguridad_inicio",
                type: "POST",
                data: {
                    id: id
                },
                success: function(resp) {
                    html = resp;
                    $('.mensaje').html(html);
                }
            })
        });
    });
    </script>

    <!-- partial -->


</body>



</html>