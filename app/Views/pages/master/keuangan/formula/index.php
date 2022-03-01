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
                    <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#master-formula" role="tab" data-toggle="tab">Master Formula</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#master-formula-item" role="tab" data-toggle="tab">Formula Item</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="master-formula">
                                <?= $this->include('pages/master/keuangan/formula/card_master_formula') ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="master-formula-item">
                                <?= $this->include('pages/master/keuangan/formula/card_master_formula_item') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add formula -->
    <?= $this->include('pages/master/keuangan/formula/modal_add_formula') ?>
    <!-- Modal Edit formula -->
    <?= $this->include('pages/master/keuangan/formula/modal_edit_formula') ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/keuangan/formula/script') ?>
<?= $this->endSection() ?>