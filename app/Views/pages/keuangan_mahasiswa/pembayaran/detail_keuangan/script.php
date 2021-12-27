<script>
    var num_format = Intl.NumberFormat();
    var item_tagihan_terbayar = [];
    var nama_paket = "";
    var global_data_tagihan;
    var global_tagihan = 0;
    var global_pembayaran = 0;

    // remove empty card detail keuangan
    $(document).ready(function() {
        var tbl = $('.tagihan > tbody')
        for (let i = 0; i < tbl.length; i++) {
            if (tbl[i].childElementCount == 1) {
                $(`.card .${tbl[i].className}`).remove();
            }
        }
    });

    // select2
    $('.custom-select').select2({
        width: 'resolve',
    });
    $('#tagihan_item_paket').select2({
        width: 'resolve',
        tags: true,
        dropdownParent: $("#modalTambahTagihan")
    });


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
            if (item.kode_item == valueSelected) {
                semester_id = item.semester_id;
            }
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

    /** 
     * Create new tagihan
     */
    function createTagihan() {
        var kode = ($('#tagihan_item_paket').val()).split('-');
        var data_tagihan = {
            kode_unit: $('#tagihan_nim').val(),
            item_kode: kode[0],
            q_kredit: kode[2],
            tanggal_transaksi: $('#tagihan_tanggal_transaksi').val(),
            semester_id: kode[1],
        };
        console.log(data_tagihan);
        $.ajax({
            url: '<? echo base_url(); ?>/keuangan-mahasiswa/tagihan/create',
            type: 'POST',
            data: data_tagihan,
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
                showSWAL('error', jqXHR.response);
                console.log(jqXHR);
            }
        });
    }

    /** 
     * Get detail pembayaran per item
     */
    function getDetailPembayaranItem(nama_item, nominal_tagihan, kode_unit, item_kode) {
        // set valur from params
        $('#dp_nama_item').val(nama_item);
        $('#dp_nominal_tagihan').val('Rp ' + num_format.format(nominal_tagihan));
        // get data from api
        $.ajax({
            url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran/detail-pembayaran-item/' + kode_unit + '/' + item_kode,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    // total pembayaran
                    var total_pembayaran = 0;
                    var sisa_tagihan = 0;
                    // clear tbody
                    $('#tbl_detail_pembayaran_per_item tbody').empty();
                    if (data.data.length > 0) {
                        data.data.forEach(element => {
                            var tr = `
                            <tr>
                                <td>${element.kode_transaksi}</td>
                                <td>${element.tanggal_transaksi}</td>
                                <td class="text-left">Rp ${num_format.format(element.q_debit)}</td>
                                <td></td>
                            </tr>`
                            $('#tbl_detail_pembayaran_per_item tbody').append(tr);
                            total_pembayaran += parseInt(element.q_debit);
                        });
                        sisa_tagihan = parseInt(nominal_tagihan) - total_pembayaran
                        $('#dp_nominal_pembayaran').val('Rp ' + num_format.format(total_pembayaran))
                        $('#dp_sisa_tagihan').val('Rp ' + num_format.format(sisa_tagihan))
                    } else {
                        $('#tbl_detail_pembayaran_per_item tbody').empty();
                        $('#dp_nominal_pembayaran').val('Rp ' + num_format.format(total_pembayaran))
                        $('#dp_sisa_tagihan').val('Rp ' + num_format.format(nominal_tagihan))
                        $('#tbl_detail_pembayaran_per_item tbody').append('<tr><td colspan="4" class="text-center text-primary">Belum ada pembayaran untuk item tagihan ini.</td></tr>')
                    }
                } else {
                    showSWAL('error', data.message);
                    $('#tbl_detail_pembayaran_per_item tbody').empty();
                    $('#tbl_detail_pembayaran_per_item tbody').append('<tr><td colspan="4" class="text-center text-primary">Belum ada pembayaran untuk item tagihan ini.</td></tr>')
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        })
    }
</script>