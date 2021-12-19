<?= $this->extend('layout/master') ?>

<?= $this->section('custom-styles') ?>
<style>
    .select2-selection__rendered {
        line-height: 30px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 35px !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengeluaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item">Transaksi</li>
                    <li class="breadcrumb-item active">Pengeluaran</li>
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
                        <h4 class="h4">Input Pengeluaran</h4>
                        <hr>
                        <form action="<?php echo base_url(); ?>/pembayaran/create" method="post" id="form_create_pembayaran" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="itempembayaran">Kategori Pengeluaran</label>
                                <select class="form-control custom-select" name="kode_akun_pengeluaran" id="kode_akun_pengeluaran" style="width: 100%;">
                                    <?php foreach ($akun_pengeluaran as $p) {
                                        echo '<option value="' . $p["kode_akun"] . '">' . $p["kode_akun"] . ' - ' . $p["nama_akun"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="tanggal_pengeluaran" id="tanggal_pengeluaran">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Pengeluaran</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="number" class="form-control" name="nominal_pengeluaran" id="add_nominal_pengeluaran" aria-label="NOMINAL PEMBAYARAN">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="itempembayaran">Metode Pembayaran</label>
                                <select class="form-control custom-select" name="kode_metode_pembayaran" id="kode_metode_pembayaran" style="width: 100%;">
                                    <?php foreach ($metode_pembayaran as $mp) {
                                        echo '<option value="' . $mp["id_metode"] . '">' . $mp["id_metode"] . ' - ' . $mp["nama_metode_pembayaran"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_bukti_transaksi" id="is_bukti_transaksi">
                                    <label class="" for="">Bukti Transaksi</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fbp" name="bukti_transaksi" disabled>
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
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/transaksi/pengeluaran/script') ?>
<?= $this->endSection() ?>