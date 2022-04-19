<script>
    // DataTable
    $('.tbl-temp-transaksi').DataTable({
        'columnDefs': [{
            className: "text-center",
            "targets": [0, 3, 5]
        }],
    });

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
    function getDataFromCheckBox(id_tmp_tr) {
        let cbs = document.querySelectorAll('input[name="bulan-' + id_tmp_tr + '"]:checked');
        let val = [];
        cbs.forEach((cb) => {
            val.push(cb.value);
        });
        return val;
    }

    function getDataTempTransaksi() {
        $.ajax({
            url: '<?= base_url() ?>/keuangan-mahasiswa/pembayaran-va/get-data',
            method: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {

                } else {
                    // response data
                    $d = data.data;
                    // table
                    var tbl = $('#tbl_temp_transaksi').DataTable();
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
            error: function(jqXHR) {
                showSWAL('error', jqXHR.responseText());
            }
        });
    }

    // acc temp transaksi
    function acc_temp_tr(id_temp_tr, nim, q_debit, mp, tgl) {
        // get data
        var data = {
            id_tmp_tr: id_temp_tr,
            nim: nim,
            mp: mp,
            tgl: tgl,
            q_debit: q_debit,
            item_tagihan: getDataFromCheckBox(id_temp_tr)
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
                    showSWAL('success', data.message);
                    refreshTable();
                } else {
                    showSWAL('error', data.message);
                    $('input[name="bulan"]:checked').prop("checked", false);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.responseText);
                console.log(jqXHR.responseText);
                $('input[name="bulan"]:checked').prop("checked", false);
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
                        refreshTable();
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
                            refreshTable();
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

    $('.spinner-border').bind('ajaxStart', function() {
        $(this).show();
    }).bind('ajaxStop', function() {
        $(this).hide();
    });

    // get data on selected paket tagihan
    function refreshTable() {
        $("#tbl_temp_transaksi > tbody").empty();
        $('.spinner-border').css("visibility", "visible");
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/keuangan-mahasiswa/pembayaran-va/get-data",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var tmptr = data.data;
                if (data.status != "success") {
                    showSWAL('error', data.message);
                } else {
                    // total nominal item paket tagihan
                    var total_tagihan = 0;
                    // create number formatter
                    var numformat = Intl.NumberFormat();
                    // table
                    var tbl = $('#tbl_temp_transaksi').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    // iterate data
                    for (let i = 0; i < tmptr.length; i++) {
                        // convert tanggal
                        var tgl = convertTGL(tmptr[i][0].tanggal_transaksi);
                        // get data for opsi button
                        var list_checkbox = ``;
                        if (Array.isArray(tmptr[i][1].status_item_tagihan)) {
                            for (let j = 0; j < tmptr[i][1].status_item_tagihan.length; j++) {
                                if (tmptr[i][1].status_item_tagihan == "lunas") {
                                    continue;
                                }
                                console.log(tmptr[i][1].status_item_tagihan[j]);
                                list_checkbox += `
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="bulan-${tmptr[i][0].id_temp_transaksi}" value="${tmptr[i][1].status_item_tagihan[j][0]}" id="${tmptr[i][0].kode_temp_transaksi}">
                                    <label for="${tmptr[i][1].status_item_tagihan[j][0]}" id="${tmptr[i][0].kode_temp_transaksi}">${tmptr[i][1].status_item_tagihan[j][1]}</label>
                                </div>`;
                            }
                        } else {
                            list_checkbox = tmptr[i][1].status_item_tagihan;
                        }
                        // create new row data
                        tbl.row.add([
                            tmptr[i][0].kode_unit,
                            `${tgl[0]}, ${tgl[1]} ${tgl[2]} ${tgl[3]}`,
                            "Rp " + numformat.format(tmptr[i][0].q_debit),
                            tmptr[i][0].metode_pembayaran,
                            generateOpsiButton(list_checkbox),
                            generateActionButton(tmptr[i][0].id_temp_transaksi, tmptr[i][0].kode_unit, tmptr[i][0].q_debit, tmptr[i][0].metode_pembayaran, tmptr[i][0].tanggal_transaksi)
                        ]).draw(false);
                    }
                }
            },
            complete: function() {
                $('.spinner-border').css("visibility", "hidden");
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.statusText);
            }
        });
    }

    /** 
     * generate Action Button
     */
    function generateActionButton(id, kode_unit, q_debit, mp, tanggal_transaksi) {
        return `
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="actionBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
            </button>
            <div class="dropdown-menu" aria-labelledby="actionBtn">
                <a class="dropdown-item text-success" href="#" onclick="acc_temp_tr('${id}','${kode_unit}',${q_debit}, '${mp}', '${tanggal_transaksi}')"><i class="fas fa-check fa-fw"></i> ACC</a>
                <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#modalUpdateTempTransaksi" onclick="fillUpdateField('${id}', ${q_debit}, '${tanggal_transaksi}')"><i class="fas fa-edit fa-fw"></i> Edit</a>
                <a class="dropdown-item text-danger" href="#" onclick="deleteTempVA('${id}')"><i class="fas fa-trash fa-fw"></i> Hapus</a>
            </div>
        </div>`;
    }

    function generateOpsiButton(list_checkbox) {
        return `<div class="btn-group dropleft">
        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-fw fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-opsi">
        <form class="px-3 py-2 vert-scroll">
            <label for="item">Pilih item tagihan</label><br />${list_checkbox}
        </form></div>`;
    }

    function convertTGL(tgl) {
        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        var tanggal = new Date(tgl).getDate();
        var xhari = new Date(tgl).getDay();
        var xbulan = new Date(tgl).getMonth();
        var xtahun = new Date(tgl).getYear();

        var hari = hari[xhari];
        var bulan = bulan[xbulan];
        var tahun = (xtahun < 1000) ? xtahun + 1900 : xtahun;
        return [hari, tanggal, bulan, tahun];
    }
</script>