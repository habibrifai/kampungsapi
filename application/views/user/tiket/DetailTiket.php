<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/temp/header'); ?>

<body class="profile-page sidebar-collapse">
    <?php $this->load->view('user/temp/nav'); ?>
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('https://images.ctfassets.net/wy4h2xf1swlt/asset_29564/2404f41bd98c21a763172984fc609bf9/New-Zealand-dairy-farm.jpg'); background-size: cover; background-position: top center;"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto m-5">
                        <h2 style="text-align:center"> Form Pemesanan Tiket</h2>
                        <u>
                            <h4>Fasilitas</h4>
                        </u>
                        <p><?php echo $body->fasilitas ?></p>
                        <u>
                            <h4>Kegiatan</h4>
                        </u>
                        <p><?php echo $body->kegiatan ?></p>
                        <div class="form-group">
                            <label for="jml"> @</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="jumlah" id="jumlah_tiket" value="1" onkeypress="return isNumberKey(event)">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="minus()"><span class="fa fa-minus"></span></button>
                                </div>

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-success" onclick="plus()"><span class="fa fa-plus"></span></button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal" onclick="up()">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5>Detail Pemesanan</h5>
                        <h6>Pemesanan "<?php echo $body->nama ?>"</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_tiket" value="<?php echo $body->id ?>">
                        <input type="hidden" name="id_user" value="<?php echo $this->session->id ?>">
                        <input type="hidden" id="jmltiket" name="jumlah_tiket" value="">
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Nama Paket</label>
                            <input type="text" class="form-control" value="<?php echo $body->nama ?>" readonly />
                        </div>
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Harga Tiket Satuan</label>
                            <input type="text" class="form-control" value="<?php echo $body->harga ?>" readonly />
                        </div>
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Jumlah Tiket</label>
                            <input type="text" id="jumlahtiket" class="form-control" readonly />
                        </div>
                        <div class="form-group label-floating has-success">
                            <label class="control-label">Total Pembayaran</label>
                            <input type="text" id="total" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Lanjutkan Ke Pembayaran">
                        <!--lanjutkan pembayaran menjalankan usercontroller detail tiket-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php $this->load->view('user/temp/footer'); ?>
<script>
    function plus() {
        var jml = parseInt(document.getElementById('jumlah_tiket').value, 10);
        var jumlah = document.getElementById('jumlah_tiket');
        if (jml < <?php echo $stokTiket; ?>) {
            jumlah.value = jml + 1;
            jml++;
        } else {
            alert('Tiket Sudah Mencapai Maximum');
            document.getElementById('jumlah_tiket').value = <?php echo $stokTiket ?>;
        }
        //document.getElementById('jumlah_tiket').value=jml;
    }

    function minus() {
        var jml = parseInt(document.getElementById('jumlah_tiket').value, 10);
        var jumlah = document.getElementById('jumlah_tiket');
        if (jml > 1) {
            jumlah.value = jml - 1;
            jml--;
        }
        document.getElementById('jumlah_tiket').value = jml;
    }

    function up() {
        var jml = parseInt(document.getElementById('jumlah_tiket').value, 10);
        if (isNaN(jml)) {
            jml = 1;
        }
        document.getElementById('jumlah_tiket').value = jml;
        document.getElementById('jumlahtiket').value = jml;
        document.getElementById('jmltiket').value = jml;
        document.getElementById('total').value = jml * <?php echo $body->harga ?>;
    }

    function isNumberKey(evt) {
        var e = evt || window.event;
        var charCode = e.which || e.keyCode;
        var c = String.fromCharCode(e.which);
        var jml = parseInt(document.getElementById('jumlah_tiket').value, 10);

        if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;
        if (e.shiftKey)
            return false;
        if (parseInt(jml + c) > <?php echo $stokTiket ?>) return check(parseInt(jml + c));
        return true;
    }

    function check(i) {
        if (i > <?php echo $stokTiket; ?>) {
            alert('Tiket Sudah Mencapai Maximum');
            document.getElementById('jumlah_tiket').value = "";
            // document.getElementById('jumlah_tiket').value = <?php echo $stokTiket ?>;
        }
    }

    // function getInputValue() {
    //     var jml = document.getElementById("jml").value;
    //     document.getElementById("jmltiket").value = document.getElementById("jml").value
    //     document.getElementById("jumlahtiket").value = document.getElementById("jmltiket").value
    //     document.getElementById("total").value = jml * <?php echo $body->harga ?>

    //     $('.btn-number').click(function(e) {
    //         e.preventDefault();

    //         fieldName = $(this).attr('data-field');
    //         type = $(this).attr('data-type');
    //         var input = $("input[name='" + fieldName + "']");
    //         var currentVal = parseInt(input.val());
    //         if (!isNaN(currentVal)) {
    //             if (type == 'minus') {

    //                 if (currentVal > input.attr('min')) {
    //                     input.val(currentVal - 1).change();
    //                 }
    //                 if (parseInt(input.val()) == input.attr('min')) {
    //                     $(this).attr('disabled', true);
    //                 }

    //             } else if (type == 'plus') {

    //                 if (currentVal < input.attr('max')) {
    //                     input.val(currentVal + 1).change();
    //                 }
    //                 if (parseInt(input.val()) == input.attr('max')) {
    //                     $(this).attr('disabled', true);
    //                 }

    //             }
    //         } else {
    //             input.val(0);
    //         }
    //     });
    //     $('.input-number').focusin(function() {
    //         $(this).data('oldValue', $(this).val());
    //     });
    //     $('.input-number').change(function() {

    //         minValue = parseInt($(this).attr('min'));
    //         maxValue = parseInt($(this).attr('max'));
    //         valueCurrent = parseInt($(this).val());

    //         name = $(this).attr('name');
    //         if (valueCurrent >= minValue) {
    //             $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    //         } else {
    //             alert('sudah mencapai maximum');
    //             $(this).val($(this).data('oldValue'));
    //         }
    //         if (valueCurrent <= maxValue) {
    //             $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    //         } else {
    //             alert('sudah mencapai maximum');
    //             $(this).val($(this).data('oldValue'));
    //         }


    //     });
    //     $(".input-number").keydown(function(e) {
    //         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
    //             (e.keyCode == 65 && e.ctrlKey === true) ||
    //             (e.keyCode >= 35 && e.keyCode <= 39)) {
    //             return;
    //         }
    //         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    //             e.preventDefault();
    //         }
    //     });
    //     s

    // }
</script>

</html>