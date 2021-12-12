<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateSemester" aria-labelledby="modalUpdateSemester" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" name="id_semester" id="update_id_semester" hidden disabled>
                <div class="form-group">
                    <label for="dp_nama_item">SEMESTER</label>
                    <input type="text" name="nama_semester" id="update_nama_semester" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateSemester()">Perbarui</button>
            </div>
        </div>
    </div>
</div>