<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateSemester" aria-labelledby="modalCreateSemester" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dp_nama_item">SEMESTER</label>
                    <input type="text" name="nama_semester" id="create_nama_semester" class="form-control" required>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="createSemester()">Tambah</button>
            </div>
        </div>
    </div>
</div>