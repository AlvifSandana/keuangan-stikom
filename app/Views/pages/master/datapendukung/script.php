<script>
    // enable datatable
    $('table').DataTable();


    function createAngkatan() {
        var data = {
            tahun_angkatan: $('#create_nama_angkatan').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/create/angkatan',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    function createJurusan() {
        var data = {
            nama_jurusan: $('#create_nama_jurusan').val(),
            nama_program: $('#create_nama_program').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/create/jurusan',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    function createSemester() {
        var data = {
            nama_semester: $('#create_nama_semester').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/create/semester',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    /** 
     * tambah paket tagihan
     */
    function createPaket() {
        var data_paket = {
            nama_paket: $('#add_nama_paket').val(),
            keterangan_paket: $('#add_keterangan_paket').val(),
            jurusan_id: $('#add_jurusan_id').val(),
            sesi_id: $('#add_sesi_id').val(),
            jalur_id: $('#add_jalur_id').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-keuangan/paket/create',
            type: 'POST',
            data: data_paket,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data.data);
                } else {
                    showSWAL('success', data.message);
                    $('#add_nama_paket').val('');
                    $('#add_keterangan_paket').val('');
                    window.location.reload();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR)
            }
        });
    }

    function updateAngkatan() {
        var data = {
            tahun_angkatan: $('#update_nama_angkatan').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/update/angkatan/' + $('#update_id_angkatan').val(),
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {

            }
        });
    }

    function updateJurusan() {
        var data = {
            nama_jurusan: $('#update_nama_jurusan').val(),
            nama_program: $('#update_nama_program').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/update/jurusan/' + $('#update_id_jurusan').val(),
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {

            }
        });
    }

    function updateSemester() {
        var data = {
            nama_semester: $('#update_nama_semester').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/update/semester/' + $('#update_id_semester').val(),
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(jqXHR) {

            }
        });
    }

    function updatePaket() {
        var data_paket = {
            id_paket: $('#update_id_paket').val(),
            nama_paket: $('#update_nama_paket').val(),
            keterangan_paket: $('#update_keterangan_paket').val(),
            jurusan_id: $('#update_jurusan_id').val(),
            sesi_id: $('#update_sesi_id').val(),
            jalur_id: $('#update_jalur_id').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-keuangan/paket/update',
            type: 'POST',
            data: data_paket,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data.data);
                } else {
                    showSWAL('success', data.message);
                    window.location.reload();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR)
            }
        });
    }

    function deleteAngkatan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus item ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/master-pendukung/delete/angkatan/' + id,
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

    function deleteJurusan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus item ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/master-pendukung/delete/jurusan/' + id,
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

    function deleteSemester(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus item ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/master-pendukung/delete/semester/' + id,
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

    function deletePaket(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus item ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/master-keuangan/paket/delete/' + id,
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

    function fillUpdateField(id, value, type, another_val = '') {
        switch (type) {
            case "angkatan":
                $('#update_id_angkatan').val(id);
                $('#update_nama_angkatan').val(value);
                break;

            case "jurusan":
                $('#update_id_jurusan').val(id);
                $('#update_nama_jurusan').val(value);
                $('#update_nama_program').val(another_val);
                break;

            case "semester":
                $('#update_id_semester').val(id);
                $('#update_nama_semester').val(value);
                break;

            case "paket":
                $('#update_id_paket').val(id);
                $('#update_nama_paket').val(value);
                break;
        }
    }

    function fillUpdatePaketField(id, nama_paket, jurusan_id, jalur_id, sesi_id, keterangan_paket) {
        $('#update_id_paket').val(id);
        $('#update_nama_paket').val(nama_paket);
        $('#update_jurusan_id').val(jurusan_id);
        $('#update_sesi_id').val(sesi_id);
        $('#update_jalur_id').val(jalur_id);
        $('#update_keterangan_paket').val(keterangan_paket);
    }
</script>