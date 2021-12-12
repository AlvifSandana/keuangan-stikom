<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp <?php echo number_format($total_tagihan[0]['total_tagihan'], 0); ?></h3>
                        <p>Tagihan Keseluruhan Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp <?php echo number_format($total_pembayaran[0]['total_pembayaran'], 0); ?></h3>
                        <p>Pembayaran Keseluruhan Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $jumlah_mhs[0]['jumlah_mahasiswa']; ?></h3>
                        <p>Jumlah Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-mahasiswa" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>4</h3>
                        <p>Program Studi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-pendukung" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->endSection() ?>