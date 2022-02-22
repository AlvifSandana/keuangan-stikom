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
<?php $p_soft = 0; $p_hard = 0; ?>
<section class="content">
    <div class="container-fluid">
        <div class="row" mb-2>
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title pt-2 mhs"><i class="fas fa-fw fa-user"></i> Data Mahasiswa</h4>
                        <div class="card-tools float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['nim'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['nama_mhs'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['jurusan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dosen Wali</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['nama_dosen'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paket</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['nama_paket'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Semester, Tahun Ajaran</td>
                                        <td>:</td>
                                        <td><?= $tahun_ajaran[0]['kode_thn'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>IP Semester Lalu</td>
                                        <td>:</td>
                                        <td><?= $ipk ?></td>
                                    </tr>
                                    <tr>
                                        <td>Program Kelas</td>
                                        <td>:</td>
                                        <td><?= $data_mhs[0]['program'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Semester yang akan ditempuh(*)</td>
                                        <td>:</td>
                                        <td id="next_semester"><?= $next_semester[0]['semester'] ?></td>
                                        <input type="text" name="angkatan" id="angkatan" value="<?= $data_mhs[0]['angkatan']?>" hidden />
                                    </tr>
                                    <tr>
                                        <td>Beban Studi Maksimal</td>
                                        <td>:</td>
                                        <td><?= $beban_sks ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title pt-2 mhs"><i class="fas fa-fw fa-info-circle "></i> Mata Kuliah yang akan ditempuh pada semester ini</h4>
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
                                <?php foreach ($list_frs as $key => $value) { 
                                    if ($value['jenis'] == 'praktikum software') {
                                        $p_soft += 1;
                                    }
                                    if ($value['jenis'] == 'praktikum hardware') {
                                        $p_soft += 1;
                                    }
                                    ?>
                                    <tr class="<?= $tanggal_persetujuan_dw[0]['status'] != 1 && ((int)$value['kapasitas'] - 1) < (int)$value['Peserta'] ? 'bg-danger' : ''; ?>">
                                        <td><?= $value['kode_mk'] ?></td>
                                        <td><?= $value['nama_mk'] ?></td>
                                        <td class="text-center"><?= $value['smtTempuh'] ?></td>
                                        <td class="text-center"><?= $value['sts_mk'] ?></td>
                                        <td class="text-center"><?= $value['jum_sks'] ?></td>
                                        <td><?= $value['nama_dosen'] ?></td>
                                        <td class="text-center"><?= $value['kelas'] ?></td>
                                        <td><?= $value['jadwal'] ?></td>
                                        <td class="text-center"><?= $value['kapasitas'] ?></td>
                                        <td class="text-center"><?= $value['Peserta'] ?></td>
                                        <td class="text-center"><?= $value['CalonPeserta'] ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4">Total SKS yang akan ditempuh</td>
                                    <td colspan="7" class="font-weight-bold"><span id="n_sks"><?= $total_sks ?></span> SKS</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Status Persetujuan KRS</td>
                                    <td colspan="7" class="font-weight-bold">
                                        <?= $tanggal_persetujuan_dw && $tanggal_persetujuan_dw[0]['status'] == 1 ? 'Disetujui oleh Dosen Wali.' : 'FRS belum disetujui Dosen Wali.' ?>
                                    </td>
                                    <input type="text" name="p_soft" id="p_soft" value="<?= $p_soft ?>" hidden/>
                                    <input type="text" name="p_hard" id="p_hard" value="<?= $p_hard ?>" hidden/>
                                </tr>
                                <tr>
                                    <td colspan="4">Status Persetujuan Keuangan</td>
                                    <td colspan="7" class="font-weight-bold">
                                        <?= $tanggal_persetujuan_k && $tanggal_persetujuan_k[0]['status'] == 1 ? 'Disetujui oleh Bagian Keuangan.' : 'FRS belum disetujui.' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Sudah disetujui pada tanggal </td>
                                    <td class="font-weight-bold" colspan="7">
                                        <?= $tanggal_persetujuan_dw && $tanggal_persetujuan_dw[0]['status'] == 1 ? $tanggal_persetujuan_dw[0]['tgl_persetujuan'] : $tanggal_persetujuan_dw[0]['tgl_persetujuan'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="group-persetujuan mt-3">
                            <span>
                                <?php
                                if ($tanggal_persetujuan_k[0]['status'] == 1) {
                                    echo '(+) Jika Anda ingin membatalkan seluruh Rencana Study Mahasiswa silakan Klik tombol Batalkan.';
                                } else {
                                    echo '(+) Jika Anda menyetujui Rencana Study Mahasiswa yang bersangkutan, silahkan Klik tombol Setujui.';
                                }?>
                            </span>
                            <button class="btn btn-warning btn-sm float-right" onclick="<?= $tanggal_persetujuan_k[0]['status'] == 1 ? 'batalFRS()':'accFRS()'?>" <?= $tanggal_persetujuan_dw[0]['status'] == 1 ? '': 'disabled'?>>
                                <?php if ($tanggal_persetujuan_k[0]['status'] == 1) {?>
                                    Batalkan Formulir Rencana Studi
                                <?php } else {?>
                                    Setujui Formulir Rencana Studi
                                <?php } ?>
                            </button>
                        </div>
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