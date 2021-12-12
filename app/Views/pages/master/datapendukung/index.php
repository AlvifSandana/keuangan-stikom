<?= $this->extend('layout/master') ?>

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
                <?= $this->include('pages/master/datapendukung/card_progdi') ?>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <?= $this->include('pages/master/datapendukung/card_semester') ?>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <?= $this->include('pages/master/datapendukung/card_angkatan') ?>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <?= $this->include('pages/master/datapendukung/card_paket') ?>
            </div>
        </div>
    </div>
</section>
<!-- Modals -->
<?= $this->include('pages/master/datapendukung/modal/modal_create_angkatan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_progdi') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_semester') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_create_paket') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_angkatan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_progdi') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_semester') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_paket') ?>
<!-- /Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
    <?= $this->include('pages/master/datapendukung/script') ?>
<?= $this->endSection() ?>
