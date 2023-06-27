<!DOCTYPE html>
<html lang="es">

<head>
    <title>My connect mind</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Descubre cómo firmar 15 socios a la semana haciendo una sola llamada">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>landingxuser/css/copia.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />
    <section class="LandingPG" id="home">
        <div class="content">
            <div class="text-area">
                <img src="<?= base_url() ?>landingxuser/images/LOGO.png" alt="prospeccion" class="text-area">
                <h1 class="text-area">
                    <?php if ($tools->t1 != null) { ?>
                        <?= $tools->t1 ?>
                    <?php } else { ?>
                        CÓMO FIRMAR +15 SOCIOS A LA SEMANA HACIENDO UNA SOLA LLAMADA
                    <?php } ?>
                </h1>
                <p class="text-area">
                    <?php if ($tools->d1 != null) { ?>
                        <?= $tools->d1 ?>
                    <?php } else { ?>
                        En este evento de 4 clases gratuitas te enseñaré el paso a paso para firmar +15 socios a la semana
                        haciendo una sola llamada, incluso si aún no tienes resultados y crees que has intentado de todo.
                    <?php } ?>
                </p>
                <form action="<?= base_url() ?>LandingxUser/insertarDatos" method="post">
                    <div class="_form-content">
                        <div class="_form_element _x37026976 _full_width ">
                            <label for="email" class="_form-label" style="color:white">
                                Correo electrónico*
                            </label>
                            <div class="_field-wrapper">
                                <input type="text" id="email" name="email" placeholder="Escriba su correo electrónico"
                                    required />
                            </div>
                        </div>
                        <div class="_button-wrapper _full_width">
                            <button id="_form_3_submit" class="_submit" type="submit">
                                QUIERO RESERVAR
                            </button>
                        </div>

                    </div>
                </form>
                <!-- 
                <div class="point">
                    <div class="one lol">
                        <span class="material-symbols-outlined icon">
                            how_to_reg
                        </span>
                        <p>100% GRATIS</p>
                    </div>
                    <div class="two lol">
                        <span class="material-symbols-outlined icon">
                            calendar_month
                        </span>
                        <p>DEL 2 y 3 DE MARZO</p>
                    </div>
                    <div class="tres lol">
                        <span class="material-symbols-outlined icon">
                            live_tv
                        </span>
                        <p>100% EN VIVO</p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="scroll" style="--d:25; --y:200">
        <div>
            <span>Branding 1 - Branding 1 - Branding 1 - Branding 1 - Branding 1 - Branding 1 - Branding 1 - Branding
                1</span>
        </div>
    </section>

    <div class="content2">
        <br><br>
        <br>
        <br><br>
        <div class="text1">
            <h2>
                <?php if ($tools->t2 != null) { ?>
                    <?= $tools->t2 ?>
                <?php } else { ?>
                    LA REBELIÓN DEL NETWORK MARKETING
                <?php } ?>
            </h2>
            <p>
                <?php if ($tools->d2 != null) { ?>
                    <?= $tools->d2 ?>
                <?php } else { ?>
                    Descripcion 2°!
                <?php } ?>
            </p>
        </div>
        <div class="row row-cols-1 row-cols-md-4 mb-4 text-center" style="margin-top:2rem ;">
            <div class="card text-bg-dark" style="width: 18rem; margin:20px;">
                <img src="<?= base_url() ?>assets/img/landing/Splash1.PNG" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Titulo Evento</h5>
                    <a href="#" class="btn btn-danger">boton</a>
                </div>
            </div>
            <div class="card text-bg-dark" style="width: 18rem;margin:20px;">
                <img src="<?= base_url() ?>assets/img/landing/Splash2.PNG" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Titulo Eventoo</h5>
                    <a href="#" class="btn btn-danger">boton</a>
                </div>
            </div>
            <div class="card text-bg-dark" style="width: 18rem;margin:20px;">
                <img src="<?= base_url() ?>assets/img/landing/Splash3.PNG" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Titulo Evento</h5>
                    <a href="#" class="btn btn-danger">boton</a>
                </div>
            </div>
        </div>
    </div>


    <div class="content3">
        <div class="cont3">
            <div>
                <h2>
                    <?php if ($tools->t3 != null) { ?>
                        <?= $tools->t3 ?>
                    <?php } else { ?>
                        Titulo 3!
                    <?php } ?>
                </h2>
                <p>
                    <?php if ($tools->d3 != null) { ?>
                        <?= $tools->d3 ?>
                    <?php } else { ?>
                        Descripcion 3°!
                    <?php } ?>
                </p>
            </div>
            <div>
                <img data-src="" class="lazyLoad" alt="mockup">
            </div>
        </div>
    </div>

    <section class="content4">
        <!-- <div class="pass1">
            <h2>¡EY! TAMBIÉN APRENDERÁS...</h2>
            <div class="cajas">
                <div class="caja1 cj">
                    <span class="material-symbols-outlined icon3">
                        tips_and_updates
                    </span>
                    <p>Los tips que les están permitiendo a mi equipo de trabajo destacar entre millones de networkers
                    </p>
                </div>
                <div class="caja2 cj">
                    <span class="material-symbols-outlined icon3">
                        book
                    </span>
                    <p>El elemento de comunicación que te hará ser diferente y único</p>
                </div>
                <div class="caja3 cj">
                    <span class="material-symbols-outlined icon3">
                        attach_money
                    </span>
                    <p>¿Te gustaría saber cómo he ganador dinero cuando me dicen que no? También lo aprenderás en este
                        evento?</p>
                </div>
            </div>
        </div> -->

        <div class="pass22">
            <h2>Titulo 4</h2>
            <div class="cajas locas">
                <div class="caja31">
                    <p>Descripcion general
                </div>
                <div class="caja4">
                    <img data-src="img/ebook.webp" lt="ebook" class="lazyLoad">
                    <!-- <p>Recibe este E-book GRATIS con tu registro</p> -->
                </div>
            </div>
        </div>
    </section>
    <section class="formp">
        <div>
            <h2>ÍNDICANOS TU CORREO PARA OBTENER <b class="rojo">MAS INFORMACION DE ESTE EVENTO</b></h2>
            <form action="<?= base_url() ?>LandingxUser/insertarDatos" method="post">
                <div class="_form-content">
                    <div class="_form_element _x37026976 _full_width ">
                        <div class="_field-wrapper">
                            <input type="text" id="email" name="email" placeholder="Escriba su correo electrónico"
                                required />
                        </div>
                    </div>
                    <div class="_button-wrapper _full_width">
                        <button id="_form_5_submit" class="_submit" type="submit">
                            QUIERO MAS INFORMACION
                        </button>
                    </div>

                </div>


            </form>
        </div>
    </section>

    <section class="detalles">
        <div>
            <p>Este sitio no forma parte ni está respaldado por MY CONNECT MIND. Facebook es una marca comercial de Meta
                Platforms,
                Inc. Los resultados indicados anteriormente son mis resultados personales. Por favor, comprende que mis
                resultados no son típicos, no estoy dando a entender que necesariamente los replicarán o harás algo al
                respecto. Tengo la ventaja de tener años de experiencia en este negocio. Estoy usando las referencias de
                mis resultados y de mis clientes solo a modo de ejemplo. Tus resultados pueden variar y dependen de
                muchos factores como tus antecedentes, experiencia o incluso ética. En mi experiencia todo logro o
                proyecto conlleva un riesgo, así como un esfuerzo y una acción constante. Si no estás dispuesto a
                aceptar esto puede que esta formación no sea para ti. Gracias por tu interés y comprensión, al final de
                la capacitación inicial sin costo haré una oferta para las personas que quieran tener acceso a un
                entrenamiento completo que les ayudará a implementar y profundizar aún más en la materia o modelo de
                negocio. Esto es completamente opcional. Este entrenamiento inicial sin costo consta de 4 videos en
                directo y si no quieres el entrenamiento completo puedes irte sin comprar nada en cualquier momento. La
                capacitación inicial sin costo no te compromete a nada y podrás implementar lo que aprendas de inmediato
                por tu cuenta.</p>
        </div>
    </section>

    <section class="stickify">
        <div class="formv">

            <form action="<?= base_url() ?>LandingxUser/insertarDatos" method="post">

                <div class="_form-contentpro">
                    <div class="_form_element _x37026976 _full_widthh ">
                        <div class="_field-wrappertt">
                            <input class="email" type="text" id="email" name="email"
                                placeholder="Escriba su correo electrónico" required />
                        </div>
                    </div>
                    <div class="_button-wrapper _full_width">
                        <button id="_form_5_submit" class="button" class="_submit" type="submit">
                            REGÍSTRARME
                        </button>
                    </div>

                </div>


            </form>
        </div>
    </section>



    </body>

</html>