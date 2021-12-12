<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pembayaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pembayaran</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="content">
    <div class="container-fluid container-pembayaran">
    <?= $this->include('layout/flash') ?>
        <!-- card search input -->
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" name="nim" id="nim" class="form-control" placeholder="Cari berdasarkan NIM">
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary btn-block" onclick="searchPembayaran()"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card search result -->
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
                                    <tbody class="text-center" id="list_search_result"></tbody>
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
        <!-- Modal Tambah Pembayaran -->
        <?= $this->include('pages/pembayaran/modaltambahpembayaran') ?>
        <!-- Modal Detail Pembayaran per item -->
        <?= $this->include('pages/pembayaran/modaldetailitempembayaran') ?>
        <!-- /Modal Detail Pembayaran per item -->
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script>
     // show upload filename
     $('#fbp').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });
</script>
<?= $this->include('pages/pembayaran/script') ?>
<?= $this->endSection() ?>