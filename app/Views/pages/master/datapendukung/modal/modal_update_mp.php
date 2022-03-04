<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateMetodePembayaran" aria-labelledby="modalUpdateMetodePembayaran" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbarui Metode Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_mp" id="update_id_mp" hidden>
                <div class="form-group">
                    <label for="nama_mp">Nama Metode Pembayaran</label>
                    <input type="text" name="nama_mp" id="update_nama_mp" class="form-control" required>
                </div>
                <button class="btn btn-warning float-right mb-4" onclick="updateMP()">Perbarui</button>
            </div>
        </div>
    </div>
</div>