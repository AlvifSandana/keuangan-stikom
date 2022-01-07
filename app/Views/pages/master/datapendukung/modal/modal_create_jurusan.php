<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateJurusan" aria-labelledby="modalCreateJurusan" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dp_nama_item">NAMA JURUSAN (min. 2 suku kata)</label>
                    <input type="text" name="nama_jurusan" id="create_nama_jurusan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">NAMA PROGRAM (ex: S1)</label>
                    <input type="text" name="nama_program" id="create_nama_program" class="form-control" required>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="createJurusan()">Tambah</button>
            </div>
        </div>
    </div>
</div>