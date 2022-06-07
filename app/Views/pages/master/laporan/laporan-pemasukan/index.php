<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Laporan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Pemasukan</li>
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
                        <h4 class="h4">Laporan Pemasukan <span><?= $tgl_mulai ?></span> - <span><?= $tgl_akhir ?></span><span class="float-right"><a href="<?= base_url('/lk').'/'.$filename?>" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print fa-fw"></i></a></span></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless table-sm">
                                    <tr class="text-success">
                                        <td>Record Pembayaran Mahasiswa</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $n_pemasukan_dari_mhs ?></td>
                                    </tr>
                                    <tr class="text-success">
                                        <td>Record Akun Pemasukan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $n_pemasukan_akun_pemasukan ?></td>
                                    </tr>

                                    <tr class="text-success">
                                        <td>Total Nominal Pembayaran Mahasiswa</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">Rp <?= number_format($total_pemasukan_dari_mhs, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr class="text-success">
                                        <td>Total Nominal Transaksi Akun Pemasukan</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">Rp <?= number_format($total_pemasukan_akun_pemasukan, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr class="text-white bg-success">
                                        <td>Total Nominal</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">Rp <?= number_format($total_pemasukan_akun_pemasukan + $total_pemasukan_dari_mhs, 0, ',', '.') ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm tbl-pemasukan">
                                <thead>
                                    <th class="text-center">NO.</th>
                                    <th class="text-center">UNIT</th>
                                    <th class="text-center">KATEGORI</th>
                                    <th class="text-center">KETERANGAN</th>
                                    <th class="text-center">NOMINAL</th>
                                    <th class="text-center">TANGGAL</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($pemasukan as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1 ?></td>
                                            <td class="text-center">
                                                <?php if (strpos($value['kode_unit'], "-") == false) { ?>
                                                    <a target="_blank" href="<?= base_url() ?>/keuangan-mahasiswa/pembayaran/detail/<?= $value['kode_unit'] ?>"><?= $value['kode_unit'] ?></a>
                                                <?php } else { ?>
                                                    <a target="_blank" href="<?= base_url() ?>/master-keuangan/akun-pemasukan#<?= $value['kode_unit'] ?>"><?= $value['kode_unit'] ?></a>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center text-success">Pemasukan</td>
                                            <td><?= strpos($value['kode_unit'], '-') == false ? $value['nama_item'] : $value['nama_akun']?></td>
                                            <td>Rp. <span class="float-right"><?= number_format($value['q_debit']) ?></span></td>
                                            <td class="text-center"><?= date('d-M-Y H:i:s', strtotime($value['tanggal_transaksi'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/master/laporan/script') ?>
<?= $this->include('pages/master/laporan/laporan-pemasukan/script') ?>
<?= $this->endSection() ?>