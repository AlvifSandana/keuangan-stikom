<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Laporan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
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
                        <h4 class="h4">Laporan Pemasukan</h4>
                        <p class="mb-3">Meliputi data pemasukan dari seluruh mahasiswa dan data pemasukan lainnya. <br>
                            Atur <b>Waktu Mulai</b> dan <b>Waktu Berakhir</b>, lalu tekan tombol <b class="text-success">Generate</b> berikut.
                        </p>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="waktu_mulai">Waktu Mulai</label>
                                    <input type="date" name="waktu_mulai_income" id="waktu_mulai_income" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="waktu_mulai">Waktu Berakhir</label>
                                    <input type="date" name="waktu_akhir_income" id="waktu_akhir_income" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-success float-right" href="<?php echo base_url(); ?>/laporan/generate_laporan_tagihan_all_mhs" style="margin-top: 30px;">
                                <i class="fas fa-fw fa-arrow-down"></i> Generate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Pengeluaran</h4>
                        <p class="mb-3">Meliputi semua data pengeluaran. <br>
                            Atur <b>Waktu Mulai</b> dan <b>Waktu Berakhir</b>, lalu tekan tombol <b class="text-success">Generate</b> berikut.
                        </p>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="waktu_mulai">Waktu Mulai</label>
                                    <input type="date" name="waktu_mulai_outcome" id="waktu_mulai_outcome" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="waktu_mulai">Waktu Berakhir</label>
                                    <input type="date" name="waktu_akhir_outcome" id="waktu_akhir_outcome" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-success float-right" href="<?php echo base_url(); ?>/laporan/generate_laporan_tagihan_all_mhs" style="margin-top: 30px;">
                                <i class="fas fa-fw fa-arrow-down"></i> Generate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Tagihan (berdasarkan NIM)</h4>
                        <p>Meliputi nominal <b>Total Tagihan</b> dan <b>Sisa Tagihan</b> berdasarkan NIM. <br>
                            Generate laporan tagihan berdasarkan NIM. Silahkan masukkan NIM yang valid, lali klik tombol <b class="text-success">Generate</b>.
                        </p>
                        <div class="input-group mb-3">
                            <input id="tagihan_nim" type="text" class="form-control" placeholder="Generate laporan tagihan per mahasiswa. Masukkan NIM." aria-label="Generate laporan tagihan per mahasiswa. Masukkan NIM." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="generateLaporanTagihanByNIM()"><i class="fas fa-arrow-down"></i> Generate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Pembayaran</h4>
                        <p class="mb-3">Meliputi <b>Nama Item Pembayaran</b>, nominal <b>Total Tagihan per Item</b> dan <b>Sisa Tagihan per Item</b> dari seluruh mahasiswa. <br>
                            <a class="btn btn-success float-right" href="<?php echo base_url(); ?>/laporan/generate_laporan_pembayaran_all_mhs"><i class="fas fa-arrow-down"></i> Generate</a>
                            Tekan tombol <b class="text-success">Generate</b> berikut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Pembayaran (berdasarkan NIM)</h4>
                        <p>Meliputi <b>Nama Item Pembayaran</b>, nominal <b>Total Tagihan per Item</b> dan <b>Sisa Tagihan per Item</b> berdasarkan NIM. <br>
                            Generate laporan pembayaran berdasarkan NIM. Silahkan masukkan NIM yang valid, lali klik tombol <b class="text-success">Generate</b>.
                        </p>
                        <div class="input-group mb-3">
                            <input id="pembayaran_nim" type="text" class="form-control" placeholder="Generate laporan pembayaran per mahasiswa. Masukkan NIM." aria-label="Generate laporan pembayaran per mahasiswa. Masukkan NIM." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="generateLaporanPembayaranByNIM()"><i class="fas fa-arrow-down"></i> Generate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Rekam Pembayaran</h4>
                        <p class="mb-3">Meliputi <b>Nama Item Pembayaran</b> dan <b>Tanggal Pembayaran</b> dari seluruh mahasiswa. <br>
                            <a class="btn btn-success float-right" href="<?php echo base_url(); ?>/laporan/generate_laporan_rekam_pembayaran_all_mhs"><i class="fas fa-arrow-down"></i> Generate</a>
                            Tekan tombol <b class="text-success">Generate</b> berikut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Laporan Rekam Pembayaran (berdasarkan NIM)</h4>
                        <p>Meliputi <b>Nama Item Pembayaran</b>, <b>Nominal Pembayaran</b>, dan <b>Tanggal Pembayaran</b> berdasarkan NIM. <br>
                            Generate laporan rekam pembayaran berdasarkan NIM. Silahkan masukkan NIM yang valid, lali klik tombol <b class="text-success">Generate</b>.
                        </p>
                        <div class="input-group mb-3">
                            <input id="rekam_pembayaran_nim" type="text" class="form-control" placeholder="Generate laporan rekam pembayaran per mahasiswa. Masukkan NIM." aria-label="Generate laporan pembayaran per mahasiswa. Masukkan NIM." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" onclick="generateLaporanRekamPembayaranByNIM()"><i class="fas fa-arrow-down"></i> Generate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/laporan/script') ?>
<?= $this->endSection() ?>