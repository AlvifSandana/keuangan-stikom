<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalAddMasterFormula" aria-labelledby="modalAddMasterFormula" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Formula</h5>
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
                                <input type="number" class="form-control" name="add_tw" id="add_tw" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100" oninput="hitungPersentase('tw')">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formula">Formula TB (Tagihan Baru)</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="add_tb" id="add_tb" placeholder="0 - 100" aria-label="0 - 100" aria-describedby="basic-addon2" min="0" max="100" oninput="hitungPersentase('tb')">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success float-right" onclick="addMasterFormula()">Tambah</button>
            </div>
        </div>
    </div>
</div>