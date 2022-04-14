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
                <h1 class="m-0">Master Data Pendukung</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Data Pendukung</li>
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
            <div class="col">
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="h4">Data Pendukung</h4>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#angkatan" role="tab" data-toggle="tab">Angkatan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#jurusan" role="tab" data-toggle="tab">Jurusan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#semester" role="tab" data-toggle="tab">Semester</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sesikuliah" role="tab" data-toggle="tab">Sesi Kuliah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#paket" role="tab" data-toggle="tab">Paket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#diskon" role="tab" data-toggle="tab">Diskon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#mp" role="tab" data-toggle="tab">Metode Pembayaran</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="angkatan">
                                <?= $this->include('pages/master/datapendukung/card_angkatan') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="jurusan">
                                <?= $this->include('pages/master/datapendukung/card_jurusan') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="semester">
                                <?= $this->include('pages/master/datapendukung/card_semester') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="sesikuliah">
                                <?= $this->include('pages/master/datapendukung/card_sesi_kuliah') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="paket">
                                <?= $this->include('pages/master/datapendukung/card_paket') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="diskon">
                                <?= $this->include('pages/master/datapendukung/card_diskon') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="mp">
                                <?= $this->include('pages/master/datapendukung/card_metode_pembayaran') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modals -->
<?= $this->include('pages/master/datapendukung/modal/modal_create_angkatan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_jurusan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_mp') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_paket') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_semester') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_sesi_kuliah') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_diskon') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_angkatan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_jurusan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_mp') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_paket') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_semester') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_sesi_kuliah') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_diskon') ?>
<!-- /Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/datapendukung/script') ?>
<?= $this->endSection() ?>