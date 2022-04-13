<script>
    // DataTable
    $('.tbl-temp-transaksi').DataTable();

    // select2
    $('#formula').select2({
        width: 'resolve',
    });

    // show upload filename
    $('#file_va').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });

    // get data from semester checkbox
    function getDataFromCheckBox() {
        let cbs = document.querySelectorAll('input[name="semester"]:checked');
        let val = [];
        cbs.forEach((cb) => {
            val.push(cb.value);
        });
        return val;
    }

    function getDataTempTransaksi(){
        $.ajax({
            url: '<?= base_url()?>/keuangan-mahasiswa/pembayaran-va/get-data',
            method: 'GET',
            dataType: 'JSON',
            success: function(data){
                if(data.status != 'success'){
                    
                } else {
                    // response data
                    $d = data.data;
                    // table
                    var tbl = $('#tbl_master_paket').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    // iterate data
                    for (let i = 0; i < d.length; i++) {
                        // create new row
                        tbl.row.add([]);
                    }
                }
            },
            error: function(jqXHR){
                showSWAL('error', jqXHR.responseText());
            }
        });
    }

    // acc temp transaksi
    function acc_temp_tr(id_temp_tr, nim, q_debit) {
        // get data
        var data = {
            id_tmp_tr: id_temp_tr,
            id_mf: $('#mformula').val(),
            nim: nim,
            q_debit: q_debit,
            smts: getDataFromCheckBox()
        };
        console.log(data);
        // ajax req
        $.ajax({
            url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/acc',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    setTimeout(function() {
                        showSWAL('success', data.message);
                    }, 2500);
                } else {
                    showSWAL('error', data.message);
                    $('input[name="semester"]:checked').prop("checked", false);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.responseText);
                console.log(jqXHR.responseText);
                $('input[name="semester"]:checked').prop("checked", false);
            }
        });
    }

    // fill update filed
    function fillUpdateField(id_temp_transaksi, q_debit, tanggal_transaksi) {
        // var tgl = tanggal_transaksi.split(' ');
        // var tgl_split = tgl[0].split('-');
        // var swap_d_m = `${tgl_split[0]}-${tgl_split[2]}-${tgl_split[1]}T${tgl[1]}`;
        $('#id_temp_transaksi').val(id_temp_transaksi);
        $('#q_debit').val(q_debit);
        $('#tanggal_transaksi').val(tanggal_transaksi.replace(' ', 'T'));
    }

    // update temp va
    function updateTempVA() {
        try {
            var update_data = {
                q_debit: $('#q_debit').val(),
                tanggal_transaksi: $('#tanggal_transaksi').val(),
            };
            $.ajax({
                url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/update/' + $('#id_temp_transaksi').val(),
                type: 'POST',
                data: update_data,
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        showSWAL('success', data.message);
                    } else {
                        showSWAL('error', data.message);
                    }
                },
                error: function(jqXHR) {
                    showSWAL('error', jqXHR.responseText);
                }
            })
        } catch (error) {

        }
    }

    /** 
     * delete akun pengeluaran by id
     */
    function deleteTempVA(id_temp_transaksi) {
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
                    url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/delete/' + id_temp_transaksi,
                    method: 'DELETE',
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
        });
    }

    /** 
     * delete akun pengeluaran (reset)
     */
    function resetTempVA() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin reset DATA TRANSAKSI SEMENTARA?',
            text: "Semua data transaksi sementara akan dihapus. Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/reset-tbl',
                    method: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 'success') {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2500);
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
        });
    }
</script>