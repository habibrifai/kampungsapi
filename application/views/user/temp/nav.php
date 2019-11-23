<nav class="navbar navbar-expand-lg bg-white  fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <?= NAMEORG ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('kegiatan') ?>">Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('tiket') ?>">Pesan Tiket</a>
                </li>
                <?php if ($this->session->username) { ?>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-user"></i>Hi <?php echo $this->session->username ?> </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="<?php echo base_url('logout') ?>" class="dropdown-item">LOGOUT</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('login') ?>" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('register') ?>" class="nav-link">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>