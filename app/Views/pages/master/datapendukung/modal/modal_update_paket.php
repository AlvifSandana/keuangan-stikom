<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdatePaket" aria-labelledby="modalUpdatePaket" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Paket Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_paket">Nama Paket</label>
                    <input type="text" name="update_nama_paket" id="update_nama_paket" class="form-control">
                    <input type="text" name="update_id_paket" id="update_id_paket" class="form-control" hidden>
                </div>
                <div class="form-group">
                    <label for="semester">Jurusan</label>
                    <select name="update_jurusan_id" id="update_jurusan_id" class="form-control">
                        <?php foreach ($jurusan as $key => $value) {?>
                            <option value="<?php echo $value['id_jurusan'];?>"><?php echo $value['nama_program'].' '.$value['nama_jurusan'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <!--<div class="form-group">
                    <label for="semester">Angkatan</label>
                    <select name="update_angkatanp_id" id="update_angkatanp_id" class="form-control">
                        <?php foreach ($angkatan as $key => $value) {?>
                            <option value="<?php echo $value['id_angkatan'];?>"><?php echo $value['tahun_angkatan'];?></option>
                        <?php } ?>
                    </select>
                </div>-->
                <div class="form-group">
                    <label for="semester">Sesi Perkuliahan</label>
                    <select name="update_sesi_id" id="update_sesi_id" class="form-control">
                        <?php foreach ($sesi_kuliah as $key => $value) { ?>
                            <option value="<?php echo $value['id_sesi'];?>"><?php echo $value['nama_sesi'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Jalur Pendaftaran</label>
                    <select name="update_jalur_id" id="update_jalur_id" class="form-control">
                        <?php foreach ($jalur as $key => $value) { ?>
                            <option value="<?php echo $value['id_jalur'];?>"><?php echo $value['nama_jalur'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester">Master Formula (untuk pembayaran VA)</label>
                    <select name="add_mf_id" id="add_mf_id" class="form-control">
                        <?php foreach ($mf as $key => $value) { ?>
                            <option value="<?= $value['kode_mformula'];?>"><?= $value['kode_mformula']." | ".$value['persentase_tw']."% - ".$value['persentase_tb']."%"?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan_paket">Keterangan Paket</label>
                    <textarea name="update_keterangan_paket" id="update_keterangan_paket" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <button class="btn btn-warning float-right" onclick="updatePaket()">Update</button>
            </div>
        </div>
    </div>
</div>