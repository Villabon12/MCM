<link rel="shortcut icon" type="image/png" href="<?= base_url() ?>dist/f.png">
<link rel="stylesheet" href="<?= base_url() ?>reTemplate/Cap4/style.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@1,700&display=swap"
    rel="stylesheet">
<link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />
<title>
    <?= $perfil->nombre . " " . $perfil->apellido1 ?>
</title>

<?php if ($sett->colorBoton != null) { ?>
    <style>
        .boton:hover {
            background-color:
                <?= $sett->colorBoton ?>
            ;
            color: #fff;
        }
    </style>
<?php } else { ?>
<?php } ?>
<!-- partial:index.partial.html -->
<section>
    <?php if ($sett->img_perfil == null) { ?>
        <img src="https://i.pinimg.com/originals/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg"
            alt="Profile Picture Could Not Be Loaded! Please refresh the page or try changing the browser."
            class="profile-picture">
    <?php } else { ?>
        <img src=" <?= base_url() ?>reTemplate/imagenes/<?= $sett->img_perfil ?>" class="profile-picture" alt="Logo" />
    <?php } ?>

    <div class="name">
        <?= $perfil->nombre . " " . $perfil->apellido1 ?>
    </div>
    <center>

        <?php if ($sett->profesion == null) { ?>
            <h4 class="plantilla">Tu Profesiòn</h4>
        <?php } else { ?>
            <h4 class="plantilla">
                <?= $sett->profesion ?>
            </h4>
        <?php } ?>
        <?php if ($sett->descripcion == null) { ?>
            <h6 class="plantilla">Tu descripcion
            </h6>
        <?php } else { ?>
            <h6 class="plantilla">
                <?= $sett->descripcion ?>
            </h6>
        <?php } ?> <br><br><br>
    </center>
    <?php foreach ($links as $l) { ?>
        <a href="<?= $l->enlace ?>" class="links  boton" style="widht:60%" target="_blank"><?= $l->nombreRed ?></a>
    <?php } ?>
</section>
<footer>
    <br><br><br>
</footer>