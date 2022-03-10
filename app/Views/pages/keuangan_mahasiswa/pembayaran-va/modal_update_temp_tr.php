<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateTempTransaksi" aria-labelledby="modalUpdateTempTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <input type="text" name="id_temp_transaksi" id="id_temp_transaksi" class="form-control" hidden>
                    </div>
                    <div class="form-group">
                        <label for="q_debit">Nominal</label>
                        <input type="number" name="q_debit" id="q_debit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
                    </div>
                    <button class="btn btn-warning float-right" onclick="updateTempVA()">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
</div>