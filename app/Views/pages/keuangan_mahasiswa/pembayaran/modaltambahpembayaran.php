<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreatePembayaran" aria-labelledby="modalCreatePembayaran" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>/pembayaran/create" method="post" id="form_create_pembayaran" enctype="multipart/form-data">
                    <input type="number" name="mahasiswa_id" id="add_mahasiswa_id" hidden>
                    <input type="number" name="user_id" id="add_user_id" value="1" hidden>
                    <div class="form-group">
                        <label for="itempembayaran">ITEM PAKET</label>
                        <select class="form-control" name="item_id" id="add_item_id">
                            <option value="">Pilih...</option>
                            <?
                            if ($item_paket) {
                                foreach ($item_paket as $key => $value) {
                                    echo '<option value="'.$value['id_item'].'">'.$value['nama_semester'].' - '.$value['nama_item'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembayaran">TANGGAL PEMBAYARAN</label>
                        <input type="datetime-local" class="form-control" name="tanggal_pembayaran" id="add_tanggal_pembayaran">
                    </div>
                    <div class="form-group">
                        <label for="">NOMINAL PEMBAYARAN</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp. </span>
                            </div>
                            <input type="number" class="form-control" name="nominal_pembayaran" id="add_nominal_pembayaran" aria-label="NOMINAL PEMBAYARAN">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_dokumen_pembayaran" id="is_fbp">
                            <label class="" for="">DOKUMEN PEMBAYARAN</label>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fbp" name="dokumen_pembayaran" disabled>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <p id="message"></p>
                    <button type="submit" class="btn btn-success float-right" id="btn_tambah_pembayaran" style="width: 200px;">Tambah Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>