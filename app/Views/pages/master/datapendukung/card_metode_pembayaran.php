<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Metode Pembayaran <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateMetodePembayaran"><i class="fa fa-plus"></i></button></h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">
                <thead class="text-center">
                    <th>NO.</th>
                    <th>METODE PEMBAYARAN</th>
                    <th>ACTION</th>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($metode_pembayaran as $i => $mp) {
                        echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td>' . $mp['nama_metode_pembayaran'] . '</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateMetodePembayaran" onclick="fillUpdateField(' . "'" . $mp['id_metode'] . "'" . ',' . "'" . $mp['nama_metode_pembayaran'] . "'" . ",'" . "mp'" . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm ml-2" onclick="deleteMP(' . "'" . $mp['id_metode'] . "'" . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>