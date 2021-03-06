<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Paket Mahasiswa <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreatePaket"><i class="fa fa-plus"></i></button></h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <th class="text-center">NO.</th>
                    <th class="text-center">NAMA PAKET</th>
                    <!--<th>TAHUN ANGKATAN</th>-->
                    <th class="text-center">ACTION</th>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($paket as $i => $p) {
                        echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td>' . $p['nama_paket'] . '</td>
                        <!--<td>' . $p['angkatan_id'] . '</td>-->
                        <td>
                            <button class="btn btn-warning btn-sm" 
                            data-toggle="modal" 
                            data-target="#modalUpdatePaket" 
                            onclick="fillUpdatePaketField(' . "'" . $p['id_paket'] . "','" . $p['nama_paket'] . "','" . $p['angkatan_id'] . "','" . $p['jurusan_id'] . "','" . $p['jalur_id'] . "','" . $p['sesi_id'] . "','" . $p['keterangan_paket'] . "'" . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm ml-2" onclick="deletePaket(' . "'" . $p['id_paket'] . "'" . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>