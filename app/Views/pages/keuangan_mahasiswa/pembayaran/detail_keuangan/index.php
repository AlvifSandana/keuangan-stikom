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
                <h1 class="m-0">Detail Keuangan Mahasiswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/keuangan-mahasiswa/pembayaran">Keuangan Mahasiswa</a></li>
                    <li class="breadcrumb-item active">Detail Keuangan Mahasiswa</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="content">
    <div class="container-fluid container-pembayaran">
        <?= $this->include('layout/flash') ?>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title pt-2 mhs"><i class="fas fa-info-circle "></i> Detail Data Mahasiswa</h4>
                        <div class="card-tools float-right">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="datamhs">
                            <div role="tabpanel" class="tab-pane" id="pembayaran">
                                <h4 class="h4 mt-2">Data <span class="text-primary"><?php echo $mahasiswa[0]['nama_mhs'] ?></span></h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>NIM</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['nim'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['nama_mhs'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Dosen Wali</td>
                                                <td>:</td>
                                                <td><?php echo $dosen[0]['nama_dosen'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['status'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Angkatan</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['angkatan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jurusan</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['jurusan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Program Kelas</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['program'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Paket</td>
                                                <td>:</td>
                                                <td><?php echo $mahasiswa[0]['nama_paket'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="h4 mt-2">
                                Detail Keuangan
                                <span class="text-primary"><?php echo $mahasiswa[0]['nama_mhs']; ?></span>
                                <div class="btn-group dropleft float-right">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false" <?php if (strpos($mahasiswa[0]['nama_paket'], 'BERBAGI')) {
                                                                                                                                                                                    echo ' disabled';
                                                                                                                                                                                } ?>>
                                        <i class="fas fa-info-circle"></i> Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#pembayaran-baru" data-toggle="modal" data-target="#modalCreatePembayaran">Tambah Pembayaran Baru</a>
                                        <a class="dropdown-item" href="#tagihan-baru" data-toggle="modal" data-target="#modalTambahTagihan">Tambah Tagihan Baru</a>
                                        <a class="dropdown-item" href="#diskon-baru" data-toggle="modal" data-target="#modalTambahDiskon">Tambah Diskon</a>
                                        <a class="dropdown-item" href="#detail-keuangan" data-toggle="modal" data-target="#modalDetailKeuangan" onclick="getDetailKeuangan('<?= $mahasiswa[0]['nim'] ?>')">Detail Keuangan</a>
                                    </div>
                                </div>
                            </h4>
                            <hr>
                            <?php if (strpos($mahasiswa[0]['nama_paket'], 'BERBAGI')) { ?>
                                <div class="info text-center">
                                    <span class="h4 text-primary"><?= $mahasiswa[0]['nama_mhs'] ?> mengikut program <?= $mahasiswa[0]['nama_paket'] ?></span>
                                </div>
                            <?php } ?>
                            <?php foreach ($semester as $s => $svalue) { ?>
                                <div class="card shadow-none border <?= $svalue['id_semester'] ?>">
                                    <div class="card-header">
                                        <h5 class="card-title h5"><?php echo $svalue['nama_semester']; ?></h5>
                                        <div class="card-tools float-right">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h6 class="h6 font-weight-bold">Detail Tagihan</h6>
                                                <table class="table table-hover table-bordered table-sm tagihan" id="tbl_detail_tagihan">
                                                    <thead class="text-center">
                                                        <th>KODE ITEM</th>
                                                        <th>NAMA ITEM</th>
                                                        <th>NOMINAL</th>
                                                    </thead>
                                                    <tbody class="<?= $svalue['id_semester'] ?>">
                                                        <?php
                                                        $total_tagihan = 0;
                                                        foreach ($tagihan as $key => $value) {
                                                            if ($value['nama_semester'] == $svalue['nama_semester']) {
                                                                $total_tagihan += $value['nominal_item']; ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $value['kode_item']; ?></td>
                                                                    <td><?php echo $value['nama_item']; ?></td>
                                                                    <td>Rp <?php echo number_format($value['nominal_item']); ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <tr class="font-weight-bold bg-danger">
                                                            <td class="text-center" colspan="2">Total Tagihan</td>
                                                            <td>Rp <?php echo number_format($total_tagihan); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="h6 font-weight-bold">Detail Pembayaran</h6>
                                                <table class="table table-hover table-bordered table-sm" id="tbl_detail_pembayaran">
                                                    <thead class="text-center">
                                                        <th>NAMA ITEM</th>
                                                        <th>TERBAYAR</th>
                                                        <th>ACTION</th>
                                                    </thead>
                                                    <tbody class="">
                                                        <?php
                                                        $total_pembayaran = 0;
                                                        $current_nominal_item_pembayaran = 0;
                                                        foreach ($tagihan as $key => $value) {
                                                            if ($value['nama_semester'] == $svalue['nama_semester']) { ?>
                                                                <tr>
                                                                    <td><?php echo $value['nama_item']; ?></td>
                                                                    <?php foreach ($pembayaran as $k => $v) {
                                                                        if ($v['kode_item'] == $value['kode_item']) {
                                                                            $current_nominal_item_pembayaran += $v['q_debit'];
                                                                        } else {
                                                                            continue;
                                                                        }
                                                                    } ?>
                                                                    <td>Rp <?php echo number_format($current_nominal_item_pembayaran); ?></td>
                                                                    <td class="text-center">
                                                                        <div class="dropdown no-arrow">
                                                                            <i class="fas fa-fw fa-ellipsis-h" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                                            <div class="dropdown-menu">
                                                                                <a href="#detail" class="dropdown-item text-primary edit" data-toggle="modal" data-target="#modalDetailPembayaranPerItem" onclick="getDetailPembayaranItem('<?= $value['nama_item'] ?>', <?= $value['q_kredit'] ?>, '<?= $value['kode_unit'] ?>', '<?= $value['item_kode'] ?>')">
                                                                                    <i class="fas fa-fw fa-eye "></i>
                                                                                    Detail Pembayaran
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php
                                                            $total_pembayaran += $current_nominal_item_pembayaran;
                                                            $current_nominal_item_pembayaran = 0;
                                                        } ?>
                                                        <tr class="font-weight-bold bg-success">
                                                            <td class="text-center" colspan="2">Total Pembayaran</td>
                                                            <td>Rp <?php echo number_format($total_pembayaran); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <h6 class="h6 font-weight-bold">Detail Diskon</h6>
                                                <table class="table table-hover table-bordered table-sm tagihan" id="tbl_detail_diskon">
                                                    <thead class="text-center">
                                                        <th>KODE ITEM</th>
                                                        <th>NAMA ITEM</th>
                                                        <th>NOMINAL</th>
                                                    </thead>
                                                    <tbody class="<?= $svalue['id_semester'] ?>">
                                                        <?php
                                                        $total_diskon = 0;
                                                        $tr_empty = '';
                                                        foreach ($diskon as $kd => $vald) {
                                                            if ($svalue['nama_semester'] == $vald['nama_semester']) {
                                                                $total_diskon += (int)$vald['nominal_item']; ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $vald['kode_item']; ?></td>
                                                                    <td><?php echo $vald['nama_item']; ?></td>
                                                                    <td>Rp <?php echo number_format($vald['nominal_item']); ?></td>
                                                                </tr>
                                                        <?php } else {
                                                                $tr_empty = '<tr><td class="text-center" colspan="3">Kosong!</td></tr>';
                                                            }
                                                        } ?>
                                                        <?= $tr_empty ?>
                                                        <tr class="font-weight-bold bg-success">
                                                            <td class="text-center" colspan="2">Total Diskon</td>
                                                            <td>Rp <?php echo number_format($total_diskon); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- modal create pembayaran -->
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/modaltambahpembayaran') ?>
<!-- modal create tagihan -->
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/modal_tambah_tagihan') ?>
<!-- modal detail pembayaran per item  -->
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/modaldetailitempembayaran') ?>
<!-- modal add diskon -->
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/modal_tambah_diskon') ?>
<!-- modal detail keuangan -->
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/detail_keuangan/modal_detail_keuangan') ?>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script>
    // show upload filename
    $('#fbp').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });
</script>
<?= $this->include('pages/keuangan_mahasiswa/pembayaran/detail_keuangan/script') ?>
<?= $this->endSection() ?>