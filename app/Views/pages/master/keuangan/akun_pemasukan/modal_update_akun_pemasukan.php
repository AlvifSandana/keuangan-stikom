<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateAkunPemasukan" aria-labelledby="modalCreateAkunPemasukan" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Akun Pemasukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_akun">Kode Akun</label>
                    <input type="text" name="add_kode_akun" id="add_kode_akun" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_akun">Nama Akun</label>
                    <input type="text" name="add_nama_akun" id="add_nama_akun" class="form-control">
                </div>
                <button class="btn btn-success float-right" onclick="createAkun()">Tambah</button>
            </div>
        </div>
    </div>
</div>