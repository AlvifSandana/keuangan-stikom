<div class="modal fade bd-example-modal-lg" id="modalEditPembayaran" tabindex="-1" role="dialog" aria-labelledby="modalEditPembayaran" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   Edit Pembayaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_transaksi">Kode Transaksi</label>
                    <input type="text" name="edit_id_transaksi" id="edit_id_transaksi" class="form-control" hidden>
                    <input type="text" name="edit_kode_transaksi" id="edit_kode_transaksi" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="text" name="edit_tanggal_transaksi" id="edit_tanggal_transaksi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="q_debit">Nominal</label>
                    <input type="number" name="edit_q_debit" id="edit_q_debit" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">Status: <span class="str-status"></span></div>
                    <div class="col-md-6">
                        <button class="btn btn-warning float-right" onclick="updatePembayaran()">Perbarui</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>