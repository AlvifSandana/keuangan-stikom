<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Sesi Kuliah <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateSesiKuliah"><i class="fa fa-plus"></i></button></h5>
        <table class="table table-hover table-bordered">
            <thead class="text-center">
                <th>NO.</th>
                <th>SESI KULIAH</th>
                <th>ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php foreach ($sesi_kuliah as $i => $s) {
                    echo '<tr>
                    <td>'.($i+1).'</td>
                    <td>' . $s['nama_sesi'] . '</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateSesiKuliah" onclick="fillUpdateField(' ."'". $s['id_sesi'] ."'". ', ' . "'" . $s['nama_sesi'] . "'" . ',' . "'" . 'sesikuliah' . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm ml-2" onclick="deleteSesiKuliah('."'".$s['id_sesi']."'".')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td></tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>