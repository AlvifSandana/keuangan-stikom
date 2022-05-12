<h5 class="h5 mt-2 mb-3">Data Formula
    <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#modalAddMasterFormula"><i class="fas fa-plus fa-fw"></i> Formula Baru</button>
</h5>
<div class="table-responsive">
    <table class="table table-bordered table-hover tbl_master_formula_m" id="tbl_master_formula_m">
        <thead class="text-center">
            <th>No.</th>
            <th>Kode Formula</th>
            <th>% TW</th>
            <th>% TB</th>
            <th>Action</th>
        </thead>
        <tbody class="">
            <?php foreach ($formulaM as $key => $value) { ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['kode_mformula'] ?></td>
                    <td><?= $value['persentase_tw'] ?></td>
                    <td><?= $value['persentase_tb'] ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-info"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-info" href="#" data-toggle="modal" data-target="#modalEditMasterFormula" onclick="fillUpdateMasterFormula('<?= $value['kode_mformula'] ?>', '<?= $value['persentase_tw'] ?>', '<?= $value['persentase_tb'] ?>')"><i class="fas fa-fw fa-percentage"></i>Edit Formula</a>
                                <a class="dropdown-item text-danger" href="#" onclick="deleteMasterFormula('<?= $value['kode_mformula'] ?>')"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>