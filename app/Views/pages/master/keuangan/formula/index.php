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
                <h1 class="m-0">Master Formula</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master Keuangan</a></li>
                    <li class="breadcrumb-item active">Formula</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <?= $this->include('layout/flash') ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="h5 mb-4">Data Item Tagihan
                            <button class="btn btn-primary btn-sm float-right" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                <i class="fas fa-filter fa-fw"></i> Filter
                            </button>
                        </h5>
                        <div class="collapse" id="collapseFilter">
                            <div class="card card-body">
                                Tampilkan berdasarkan:
                                <div class="row mb-1">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="paket_id">Paket</label>
                                            <select class="form-control custom-select" id="paket_id" style="width: 100%;">
                                                <option value=""></option>
                                                <?php foreach ($paket as $key => $value) { ?>
                                                    <option value="<?= $value['id_paket']?>"><?= $value['nama_paket']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="semester_id">Semester</label>
                                            <select class="form-control custom-select" id="semester_id" style="width: 100%;">
                                                <option value=""></option>
                                                <?php foreach ($semester as $key => $value) { ?>
                                                    <option value="<?= $value['id_semester']?>"><?= $value['nama_semester']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="angkatan_id">Tahun Angkatan</label>
                                            <select class="form-control custom-select" id="angkatan_id" style="width: 100%;">
                                                <option value=""></option>
                                                <?php foreach ($angkatan as $key => $value) { ?>
                                                    <option value="<?= $value['id_angkatan']?>"><?= $value['tahun_angkatan']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-success btn-sm float-right"><i class="fas fa-check fa-fw"></i> Terapkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover tbl_master_formula" id="tbl_master_formula">
                            <thead class="text-center">
                                <th>Kode Formula</th>
                                <th>Kode Item Tagihan</th>
                                <th>Nama Item</th>
                                <th>Nominal</th>
                                <th>persentase</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="">
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
<?= $this->include('pages/master/keuangan/formula/script') ?>
<?= $this->endSection() ?>