<footer class="footer">
    <div class="container-fluid">
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> 
        </div>
    </div>
</footer>
<script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap-material-design.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/sweetalert2.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/nouislider.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/arrive.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/chartist.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
<script src="<?= base_url() ?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/demo/demo.js"></script>
<script>
    function initDashboardPageCharts() {

        if ($('#dailySalesChart').length != 0) {
            /* ----------==========     Daily Sales Chart initialization    ==========---------- */

            dataDailySalesChart = {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                series: [
                    [
                        <?php
                        $max = 0;
                        foreach ($body['tahun'] as $tgl) {
                            $pendapatanHarian = 0;
                            foreach ($tgl as $data) {
                                if (count($data) == 0) break;
                                for ($i = 0; $i < count($data); $i++) {
                                    if ($data[$i]['nama'] == 'mahasiswa' || $data[$i]['nama'] == 'goshow' || $data[$i]['nama'] == 'tk' || $data[$i]['nama'] == 'smp') {
                                        $tiket = $data[$i]['total'] . ' tiket';
                                        $pendapatanHarian += $data[$i]['totalHarga'];
                                        // break;
                                    }
                                }
                            }
                            if ($max < $pendapatanHarian) $max = $pendapatanHarian;
                            echo "$pendapatanHarian,";
                        }
                        ?>
                    ]
                ]
            };

            optionsDailySalesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: <?= $max ?>, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 50
                },
            }

            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
        }
    }
</script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        initDashboardPageCharts();
    });
</script>