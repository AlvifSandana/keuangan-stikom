<script>
    var num_format = Intl.NumberFormat();
    var item_tagihan_terbayar = [];
    var nama_paket = "";
    var global_data_tagihan;
    var global_tagihan = 0;
    var global_pembayaran = 0;

    /**
     * create a new pembayaran
     */
    function createPembayaran() {
        $("#btn_tambah_pembayaran").prop('disabled', true);
        $("#btn_tambah_pembayaran").html(`<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        var fbp = new FormData($('form#form_create_pembayaran')[0]);
        var mydata = {
            item_id: $("#add_item_id").val(),
            paket_id: $("#add_paket_id").val(),
            mahasiswa_id: $("#add_mahasiswa_id").val(),
            tanggal_pembayaran: $("#add_tanggal_pembayaran").val(),
            nominal_pembayaran: $("#add_nominal_pembayaran").val(),
            user_id: 1,
            is_dokumen_pembayaran: $('#is_fbp').val(),
            dokumen_pembayaran: fbp
        }
        $.ajax({
            url: "<?php echo base_url(); ?>/pembayaran/create",
            type: "POST",
            contentType: false,
            // processData: false,
            data: mydata, //$('form#form_create_pembayaran').serialize(),
            dataType: 'JSON',
            success: function(res) {
                var response = res;
                $("#btn_tambah_pembayaran").prop('disabled', false);
                $("#btn_tambah_pembayaran").html('Tambah Pembayaran');
                showSWAL(response.status, response.message);
                searchPembayaran();
            },
            error: function(jqXHR) {
                console.log(jqXHR)
                $("#btn_tambah_pembayaran").prop('disabled', false);
                $("#btn_tambah_pembayaran").html('Tambah Pembayaran');
                showSWAL('error', jqXHR);
            }
        });
    }

    /**
     * delete pembayaran by id
     */
    function deletePembayaran(id_pembayaran) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/pembayaran/delete/' + id_pembayaran,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            // searchPembayaran();
                        }
                    },
                    error: function(jqXHR) {
                        showSWAL('error', jqXHR);
                    }
                });
            }
        });
    }
</script>