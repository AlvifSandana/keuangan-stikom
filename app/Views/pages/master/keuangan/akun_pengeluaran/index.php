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
        <?= $this->include('layout/flash') ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Akun Pengeluaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master Keuangan</a></li>
                    <li class="breadcrumb-item active">Akun Pengeluaran</li>
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
                        <h5 class="h5 mb-4">Data Akun Pengeluaran
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#modalCreateAkunPengeluaran"><i class="fas fa-plus"></i> Tambah Akun Pengeluaran</button>
                        </h5>
                        <table class="table table-bordered table-hover table-sm tbl_master_akun_pengeluaran" id="tbl_master_akun_pengeluaran">
                            <thead class="text-center">
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="">
                                <?php foreach ($akun_pengeluaran as $key => $value) { ?>
                                    <tr>
                                        <td class="text-center"><?= $value['kode_akun'] ?></td>
                                        <td><?= $value['nama_akun'] ?></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-fw fa-info"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#modalUpdateAkunPengeluaran" onclick="getAkunById(<?= $value['id_akun']?>)"><i class="fas fa-edit"></i> Edit</a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deleteAkun(<?= $value['id_akun'] ?>)"><i class="fas fa-trash"></i> Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modals -->
    <?= $this->include('pages/master/keuangan/akun_pengeluaran/modal_create_akun_pengeluaran') ?>
    <?= $this->include('pages/master/keuangan/akun_pengeluaran/modal_update_akun_pengeluaran') ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/keuangan/akun_pengeluaran/script') ?>
<?= $this->endSection() ?>