<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdatePaket" aria-labelledby="modalUpdatePaket" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" name="id_paket" id="update_id_paket" hidden disabled>
                <div class="form-group">
                    <label for="">NAMA PAKET SAAT INI</label>
                    <input type="text" name="nama_paket" id="current_nama_paket" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">NAMA PAKET</label>
                    <select class="form-control" name="nama_paket" id="update_nama_paket">
                        <?php foreach ($progdi as $p) {
                            echo '<option value="'.$p['nama_progdi'].'">'.$p['nama_progdi'].'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">SEMESTER</label>
                    <select class="form-control" name="semester_id" id="update_semester_id">
                        <?php foreach ($semester as $s) {
                            echo '<option value="'.$s['id_semester'].'">'.$s['nama_semester'].'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan_paket">KETERANGAN</label>
                    <textarea name="keterangan_paket" id="update_keterangan_paket" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updatePaket()">Perbarui</button>
            </div>
        </div>
    </div>
</div>