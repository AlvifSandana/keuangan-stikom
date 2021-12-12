<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreatePaket" aria-labelledby="modalCreatePaket" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Paket Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_paket">NAMA PAKET</label>
                    <select class="form-control" name="nama_paket" id="create_nama_paket">
                        <?php 
                        foreach ($progdi as $p ) {
                            echo '<option value="' . $p['nama_progdi'] . '">' . $p['nama_progdi'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">SEMESTER</label>
                    <select name="semester_id" id="create_semester_id" class="form-control">
                        <?php
                        foreach ($semester as $s) {
                            echo '<option value="' . $s['id_semester'] . '">' . $s['nama_semester'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan_paket">KETERANGAN</label>
                    <textarea name="keterangan_paket" id="create_keterangan_paket" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <button class="btn btn-success float-right" onclick="createPaket()">Tambah</button>
            </div>
        </div>
    </div>
</div>