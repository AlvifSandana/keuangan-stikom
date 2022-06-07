<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalUpdateUser" aria-labelledby="modalUpdateUser" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dp_nama_item">NAMA</label>
                    <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo session('id_user'); ?>" hidden disabled>
                    <input type="text" name="nama" id="update_nama" class="form-control" value="<?php echo session('nama'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">USERNAME</label>
                    <input type="text" name="username" id="update_username" class="form-control" value="<?php echo session('username'); ?>"required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">EMAIL</label>
                    <input type="text" name="email" id="update_email" class="form-control" value="<?php echo session('email'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">CURRENT PASSWORD</label>
                    <input type="password" name="current_password" id="update_current_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">NEW PASSWORD</label>
                    <input type="text" name="password" id="update_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">CONFIRM PASSWORD</label>
                    <input type="text" name="confirm_password" id="update_confirm_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">ACCESS LEVEL</label>
                    <select class="form-control" name="user_level" id="update_user_level" <?php if(session('user_level') == 'demo'){echo 'disabled';}else{echo '';}?>>
                        <?php if(session('user_level') === 'admin') {?>
                        <option value="admin" <?= session('user_level') == 'admin' ? 'selected' :''?>>ADMINISTRATOR</option>
                        <?php }?>
                        <option value="demo" <?= session('user_level') == 'demo' ? 'selected' :''?>>DEMO</option>
                        <option value="read" <?= session('user_level') == 'read' ? 'selected' :''?>>READ</option>
                        <?php if(session('user_level') === 'admin') {?>
                        <option value="readwrite" <?= session('user_level') == 'readwrite' ? 'selected' :''?>>READ/WRITE</option>
                        <?php }?>
                    </select>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="updateUser()">Update</button>
            </div>
        </div>
    </div>
</div>