<div class="card">
    <div class="card-body">
    <h5 class="h5 mb-3">Data Diskon <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateDiskon"><i class="fa fa-plus"></i></button></h5>
        <table class="table table-hover table-bordered">
            <thead class="text-center">
                <th>NO.</th>
                <th>Nama Item</th>
                <th>Tahun</th>
                <th>Semester</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php foreach ($diskon as $i => $d) {
                    echo '<tr>
                    <td>'.($i+1).'</td>
                    <td>' . $d['nama_item'] . '</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateDiskon" onclick="fillUpdateField(' ."'". $d['id_semester'] ."'". ', ' . "'" . $d['nama_semester'] . "'" . ',' . "'" . 'semester' . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm ml-2" onclick="deleteDiskon('."'".$d['id_item']."'".')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td></tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>