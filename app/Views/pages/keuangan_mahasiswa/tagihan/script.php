<script>
    // global data
    let data_mhs;
    let data_tagihan;
    var global_tagihan = 0;
    var global_terbayar = 0;
    // number format
    var numFormat = Intl.NumberFormat();

    /** 
     * event onkeypress enter untuk pencarian
     * data tagihan mahasiswa
     */
    $('#nim').on('keypress', function(e) {
        if (e.which == 13) {
            searchMhs();
        }
    });

    /** 
     * function pencarian data tagihan mahasiswa
     * berdasarkan NIM
     */
    function searchMhs() {
        var nim = $("#nim").val();
        $.ajax({
            url: "<?php echo base_url(); ?>" + "/tagihan/search/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data == null || data.status == "failed") {
                    showSWAL('error', data.message);
                } else {
                    $('.detail-tagihan').empty();
                    $('.hasil').css('visibility', 'hidden');
                    showAfterSearch(data.data.detail_mahasiswa.id_mahasiswa, data.data.detail_mahasiswa.nim, data.data.detail_mahasiswa.nama_mahasiswa, data.data.detail_mahasiswa.progdi, data.data.detail_mahasiswa.angkatan);
                    // data detail_tagihan    
                    var detail_tagihan = data.data.detail_tagihan;
                    data_tagihan = detail_tagihan;
                    data_mhs = data.data.detail_mahasiswa;
                    // total tagihan & total terbayar
                    global_tagihan = 0;
                    global_terbayar = 0;
                    var total_tagihan = 0;
                    var total_terbayar = 0;
                    var tmp_terbayar = 0;
                    var new_tagihan = ``;
                    var new_row = ``;
                    // iterate data.detail_tagihan
                    for (let index = 0; index < detail_tagihan.length; index++) {
                        // iterate item_paket tagihan
                        for (let i = 0; i < detail_tagihan[index].detail_item_paket.length; i++) {
                            total_tagihan += parseInt(detail_tagihan[index].detail_item_paket[i].nominal_item);
                            // iterate detail pembayaran per item_paket
                            for (let j = 0; j < detail_tagihan[index].detail_item_paket[i].detail_pembayaran.length; j++) {
                                tmp_terbayar += parseInt(detail_tagihan[index].detail_item_paket[i].detail_pembayaran[j].nominal_pembayaran);
                            }
                            new_row += `
                                        <tr>
                                            <td>${detail_tagihan[index].detail_item_paket[i].nama_item}</td>
                                            <td>Rp ${numFormat.format(parseInt(detail_tagihan[index].detail_item_paket[i].nominal_item))}</td>
                                            <td>Rp ${numFormat.format(tmp_terbayar)}</td>
                                            <td class="text-center"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalDetailTagihan" onclick="showDetailPembayaran(${index}, ${i})"><i class="fas fa-info"></i></button></td>
                                        </tr>
                                        `;
                            total_terbayar += tmp_terbayar;
                            tmp_terbayar = 0;
                        }
                        new_tagihan += `
                                        <div class="tagihan-${index} mb-3">
                                        <h5 class="h5">Tagihan ${detail_tagihan[index].detail_paket[0].nama_paket} <span class="float-right badge badge-${detail_tagihan[index].status_tagihan.toLowerCase() == 'lunas' ? 'success' : 'warning'}">${detail_tagihan[index].status_tagihan}</span></h5>
                                        <table class="table table-hover table-bordered">
                                            <thead class="text-center">
                                            <th>ITEM TAGIHAN</th>
                                            <th>NOMINAL</th>
                                            <th>TERBAYAR</th>
                                            <th>ACTION</th>
                                            </thead>
                                            <tbody>
                                            ${new_row}
                                            <tr class="font-weight-bold">
                                                <td>TOTAL</td>
                                                <td>Rp ${numFormat.format(total_tagihan)}</td>
                                                <td>Rp ${numFormat.format(total_terbayar)}</td>
												<td class="text-center"><a href="<?php echo base_url(); ?>/cetak-tagihan/by-nim-by-paket/${nim}/${detail_tagihan[index].detail_paket[0].id_paket}" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                        <hr/>`;
                        $('.detail-tagihan').append(new_tagihan);
                        new_row = ``;
                        new_tagihan = ``;
                        global_tagihan += total_tagihan;
                        global_terbayar += total_terbayar;
                        total_tagihan = 0;
                        total_terbayar = 0;
                    }
                    $('#global-tagihan').text(numFormat.format(global_tagihan).toString());
                    $('#global-pembayaran').text(numFormat.format(global_terbayar).toString());
                }
            },
            error: function(jqXHR) {
                console.log(jqXHR);
                showSWAL('error', jqXHR);
            }
        });
    }

    /** 
     * function untuk menampilkan card hasil 
     * pencarian data mahasiswa
     */
    function showAfterSearch(id, nim, nama, progdi, angkatan) {
        $('#list_tagihan').empty();
        var new_row = `
                        <tr>
                        <td>${nim}</td>
                        <td>${nama}</td>
                        <td>${progdi}</td>
                        <td>${angkatan}</td>
                        <td>
						<a class="btn btn-secondary btn-sm" href="<?php echo base_url(); ?>/cetak-tagihan/by-nim/${nim}"><i class="fas fa-print"></i></a>
                            <button class="btn btn-primary btn-sm" onclick="showDetailTagihan()"><i class="fas fa-info"></i></button>
                        </td>
                        </tr>`;
        $('#list_tagihan').append(new_row);
        $('#search_result').css('visibility', 'visible');
        $('#search_result').addClass("animate__animated animate__fadeIn");
    }

    function showDetailTagihan() {
        if ($('.hasil').css('visibility') == 'hidden') {
            $('.hasil').removeClass('animate__animated animate__fadeOut');
            $('.hasil').css('visibility', 'visible');
            $('.hasil').addClass('animate__animated animate__fadeIn');
        } else {
            $('.hasil').removeClass('animate__animated animate__fadeIn');
            $('.hasil').addClass('animate__animated animate__fadeOut');
            setTimeout(()=> {
                $('.hasil').css('visibility', 'hidden');
            }, 1000);
        }
    }

    /** 
     * function untuk menampilkan 
     * modal detail tagihan per item paket
     */
    function showDetailPembayaran(idx_detail_tagihan, idx_detail_item_paket) {
        var pembayaran_row = ``;
        // clear field
        $('#detail_nim').val('');
        $('#detail_nama_mhs').val('');
        $('#detail_nama_paket').val('');
        $('#list_item_pembayaran').empty();
        // set field value
        $('#detail_nim').val(data_mhs.nim);
        $('#detail_nama_mhs').val(data_mhs.nama_mahasiswa);
        $('#detail_nama_paket').val(data_tagihan[idx_detail_tagihan].detail_paket[0].nama_paket);
        $('#detail_nama_item_paket').val(data_tagihan[idx_detail_tagihan].detail_item_paket[idx_detail_item_paket].nama_item);
        // iterate pembayaran
        for (let i = 0; i < data_tagihan[idx_detail_tagihan].detail_item_paket[idx_detail_item_paket].detail_pembayaran.length; i++) {
            var tanggal_pembayaran = data_tagihan[idx_detail_tagihan].detail_item_paket[idx_detail_item_paket].detail_pembayaran[i].tanggal_pembayaran;
            pembayaran_row += `
      <tr>
        <td>${Intl.DateTimeFormat('id-id', {dateStyle: 'full'}).format(Date.parse(tanggal_pembayaran))}</td>
        <td>Rp ${numFormat.format(data_tagihan[idx_detail_tagihan].detail_item_paket[idx_detail_item_paket].detail_pembayaran[i].nominal_pembayaran)}</td>
        <td>${data_tagihan[idx_detail_tagihan].detail_item_paket[idx_detail_item_paket].detail_pembayaran[i].keterangan_pembayaran}</td>
      </tr>
      `;
        }
        $('#list_item_pembayaran').append(pembayaran_row);
    }
</script>
