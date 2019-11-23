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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="card-title ">Daftar Pengguna Kampung Sapi Adventure</h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary text-center">
                                                <th> ID </th>
                                                <th> Nama </th>
                                                <th> Email </th>
                                                <th> Status </th>
                                                <th> Action </th>
                                            </thead>
                                            <tbody class=text-center>
                                                <?php foreach ($body as $value) { ?>
                                                    <tr>
                                                        <td><?= $value->id ?></td>
                                                        <td><?= $value->username ?></td>
                                                        <td><?= $value->email ?></td>
                                                        <td style="word-break: break-all;">
                                                            <?= ($value->status == '0') ? 'Email Belum Diverifikasi' : 'Email Sudah Diverifikasi' ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('admin/pengguna/hapus/') . $value->id ?>" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
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
    </div>
</body>
<?php $this->load->view('admin/temp/footer'); ?>

</html>