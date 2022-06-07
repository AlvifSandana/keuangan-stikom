<?= $this->extend('layout/master') ?>

<?= $this->section('content-header') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Account Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Account Settings</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="content">
    <div class="container-fluid">
        <?= $this->include('layout/flash') ?>
        <?php if (session()->get('user_level') == 'admin') { ?>
            <div class="row mb-2">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="h4">Create New User</h4>
                            <p>Membuat data user baru dengan atribut <b>Nama</b>, <b>Username</b>, <b>Email</b>, dan <b>Password</b> <br>
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCreateUser"><i class="fas fa-user-plus"></i> Create</button>
                                dengan mengklik tombol <b class="text-primary">Create</b> berikut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="h4">Update User Details</h4>
                        <p>Perbarui data user saat ini (signed in) seperti <b>Nama</b>, <b>Username</b>, <b>Email</b>, dan <b>Password</b> <br>
                            <button class="btn btn-warning float-right" data-toggle="modal" data-target="#modalUpdateUser"><i class="fas fa-sync-alt"></i> Update</button>
                            dengan mengklik tombol <b class="text-warning">Update</b> berikut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php if (session()->get('user_level') == 'admin') { ?>
            <div class="row mb-2">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="h4 mb-3">List of Users</h4>
                            <div class="table-responsive">
                                <table class="table table-hover" id="tbl_user">
                                    <thead class="text-center">
                                        <th class="text-center">#</th>
                                        <th class="text-center">USERNAME</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">LEVEL</th>
                                        <th class="text-center">ACTION</th>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach ($users as $u) {
                                            echo '<tr>
                                        <td>' . $u['id_user'] . '</td>
                                        <td>' . $u['username'] . '</td>
                                        <td>' . $u['email'] . '</td>
                                        <td>' . $u['user_level'] . '</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="deleteUser(' . $u['id_user'] . ')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>';
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- Modals -->
<?php if (session()->get('user_level') == 'admin') { ?>
    <?= $this->include('pages/settings/account/modal/modal_create_user') ?>
<?php } ?>
<?= $this->include('pages/settings/account/modal/modal_update_current_user') ?>
<!-- /Modals -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<?= $this->include('pages/settings/account/script') ?>
<?= $this->endSection() ?>