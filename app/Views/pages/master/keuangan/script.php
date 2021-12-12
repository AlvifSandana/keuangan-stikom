<script>
    $('.custom-select').select2({
        width: 'resolve'
    });

    // get data on selected paket tagihan
    function getItemPaket() {
        $("#tbl_master_paket > tbody").empty();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/itempaket/" + $('select#select_paket').children('option:selected').val(),
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var response = data;
                if (response.status != "success") {
                    showSWAL('error', data.message);
                } else {
                    var row_item_tagihan = "";
                    var total_tagihan = 0;
                    var numformat = Intl.NumberFormat();
                    for (let index = 0; index < response.data.length; index++) {
                        row_item_tagihan += `<tr>
              <td>${response.data[index].nama_item}</td>
              <td class="text-left">Rp. ${numformat.format(parseInt(response.data[index].nominal_item))}</td>
              <td>${response.data[index].keterangan_item}</td>
              <td>
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditItemPaket" onclick="getItemPaketById(${response.data[index].id_item})"><i class="far fa-edit"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteItemPaket(${response.data[index].id_item})"><i class="fas fa-trash"></i></button>
              </td>
              </tr>`;
                        total_tagihan += parseInt(response.data[index].nominal_item);
                    }
                    Intl
                    $("#tbl_master_paket > tbody").append(row_item_tagihan);
                    $("#tbl_master_paket > tbody").append(`<tr class="font-weight-bold"><td colspan="3">Total Tagihan</td><td colspan="2">Rp. ${numformat.format(total_tagihan)}</td></tr>`);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
            }
        });
    }

    /** 
     * get paket
     */
    function getPaket() {
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/paket/all',
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                var paket = ``;
                for (let index = 0; index < data.data.paket.length; index++) {
                    paket += `<option value="${data.data.paket[index].id_paket}">${data.data.paket[index].nama_paket}</option>`;
                }
                $('#paket_id').append(paket);
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
            }
        });
    }
    getPaket();

    /** 
     * get item paket berdasarkan id_item
     */
    function getItemPaketById(id_item) {
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/itempaket/find/' + id_item,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    // clean input
                    $('#edit_id_item').val(0);
                    $('#edit_paket_id').val(0);
                    $('#edit_nama_item').val('');
                    $('#edit_nominal_item').val(0);
                    $('#edit_keterangan_item').val('data.data.keterangan_item');
                    // fill with data
                    $('#edit_id_item').val(data.data.id_item);
                    $('#edit_paket_id').val(data.data.paket_id);
                    $('#edit_nama_item').val(data.data.nama_item);
                    $('#edit_nominal_item').val(parseInt(data.data.nominal_item));
                    $('#edit_keterangan_item').val(data.data.keterangan_item);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
            }
        });
    }

    /** 
     * tambah paket tagihan
     */
    function addPaket() {
        var data_paket = {
            nama_paket: $('#add_nama_paket').val() + ' - ' + $('#add_semester_id option:selected').text(),
            keterangan_paket: $('#add_keterangan_paket').val(),
            semester_id: parseInt($('#add_semester_id').val()),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/paket/create',
            type: 'POST',
            data: data_paket,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    $('#add_nama_paket').val('');
                    $('#add_keterangan_paket').val('');
                    window.location.reload();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR)
            }
        });
    }

    /** 
     * tambah item paket
     */
    function addItemPaket() {
        var data_item = {
            paket_id: parseInt($('#paket_id').val()),
            nama_item: $('#nama_item').val(),
            nominal_item: parseInt($('#nominal_item').val()),
            keterangan_item: $('#keterangan_item').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/itempaket/create',
            type: 'POST',
            data: data_item,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    $("#tbl_master_paket > tbody").empty();
                    getItemPaket();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
            }
        });
    }

    /** 
     * hapus item paket
     */
    function deleteItemPaket(id_item) {
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
                    url: '<?php echo base_url(); ?>' + '/itempaket/delete/' + id_item,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            $("#tbl_master_paket > tbody").empty();
                            getItemPaket();
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
     * update item paket
     */
    function updateItemPaket() {
        var data_item = {
            id_item: parseInt($('#edit_id_item').val()),
            paket_id: parseInt($('#edit_paket_id').val()),
            nama_item: $('#edit_nama_item').val(),
            nominal_item: parseInt($('#edit_nominal_item').val()),
            keterangan_item: $('#edit_keterangan_item').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>' + '/itempaket/update/' + data_item.id_item,
            type: 'POST',
            data: data_item,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    $("#tbl_master_paket > tbody").empty();
                    getItemPaket();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
            }
        });
    }
</script>
