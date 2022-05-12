<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Jurusan <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateJurusan"><i class="fa fa-plus"></i></button></h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">
                <thead class="text-center">
                    <th>NO.</th>
                    <th>JURUSAN</th>
                    <th>PROGRAM</th>
                    <th>ACTION</th>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($jurusan as $i => $j) {
                        echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td>' . $j['nama_jurusan'] . '</td>
                        <td>' . $j['nama_program'] . '</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateJurusan" onclick="fillUpdateField(' . "'" . $j['id_jurusan'] . "'" . ', ' . "'" . $j['nama_jurusan'] . "'" . ',' . "'" . 'jurusan' . "','" . $j['nama_program'] . "'" . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm ml-2" onclick="deleteJurusan(' . "'" . $j['id_jurusan'] . "'" . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>