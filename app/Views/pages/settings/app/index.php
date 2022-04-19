<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Application Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Application Settings</li>
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
                            <div class="col-md-12">
                                <label for=""><?= $settings[0]['nama_setting'] ?></label>
                                <p><?= $settings[0]['deskripsi_settings'] ?></p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="val">Angkatan Tahun</label>
                                    </div>
                                    <select class="custom-select" name="val" id="val">
                                        <?php foreach ($angkatan as $key => $value) { ?>
                                            <option value="<?= $value['tahun_angkatan'] ?>"><?= $value['tahun_angkatan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <p>Current value: <b><?= $settings[0]['value'] ?></b></p>
                                <button class="btn btn-success float-right" onclick="saveSetting(<?= $settings[0]['id_setting']?>)"><i class="fas fa-fw fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modals -->
<!-- /Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/settings/app/script') ?>
<?= $this->endSection() ?>