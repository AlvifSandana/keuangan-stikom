<h5 class="h5 mt-2 mb-3">Data Formula
    <button class="btn btn-primary float-right btn-sm"><i class="fas fa-plus fa-fw"></i> Formula Baru</button>
</h5>
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
               <td><?= $key ?></td>
               <td><?= $value['kode_mformula'] ?></td>
               <td><?= $value['persentase_tw'] ?></td>
               <td><?= $value['persentase_tb'] ?></td>
               <td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>