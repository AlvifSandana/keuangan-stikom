<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalEditMasterFormula" aria-labelledby="modalEditMasterFormula" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Formula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="formula">Formula TW (Tagihan Wajib)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="edit_kode_mformula" id="edit_id_mformula" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" hidden/>
                                <input type="number" class="form-control" name="edit_tw" id="edit_tw" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100" oninput="EdithitungPersentase('tw')">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formula">Formula TB (Tagihan Baru)</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="edit_tb" id="edit_tb" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100" oninput="EdithitungPersentase('tb')">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning float-right" onclick="updateMasterFormula()">Perbarui</button>
            </div>
        </div>
    </div>
</div>