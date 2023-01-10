<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Connect Mind</title>
    <link href="<?= base_url() ?>asset/puzzle/css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="form-structor">
        <?php if ($accion == 'registrar') { ?>
        <div class="signup">
        <?php } else { ?>
            <div class="signup slideup">
        <?php } ?>
                <h2 class="form-title" id="signup"><span>o</span>Registrarse</h2>
            <form class="form" action="<?= base_url() ?>Landing/registrarNew/<?= $perfil->id ?>" method="post">
                <div class="form-holder">
                    <input type="text" class="input" placeholder="Nombre" name="nombre" required />
                    <input type="text" class="input" placeholder="Apellido" name="apellido1" required />
                    <input type="number" class="input" placeholder="cedula" name="cedula" required />
                    <input type="email" class="input" placeholder="Email" id="email" name="correo" required />
                    <input type="number" class="input" placeholder="Telefono" name="celular" required />
                    <select aria-label="Default select example" class="input" id="pais" name="pais" required>
                        <option selected>Seleccionar país</option>
                        <?php foreach ($pais as $d) { ?>
                            <option value="<?= $d->id ?>"><?= $d->paisnombre ?></option>
                        <?php } ?>
                    </select>
                    <div id="ciudad"></div>
                    <input type="text" class="input" placeholder="Usuario" name="user" id="user" required />
                    <input type="password" class="input" placeholder="Contraseña" name="contrasena" required />
                    <input type="password" class="input" placeholder="Repite Contraseña" name="contrasena1" required />
                </div>
                <div id="verificar"></div>
                <?php if ($this->session->flashdata("error")) { ?>
                    <p><?php echo $this->session->flashdata("error") ?></p>
                <?php } ?>
                <?php if ($this->session->flashdata("exito")) { ?>
                    <p><?php echo $this->session->flashdata("exito") ?></p>
                <?php } ?>
                <button type="submit" class="submit-btn">Registrarme</button>
            </form>
        </div>
        <?php if ($accion == 'ingresar') { ?>
            <div class="login">
        <?php } else { ?>
            <div class="login slide-up">
        <?php } ?>
            <div class="center">
                    <h2 class="form-title" id="login"><span>o</span>Iniciar Sesion</h2>

                <form class="form" action="<?= base_url() ?>Landing/validaAcceso/<?= $perfil->id ?>" method="post">
                    <div class="form-holder">
                        <input type="text" class="input" placeholder="Usuario o Correo" name="user" />
                        <input type="password" class="input" placeholder="Contraseña" name="pass" />
                    </div>
                    <button class="submit-btn">Iniciar Sesion</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>asset/puzzle/js/login.js" type="text/javascript"></script>

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
                    html += '<select aria-label="Default select example" class="input" name="ciudad" required>';
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
                    $('#verificar').html(html);
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
                    $('#verificar').html(html);
                }
            })
        })
    });
</script>

</html>