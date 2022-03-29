<div class="modal fade bd-example-modal-lg" id="modalDetailKeuangan" tabindex="-1" role="dialog" aria-labelledby="modalDetailKeuangan" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Detail Keuangan <?= $mahasiswa[0]['nama_mhs'] ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col">
                        <table class="table table-hover table-bordered tbl-detail-keuangan-semester">
                            <thead class="text-center">
                                <th>No.</th>
                                <th>Semester</th>
                                <th class="text-danger">Total Tagihan (Rp)</th>
                                <th class="text-success">Total Pembayaran (Rp)</th>
                                <th>Sisa Tagihan (Rp)</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>