<script>
    $(document).ready(function() {
        getItemPaketLain();
    })
    // DataTable
    $('table').DataTable({
        'columnDefs': [{
            className: "text-center",
            "targets": [0, 2, 3, 5, 6]
        }],
    });

    // select2
    $('.custom-select').select2({
        width: 'resolve',
    });
    $('#paket_id').select2({
        width: 'resolve',
        tags: true,
        dropdownParent: $("#modalAddItemPaket")
    });
    $('#angkatan_id').select2({
        width: 'resolve',
        tags: true,
        dropdownParent: $("#modalAddItemPaket")
    });
    $('#semester_id').select2({
        width: 'resolve',
        tags: true,
        dropdownParent: $("#modalAddItemPaket")
    });

    // get data on selected paket tagihan
    function getItemPaket() {
        $("#tbl_master_paket > tbody").empty();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/master-keuangan/itempaket/" + $('select#select_paket').children('option:selected').val(),
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var itempaket = data.data;
                if (data.status != "success") {
                    showSWAL('error', data.message);
                } else {
                    // total nominal item paket tagihan
                    var total_tagihan = 0;
                    // create number formatter
                    var numformat = Intl.NumberFormat();
                    // table
                    var tbl = $('#tbl_master_paket').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    // iterate data
                    itempaket.forEach(element => {
                        // create new row data
                        tbl.row.add([element.kode_item, element.nama_item, element.tahun_angkatan, element.nama_semester, "Rp " + numformat.format(element.nominal_item), element.keterangan_item, generateActionButton(element.id_item, element.kode_item)]).draw(false);
                        // add total tagihan
                        total_tagihan += parseInt(element.nominal_item);
                    });
                    // show total tagihan
                    $("#tbl_master_paket > tbody").append(`<tr class="font-weight-bold text-center"><td colspan="3">Total Tagihan</td><td colspan="2">Rp. ${numformat.format(total_tagihan)}</td></tr>`);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.statusText);
            }
        });
    }

    /** 
     * generate Action Button
     */
    function generateActionButton(id_item, kode_item) {
        return `
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-info"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#modalEditItemPaket" onclick="getItemPaketById(${id_item})"><i class="fas fa-edit"></i> Edit</a>
                    <a class="dropdown-item text-danger" href="#" onclick="deleteItemPaket(${id_item})"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>`;
    }

    /** 
     * get item paket berdasarkan id_item
     */
    function getItemPaketById(id_item) {
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/itempaket/find/' + id_item,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    // clean input
                    $('#edit_id_item').val(0);
                    $('#edit_kode_item').val('');
                    $('#edit_paket_id').val('');
                    $('#edit_angkatan_id').val('');
                    $('#edit_semester_id').val('');
                    $('#edit_nama_item').val('');
                    $('#edit_nominal_item').val(0);
                    $('#edit_keterangan_item').val('data.data.keterangan_item');
                    // fill with data
                    $('#edit_id_item').val(data.data[0].id_item);
                    $('#edit_kode_item').val(data.data[0].kode_item);
                    $('#edit_paket_id').val(data.data[0].paket_id).change();
                    $('#edit_angkatan_id').val(data.data[0].angkatan_id).change();
                    $('#edit_semester_id').val(data.data[0].semester_id).change();
                    $('#edit_nama_item').val(data.data[0].nama_item);
                    $('#edit_nominal_item').val(parseInt(data.data[0].nominal_item));
                    $('#edit_keterangan_item').val(data.data[0].keterangan_item);
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

    /** 
     * tambah item paket
     */
    function addItemPaket() {
        var data_item = {
            paket_id: $('#paket_id').val(),
            angkatan_id: $('#angkatan_id').val(),
            semester_id: $('#semester_id').val(),
            nama_item: $('#nama_item').val(),
            nominal_item: parseInt($('#nominal_item').val()),
            keterangan_item: $('#keterangan_item').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/itempaket/create',
            type: 'POST',
            data: data_item,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    showSWAL('success', data.message);
                    $("#tbl_master_paket > tbody").empty();
                    console.log(data_item.paket_id);
                    if (data_item.paket_id == '') {
                        getItemPaketLain();
                    } else {
                        getItemPaket();
                    }
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR);
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
                    url: '<?php echo base_url(); ?>/master-keuangan/itempaket/delete/' + id_item,
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
            kode_item: $('#edit_kode_item').val(),
            paket_id: $('#edit_paket_id').val(),
            angkatan_id: $('#edit_angkatan_id').val(),
            semester_id: $('#edit_semester_id').val(),
            nama_item: $('#edit_nama_item').val(),
            nominal_item: parseInt($('#edit_nominal_item').val()),
            keterangan_item: $('#edit_keterangan_item').val(),
        };
        console.log(data_item);
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/itempaket/update/' + data_item.id_item,
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
     * get item paket with NULL paket_id (item pembayaran lain-lain)
     */
    function getItemPaketLain() {
        $("#tbl_master_item_lain > tbody").empty();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/master-keuangan/itempaket/null",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var itempaket = data.data;
                if (data.status != "success") {
                    showSWAL('error', data.message);
                } else {
                    // total nominal item paket tagihan
                    var total_tagihan = 0;
                    // create number formatter
                    var numformat = Intl.NumberFormat();
                    // table
                    var tbl = $('#tbl_master_item_lain').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    // iterate data
                    itempaket.forEach(element => {
                        // create new row data
                        tbl.row.add([element.kode_item, element.nama_item, element.tahun_angkatan, element.nama_semester, "Rp " + numformat.format(element.nominal_item), element.keterangan_item, generateActionButton(element.id_item, element.kode_item)]).draw(false);
                        // add total tagihan
                        total_tagihan += parseInt(element.nominal_item);
                    });
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.statusText);
            }
        });
    }
</script>