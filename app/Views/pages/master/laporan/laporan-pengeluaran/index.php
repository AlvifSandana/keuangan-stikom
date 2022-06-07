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
                    <li class="breadcrumb-item active">Laporan Pengeluaran</li>
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
                        <h4 class="h4">Laporan Pengeluaran <span><?= $tgl_mulai ?></span> - <span><?= $tgl_akhir ?></span><span class="float-right"><a href="<?= base_url('lk/').'/'.$filename?>" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print fa-fw"></i></a></span></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless table-sm">
                                    <tr class="text-danger">
                                        <td>Record Akun Pengeluaran</td>
                                        <td>:</td>
                                        <td class="font-weight-bold"><?= $n_pengeluaran ?></td>
                                    </tr>
                                    <tr class="text-white bg-danger">
                                        <td>Total Nominal Transaksi Akun Pengeluaran</td>
                                        <td>:</td>
                                        <td class="font-weight-bold">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm tbl-pengeluaran">
                                <thead class="text-center">
                                    <th class="text-center">NO.</th>
                                    <th class="text-center">UNIT</th>
                                    <th class="text-center">KATEGORI</th>
                                    <th class="text-center">KETERANGAN</th>
                                    <th class="text-center">NOMINAL</th>
                                    <th class="text-center">TANGGAL</th>
                                </thead>
                                <tbody>
                                    <?php if (is_array($pengeluaran)) {
                                        foreach ($pengeluaran as $key => $value) { ?>
                                            <tr>
                                                <td class="text-center"><?= $key + 1 ?></td>
                                                <td class="text-center">
                                                    <?php if (strpos($value['kode_unit'], "-") == false) { ?>
                                                        <a target="_blank" href="<?= base_url() ?>/keuangan-mahasiswa/pembayaran/detail/<?= $value['kode_unit'] ?>"><?= $value['kode_unit'] ?></a>
                                                    <?php } else { ?>
                                                        <a target="_blank" href="<?= base_url() ?>/master-keuangan/akun-pengeluaran#<?= $value['kode_unit'] ?>"><?= $value['kode_unit'] ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center text-danger">Pengeluaran</td>
                                                <td><?= $value['nama_akun']?></td>
                                                <td>Rp. <span class="float-right"><?= number_format($value['q_kredit']) ?></span></td>
                                                <td class="text-center"><?= $value['tanggal_transaksi'] ?></td>
                                            </tr>
                                    <?php }
                                    } else {
                                        echo "<tr><td><?= $pengeluaran ?></td></tr>";
                                    } ?>
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
<?= $this->include('pages/master/laporan/laporan-pengeluaran/script') ?>
<?= $this->endSection() ?>