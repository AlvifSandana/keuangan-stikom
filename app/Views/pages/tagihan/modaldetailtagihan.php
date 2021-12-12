<div class="modal fade bd-example-modal-lg" id="modalDetailTagihan" tabindex="-1" role="dialog" aria-labelledby="modalDetailTagihan" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="detail_nim">NIM</label>
                    <input type="text" class="form-control" name="nim" id="detail_nim" disabled />
                </div>
                <div class="form-group">
                    <label for="detail_nim">NAMA MAHASISWA</label>
                    <input type="text" class="form-control" name="nama_mhs" id="detail_nama_mhs" disabled />
                </div>
                <div class="form-group">
                    <label for="detail_nim">PAKET</label>
                    <input type="text" class="form-control" name="paket" id="detail_nama_paket" disabled />
                </div>
                <div class="form-group">
                    <label for="detail_nim">NAMA ITEM PAKET</label>
                    <input type="text" class="form-control" name="paket" id="detail_nama_item_paket" disabled />
                </div>
                <label>DETAIL PEMBAYARAN</label>
                <table class="table table-hover table-bordered">
                    <thead class="text-center">
                        <th>Tanggal Pembayaran</th>
                        <th>Nominal Pembayaran</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody class="text-center" id="list_item_pembayaran"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>