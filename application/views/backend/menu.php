<ul class="nav">
    <!-- Dashboard -->
    <li class="nav-item">
        <a href="<?php echo base_url('admin') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <!-- Master Data -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo base_url('tahun_pelajaran') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tahun Pelajaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('jurusan') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Jurusan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('kelas') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kelas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('biaya') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Biaya</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('seragam') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Seragam</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- Pendaftaran -->
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>Pendaftaran</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo base_url('pendaftaran_awal') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran Awal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('pendaftaran_ulang') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran Ulang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('pendaftaran_batal') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran Batal</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- Akun Pengguna -->
    <li class="nav-item">
        <a href="<?php echo base_url('user_akun') ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Akun Pengguna</p>
        </a>
    </li>



    <!-- Keluar -->
    <li class="nav-item">
        <a href="<?php echo base_url('login/logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Keluar</p>
        </a>
    </li>
</ul>