<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateAngkatan" aria-labelledby="modalUpdateAngkatan" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Tahun Angkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" name="id_angkatan" id="update_id_angkatan" hidden disabled>
                <div class="form-group">
                    <label for="nama_angkatan">TAHUN ANGKATAN</label>
                    <input type="text" name="nama_angkatan" id="update_nama_angkatan" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateAngkatan()">Perbarui</button>
            </div>
        </div>
    </div>
</div>