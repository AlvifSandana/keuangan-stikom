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

    .dropdown-menu-opsi {
        width: 300px !important;
        height: 450px !important;
    }
</style>
<?= $this->endSection() ?>

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
                        <form action="<?php echo base_url(); ?>/keuangan-mahasiswa/pembayaran-va/upload-va" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_va" id="file_va" accept=".csv, .xls">
                                    <label class="custom-file-label" for="file_va">Choose file (.csv .xls)</label>
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
                            <tbody>
                                <?php if ($temp_tr != null) {
                                    foreach ($temp_tr as $key => $value) {
                                        $dt_tgl = new DateTime($value['tanggal_transaksi']);
                                        $tgl = $dt_tgl->format('D, d M Y H:i:s');
                                        $nom = number_format($value['q_debit']); ?>
                                        <tr>
                                            <td class="text-center"><?= $value['kode_unit'] ?></td>
                                            <td class="text-center"><?= $tgl ?></td>
                                            <td><span class="text-left">Rp. </span><span class="float-right"><?= $nom ?></span></td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fas fa-fw fa-bars"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-opsi">
                                                        <form class="px-3 py-2">
                                                            <div class="form-group">
                                                                <label for="">Pilih Formula</label><br>
                                                                <?php foreach ($formula as $idf => $f) { ?>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="rad<?= $f['kode_mformula']?>" id="rad<?= $f['kode_mformula']?>" value="<?= $f['kode_mformula'].'-'.$f['persentase_tw'].'-'.$f['persentase_tb'] ?> ">
                                                                        <label class="form-check-label" for="rad<?= $f['kode_mformula']?>">
                                                                            <?= $f['kode_mformula']?>
                                                                        </label>
                                                                    </div>
                                                                <?php } ?>
                                                                TW = <span></span>&Tab;TB = <span></span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="semester">Pilih semester</label><br />
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <?php foreach ($semester as $ids => $s) {
                                                                            if ($ids < 8) { ?>
                                                                                <input type="checkbox" name="<?= $s['id_semester'] ?>" id="<?= $s['id_semester'] ?>" value="<?= $s['id_semester'] ?>">
                                                                                <label for="<?= $s['id_semester'] ?>"><?= $s['nama_semester'] ?></label><br>
                                                                        <?php }
                                                                        } ?>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <?php foreach ($semester as $ids => $s) {
                                                                            if ($ids >= 8) { ?>
                                                                                <input type="checkbox" name="<?= $s['id_semester'] ?>" id="<?= $s['id_semester'] ?>" value="<?= $s['id_semester'] ?>">
                                                                                <label for="<?= $s['id_semester'] ?>"><?= $s['nama_semester'] ?></label><br>
                                                                        <?php }
                                                                        } ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="actionBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="actionBtn">
                                                        <a class="dropdown-item text-success" target="_blank" href=""><i class="fas fa-check fa-fw"></i> Acc</a>
                                                        <a class="dropdown-item text-warning" target="_blank" href=""><i class="fas fa-edit fa-fw"></i> Edit</a>
                                                        <a class="dropdown-item text-danger" target="_blank" href=""><i class="fas fa-trash fa-fw"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
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