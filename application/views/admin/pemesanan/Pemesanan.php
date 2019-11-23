-[<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/temp/header', $header); ?>

<body class="">
    <div class="wrapper ">
        <?php $this->load->view('admin/temp/sidebar', $header); ?>
        <div class="main-panel">
            <?php $this->load->view('admin/temp/navbar', $header); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="card-title ">Daftar Pemesanan Tiket Kampung Sapi Kampung Sapi Adventure</h4>
                                            <p class="card-category"></p>
                                        </div>
                                        <!--<div class="col-md-2">
                                            <a class="btn btn-success btn-sm" href="<?= base_url('admin/cetaklaporan') ?>"><i class="material-icons">print</i></a>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary text-center">
                                                <th> ID </th>
                                                <th> Nama Pembeli</th>
                                                <th> Tiket </th>
                                                <th> Jumlah </th>
                                                <th> Status Pembayaran </th>
                                                <th> Metode Pembayaran </th>
                                                <th> Total </th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php $jumlahtotal = 0;
                                                $totalTemporary = 0;
                                                $i = 0;
                                                foreach ($body as $value) { ?>
                                                    <tr>
                                                        <td><?= $value->id ?></td>
                                                        <td><?= $value->username ?></td>
                                                        <td><?= $value->nama ?></td>
                                                        <td><?= $value->jumlah_tiket ?></td>
                                                        <td><?= $status[$i]['status']?></td>
                                                        <td><?= $status[$i]['status'] ?></td>
                                                        <?php
                                                            $totalTemporary = $value->harga * $value->jumlah_tiket;
                                                            $jumlahtotal = $jumlahtotal + $totalTemporary;
                                                            ?>
                                                        <td> <?= rupiah($totalTemporary) ?></td>
                                                    </tr>
                                                <?php $i++; } ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-primary text-center">Total</td>
                                                    <td class="text-center"><?= rupiah($jumlahtotal) ?></td>
                                                </tr>
                                            </tbody>
                                            <!-- <tbody>
                                                <?php $jumlahtotal = 0;
                                                $totalTemporary = 0;
                                                foreach (array_combine($body, $status) as $value => $stat) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?= $stat['status'] ?></td>
                                                        <td><?= "Coming Soon" ?></td>
                                                        
                                                        <td class="text-right"></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-primary">Total</td>
                                                    <td class="text-right"></td>
                                                </tr>
                                            </tbody> -->
                                        </table>
                                    </div>
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