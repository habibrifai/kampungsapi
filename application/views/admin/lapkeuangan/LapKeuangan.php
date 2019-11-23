<?php
// var_dump($body);die();
?>
<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/temp/header', $header); ?>

<body class="">
    <div class="wrapper ">
        <?php $this->load->view('admin/temp/sidebar', $header); ?>
        <div class="main-panel">
            <?php $this->load->view('admin/temp/navbar', $header); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="card-title">Laporan Keuangan Kampung Sapi Adventure</h4>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/cetaklaporan/').$thn ?>"><i class="material-icons">print</i></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="">
                                <div class="row mb-3">
                                    <div class="col-md-2 offset-md-6">
                                        <select name="bln" id="bulan" class="form-control" required> 
                                            <option value="<?php echo $bln ?>" disable selected hidden><?php echo $bulan ?></option>
         
                                            <?php for($i = 1; $i <= 12; $i++){ ?>
                                                    <option value="<?php echo $i ?>"><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                                        <div class="col-md-2">
                                                <select name="thn" id="" class="form-control" required> 
                                                <?php ?>     
                                                    <option value="<?php echo $thn ?>" disable selected hidden><?php echo $thn ?></option>                                      
                                                    <?php for($i = 2019; $i <= 2024; $i++){ ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary">Tampil</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Go Show</th>
                                        <th>TK/SD</th>
                                        <th>SMP/SMA</th>
                                        <th>Mahasiswa</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    $no = 1;
                                    $pendapatanTotal = 0;
                                    foreach ($body['bulan'] as $tgl) : 
                                        $pendapatanHarian = 0;
                                    ?>
                                        <tr>
                                            <td><?= $body['tgl'][$no][0]; $no++; ?></td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'goshow') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'tk') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'smp') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'mahasiswa') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td><?php $pendapatanTotal+= $pendapatanHarian; echo rupiah($pendapatanHarian) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="5">Total Pendapatan</td>
                                        <td><?= rupiah($pendapatanTotal) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Laporan Berdasarkan Tahun <?= date("Y") ?></h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Go Show</th>
                                        <th>TK/SD</th>
                                        <th>SMP/SMA</th>
                                        <th>Mahasiswa</th>
                                        <th>Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    $no = 1;
                                    $pendapatanTotal = 0;
                                    foreach ($body['tahun'] as $tgl) : 
                                        $pendapatanHarian = 0;
                                    ?>
                                        
                                        <tr>
                                            <td><?= $body['thn'][$no][0]; $no++; ?></td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'goshow') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'tk') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'smp') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $tiket = "0 tiket";
                                                    foreach ($tgl as $data) {
                                                        if (count($data) == 0) break;
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            if ($data[$i]['nama'] == 'mahasiswa') {
                                                                $tiket = $data[$i]['total'] . ' tiket';
                                                                $pendapatanHarian += $data[$i]['totalHarga'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    echo $tiket;
                                                    ?>
                                            </td>
                                            <td><?php $pendapatanTotal+= $pendapatanHarian; echo rupiah($pendapatanHarian) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="5">Total Pendapatan</td>
                                        <td><?= rupiah($pendapatanTotal) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php $this->load->view('admin/temp/footer'); ?>
</body>

</html>