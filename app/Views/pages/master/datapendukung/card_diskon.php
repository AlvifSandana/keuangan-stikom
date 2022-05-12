<div class="card">
    <div class="card-body">
        <h5 class="h5 mb-3">Data Diskon <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreateDiskon"><i class="fa fa-plus"></i></button></h5>
        <div class="table-responsive">
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
                        <td>' . ($i + 1) . '</td>
                        <td>' . $d['nama_item'] . '</td>
                        <td>' . $d['tahun_angkatan'] . '</td>
                        <td>' . $d['nama_semester'] . '</td>
                        <td>' . $d['nominal_item'] . '</td>
                        <td>' . $d['keterangan_item'] . '</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalUpdateDiskon" onclick="fillUpdateDiskonField(' . "'" . $d['id_item'] . "'" . ', ' . "'" . $d['nama_item'] . "'" . ',' . "'" . $d['nominal_item'] . "'" . ',' . "'" . $d['semester_id'] . "'" . ',' . "'" . $d['angkatan_id'] . "'" . ',' . "'" . $d['keterangan_item'] . "'" . ')">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm ml-2" onclick="deleteDiskon(' . "'" . $d['id_item'] . "'" . ')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>