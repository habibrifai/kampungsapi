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
                                            <h4 class="card-title "></h4>Silahkan Tambah / Edit / Hapus Kegiatan
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success text-right" data-toggle="modal" data-target="#tambahkegiatan"><i class="material-icons">add_circle</i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary text-center">
                                                <th> ID </th>
                                                <th> Judul </th>
                                                <th> Deskripsi </th>
                                                <th> Action </th>
                                            </thead>
                                            <tbody class="text-center">
                                                <?php foreach ($body as $value) { ?>
                                                    <tr>
                                                        <td><?= $value->id ?></td>
                                                        <td><?= $value->nama ?></td>
                                                        <td style="word-break: break-all;">
                                                            <?= $value->deskripsi ?>
                                                        </td>
                                                        <!--Hapus Kegiatan-->
                                                        <td class="text-right">
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKegiatan<?php echo $value->id ?>"><i class="material-icons">edit</i></button>
                                                            <a href="<?= base_url('admin/kegiatan/hapus/') . $value->id ?>" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>
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
    <!--Tambah Kegiatan-->
    <div class="modal fade" id="tambahkegiatan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo base_url('admin/kegiatan/tambah') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Pilih Gambar</label><br />
                        <img id="image-preview" alt="image preview" />
                        <input type="file" name="foto" id="image-source" class="btn btn-primary" onchange="previewImage();" />
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Kegiatan</label><br />
                                <textarea required name="nama" class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('nama');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Kegiatan</label><br />
                                <textarea required name="deskripsi" class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('deskripsi');
                                </script>
                            </div>
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
    <!--Edit Kegiatan-->
    <?php foreach ($body as $row) : ?>
        <div class="modal fade" id="editKegiatan<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?php echo base_url('admin/kegiatan/edit/') . $row->id ?>" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label>Pilih Gambar</label><br />
                            <img id="image-preview" alt="image preview" />
                            <input type="file" name="foto" id="image-source" class="btn btn-primary" onchange="previewImage();" />
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <textarea required class="form-control" name="nama"> <?php echo $row->nama ?></textarea>
                                    <script>
                                        CKEDITOR.replace('nama');
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Kegiatan</label>
                                    <textarea required class="form-control" name="deskripsi" cols="30" rows="5"><?php echo $row->deskripsi ?></textarea>
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