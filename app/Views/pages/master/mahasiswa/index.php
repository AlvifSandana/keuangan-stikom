<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Mahasiswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Mahasiswa</li>
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
                        <h5 class="h5 mb-3">Import Data Mahasiswa</h5>
                        <form action="<?php echo base_url(); ?>/master-mahasiswa/import/upload" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_import" id="file_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet`">
                                    <label class="custom-file-label" for="file_import">Choose file (.xlsx)</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="h5 mb-4">Data Mahasiswa <button class="btn btn-success float-right" data-toggle="modal" data-target="#modalAddMahasiswa"><i class="fas fa-plus"></i> Tambah Data Mahasiswa</button></h5>
                        <table class="table table-hover table-bordered" id="tbl_list_mhs">
                            <thead class="text-center">
                                <th>NIM</th>
                                <th>NAMA MAHASISWA</th>
                                <th>ACTION</th>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($data_mahasiswa as $m) {
                                    echo '<tr data-idmhs="' . $m['id_mahasiswa'] . '"><td>' . $m['nim'] . '</td><td>' . $m['nama_mahasiswa'] . '</td><td><button class="btn btn-sm btn-success mx-1" data-toggle="modal" data-target="#modalUpdateTagihanMahasiswa" onclick="fillModalUpdateForm(' . $m["id_mahasiswa"] . ')"><i class="fas fa-dollar-sign"></i></button><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalUpdateMahasiswa" onclick="fillModalUpdateForm(' . $m["id_mahasiswa"] . ')"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger mx-1" onclick="deleteMahasiswa(' . $m['id_mahasiswa'] . ')"><i class="fas fa-trash"></i></button></td></tr>';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modals -->
<?= $this->include('pages/master/mahasiswa/modaladdmahasiswa') ?>
<?= $this->include('pages/master/mahasiswa/modalupdatemahasiswa') ?>
<?= $this->include('pages/master/mahasiswa/modalupdatetagihanmahasiswa') ?>
<!-- ./Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/mahasiswa/script') ?>
<?= $this->endSection() ?>
