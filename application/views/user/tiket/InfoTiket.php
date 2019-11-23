<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/temp/header',$header); ?>
<body class="index-page sidebar-collapse">
    <?php $this->load->view('user/temp/nav'); ?>
    <div class="main ">
      <!-- <?php $this->load->view('user/temp/carousel'); ?>-->
        <div class="section section-basic sectione">
            <div class="container">
                <div class="title">
                    <h2 class="text-center"> INFORMASI PAKET  </h2>
                    <h3 class="text-center"> <b> Tiket <?= ($type['type']==1)?"Go Show":"Reservasi" ?> </b></h3>
                    <br>
                    <br>
                 </div>
                <div class="row">
                    <?php 
                    $no = 1;
                    foreach ($body as $value) { ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/tiket/').$value->img ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="text-center" data-toggle="collapse" data-target="#collapseExample<?php echo $value->id ?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;"><b>Detail Paket</b></h5>
                                    <div class="collapse" id="collapseExample<?php echo $value->id ?>">
                                        <H6><u>KEGIATAN</u></H6>
                                        <P><?php echo $value->kegiatan ?></P>
                                        <H6><u>FASILITAS</u></H6>
                                        <P><?php echo $value->fasilitas ?></P>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="card-text">Harga : <?php echo rupiah($value->harga) ?></h6>
                                        </div>
                                        
                                    </div>
                                    <div class="" style="vertical-align:b">    
                                        <?php
                                        if ($_GET['type'] == 1) { ?>
                                            <h6>Tiket Tersedia : <?php echo $value->stok ?></h6>
                                        <?php } else { ?>
                                            <!--selain type==1  maka dilakukan pengecekan tanggal dahulu baru muncul tersedia)-->
                                            <h6><a class="text-info" data-toggle="collapse" href="#collapseDate<?php echo $value->id ?>" role="button" aria-expanded="false" aria-controls="collapseExample">Cek Tanggal</a></h6>
                                        <?php } ?>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="collapse row" id="collapseDate<?php echo $value->id ?>"> 
                                            <div class="col-sm-6">
                                                <input name="<?php echo $value->id; ?>" type="date" class="form-control" id="tgl<?= $no ?>" min="<?php $Date =date('Y-m-d');  echo date('Y-m-d', strtotime($Date. ' + 2 days'));?>" value="<?php echo date('Y-m-d', strtotime($Date. ' + 2 days'));?>" max="<?php echo date('Y-m-d', strtotime($Date. ' + 12 days'));?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <a>Tiket Tersedia : <span id="stokHari<?= $no++ ?>"></span></a>
                                            </div>                                       
                                        </div>
                                        <a type="submit" href="<?php echo base_url('detail/').$value->id ?>" class="btn btn-info btn-block">BELI</a>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    <?php } ?>
                </div>  
            </div>
        </div>
    </div>
    
    <?php $this->load->view('user/temp/footer'); ?>
    
<script type="text/javascript">
    $(document).ready(function() {

        <?php
            $no = 1; 
            foreach($body as $value) : ?>
            $('#tgl<?= $no ?>').on('change', function() {
                var tgl = $(this).val();
                $.ajax({
                    type : "GET",
                    url : "<?= base_url('UserController/cekStok/') ?>" + tgl,
                    dataType : "JSON",
                    data : {tgl},
                    success : function (data) {
                        $('#stokHari<?= $no++ ?>').html(data)
                    }
                })
            })
        <?php endforeach; ?>
    });
</script>
</body>

</html>