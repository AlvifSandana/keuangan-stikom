<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalCreateUser" aria-labelledby="modalCreateUser" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dp_nama_item">NAMA</label>
                    <input type="text" name="nama" id="create_nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">USERNAME</label>
                    <input type="text" name="username" id="create_username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">EMAIL</label>
                    <input type="text" name="email" id="create_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">PASSWORD</label>
                    <input type="text" name="password" id="create_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">CONFIRM PASSWORD</label>
                    <input type="text" name="confirm_password" id="create_confirm_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dp_nama_item">ACCESS LEVEL</label>
                    <select class="form-control" name="user_level" id="create_user_level">
                        <option value="admin">ADMIN</option>
                        <option value="demo">DEMO</option>
                        <option value="read">READ</option>
                    </select>
                </div>
                <button class="btn btn-success float-right mb-4" onclick="createUser()">Create</button>
            </div>
        </div>
    </div>
</div>