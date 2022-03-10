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

    // get detail of master formula
    function getDetailSelectedMasterFormula(id_mformula) {
        try {
            $.ajax({
                url: ''
            });
        } catch (err) {

        }
    }

    // fill update filed
    function fillUpdateField(id_temp_transaksi, q_debit, tanggal_transaksi){
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
                url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/update/'+$('#id_temp_transaksi').val(),
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
</script>