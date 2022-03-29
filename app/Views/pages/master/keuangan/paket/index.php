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
                <h1 class="m-0">Master Paket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master Keuangan</a></li>
                    <li class="breadcrumb-item active">Paket</li>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="h5 mb-4">Data Paket Tagihan
                            <button class="btn btn-success float-right ml-2" data-toggle="modal" data-target="#modalAddItemPaket"><i class="fas fa-plus"></i> Tambah Item Tagihan</button>
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#modalAddPaket"><i class="fas fa-plus"></i> Tambah Paket</button>
                        </h5>
                        <select name="paket" class="form-control custom-select" id="select_paket" onchange="getItemPaket()" style="width: 100%;">
                            <option value=""></option>
                            <?php
                            foreach ($data_paket as $p) {
                                echo '<option value="' . $p['id_paket'] . '">' . $p['nama_paket'] . '</option>';
                            }
                            ?>
                        </select>
                        <h5 class="h5 mt-3 mb-4">Detail Item Paket</h5>
                        <table class="table table-bordered tbl_master_paket" id="tbl_master_paket">
                            <thead class="text-center">
                                <th>Kode Item Tagihan</th>
                                <th>Nama Item</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <h5 class="h5 mt-3 mb-4">Detail Item Tagihan Lain-lain</h5>
                        <table class="table table-bordered table-hover tbl_master_paket" id="tbl_master_item_lain">
                            <thead class="text-center">
                                <th>Kode Item Tagihan</th>
                                <th>Nama Item</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
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
    <!-- Modal Add Paket -->
    <?= $this->include('pages/master/keuangan/paket/modal_add_paket') ?>
    <!-- Modal Add Item Paket -->
    <?= $this->include('pages/master/keuangan/paket/modal_add_item_paket') ?>
    <!-- Modal Edit Item Paket -->
    <?= $this->include('pages/master/keuangan/paket/modal_edit_item_paket') ?>
    <!-- Modal Add formula -->
    <?= $this->include('pages/master/keuangan/paket/modal_add_formula') ?>
    <!-- Modal Edit formula -->
    <?= $this->include('pages/master/keuangan/paket/modal_edit_formula') ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/keuangan/paket/script') ?>
<?= $this->endSection() ?>