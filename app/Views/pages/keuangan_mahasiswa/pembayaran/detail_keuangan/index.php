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
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#datamhs" role="tab" data-toggle="tab">Data Mahasiswa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pembayaran" role="tab" data-toggle="tab">Pembayaran</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="datamhs">
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
                            <div role="tabpanel" class="tab-pane" id="pembayaran">
                                <h4 class="h4 mt-2">
                                    Data Keuangan
                                    <span class="text-primary"><?php echo $mahasiswa[0]['nama_mhs']; ?></span>
                                    <div class="btn-group dropleft float-right">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-info-circle"></i> Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#pembayaran-baru" data-toggle="modal" data-target="#modalCreatePembayaran">Tambah Pembayaran Baru</a>
                                            <a class="dropdown-item" href="#tagihan-baru" data-toggle="modal" data-target="#modalTambahTagihan">Tambah Tagihan Baru</a>
                                            <a class="dropdown-item" href="#diskon-baru">Tambah Diskon</a>
                                        </div>
                                    </div>
                                </h4>
                                <hr>
                                <? if (strpos($mahasiswa[0]['nama_paket'], 'BERBAGI')) { ?>
                                    <div class="info text-center">
                                        <span class="h4 text-primary"><?= $mahasiswa[0]['nama_mhs'] ?> mengikut program <?= $mahasiswa[0]['nama_paket'] ?></span>
                                    </div>
                                <? } ?>
                                <? foreach ($semester as $s => $svalue) { ?>
                                    <div class="card shadow-none border <?= $svalue['id_semester'] ?>">
                                        <div class="card-header">
                                            <h5 class="card-title h5"><? echo $svalue['nama_semester']; ?></h5>
                                            <div class="card-tools float-right">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
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
                                                                        <td class="text-center"><? echo $value['kode_item']; ?></td>
                                                                        <td><? echo $value['nama_item']; ?></td>
                                                                        <td>Rp <? echo number_format($value['nominal_item']); ?></td>
                                                                    </tr>
                                                                <? } ?>
                                                            <? } ?>
                                                            <tr class="font-weight-bold">
                                                                <td class="text-center" colspan="2">Total Tagihan</td>
                                                                <td>Rp <? echo number_format($total_tagihan); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="h6 font-weight-bold">Detail Pembayaran</h6>
                                                    <table class="table table-hover table-bordered table-sm" id="tbl_detail_tagihan">
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
                                                                        <td><? echo $value['nama_item']; ?></td>
                                                                        <? foreach ($pembayaran as $k => $v) {
                                                                            if ($v['kode_item'] == $value['kode_item']) {
                                                                                $current_nominal_item_pembayaran += $v['q_debit'];
                                                                            } else {
                                                                                continue;
                                                                            }
                                                                        } ?>
                                                                        <td>Rp <? echo number_format($current_nominal_item_pembayaran); ?></td>
                                                                        <td></td>
                                                                    </tr>
                                                                <? } ?>
                                                            <?
                                                                $total_pembayaran += $current_nominal_item_pembayaran;
                                                                $current_nominal_item_pembayaran = 0;
                                                            } ?>
                                                            <tr class="font-weight-bold">
                                                                <td class="text-center" colspan="2">Total Pembayaran</td>
                                                                <td>Rp <? echo number_format($total_pembayaran); ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
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