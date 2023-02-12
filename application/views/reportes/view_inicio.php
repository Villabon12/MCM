<div class="main-panel">
    <div class="content-wrapper">
        <select name="" id="year">
            <option value="2022">2022</option>
            <option value="2023" selected>2023</option>
        </select>
        <center>
            <div class="col-lg-7">

                <div id="chart2"></div>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


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

        var options = {
            chart: {
                type: 'bar',

            },
            series: [{
                name: 'ganancia %',
                data: ganancia
            }],

            stroke: {
                show: true,
                width: 3
            },

            plotOptions: {
                bar: {
                    columnWidth: '90%',
                    distributed: true,
                }
            },
            xaxis: {
                labels: {
                    rotate: -45
                },
                categories: dias,
                tickPlacement: 'on'
            },
            yaxis: {
                title: {
                    text: 'Mes',
                },
            },
        }
        try {
            chart.destroy();
        } catch (err) {
            console.log(err);
        }
        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
    }
});
</script>