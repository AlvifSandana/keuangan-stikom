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

            }
        });
    }

    function createPaket() {
        var data = {
            nama_paket: $('#create_nama_paket').val() + ' - ' + $('#create_semester_id option:selected').text(),
            semester_id: $('#create_semester_id').val(),
            keterangan_paket: $('#create_keterangan_paket').val()
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/create/paket',
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
        var data = {
            nama_paket: $('#update_nama_paket').val() + ' - ' + $('#update_semester_id option:selected').text(),
            keterangan_paket: $('#update_keterangan_paket').val(),
            semester_id: $('#update_semester_id').val()
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/master-pendukung/update/paket/' + $('#update_id_paket').val(),
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
                    url: '<?php echo base_url(); ?>' + '/master-pendukung/delete/paket/' + id,
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

    function fillUpdatePaketField(id, nama_paket, semester_id, keterangan_paket) {
        $('#update_id_paket').val(id);
        $('#current_nama_paket').val(nama_paket);
        $('#update_semester_id').val(semester_id);
        $('#update_keterangan_paket').val(keterangan_paket);
    }
</script>