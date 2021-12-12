<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Tahun Angkatan <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateAngkatan"><i class="fa fa-plus"></i></button></h5>
        <table class="table table-hover table-bordered">
            <thead class="text-center">
                <th>TAHUN ANGKATAN</th>
                <th>ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php foreach ($angkatan as $a) {
                    echo '<tr><td>' . $a['nama_angkatan'] . '</td><td><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateAngkatan" onclick="fillUpdateField(' . $a['id_angkatan'] . ', ' . "'" . $a['nama_angkatan'] . "'" . ',' . "'" . 'angkatan' . "'" . ')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm ml-2" onclick="deleteAngkatan('.$a['id_angkatan'].')"><i class="fa fa-trash"></i></button></td></tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>