
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="<?= base_url() ?>" class="simple-text logo-normal">
          <?= NAMEORG ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="nav-item <?= $title=='Dashboard'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin') ?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?= $title=='Tiket'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin/tiket') ?>">
              <i class="material-icons">content_paste</i>
              <p>Tiket</p>
            </a>
          </li>
          <li class="nav-item <?= $title=='Kegiatan'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin/kegiatan') ?>">
              <i class="material-icons">content_paste</i>
              <p>Kegiatan</p>
            </a>
          </li>
          <li class="nav-item <?= $title=='Pengguna'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin/pengguna') ?>">
              <i class="material-icons">content_paste</i>
              <p>Daftar Pengguna</p>
            </a>
          </li>
          <li class="nav-item <?= $title=='Pemesanan'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin/pemesanan') ?>">
              <i class="material-icons">content_paste</i>
              <p>Daftar Pemesanan</p>
            </a>
          </li>
          <li class="nav-item <?= $title=='LapKeuangan'?'active':'' ?>">
            <a class="nav-link" href="<?= base_url('admin/lapkeuangan') ?>">
              <i class="material-icons">content_paste</i>
              <p>Laporan Keuangan</p>
            </a>
          </li>
        </ul>
      </div>
    </div>