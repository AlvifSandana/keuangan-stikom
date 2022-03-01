<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo base_url(); ?>/assets/img/bill.png" class="brand-image elevation-2" alt="Brand" style="opacity: .8;" />
        <span class="brand-text font-weight-light">Sistem Keuangan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>/assets/img/admin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo base_url() ?>" class="d-block"><?php echo session('nama'); ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php if (session('user_level') === 'admin') { ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo base_url() ?>/dashboard" class="nav-link<?php if ($uri_segment == "dashboard") {
                                                                                        echo " active";
                                                                                    } ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">MAHASISWA</li>
                    <li class="nav-item<?php //if ($uri_segment == "pembayaran" || $uri_segment == "tagihan") {echo " menu-is-opening menu-open";} ?>">
                        <a href="<?php echo base_url() ?>/keuangan-mahasiswa/pembayaran" class="nav-link<?php $uri_segment == "pembayaran" || $uri_segment == "frs" || $uri_segment == "keuangan-mahasiswa"? print(" active") : print("") ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Keuangan Mahasiswa
                                <!--<i class="fas fa-angle-left right"></i>-->
                            </p>
                        </a>
                        <!--<ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/keuangan-mahasiswa/pembayaran" class="nav-link<?php $uri_segment == "pembayaran" ? print(" active") : print("") ?>">
                                    <i class="fas fa-arrow-down nav-icon"></i>
                                    <p>Pembayaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/keuangan-mahasiswa/tagihan" class="nav-link<?php $uri_segment == "tagihan" ? print(" active") : print("") ?>">
                                    <i class="fas fa-arrow-up nav-icon"></i>
                                    <p>Tagihan</p>
                                </a>
                            </li>
                        </ul>-->
                    </li>
                    <li class="nav-item<?php //if ($uri_segment == "pembayaran" || $uri_segment == "tagihan") {echo " menu-is-opening menu-open";} ?>">
                        <a href="<?php echo base_url() ?>/keuangan-mahasiswa/pembayaran-va" class="nav-link<?php $uri_segment == "pembayaran-va" || $uri_segment == "keuangan-mahasiswa"? print(" active") : print("") ?>">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Pembayaran VA
                                <!--<i class="fas fa-angle-left right"></i>-->
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">OPERASIONAL</li>
                    <li class="nav-item<?php if ($uri_segment == "pemasukan" || $uri_segment == "pengeluaran") {
                                            echo " menu-is-opening menu-open";
                                        } ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Transaksi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/transaksi/pemasukan" class="nav-link<?php $uri_segment == "pemasukan" ? print(" active") : print("") ?>">
                                    <i class="fas fa-arrow-down nav-icon"></i>
                                    <p>Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/transaksi/pengeluaran" class="nav-link<?php $uri_segment == "pengeluaran" ? print(" active") : print("") ?>">
                                    <i class="fas fa-arrow-up nav-icon"></i>
                                    <p>Pengeluaran</p>
                                </a>
                            </li>
                    </li>
                </ul>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/master-laporan" class="nav-link<?php $uri_segment == "master-laporan" ? print(" active") : print("") ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item<?php if ($uri_segment == "paket" || $uri_segment == "akun-pemasukan" || $uri_segment == "formula" || $uri_segment == "akun-pengeluaran") {
                                            echo " menu-is-opening menu-open";
                                        } ?>">
                    <a href="#" class="nav-link<?php $uri_segment == "master-keuangan" ? print(" active") : print("") ?>">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Keuangan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/master-keuangan/paket" class="nav-link<?php $uri_segment == "paket" ? print(" active") : print("") ?>">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>Paket (Mahasiswa)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/master-keuangan/formula" class="nav-link<?php $uri_segment == "formula" ? print(" active") : print("") ?>">
                                    <i class="fas fa-percentage nav-icon"></i>
                                    <p>Formula</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/master-keuangan/akun-pemasukan" class="nav-link<?php $uri_segment == "akun-pemasukan" ? print(" active") : print("") ?>">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Akun Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/master-keuangan/akun-pengeluaran" class="nav-link<?php $uri_segment == "akun-pengeluaran" ? print(" active") : print("") ?>">
                                    <i class="fas fa-minus nav-icon"></i>
                                    <p>Akun Pengeluaran</p>
                                </a>
                            </li>
                        </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/master-mahasiswa" class="nav-link<?php $uri_segment == "master-mahasiswa" ? print(" active") : print("") ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/master-pendukung" class="nav-link<?php $uri_segment == "master-pendukung" ? print(" active") : print("") ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Pendukung
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/backup-restore" class="nav-link<?php $uri_segment == "backup-restore" ? print(" active") : print("") ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Backup / Restore DB
                        </p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/settings-account" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            <?php } else if (session('user_level') === 'demo') { ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo base_url() ?>/dashboard" class="nav-link<?php if ($uri_segment == "dashboard") {
                                                                                        echo " active";
                                                                                    } ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item<?php if ($uri_segment == "tagihan" || $uri_segment == "pembayaran") {
                                            echo " menu-is-opening menu-open";
                                        } ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Keuangan Mahasiswa
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/tagihan" class="nav-link<?php $uri_segment == "tagihan" ? print(" active") : print("") ?>">
                                    <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                    <p>Tagihan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url() ?>/pembayaran" class="nav-link<?php $uri_segment == "pembayaran" ? print(" active") : print("") ?>">
                                    <i class="fas fa-receipt nav-icon"></i>
                                    <p>Pembayaran</p>
                                </a>
                            </li>
                    </li>
                </ul>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/settings-account" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            <?php } ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>