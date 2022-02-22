<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pembayaran VA</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Keuangan Mahasiswa</li>
                    <li class="breadcrumb-item active">Pembayaran VA</li>
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
        <?= $this->include('layout/flash') ?>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Input Dokumen Pembayaran Virtual Account</h4>
                        <p>Pilih file .csv lalu tekan tombol <b class="text-primary">Upload</b>.</p>
                        <form action="<?php echo base_url(); ?>/keuangan-mahasiswa/pembayaran-va/upload" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_va" id="file_va" accept=".csv">
                                    <label class="custom-file-label" for="file_va">Choose file (.csv)</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-upload"></i> Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Data Transaksi Sementara (dari VA)</h4>
                        <table class="table table-hover table-sm tbl-temp-transaksi">
                            <thead class="text-center">
                                <th>NIM</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal</th>
                                <th>Opsi</th>
                                <th>Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/keuangan_mahasiswa/pembayaran-va/script') ?>
<?= $this->endSection() ?>