<footer class="footer" data-background-color="black">
  <div class="container">
    <div class="row">
    <div class="col-lg-2 d-flex align-items-center">
      <img src="<?= base_url('assets/img/upload/logo.png') ?>" class="img-fluid">
    </div>
    <div class="col-lg-4">
      <h3 class="text-left">Kampung Sapi Adventure</h3>
      <p class="text-left">Jl. Makam, Desa Beji, Kec. Junrejo, Kota Batu, Jawa Timur,<br>
      08.00 –  14.00 WIB<br>081 232 463 924<br>
      <a href="https://web.facebook.com/kampungsapi/" style="color: #363636"><i class="fab fa-facebook-square fa-2x"></i></a>
      <a href="https://www.instagram.com/kampungsapiadventure/" style="color: #363636"><i class="fab fa-instagram fa-2x"></i></a></p>
    </div>
  </div>
</div>
    
  </div>
</footer>
<script src="<?php echo base_url('assets/js/core/jquery.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/core/popper.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/core/bootstrap-material-design.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/bootstrap-datetimepicker.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/nouislider.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/material-kit.js?v=2.0.5') ?>" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    materialKit.initFormExtendedDatetimepickers();
    materialKit.initSliders();
  });
  function scrollToDownload() {
    if ($('.section-download').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-download').offset().top
      }, 1000);
    }
  }
</script>