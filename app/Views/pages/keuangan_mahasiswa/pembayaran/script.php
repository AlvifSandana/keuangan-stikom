<script>
    var num_format = Intl.NumberFormat();
    var item_tagihan_terbayar = [];
    var nama_paket = "";
    var global_data_tagihan;
    var global_tagihan = 0;
    var global_pembayaran = 0;

    /** 
     * event onkeypress enter untuk pencarian
     * data pembayaran mahasiswa
     */
    $('#nim').on('keypress', function(e) {
        if (e.which == 13) {
            searchPembayaran();
        }
    });

    $('input[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#fbp').prop('disabled', false);
        } else if ($(this).is(":not(:checked)")) {
            $('#fbp').prop('disabled', true);
        }
    });

    /**
     * search pembayaran by nim
     * and show result table
     */
    function searchPembayaran() {
        // change visibility
        $(".card_detail_tagihan").css("visibility", "hidden");
        $(".card_detail_pembayaran").css("visibility", "hidden");
        $("#tbl_detail_tagihan > tbody").empty();
        $("#tbl_detail_pembayaran > tbody").empty();
        $("#mahasiswa_id").val(0);
        $("#paket_id").val(0);
        var nim = $("#nim").val();
        var pembayaran_row = ``;
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/pembayaran/search/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data == null || data.data.mahasiswa == null) {
                    showSWAL('error', 'Data tidak ditemukan!');
                } else {
                    $('.pembayaran').remove();
                    // call fillDetail() function 
                    fillDetail();
                    $('#add_mahasiswa_id').val(data.data.mahasiswa.id_mahasiswa);
                    // kosongkan tbody
                    $("#list_search_result").empty();
                    // create new data row
                    var row = `
            <tr>
              <td>${data.data.mahasiswa.nim}</td>
              <td>${data.data.mahasiswa.nama_mahasiswa}</td>
              <td>${data.data.mahasiswa.progdi}</td>
              <td>${data.data.mahasiswa.angkatan}</td>
              <td>
			  <a href="<?php echo base_url(); ?>/cetak-pembayaran/by-nim/${data.data.mahasiswa.nim}" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i></a>
                <button class="btn btn-primary btn-sm" onclick="showDetail()" data-toggle="tooltip" data-placement="top" title="Lihat Detail"><i class="fas fa-info"></i></button>
              </td>
            </tr>
            </tr>
          `;
                    // fill id_mahasiswa to modal create pembayaran
                    $("#mahasiswa_id").val(data.data.mahasiswa.id_mahasiswa);
                    // show table with data row
                    $("#search_result").css("visibility", "visible");
                    $("#search_result").addClass("animate__animated animate__fadeIn")
                    $("#list_search_result").append(row);
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
                showSWAL('error', 'Data tidak ditemukan!');
            }
        });
    }

    /**
     * fill detail of tagihan mahasiswa
     */
    function fillDetail() {
        try {
            // declare data row
            var tagihan_row = ``;
            var pembayaran_row = ``;
            // get data tagihan by nim
            $.ajax({
                url: "<?php echo base_url(); ?>" + "/tagihan/search/" + $("#nim").val(),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    // if data available
                    if (data.status == 'success' && data.message == 'Data available') {
                        // get data mahasiswa and tagihan
                        var mahasiswa = data.data.detail_mahasiswa;
                        var tagihan = data.data.detail_tagihan;
                        // set value for global_data_tagihan
                        global_data_tagihan = tagihan;
                        // total tagihan & total pembayaran
                        var total_tagihan = 0;
                        var total_pembayaran = 0;
                        global_tagihan = 0;
                        global_pembayaran = 0;
                        // variable for new HTML Elements
                        var new_div_row = ``;
                        var new_div_col_tagihan = ``;
                        var new_div_col_pembayaran = ``;
                        var new_tbl_row_tagihan = ``;
                        var new_tbl_row_pembayaran = ``;
                        // iterate tagihan
                        for (let i = 0; i < tagihan.length; i++) {
                            new_div_col_tagihan = ``;
                            new_div_col_pembayaran = ``;
                            new_tbl_row_tagihan = ``;
                            new_tbl_row_pembayaran = ``;
                            total_tagihan = 0;
                            total_pembayaran = 0;
                            // iterate item tagihan
                            for (let j = 0; j < tagihan[i].detail_item_paket.length; j++) {
                                // create table row from detail item tagihan
                                new_tbl_row_tagihan += `
                                                        <tr>
                                                        <td>${tagihan[i].detail_item_paket[j].nama_item}</td>
                                                        <td>Rp ${num_format.format(parseInt(tagihan[i].detail_item_paket[j].nominal_item))}</td>
                                                        </tr>`;
                                // add total tagihan
                                total_tagihan += parseInt(tagihan[i].detail_item_paket[j].nominal_item);
                                // iterate pembayaran per item tagihan
                                var tmp_nominal_pembayaran = 0;
                                for (let k = 0; k < tagihan[i].detail_item_paket[j].detail_pembayaran.length; k++) {
                                    tmp_nominal_pembayaran += parseInt(tagihan[i].detail_item_paket[j].detail_pembayaran[k].nominal_pembayaran);
                                }
                                // add total pembayaran
                                total_pembayaran += tmp_nominal_pembayaran;
                                // create table row from detail pembayaran per item paket
                                new_tbl_row_pembayaran += `
                                                            <tr>
                                                            <td>${tagihan[i].detail_item_paket[j].nama_item}</td>
                                                            <td>Rp ${num_format.format(tmp_nominal_pembayaran)}</td>
                                                            <td>Rp ${num_format.format(parseInt(tagihan[i].detail_item_paket[j].nominal_item)-tmp_nominal_pembayaran)}</td>
                                                            <td class="text-center"><span class="badge badge-primary" data-toggle="modal" data-target="#modalDetailPembayaranPerItem" onclick="showDetailPembayaranItem(${i}, ${j})"><i class="fas fa-info"></i></button></td>
                                                            </tr>`;
                            }
                            // create new div column element for current tagihan 
                            new_div_col_tagihan += `
                                                        <div class="col-6">
                                                            <div class="card card_detail_tagihan" id="" style="visibility: hidden;">
                                                            <div class="card-body">
                                                                <h5 class="h5 pb-2">Tagihan ${tagihan[i].detail_paket[0].nama_paket} <span class="float-right badge badge-${tagihan[i].status_tagihan == 'Lunas' ? 'success' : 'danger'}">${tagihan[i].status_tagihan} </span></h5>
                                                                <div class="row">
                                                                <div class="col">
                                                                    <table class="table table-hover table-bordered" id="tbl_detail_tagihan">
                                                                    <thead class="text-center">
                                                                        <th>ITEM TAGIHAN</th>
                                                                        <th>NOMINAL</th>
                                                                    </thead>
                                                                    <tbody class="">
                                                                        ${new_tbl_row_tagihan}
                                                                        <tr class="font-weight-bold">
                                                                        <td class="text-center">TOTAL TAGIHAN</td>
                                                                        <td>Rp ${num_format.format(total_tagihan)}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>`;
                            // create new div column element for current tagihan
                            new_div_col_pembayaran += `
                                                        <div class="col-6">
                                                            <div class="card card_detail_pembayaran" id="" style="visibility: hidden;">
                                                            <div class="card-body">
                                                                <h5 class="h5 pb-2">Pembayaran ${tagihan[i].detail_paket[0].nama_paket} <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modalCreatePembayaran" onclick="showModalCreatePembayaran(${tagihan[i].paket_id}, ${i})"><i class="fas fa-plus"></i></button></h5>
                                                                <div class="row">
                                                                <div class="col">
                                                                    <table class="table table-hover table-bordered" id="tbl_detail_tagihan">
                                                                    <thead class="text-center">
                                                                        <th>ITEM PEMBAYARAN</th>
                                                                        <th>TERBAYAR</th>
                                                                        <th>SISA TAGIHAN</th>
                                                                        <th>ACTION</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        ${new_tbl_row_pembayaran}
                                                                        <tr class="font-weight-bold">
                                                                        <td class="text-center">TOTAL PEMBAYARAN</td>
                                                                        <td colspan="2">Rp ${num_format.format(total_pembayaran)}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>`;
                            // add total tagihan & pembayaran to global
                            global_tagihan += total_tagihan;
                            global_pembayaran += total_pembayaran;
                            // create new div row for current tagihan
                            new_div_row += `
                                            <div class="row mb-2 pembayaran">
                                                ${new_div_col_tagihan}
                                                ${new_div_col_pembayaran}
                                            </div>`;
                        }
                        // append to parent div container
                        $('.container-pembayaran').append(new_div_row);
                        $('#global-tagihan').text(num_format.format(global_tagihan).toString());
                        $('#global-pembayaran').text(num_format.format(global_pembayaran).toString());
                    } else {
                        // get error 
                        showSWAL('error', data.message);
                    }
                },
                error: function(jqXHR) {
                    showSWAL('error', jqXHR);
                    console.log(jqXHR);
                }
            });
        } catch (error) {
            console.log(error);
            showSWAL('error', error);
        }
    }

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
     * show modal create pembayaran
     * 
     * @param id_paket
     * @param idx_tagihan(array index)
     */
    function showModalCreatePembayaran(id_paket, idx_tagihan) {
        $('#add_paket_id').val('');
        $('#add_item_id').empty();
        // set value paket_id & item_id
        $('#add_paket_id').val(id_paket);
        for (let i = 0; i < global_data_tagihan[idx_tagihan].detail_item_paket.length; i++) {
            $('#add_item_id').append($('<option></option>')
                .attr('value', global_data_tagihan[idx_tagihan].detail_item_paket[i].id_item)
                .text(global_data_tagihan[idx_tagihan].detail_item_paket[i].nama_item));
        }
    }

    /**
     * show detail card
     */
    function showDetail() {
        // change visibility
        if ($('.card_detail_tagihan').css('visibility') == 'hidden') {
            $('.pembayaran').removeClass('animate__animated animate__fadeOut');
            $('.card_detail_tagihan').css('visibility', 'visible');
            $('.card_detail_pembayaran').css('visibility', 'visible');
            $('.pembayaran').addClass('animate__animated animate__fadeIn');
        } else {
            $('.pembayaran').removeClass('animate__animated animate__fadeIn');
            $('.pembayaran').addClass('animate__animated animate__fadeOut');
            setTimeout(() => {
                $('.card_detail_tagihan').css('visibility', 'hidden');
                $('.card_detail_pembayaran').css('visibility', 'hidden');
            }, 1000);
        }
    }

    /**
     * show modal detail pembayaran from item
     */
    function showDetailPembayaranItem(id_tagihan, id_item) {
        // set data tagihan
        var data_tagihan = global_data_tagihan;
        // create row_pembayaran
        var row_pembayaran = ``;
        // set tabel detail pembayaran per item to empty
        $("#tbl_detail_pembayaran_per_item > tbody").empty();
        // set nama item pembayaran
        $("#dp_nama_pembayaran").val(data_tagihan[id_tagihan].detail_paket[0].nama_paket);
        $("#dp_nama_item").val(data_tagihan[id_tagihan].detail_item_paket[id_item].nama_item);
        // check data pembayaran
        if (data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran.length == 0) {
            row_pembayaran = `
      <tr>
        <td class="text-warning font-weight-bold" colspan="3">Data Pembayaran Kosong.</td>
      </tr>`;
        } else {

        }
        for (let index = 0; index < data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran.length; index++) {
            row_pembayaran += `
        <tr>
        <td>${Intl.DateTimeFormat('id-id', {dateStyle: 'full'}).format(Date.parse(data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].tanggal_pembayaran))}</td>
        <td>Rp ${num_format.format(parseInt(data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].nominal_pembayaran))}</td>
        <td>
		<a target="_blank" href="${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].dokumen_pembayaran == null ? '#': '<?php echo base_url(); ?>/public/doc_pembayaran/' + data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].dokumen_pembayaran}" 
               class="btn btn-${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].is_dokumen_pembayaran == null ? 'danger':'success'} btn-sm">
                <i class="fas fa-${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].is_dokumen_pembayaran == null ? 'times':'check'}"></i>
            </a>
			<a href="<?php echo base_url(); ?>/cetak-pembayaran/by-pembayaran/${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].id_pembayaran}" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i></a>
			<a href="<?php echo base_url(); ?>/pembayaran/delete/${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].id_pembayaran}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
        </td>
        </tr>`;
        }
        $("#tbl_detail_pembayaran_per_item > tbody").append(row_pembayaran);
        // <td>${data_tagihan[id_tagihan].detail_item_paket[id_item].detail_pembayaran[index].id_pembayaran}</td>
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
