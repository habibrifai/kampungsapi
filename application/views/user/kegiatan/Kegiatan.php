<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/temp/header',$header); ?>
<body class="index-page sidebar-collapse">
    <?php $this->load->view('user/temp/nav'); ?>
    <div class="main ">
        <div class="section section-basic sectione">
            <div class="container">
                <div class="title">
                    <h2 class="text-center">KEGIATAN WISATA KAMPUNG SAPI ADVENTURE</h2>
                </div>
                <div class="row">
                    <?php foreach ($body as $value) {?>
                        <div class="col-md-4">
                            <div class="card" style="min-height: 700px;">
                                <img class="card-img-top" src="<?= base_url('assets/img/kegiatan/').$value->foto ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h3><?php echo $value->nama ?></h3>
                                    <p class="card-text"><?php echo $value->deskripsi ?></p>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                </div>  
            </div>
        </div>
    </div>
    <?php $this->load->view('user/temp/footer'); ?>
</body>

</html>