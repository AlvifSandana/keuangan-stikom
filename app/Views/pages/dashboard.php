<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="row mb-1">
            <div class="col-md-6 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp <?php echo number_format($total_tagihan[0]['total_tagihan']); ?></h3>
                        <p>Tagihan Keseluruhan Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp <?php echo number_format($total_pembayaran[0]['total_pembayaran']); ?></h3>
                        <p>Pembayaran Keseluruhan Mahasiswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $mahasiswa[0]['jumlah_mahasiswa']; ?></h3>
                        <p>Mahasiswa Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-mahasiswa" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $jurusan[0]['jumlah_jurusan']; ?></h3>
                        <p>Program Studi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-pendukung#jurusan" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $paket[0]['jumlah_paket']; ?></h3>
                        <p>Paket Program Studi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-pendukung#paket" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $jalur[0]['jumlah_jalur']; ?></h3>
                        <p>Jalur Registrasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-random"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>/master-pendukung" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-6 col-sm-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Keuangan tahun <?= date("Y")?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="keuangan-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script>
    // define initial chart data
    const ctx = $("#keuangan-chart-canvas").get(0).getContext('2d')
    var chartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
                label: 'Pemasukan',
                backgroundColor: 'rgba(40,167,69,0.9)',
                borderColor: 'rgba(40,167,69),0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                label: 'Pengeluaran',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
        ]
    };
    //////////////////// GET DATA /////////////////////////////////////
    var data_pemasukan = [];
    var data_pengeluaran = [];
    // get current year
    var year = new Date().getFullYear();
    // get data from api 
    $.ajax({
        url: '<?= base_url() ?>/dashboard/chart-keuangan/' + year,
        method: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.status == 'success') {
                if (data.data.pemasukan.length != 0) {
                    chartData.datasets[0].data = data.data.pemasukan
                }
                if (data.data.pengeluaran.length != 0) {
                    chartData.datasets[1].data = data.data.pengeluaran
                }
                var barChartData = $.extend(true, {}, chartData)
                var tmp0 = chartData.datasets[0]
                var tmp1 = chartData.datasets[1]
                barChartData.datasets[0] = tmp0
                barChartData.datasets[1] = tmp1
            
                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                };
            
                const keuangan_chart = new Chart(ctx, {
                    type: "bar",
                    data: chartData,
                    options: barChartOptions
                });
            }
        },
        error: function(jqXHR) {
            console.log(jqXHR);
        }
    })



</script>
<?= $this->endSection() ?>