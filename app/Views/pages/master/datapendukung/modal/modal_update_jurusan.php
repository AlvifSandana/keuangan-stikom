<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateJurusan" aria-labelledby="modalUpdateProgdi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_jurusan" id="update_id_jurusan" hidden disabled>
                <div class="form-group">
                    <label for="nama_progdi">JURUSAN</label>
                    <input type="text" name="nama_jurusan" id="update_nama_jurusan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama_progdi">PROGRAM</label>
                    <input type="text" name="nama_program" id="update_nama_program" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateJurusan()">Perbarui</button>
            </div>
        </div>
    </div>
</div>