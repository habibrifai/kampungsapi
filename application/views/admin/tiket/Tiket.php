<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/temp/header', $header); ?>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>


<style>
    #image-preview {
        display: none;
        max-width: 200px;
    }
</style>

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
                                            <h4 class="card-title ">Silahkan Lakukan Tambah/Edit/Hapus Pada Data Tiket</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button class="btn btn-success btn text-left" data-toggle="modal" data-target="#tambahtiket"><i class="material-icons">add</i> Tambah Tiket</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                            <input type="text" class="form-control" name="stok" id="jumlah_stok" >
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-warning btn-sm text-right" data-toggle="modal" data-target="#editStok"><i class="material-icons">edit</i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary text-center">
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Nama
                                                </th>
                                                <th>
                                                    Stok
                                                </th>
                                                <th>
                                                    Harga
                                                </th>
                                                <th>
                                                    Tipe
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php foreach ($body as $value) { ?>
                                                    <tr>
                                                        <td>
                                                            <?= $value->id ?>
                                                        </td>
                                                        <td>
                                                            <?= $value->nama ?>
                                                        </td>
                                                        <td>
                                                            <?= $value->stok ?>
                                                        </td>
                                                        <td>
                                                            <?= rupiah($value->harga) ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($value->type == '1') {
                                                                    echo ('Go Show');
                                                                } else if ($value->type == '2') {
                                                                    echo ('Reservasi TK-SD');
                                                                } else if ($value->type == '3') {
                                                                    echo ('Reservasi SMP-SMA');
                                                                } else {
                                                                    echo ('Reservasi Reservasi Mahasiswa-Peternak-Pra Pensiun');
                                                                }

                                                                ?>
                                                        </td>
                                                        <!--Delete Tiket-->
                                                        <td class="text-center">
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editTiket<?php echo $value->id ?>"><i class="material-icons">edit</i></button>
                                                            <a href="<?= base_url('admin/tiket/hapus/') . $value->id ?>" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>
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
    <!--Tambah Tiket-->
    <div class="modal fade" id="tambahtiket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo base_url('admin/tiket/tambah') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-preview" alt="image preview" />
                        <input type="file" name="foto" id="image-source" class="btn btn-primary" onchange="previewImage();" />
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Tiket</label><br />
                                <textarea required name="nama" class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('fasilitas');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Fasilitas</label><br />
                                <textarea required name="fasilitas" class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('fasilitas');
                                </script>

                            </div>
                            <div class="form-group">
                                <label>Kegiatan</label><br />
                                <textarea required name="kegiatan" class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('kegiatan');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input required type="number" name="harga" class="form-control" placeholder="Harga Tiket">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input required type="number" name="stok" class="form-control" placeholder="Stok Tiket">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="type">
                                    <option value="1">Go Show</option>
                                    <option value="2">Reservasi TK-SD</option>
                                    <option value="3">Reservasi SMP-SMA</option>
                                    <option value="4">Reservasi Mahasiswa-Peternak-Pra Pensiun </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-info" type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Edit Tiket-->
    <?php foreach ($body as $row) : ?>
        <div class="modal fade" id="editTiket<?= $row->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('admin/tiket/edit/') . $row->id ?>" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Tiket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Tiket</label>
                                <input required type="text" name="nama" value="<?= $row->nama ?>" class="form-control" placeholder="Nama Tiket">
                            </div>
                            <div class="form-group">
                                <label>Fasilitas</label>
                                <textarea required class="form-control" name="fasilitas" cols="30" rows="5"><?php echo $row->fasilitas ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Kegiatan</label>
                                <textarea required class="form-control" name="kegiatan" cols="30" rows="5"><?php echo $row->kegiatan ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input required type="number" name="harga" value="<?= $row->harga ?>" class="form-control" placeholder="Harga Tiket">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input required type="number" name="stok" value="<?= $row->stok ?>" class="form-control" placeholder="Stok Tiket">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="tipe">
                                    <option value="1">Go Show</option>
                                    <option value="2">Reservasi TK-SD</option>
                                    <option value="3">Reservasi SMP-SMA</option>
                                    <option value="4">Reservasi Mahasiswa-Peternak-Pra Pensiun </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input class="btn btn-info" type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>
<?php $this->load->view('admin/temp/footer'); ?>

<script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
</script>

</html>