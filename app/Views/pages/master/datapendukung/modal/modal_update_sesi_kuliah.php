<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateSesiKuliah" aria-labelledby="modalUpdateSesiKuliah" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Sesi Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_sesikuliah" id="update_id_sesikuliah" hidden disabled>
                <div class="form-group">
                    <label for="dp_nama_item">SESI KULIAH</label>
                    <input type="text" name="nama_sesikuliah" id="update_nama_sesikuliah" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateSesiKuliah()">Perbarui</button>
            </div>
        </div>
    </div>
</div>