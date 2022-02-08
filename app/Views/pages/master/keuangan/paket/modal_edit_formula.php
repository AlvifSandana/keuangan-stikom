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
                    <input type="text" name="editf_item_kode" id="editf_kode_formula" class="form-control" hidden>
                    <input type="text" name="editf_item_kode" id="editf_item_kode" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_paket">Nama Item</label>
                    <input type="text" name="editf_nama_item" id="editf_nama_item" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_paket">Nominal</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2">Rp</span>
                        </div>
                        <input type="text" name="editf_nominal_item" id="editf_nominal_item" class="form-control" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">.00</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="formula">Formula</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="editf_formula" id="editf_formula" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100" oninput="hitungNominalWithFormula()" onfocus="hitungNominalWithFormula()">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formula">Nominal setelah formula</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="editf_nominal_after" id="editf_nominal_after" placeholder="0" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info float-right" onclick="updateFormula()">Perbarui</button>
            </div>
        </div>
    </div>
</div>