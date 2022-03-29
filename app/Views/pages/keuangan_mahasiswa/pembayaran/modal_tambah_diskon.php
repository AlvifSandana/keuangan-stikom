<div class="modal fade bd-example-modal-lg" id="modalTambahDiskon" tabindex="-1" role="dialog" aria-labelledby="modalTambahDiskon" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Diskon Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="diskon_nim">NIM</label>
                    <input type="text" class="form-control" name="nim" id="diskon_nim" value="<?php echo $mahasiswa[0]['nim'] ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="diskon_nim">NAMA MAHASISWA</label>
                    <input type="text" class="form-control" name="nama_mhs" id="diskon_nama_mhs" value="<?php echo $mahasiswa[0]['nama_mhs'] ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="diskon_nim">PAKET</label>
                    <input type="text" class="form-control" name="paket" id="diskon_nama_paket" value="<?php echo $mahasiswa[0]['nama_paket'] ?>" disabled />
                </div>
                <div class="form-group">
                    <label for="diskon_nim">NAMA ITEM PAKET</label>
                    <select class="form-control custom-select" name="item_paket" id="diskon_item_paket" style="width: 100%;">
                        <option data-nominal="0" value=""></option>
                        <?
                            foreach ($item_paket as $key => $value) {
                                if(stripos($value['nama_item'], 'diskon') !== false){
                                    echo '<option value="'.$value['kode_item'].'-'.$value['id_semester'].'-'.$value['nominal_item'].'">'.$value['tahun_angkatan'].' - '.$value['nama_semester'].' - '.$value['nama_item'].' - Rp '.number_format($value['nominal_item']).'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_tagihan">TANGGAL</label>
                    <input type="datetime-local" class="form-control" name="tanggal_transaksi" id="diskon_tanggal_transaksi">
                </div>
                <button type="button" class="btn btn-success float-right" onclick="createDiskon()">Tambah Diskon</button>
            </div>
        </div>
    </div>
</div>