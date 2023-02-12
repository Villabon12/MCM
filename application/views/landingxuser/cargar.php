<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Connect Mind</title>
    <link rel="stylesheet" type="text/css"
        href="<?=base_url()?>landingxuser/dist/plugins/bootstrap-3.4.1/css/bootstrap.min.css"
        data-type="keditor-style" />

    <link rel="stylesheet" type="text/css"
        href="<?=base_url()?>landingxuser/dist/plugins/font-awesome-4.7.0/css/font-awesome.min.css"
        data-type="keditor-style" />
    <!-- Start of KEditor styles -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>landingxuser/dist/css/keditor.css"
        data-type="keditor-style" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>landingxuser/dist/css/keditor-components.css"
        data-type="keditor-style" />
    <!-- End of KEditor styles -->
    <link rel="stylesheet" type="text/css"
        href="<?=base_url()?>landingxuser/dist/plugins/code-prettify/src/prettify.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>landingxuser/dist/css/examples.css" />
</head>

<body>
    <div class="container">
        <div id="content-area">
            <?php if ($contenido != false) { ?>
                <?=$contenido->contenido?>
            <?php } ?>
        </div>
    </div>

    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/jquery-1.11.3/jquery-1.11.3.min.js">
    </script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/bootstrap-3.4.1/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
        src="<?=base_url()?>landingxuser/dist/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/ckeditor-4.11.4/ckeditor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/formBuilder-2.5.3/form-builder.min.js">
    </script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/formBuilder-2.5.3/form-render.min.js">
    </script>
    <!-- Start of KEditor scripts -->
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/js/keditor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/js/keditor-components.js"></script>
    <!-- End of KEditor scripts -->
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/code-prettify/src/prettify.js">
    </script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/plugins/js-beautify-1.7.5/js/lib/beautify.js">
    </script>
    <script type="text/javascript"
        src="<?=base_url()?>landingxuser/dist/plugins/js-beautify-1.7.5/js/lib/beautify-html.js"></script>
    <script type="text/javascript" src="<?=base_url()?>landingxuser/dist/js/examples.js"></script>

</body>

</html>