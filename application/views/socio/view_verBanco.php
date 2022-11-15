<body>



    <link href="<? base_url() ?>dist/css/addpages/stylepages.css" rel="stylesheet">

    <!-- Dashboard 1 Page CSS -->

    <link href="<? base_url() ?>dist/css/pages/dashboard5.css" rel="stylesheet">



    <link rel="shortcut icon" type="image/png" href="<? base_url() ?>wp-content/uploads/2022/05/favicon-cryptoce.png">



    <!-- stylos para addons -->

    <link href="<? base_url() ?>asset/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />

    <script src="<?= base_url() ?>asset/node_modules/jquery/jquery-3.2.1.min.js"></script>

    </br></br></br>





    <div class="page-wrapper bacblan">





        <div class="row" style="justify-content: center;">

            <!-- Column -->

            <div class="col-lg-6 col-md-6 ppbtn">

                <div class="card cc-widget">



                    <button class="buttomo">

                        <div class="cc-icon align-self-center"><i class="mdi mdi-account-key auni coloramarillo" title="Ofertar Activos"></i></div>

                        <div class="m-l-10 align-self-center">

                            <h4 class="m-b-0 amar">VERIFICACION DE CUENTA BANCARIA</h4>

                        </div>

                        <div class="buttomo__horizontal"></div>

                        <div class="buttomo__vertical"></div>

                    </button>



                    <!-- <div class="card-body">

                            <div class="d-flex no-block flex-row">

                                <div class="cc-icon align-self-center"><i class="icon-basket auni coloramarillo" title="BTC"></i></div>

                                <div class="m-l-10 align-self-center">

                                    <h4 class="m-b-0 amar">OFERTAR MIS ACTIVOS</h4>

                                </div>

                            </div>

                            <div id="spark1" class="sparkchart"></div>

                        </div> -->

                </div>

            </div>



            <!-- ============================================================== -->

            <!-- Container fluid  -->

            <!-- ============================================================== -->

            <div class="container-fluid">



                <div class="col-lg-12 col-xlg-12 col-md-12">

                    <div class="card">





                        <!-- Nav tabs -->

                        <ul class="nav nav-tabs profile-tab" role="tablist">

                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#compra" role="tab">Bancos</a> </li>

                            <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#venta" role="tab">Ventas</a> </li> -->

                        </ul>

                        <!-- Tab panes -->





                        <div class="tab-content">



                            <div class="tab-pane active" id="compra" role="tabpanel">

                                <div class="row">



                                    <?php foreach ($validar as $v) { ?>



                                        <div class="col-lg-4 col-md-6">

                                            <div class="blog_post lyf">

                                                <div class="img_podcconu cpvdbanc">

                                                    <img class="imgpcard" src="https://pbs.twimg.com/profile_images/890901007387025408/oztASP4n.jpg" alt="random image">

                                                </div>

                                                <div class="container_copy">

                                                    <h3 class="h3card"><?= $v->nombre ?> <?= $v->apellido1 ?></br>

                                                        Tipo de cuenta: <?= $v->tipo_cuenta ?> </br>

                                                        Banco: <?= $v->banco ?></br>

                                                        Numero de Cuenta: <?= $v->numero_cuenta ?> </br>

                                                    </h3></br>

                                                    <h1 class="h1card">Cuenta</h1>

                                                    <div class="espf">



                                                        <img id="myImg<?= $v->id ?>" src="<?= base_url() ?>asset/images/confirmacion/<?= $v->comprobante ?>" alt="Snow" style="width:100px;max-width:300px">



                                                    </div>

                                                    <!-- The Modal -->

                                                    <div id="myModal<?= $v->id ?>" class="modal" tabindex="-1" role="dialog" style="z-index: 1000;" aria-labelledby="vcenter" aria-hidden="true">

                                                        <div class="modal-content">

                                                            <button type="button" class="close" id="close<?=$v->id?>" data-dismiss="modal" aria-hidden="true">×</button>

                                                            <img class="modal-content" id="img<?= $v->id ?>">

                                                        </div>

                                                    </div>

                                                    <script>

                                                        $("#myImg<?= $v->id ?>").on("click", function() {

                                                            id = $(this).attr("src");

                                                            $('#myModal<?= $v->id ?>').show(); //muestro mediante id

                                                            $('#img<?= $v->id ?>').attr("src", id);

                                                        });

                                                        $("#close<?= $v->id ?>").on("click", function() {

                                                                $('#myModal<?= $v->id ?>').hide(); //ocultar mediante id

                                                            });

                                                    </script>





                                                    <div style="float: right;">

                                                        <button class="btn_primarycard btnc3 cpvdbanc btn-c" value="<?= $v->id ?>">Aprobar</button>

                                                        <button type="button" class="btn waves-effect waves-light btn-outline-danger">Rechazar</button>

                                                    </div>



                                                </div>



                                            </div>

                                        </div>



                                    <?php } ?>











                                </div>

                            </div>



                        </div>

                    </div>

                </div>





                <!-- ============================================================== -->

                <!-- End contain-fluid  -->





            </div>

        </div>

    </div>







</body>



<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>

    var base_url = "<?= base_url() ?>";



    $(".btn-c").on("click", function() {

        var id = $(this).val();

        alertify.confirm("¿Estas seguro de aprobar?", function(e) {

            $.ajax({

                url: base_url + "Socios/aprobarBanco",

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

</script>



</html>