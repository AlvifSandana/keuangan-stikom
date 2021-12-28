<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Semester <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateSemester"><i class="fa fa-plus"></i></button></h5>
        <table class="table table-hover table-bordered">
            <thead class="text-center">
                <th>NO.</th>
                <th>SEMESTER</th>
                <th>ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php foreach ($semester as $i => $s) {
                    echo '<tr>
                    <td>'.($i+1).'</td>
                    <td>' . $s['nama_semester'] . '</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateSemester" onclick="fillUpdateField(' ."'". $s['id_semester'] ."'". ', ' . "'" . $s['nama_semester'] . "'" . ',' . "'" . 'semester' . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm ml-2" onclick="deleteSemester('.$s['id_semester'].')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td></tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>