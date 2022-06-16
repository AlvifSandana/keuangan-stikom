<script>
    var num_format = Intl.NumberFormat();
    var item_tagihan_terbayar = [];
    var nama_paket = "";
    var global_data_tagihan;
    var global_tagihan = 0;
    var global_pembayaran = 0;

    fillCreateTagihanField();

    // remove empty card detail keuangan
    $(document).ready(function() {
        var tbl = $('#tbl_detail_tagihan > tbody');
        for (let i = 0; i < tbl.length; i++) {
            console.log('tbl' + tbl[i].childElementCount);
            if (tbl[i].childElementCount <= 1) {
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
        dropdownParent: $("#modalTambahTagihan")
    });
    $('#add_item_kode').select2({
        width: 'resolve',
        tags: true,
        dropdownParent: $("#modalCreatePembayaran")
    });

    // enable and disable select file bukti transaksi
    $('input[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#fbp').prop('disabled', false);
        } else if ($(this).is(":not(:checked)")) {
            $('#fbp').prop('disabled', true);
        }
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
        var item_tagihan = <?php echo json_encode($item_paket); ?>;
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
     * DataTable
     */
    $('.tbl-detail-keuangan-semester').DataTable({
        'columnDefs': [{
            className: "text-center",
            "targets": [0, 1]
        }, {
            className: "text-right",
            "targets": [2, 3, 4]
        },{
            className: "text-danger",
            "targets": [2,]
        },{
            className: "text-success",
            "targets": [3,]
        },],
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
            is_bukti_transaksi: $('#is_fbp').val(),
            bukti_transaksi: fbp
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
            title: 'Apakah Anda yakin ingin menghapus data pembayaran ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>' + '/keuangan-mahasiswa/pembayaran/delete/' + id_pembayaran,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
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
        // var kode = ($('#tagihan_item_paket').val()).split('-');
        var kode = $('#tagihan_item_paket').val();
        var data_tagihan = {
            kode_unit: $('#tagihan_nim').val(),
            item_kode: kode,
            // q_kredit: kode[2],
            tanggal_transaksi: $('#tagihan_tanggal_transaksi').val(),
            // semester_id: kode[1],
        };
        console.log(data_tagihan);
        $.ajax({
            url: '<?php echo base_url(); ?>/keuangan-mahasiswa/tagihan/create',
            type: 'POST',
            data: data_tagihan,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data);
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
     * Create new diskon
     */
    function createDiskon() {
        var kode = ($('#diskon_item_paket').val()).split('-');
        var data_tagihan = {
            kode_unit: $('#diskon_nim').val(),
            item_kode: kode[0],
            q_debit: kode[2],
            tanggal_transaksi: $('#diskon_tanggal_transaksi').val(),
            semester_id: kode[1],
        };
        console.log(data_tagihan);
        $.ajax({
            url: '<?php echo base_url(); ?>/keuangan-mahasiswa/diskon/create',
            type: 'POST',
            data: data_tagihan,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data.data);
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
            url: '<?php echo base_url() ?>/keuangan-mahasiswa/pembayaran/detail-pembayaran-item/' + kode_unit + '/' + item_kode,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    // total pembayaran
                    var total_pembayaran = 0;
                    var sisa_tagihan = 0;
                    console.log(data.data);
                    // clear tbody
                    $('#tbl_detail_pembayaran_per_item tbody').empty();
                    // create tbody with new data
                    if (data.data.length > 0) {
                        data.data.forEach(element => {
                            var tr = `
                            <tr>
                                <td>${element.kode_transaksi}</td>
                                <td>${element.tanggal_transaksi}</td>
                                <td class="text-left">Rp <span class="float-right">${num_format.format(element.q_debit)}</span></td>
                                <td>
                                <div class="dropdown no-arrow">
                                    <i class="fas fa-fw fa-ellipsis-h" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu">
                                        <a target="_blank" href="<?php echo base_url('cetak/bukti_pembayaran') . '/' ?>${element.kode_transaksi}" class="dropdown-item text-primary edit" 
                                        data-toggle="" 
                                        data-target="#" 
                                        onclick="">
                                            <i class="fas fa-fw fa-print "></i>
                                            Bukti Pembayaran
                                        </a>
                                        <a href="#edit" class="dropdown-item text-warning edit" data-toggle="modal" data-target="#modalEditPembayaran" onclick="fillModalEditPembayaran(${element.id_transaksi}, '${element.kode_transaksi}', '${element.tanggal_transaksi}', ${element.q_debit})">
                                            <i class="fas fa-fw fa-edit "></i>
                                            Edit
                                        </a>
                                        <a href="#hapus" class="dropdown-item text-danger edit" data-toggle="" data-target="#" onclick="deletePembayaran('${element.kode_transaksi}')">
                                            <i class="fas fa-fw fa-trash "></i>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                                </td>
                            </tr>`
                            $('#tbl_detail_pembayaran_per_item tbody').append(tr);
                            // add total tagihan from q_debit
                            total_pembayaran += parseInt(element.q_debit);
                        });
                        // sisa tagihan from nominal tagihan - total pembayaran
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

    /** 
     * fill modal edit pembayaran field
     */
    function fillModalEditPembayaran(id_transaksi, kode_transaksi, tanggal_transaksi, q_debit){
        $('#edit_id_transaksi').val('');
        $('#edit_kode_transaksi').val('');
        $('#edit_tanggal_transaksi').val('');
        $('#edit_q_debit').val('');
        $('#edit_id_transaksi').val(id_transaksi);
        $('#edit_kode_transaksi').val(kode_transaksi);
        $('#edit_tanggal_transaksi').val(tanggal_transaksi);
        $('#edit_q_debit').val(q_debit);
    }

    function updatePembayaran(){
        var data = {
            id_transaksi: $('#edit_id_transaksi').val(),
            kode_transaksi: $('#edit_kode_transaksi').val(),
            tanggal_transaksi: $('#edit_tanggal_transaksi').val(),
            q_debit: $('#edit_q_debit').val()
        };
        $.ajax({
            url: '<?= base_url()?>/keuangan-mahasiswa/pembayaran/edit/' + data.id_transaksi,
            method: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function() {
                $('.str-status').text("loading...");
            },
            success: function(data){
                if (data.status == 'success') {
                    $('.str-status').addClass('text-success');
                    $('.str-status').text(data.message + ' Reloading halaman dalam 3 detik...');
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                } else {
                    $('.str-status').addClass('text-danger');
                    $('.str-status').text(data.message);
                }
            },
            error: function(jqXHR){
                $('.str-status').addClass('text-danger');
                $('.str-status').text(jqXHR.responseText);
            },
        })
    }

    /**
     * get detail keuangan semester 
     */
    function getDetailKeuangan(nim) {
        $.ajax({
            url: '<?= base_url() ?>/keuangan-mahasiswa/detail-keuangan-semester/' + nim,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    var counter = 0;
                    var tbl = $('.tbl-detail-keuangan-semester').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    data.data.forEach(element => {
                        counter += 1;
                        if (element.detail[0].total_tagihan != null) {
                            tbl.row.add([
                                counter,
                                'Semester ' + element.detail.semester,
                                num_format.format(parseInt(element.detail[0].total_tagihan)),
                                element.detail[1].total_pembayaran == null ? 0 : num_format.format(parseInt(element.detail[1].total_pembayaran)),
                                num_format.format(parseInt(element.detail[0].total_tagihan) - (element.detail[1].total_pembayaran == null ? 0 : parseInt(element.detail[1].total_pembayaran)))
                            ]).draw(false);
                        }
                    });
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.responseText);
                console.log(jqXHR);
            }
        });
    }

    function fillCreateTagihanField(){
        $.ajax({
            url: '<?= base_url()?>/keuangan-mahasiswa/tagihan/get/<?= $mahasiswa[0]['nim'] ?>',
            method: 'GET',
            dataType: 'JSON',
            success: function(data){
                if (data.status == 'success') {
                    // console.log(data);
                    var tagihan = [];
                    for (let i = 0; i < data.data.length; i++) {
                        var d = data.data[i].kode_item + '-' + data.data[i].semester_id + '-' + data.data[i].nominal_item;
                        tagihan.push(d);
                    }
                    $('#tagihan_item_paket').val([...tagihan]);
                } else {
                    console.log(data);
                }
            },
            error: function(jqXHR){
                console.log(jqXHR);
            }
        });
    }
</script>