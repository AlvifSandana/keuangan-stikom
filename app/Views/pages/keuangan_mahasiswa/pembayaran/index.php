<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Keuangan Mahasiswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Keuangan Mahasiswa</li>
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
                            <div class="col-md-9 col-sm-12">
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari berdasarkan NIM atau NAMA Mahasiswa">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <button class="btn btn-primary btn-block" onclick="searchMahasiswa()"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card search result -->
        <div class="row mb-2">
            <div class="col">
                <div class="card" id="search_result" style="visibility: visible;">
                    <div class="card-header border-0">
                        <h3 class="card-title pt-2"><i class="fas fa-search"></i> Hasil Pencarian</h3>
                        <div class="card-tools float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm" id="tbl_pencarian">
                                        <thead class="text-center">
                                            <th>NIM</th>
                                            <th>NAMA MAHASISWA</th>
                                            <th>PROGRAM STUDI</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </thead>
                                        <tbody class="text-center" id="tbl_hasil_pencarian"></tbody>
                                    </table>
                                </div>
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
<script>
    // show upload filename
    $('#fbp').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });
</script>
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/script') ?>
<?= $this->endSection() ?>