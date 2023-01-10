
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=base_url()?>css/style.css">
  <title>My Connect Mind</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<body>

<!-- Central Modal Warning Demo-->
<div id="centralModalWarningDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" data-aos="flip-down" data-aos-duration="1000">
        <p class="heading" >Compra exitosa</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row">
          <div class="col-4 text-center algo">
            <img src="<?= base_url() ?>asset/puzzle/image/LOGO.png" style="width: 100px;">
            <div style="height: 10px"></div>
          </div>

          <div class="col-8" style="text-align: center; justify-content: center; display: flex; align-items: center;">
            <p style="font-family: 'Inter', sans-serif; color:black; font-weight: 800;" data-aos="flip-down" data-aos-duration="1500">
            Compra exitosa <br><br> el tiempo de envio puede variar según su municipio </p>
          </div>
        </div>


      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">


      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Warning Demo-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>juegos/js/confeti.js"></script>


<script>

// start

const start = () => {
    setTimeout(function() {
        confetti.start()
    }, 1000); // 1000 is time that after 1 second start the confetti ( 1000 = 1 sec)
};

//  Stop

const stop = () => {
    setTimeout(function() {
        confetti.stop()
    }, 5000); // 5000 is time that after 5 second stop the confetti ( 5000 = 5 sec)
};

start();
stop();
</script>


</body>

</html>