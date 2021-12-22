<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalAddPaket" aria-labelledby="modalAddPaket" aria-hidden="true">
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
                    <select class="form-control" name="add_nama_paket" id="add_nama_paket">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">SEMESTER</label>
                    <select name="add_semester_id" id="add_semester_id" class="form-control">
                        
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan_paket">KETERANGAN</label>
                    <textarea name="add_keterangan_paket" id="add_keterangan_paket" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <button class="btn btn-success float-right" onclick="addPaket()">Tambah</button>
            </div>
        </div>
    </div>
</div>