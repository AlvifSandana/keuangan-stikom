<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">FRS Mahasiswa STIKOM Banyuwangi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Keuangan Mahasiswa</li>
                    <li class="breadcrumb-item active">FRS</li>
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
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title pt-2 mhs"><i class="fas fa-info-circle "></i> Mata Kuliah yang akan ditempuh pada semester ini</h4>
                        <div class="card-tools float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-sm table-bordered">
                            <thead class="text-center">
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>Ket</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Jadwal</th>
                                <th>Kuota</th>
                                <th>Peserta</th>
                                <th>Calon</th>
                            </thead>
                            <tbody>
                                <?php foreach ($list_frs as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['kode_mk'] ?></td>
                                        <td><?= $value['nama_mk'] ?></td>
                                        <td class="text-center"><?= $value['smtTempuh'] ?></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"><?= $value['jum_sks'] ?></td>
                                        <td><?= $value['nama_dosen'] ?></td>
                                        <td class="text-center"><?= $value['kelas'] ?></td>
                                        <td><?= $value['jadwal'] ?></td>
                                        <td class="text-center"><?= $value['kapasitas'] ?></td>
                                        <td class="text-center"><?= $value['Peserta'] ?></td>
                                        <td class="text-center"><?= $value['CalonPeserta'] ?></td>
                                    </tr>
                                <? } ?>
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
<?= $this->include('pages/keuangan_mahasiswa/frs/script') ?>
<?= $this->endSection() ?>