<!-- Modal Create new Data Mahasiswa -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalAddMahasiswa" aria-labelledby="modalAddMahasiswa" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_mahasiswa">NAMA MAHASISWA</label>
                    <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="angkatan_id">ANGKATAN</label>
                    <select name="angkatan_id" id="angkatan_id" class="form-control">
                        <?php foreach ($angkatan as $key => $value) {?>
                            <option value="<?= $value['tahun_angkatan'] ?>"><?= $value['tahun_angkatan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="jurusan_id">JURUSAN</label>
                    <select name="jurusan_id" id="jurusan_id" class="form-control">
                        <?php foreach ($jurusan as $key => $value) { ?>
                            <option value="<?= $value['id_jurusan'] ?>"><?= $value['nama_jurusan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="paket_tagihan">PAKET TAGIHAN</label><br>
                    <select class="form-control customselect" name="paket_tagihan" id="paket_tagihan" multiple="multiple" style="width: 100%;">
                        <?php foreach ($paket as $key => $value) { ?>
                            <option value="<?= $value['id_paket'] ?>"><?= $value['nama_paket'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="btn btn-success float-right" onclick="createMahasiswa()">Tambah</button>
            </div>
        </div>
    </div>
</div>
</div>