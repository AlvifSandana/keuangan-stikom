<h5 class="h5 mt-2 mb-4">Data Item Tagihan
    <button class="btn btn-primary btn-sm float-right" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
        <i class="fas fa-filter fa-fw"></i> Filter
    </button>
</h5>
<div class="collapse" id="collapseFilter">
    <div class="card card-body">
        Tampilkan berdasarkan:
        <div class="row mb-1">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="paket_id">Paket</label>
                    <select class="form-control custom-select" id="paket_id" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($paket as $key => $value) { ?>
                            <option value="<?= $value['id_paket'] ?>"><?= $value['nama_paket'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="semester_id">Semester</label>
                    <select class="form-control custom-select" id="semester_id" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($semester as $key => $value) { ?>
                            <option value="<?= $value['id_semester'] ?>"><?= $value['nama_semester'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="angkatan_id">Tahun Angkatan</label>
                    <select class="form-control custom-select" id="angkatan_id" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($angkatan as $key => $value) { ?>
                            <option value="<?= $value['id_angkatan'] ?>"><?= $value['tahun_angkatan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-success btn-sm float-right" onclick="getFormulaByFilter()">
                    <i class="fas fa-check fa-fw"></i> Terapkan
                </button>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover tbl_master_formula" id="tbl_master_formula">
        <thead class="text-center">
            <th>Kode Formula</th>
            <th>Kode Item Tagihan</th>
            <th>Nama Item</th>
            <th>Nominal</th>
            <th>persentase</th>
            <th>Action</th>
        </thead>
        <tbody class="">
            <?php foreach ($formula as $key => $value) { ?>
                <tr>
                    <td class="text-center"><?= $value['kode_formula'] ?></td>
                    <td class="text-center"><?= $value['kode_item'] ?></td>
                    <td data-toggle="tooltip" data-placement="top" title="<?= $value['nama_semester'] ?> angkatan <?= $value['tahun_angkatan'] ?>"><?= $value['nama_item'] ?></td>
                    <td>Rp <?= number_format($value['nominal_item']) ?></td>
                    <td class="text-center"><?= $value['persentase'] == null ? '' : $value['persentase'] . ' %' ?></td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-info"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-<?= $value['kode_formula'] == null ? 'success' : 'info' ?>" href="#" data-toggle="modal" data-target="#modal<?= $value['kode_formula'] == null ? 'Add' : 'Edit' ?>Formula" onclick="getItemPaketFormulaByIdItem('<?= $value['id_item'] ?>')"><i class="fas fa-fw fa-percentage"></i> <?= $value['kode_formula'] == null ? 'Add Formula' : 'Edit Formula' ?></a>
                                <a class="dropdown-item text-danger" href="#" onclick="deleteItemFormula(<?= $value['id_formula'] ?>)"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>