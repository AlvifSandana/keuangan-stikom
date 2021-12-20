<!-- Modal Update Data Mahasiswa -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateMahasiswa" aria-labelledby="modalUpdateMahasiswa" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_mahasiswa" id="id_mahasiswa" disabled hidden>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" name="update_nim" id="update_nim" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_mahasiswa">NAMA MAHASISWA</label>
                    <input type="text" name="nama_mahasiswa" id="update_nama_mahasiswa" class="form-control">
                </div>
                <div class="form-group">
                    <label for="progdi_id">PROGRAM STUDI</label>
                    <select name="progdi_id" id="update_progdi_id" class="form-control">
                        
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="angkatan_id">ANGKATAN</label>
                    <select name="angkatan_id" id="update_angkatan_id" class="form-control">
                        
                    </select>
                </div>
                <button class="btn btn-warning float-right" onclick="updateMahasiswa()">Update</button>
            </div>
        </div>
    </div>
</div>