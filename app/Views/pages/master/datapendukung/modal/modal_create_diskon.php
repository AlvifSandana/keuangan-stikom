<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateDiskon" aria-labelledby="modalCreateDiskon" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="angkatan_id">TAHUN ANGKATAN</label>
                    <select name="angkatan_id" id="angkatan_id" class="form-control custom-select" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($angkatan as $key => $value) {
                            echo '<option value="' . $value['id_angkatan'] . '">' . $value['tahun_angkatan'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester_id">SEMESTER</label>
                    <select name="semester_id" id="semester_id" class="form-control custom-select" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($semester as $key => $value) {
                            echo '<option value="' . $value['id_semester'] . '">' . $value['nama_semester'] . '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">NAMA ITEM</label>
                    <input type="text" name="nama_item" id="nama_item" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nominal_item">NOMINAL</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp. </span>
                        </div>
                        <input type="number" class="form-control" name="nominal_item" id="nominal_item" aria-label="NOMINAL ITEM">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="keterangan_item">KETERANGAN</label>
                    <textarea class="form-control" name="keterangan_item" id="keterangan_item" cols="30" rows="4"></textarea>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="createDiskon()">Tambah</button>
            </div>
        </div>
    </div>
</div>