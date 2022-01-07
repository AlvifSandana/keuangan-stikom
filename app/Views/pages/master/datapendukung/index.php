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
                                <a class="nav-link" href="#paket" role="tab" data-toggle="tab">Paket</a>
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
                            <div role="tabpanel" class="tab-pane" id="paket">
                                <?= $this->include('pages/master/datapendukung/card_paket') ?>
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
<?= $this->include('pages/master/datapendukung/modal/modal_create_semester') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_angkatan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_jurusan') ?>
<?= $this->include('pages/master/datapendukung/modal/modal_update_semester') ?>
<!-- /Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/datapendukung/script') ?>
<?= $this->endSection() ?>