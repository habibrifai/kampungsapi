<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/temp/header',$header); ?>
<body class="index-page sidebar-collapse">
    <?php $this->load->view('user/temp/nav'); ?>
    <div class="main ">
        <!--<?php $this->load->view('user/temp/carousel'); ?>-->
        <div class="section section-basic sectione">
            <div class="container">
                <div class="title">
                    <h2 class="text-center"> PILIH KATEGORI TIKET </h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                               <h3 class="text-center"> <b> TIKET GO SHOW </b> </h3> 
                               <p class="text-center"> (<b>Hanya Tersedia Pada Hari Ini</b>)</p>
                            </div>
                            <a href="?type=1" class="btn btn-success m-3"><b>PILIH</b></a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center"><b> TIKET RESERVASI </b> </h3>
                                <p class="text-center"> ( <b> Hanya Dapat Dipesan H-2 Dari Hari H</b> )</p>
                            </div>
                            <a href="" class="btn btn-info m-3" data-toggle="modal" data-target="#myModal"><b>PILIH</b></a>
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tiket Reservasi Berdasarkan Kategori Wisatawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="btn btn-info col-lg-12" onclick="location.href='<?php echo base_url('tiket?type=2') ;?>';">TK-SD</div>
                    <div class="btn btn-info col-lg-12" onclick="location.href='<?php echo base_url('tiket?type=3') ;?>';">SMP-SMA</div>
                    <div class="btn btn-info col-lg-12"onclick="location.href='<?php echo base_url('tiket?type=4') ;?>';">MAHASISWA - PETERNAK - PRA PENSIUN</div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <?php $this->load->view('user/temp/footer'); ?>
</body>
</html>