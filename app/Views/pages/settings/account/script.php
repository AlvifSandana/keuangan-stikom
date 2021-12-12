<script>
    $('table').DataTable();

    function createUser() {
        try {
            var validate_password = passwordValidation('create');
            if (validate_password) {
                // get data
                var data = {
                    id_user: $('#id_user').val(),
                    nama: $('#create_nama').val(),
                    username: $('#create_username').val(),
                    email: $('#create_email').val(),
                    password: $('#create_password').val(),
                    user_level: $('#create_user_level').val(),
                };
                $.ajax({
                    url: '<?php echo base_url(); ?>/settings-account/create',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function(data){
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
                        }
                    },
                    error: function(jqXHR){
                        showSWAL('error', jqXHR);
                    }
                });
            } else {
                showSWAL('error', 'Validasi password gagal! Password tidak cocok!');
            }
        } catch (error) {
            showSWAL('error', error);
        }
    }

    function updateUser() {
        try {
            var validate_password = passwordValidation('update');
            if (validate_password) {
                // get data
                var update_data = {
                    id_user: $('#id_user').val(),
                    nama: $('#update_nama').val(),
                    username: $('#update_username').val(),
                    email: $('#update_email').val(),
                    current_password: $('#update_current_password').val(),
                    new_password: $('#update_password').val(),
                    user_level: $('#update_user_level').val(),
                };
                $.ajax({
                    url: '<?php echo base_url(); ?>/settings-account/update/' + update_data.id_user,
                    type: 'POST',
                    data: update_data,
                    dataType: 'JSON',
                    success: function(data){
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
                        }
                    },
                    error: function(jqXHR){
                        showSWAL('error', jqXHR);
                    }
                });
            } else {
                showSWAL('error', 'Validasi password gagal! Password tidak cocok!');
            }
        } catch (error) {
            showSWAL('error', error);
        }
    }

    function deleteUser(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus user ini?',
            text: "Pastikan tidak ada rekam pembayaran yang dilayani oleh user ini. Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/settings-account/delete/' + id,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000)
                        }
                    },
                    error: function(jqXHR) {
                        showSWAL('error', jqXHR);
                    }
                });
            }
        });
    }


    function passwordValidation(type) {
        switch (type) {
            case 'create':
                var password = $('#create_password').val();
                var confirm_password = $('#create_confirm_password').val();
                if (password === confirm_password) {
                    return true;
                } else {
                    return false;
                }
                break;

            case 'update':
                var password = $('#update_password').val();
                var confirm_password = $('#update_confirm_password').val();
                if (password === confirm_password) {
                    return true;
                } else {
                    return false;
                }
                break;

            default:
                break;
        }
    }
</script>
