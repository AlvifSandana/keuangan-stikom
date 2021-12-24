<script>
    var num_format = Intl.NumberFormat();
    var item_tagihan_terbayar = [];
    var nama_paket = "";
    var global_data_tagihan;
    var global_tagihan = 0;
    var global_pembayaran = 0;

    /** 
     * Event onchange item tagihan pada modal tambah pembayaran.
     * Set semester_id
     */
    $('#add_item_kode').on('change', function() {
        // get option selected value
        var optSelected = $("option:selected", this);
        var valueSelected = this.value;
        var textSelected = $('#add_item_kode option:selected').text();
        // console.log(valueSelected);
        // array of item_tagihan
        var item_tagihan = <? echo json_encode($item_paket); ?>;
        // get semester_id from array
        var semester_id;
        item_tagihan.forEach(item => {
            console.log(item);
            if(item.kode_item == valueSelected) { semester_id = item.semester_id;}
        });
        // console.log(semester_id);
        $('#add_semester_id').val(semester_id);
        $('#add_nama_item').val(textSelected);
    });

    /**
     * create a new pembayaran
     */
    function createPembayaran() {
        $("#btn_tambah_pembayaran").prop('disabled', true);
        $("#btn_tambah_pembayaran").html(`<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`);
        var fbp = new FormData($('form#form_create_pembayaran')[0]);
        var mydata = {
            item_kode: $("#add_item_kode").val(),
            kode_unit: $("#add_kode_unit").val(),
            tanggal_transaksi: $("#add_tanggal_transaksi").val(),
            nominal_transaksi: $("#add_nominal_transaksi").val(),
            user_id: 1,
            is_dokumen_pembayaran: $('#is_fbp').val(),
            dokumen_pembayaran: fbp
        }
        $.ajax({
            url: "<?php echo base_url(); ?>/keuangan-mahasiswa/pembayaran/create",
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