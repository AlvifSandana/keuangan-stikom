<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pemasukan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item active">Pemasukan</li>
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
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Input Pemasukan</h4>
                        <hr>
                        <form action="<?php echo base_url(); ?>/pembayaran/create" method="post" id="form_create_pembayaran" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="itempembayaran">Kategori Pemasukan</label>
                                <select class="form-control" name="kode_akun_pemasukam" id="kode_akun_pemasukan"></select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pemasukan</label>
                                <input type="date" class="form-control" name="tanggal_pemasukam" id="tanggal_pemasukan">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Pemasukan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="number" class="form-control" name="nominal_pembayaran" id="add_nominal_pembayaran" aria-label="NOMINAL PEMBAYARAN">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="itempembayaran">Metode Pembayaran</label>
                                <select class="form-control" name="kode_metode_pembayaran" id="kode_metode_pembayaran"></select>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_dokumen_pembayaran" id="is_fbp">
                                    <label class="" for="">Bukti Transaksi</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fbp" name="dokumen_pembayaran" disabled>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                            <p id="message"></p>
                            <button type="submit" class="btn btn-success float-right" id="btn_tambah_pembayaran" style="width: 200px;">Tambah Transaksi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">

        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->endSection() ?>