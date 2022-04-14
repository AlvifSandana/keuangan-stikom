<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateSesiKuliah" aria-labelledby="modalCreateSesiKuliah" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Sesi Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dp_nama_item">SESI KULIAH (ex: PAGI)</label>
                    <input type="text" name="nama_sesikuliah" id="create_nama_sesikuliah" class="form-control" required>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="createSesiKuliah()">Tambah</button>
            </div>
        </div>
    </div>
</div>