<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateProgdi" aria-labelledby="modalUpdateProgdi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Program Studi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" name="id_progdi" id="update_id_progdi" hidden disabled>
                <div class="form-group">
                    <label for="nama_progdi">PROGRAM STUDI</label>
                    <input type="text" name="nama_progdi" id="update_nama_progdi" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateProgdi()">Perbarui</button>
            </div>
        </div>
    </div>
</div>