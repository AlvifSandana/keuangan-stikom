<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalEditFormula" aria-labelledby="modalEditFormula" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Formula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_paket">Kode Item</label>
                    <input type="text" name="edit_item_kode" id="edit_item_kode" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_paket">Nama Item</label>
                    <input type="text" name="edit_nama_item" id="edit_nama_item" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_paket">Nominal</label>
                    <input type="text" name="edit_nominal_item" id="edit_nominal_item" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="formula">Formula</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="edit_formula" id="edit_formula" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success float-right" onclick="editFormula()">Perbarui</button>
            </div>
        </div>
    </div>
</div>