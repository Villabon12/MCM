<div class="main-panel">
    <div class="content-wrapper">
        <select name="" id="year">
            <option value="2022">2022</option>
            <option value="2023" selected>2023</option>
        </select>
        <center>
            <div class="col-lg-7">

                <canvas id="miGrafico"></canvas>
            </div>
        </center>
        <!-- <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-graficar" action="<?= base_url() ?>Ultra/gananciaMes" method="post">

                        <div class="row">
                            <div class="col-md-3">
                                <label for="form-label">Desde: </label>
                                <input type="date" name="fecha" id="">

                            </div>
                            <div class="col-md-3">
                                <label for="form-label">Hasta: </label>
                                <input type="date" name="fecha2" id="">

                            </div>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>

                    </form>
                    <div class="table-responsive">

                        <table class="table" id="">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Ganancia</th>
                                    <th scope="col">Servicio</th>
                                    <th scope="col">Activacion</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ESTÁ EN DESARROLLO</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © My Connect Mind
                2022</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->

<script src="<?= base_url() ?>admin_temp/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/moment/moment.min.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/chartist/chartist.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= base_url() ?>admin_temp/js/off-canvas.js"></script>
<script src="<?= base_url() ?>admin_temp/js/misc.js"></script>
<script src="<?= base_url() ?>admin_temp/js/settings.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/vendors/clipboard/clipboard.min.js"></script>

<script src="<?= base_url() ?>admin_temp/js/dashboard.js"></script>
<!-- End custom js for this page -->

<script src="<?= base_url() ?>admin_temp/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>admin_temp/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/data-table.js"></script>
<!-- End custom js for this page -->
<script src="<?= base_url() ?>admin_temp/js/chart.min.js"></script>


<script>
$(document).ready(function() {

    var base_url = "<?= base_url() ?>";
    var chart = document.querySelector("#chart2");
    $('#year').on('change', function(e) {
        var year = $(this).val();
        datagrafico2(base_url, year);
    });
    $('#year').trigger('change');


    function datagrafico2(base_url, year) {
        namesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"];
        $.ajax({
            url: base_url + "Reportes/getData/<?= $inversion->id ?>?rand=" + Math.random(),
            type: "POST",
            headers: {
                'Cache-Control': 'no-cache, no-store, must-revalidate',
                'Pragma': 'no-cache',
                'Expires': '0'
            },
            data: {
                year: year
            },
            dataType: "json",
            success: function(data) {
                var dias = new Array();
                var ganancia = new Array();
                $.each(data, function(key, value) {
                    dias.push(namesMonth[value.mes - 1]);
                    valor = Number(value.ganancia).toFixed(4) * 100;
                    ganancia.push(valor);
                });
                grafica(dias, ganancia);
            },
            complete: function(data) {
                console.log('la solicitud ha terminado');
            }
        });
    }

    function grafica(dias, ganancia) {

        var ctx = document.getElementById('miGrafico').getContext('2d');
        var miGrafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dias,
                datasets: [{
                    label: 'Porcentaje',
                    data: ganancia,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    // Agrega un plugin que dibuja el valor de cada barra encima de ella
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: 2,
                        font: {
                            size: '14'
                        },
                        formatter: function(value, context) {
                            return value;
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }
});
</script>