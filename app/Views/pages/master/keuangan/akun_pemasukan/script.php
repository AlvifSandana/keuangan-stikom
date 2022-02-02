<script>
    // DataTable
    $('.tbl_master_akun_pemasukan').DataTable();

    /** 
     * get akun pemasukan by id
     */
    function getAkunById(id_akun){
        $.ajax({
            url: '<?= base_url() ?>/master-keuangan/akun-pemasukan/find/' + id_akun,
            method: 'GET',
            dataType: 'JSON',
            success: function(data){
                if (data.status == 'success') {
                    $('update_id_akun').val(data.data).id_akun;
                    $('update_kode_akun').val(data.data).kode_akun;
                    $('update_nama_akun').val(data.data.nama_akun);
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR){
                console.log(jqXHR);
                showSWAL('error', jqXHR.responseText);
            }
        });
    }

    /** 
     * create new akun pemasukan
     */
    function createAkun() {
        // get data from modal field
        var create_data = {
            kode_akun: $('create_kode_akun').val(),
            nama_akun: $('create_nama_akun').val(),
        }
        // send with ajax
        $.ajax({
            url: '<?= base_url() ?>/master-keuangan/akun-pemasukan/create',
            method: 'POST',
            data: create_data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
                showSWAL('error', jqXHR.responseText)
            }
        });
    }

    /** 
     * update akun pemasukan by id
     */
    function updateAkun() {
        // get data from modal field
        var update_data = {
            id_akun: $('update_id_akun').val(),
            kode_akun: $('update_kode_akun').val(),
            nama_akun: $('update_nama_akun').val(),
        }
        // send with ajax
        $.ajax({
            url: '<?= base_url() ?>/master-keuangan/akun-pemasukan/update',
            method: 'POST',
            data: update_data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
                showSWAL('error', jqXHR.responseText)
            }
        });
    }

    /** 
     * delete akun pemasukan by id
     */
    function deleteAkun(id_akun) {
        $.ajax({
            url: '<?= base_url() ?>/master-keuangan/akun-pemasukan/delete/' + id_akun,
            method: 'DELETE',
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    showSWAL('success', data.message);
                    setTimeout(function() {
                        window.location.reload();
                    });
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
                showSWAL('error', jqXHR.responseText)
            }
        });
    }
</script>