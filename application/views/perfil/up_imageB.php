<!DOCTYPE html>

<html lang="en">



<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Connect Mind</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ?>admin_temp/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>images/myconnect/toro.png" />

    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }


        .error {
            color: #E13300;
        }

        .success {
            color: darkgreen;
        }
    </style>
</head>

<body>

    <center>


        <?php if ($this->session->flashdata("error")) { ?>



            <p><?php echo $this->session->flashdata("error") ?></p>



        <?php } ?>


        <h2>Escoge cédula atrás</h2>
        <?php
        if (isset($success) && strlen($success)) {
            echo '<div class="success">';
            echo '<p>' . $success . '</p>';
            echo '</div>';
        }
        if (isset($errors) && strlen($errors)) {
            echo '<div class="error">';
            echo '<p>' . $errors . '</p>';
            echo '</div>';
        }
        if (validation_errors()) {
            echo validation_errors('<div class="error">', '</div>');
        }
        if (isset($resize_img)) {
            redirect(base_url("Perfil/updateCuenta3/" . $perfil->token));
        }
        ?>
        <?php
        $attributes = array('name' => 'image_upload_form', 'id' => 'image_upload_form');
        echo form_open_multipart($this->uri->uri_string(), $attributes);
        ?>
        <p><input accept="image/*" name="image_name" class="form-control" id="image_name" readonly="readonly" type="file" /></p>
        <p><input name="image_resize" class="btn btn-primary" value="Upload Image" type="submit" /></p>
        <?php
        echo form_close();
        ?>
                <img src="<?=base_url()?>images/myconnect/frente.png" srcset="<?=base_url()?>images/myconnect/frente.png 1024w, <?=base_url()?>images/myconnect/frente.png 640w, <?=base_url()?>images/myconnect/frente.png 320w" sizes="(min-width: 576px) 33.3vw, 100vw" alt="">

    </center>

</body>

</html>