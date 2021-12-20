<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tagihan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Keuangan Mahasiswa</li>
                    <li class="breadcrumb-item active">Tagihan</li>
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
                        <div class="row">
                            <div class="col-9">
                                <input type="text" name="nim" id="nim" class="form-control" placeholder="Cari berdasarkan NIM atau NAMA Mahasiswa">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary btn-block" onclick="searchMhs()"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card" id="search_result" style="visibility: hidden;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="h5">Hasil Pencarian</h5>
                                <table class="table table-hover">
                                    <thead class="text-center">
                                        <th>NIM</th>
                                        <th>NAMA MAHASISWA</th>
                                        <th>PROGRAM STUDI</th>
                                        <th>ANGKATAN</th>
                                        <th>ACTION</th>
                                    </thead>
                                    <tbody class="text-center" id="list_tagihan">
                                    </tbody>
                                </table>
                                <table>
                                    <tr>
                                        <td><b>Summary</b></td>
                                    </tr>
                                    <tr>
                                        <td>Total Tagihan</td>
                                        <td>&emsp;=&emsp;</td>
                                        <td>Rp <span id="global-tagihan"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Terbayar</td>
                                        <td>&emsp;=&emsp;</td>
                                        <td>Rp <span id="global-pembayaran"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card hasil" style="visibility: hidden;">
                    <div class="card-body detail-tagihan">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- modal detail tagihan -->
<?= $this->include('pages/keuangan_mahasiswa/tagihan/modaldetailtagihan') ?>
<!-- /modal detail tagihan -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/keuangan_mahasiswa/tagihan/script') ?>
<?= $this->endSection() ?>