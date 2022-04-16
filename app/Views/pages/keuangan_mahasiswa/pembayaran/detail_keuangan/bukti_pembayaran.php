<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: "Lucida Console", "Courier New", monospace;
        }

        .kop {
            margin-top: 50px;
            width: 100%;
            text-align: center;
        }

        .container {
            margin-left: 50px;
            margin-right: 50px;
        }

        .content {
            margin-top: 30px;
        }

        .note {
            font-size: small;
        }

        .ttd {
            margin-top: 70px;
            margin-left: 50px;
            margin-right: 50px;
            margin-bottom: 10px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop">
            <span class="kop-instansi">SEKOLAH TINGGI ILMU KOMPUTER PGRI BANYUWANGI</span>
            <br>
            <span class="kop-instansi">Tanda Bukti Pembayaran</span>
        </div>
        <hr>
        <div class="content">
            <table>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><?= $nim ?></td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $nama_mhs ?></td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Banyaknya Uang</td>
                    <td>:</td>
                    <td><?= ucwords($terbilang) ?></td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td>:</td>
                    <td><?= $nama_mhs ?> - <?= $jurusan ?> - <?= $nama_item ?> - RP <?= number_format($nominal, 0, ',', '.') ?></td>
                </tr>
                <tr></tr>
                <tr>
                    <td>Jumlah Rp</td>
                    <td>:</td>
                    <td><?= number_format($nominal, 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>
        <div class="ttd">
            <p style="margin-bottom: 40px;">Banyuwangi, <?= $tgl ?></p>
            <br>
            <p style="margin-right: 50px;"><?= session('nama') ?></p>
            <br>
        </div>
        <span class="note">*Nb: Dana yang sudah masuk tidak dapat ditarik kembali</span>
    </div>
</body>

</html>