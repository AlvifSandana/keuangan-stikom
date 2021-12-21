<script>
    // use DataTable
    $('table').DataTable();

    /** 
     * event onkeypress enter untuk pencarian
     * data pembayaran mahasiswa
     */
    $('#keyword').on('keypress', function(e) {
        if (e.which == 13) {
            // searchPembayaran();
            searchMahasiswa();
        }
    });

    $('input[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#fbp').prop('disabled', false);
        } else if ($(this).is(":not(:checked)")) {
            $('#fbp').prop('disabled', true);
        }
    });

    function searchMahasiswa() {
        var data = {
            keyword: $('input[name="keyword"]').val(),
        };

        $.ajax({
            url: "<?php echo base_url(); ?>/keuangan-mahasiswa/cari-mahasiswa",
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    // get data
                    var result = data.data;
                    // get table
                    var tbl = $('#tbl_pencarian').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    result.forEach(element => {
                        tbl.row.add([element.nim, element.nama_mhs, element.nama_paket, element.status_mhs, generateActionButton(element.nim)]).draw(false);
                    });
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR.status);
            }
        })
    }

    function generateActionButton(nim) {
        return `
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-info"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo base_url() ;?>/keuangan-mahasiswa/pembayaran/detail/${nim}">Detail Keuangan</a>
                    <a class="dropdown-item" href="#">Proses FRS</a>
                </div>
            </div>`;
    }
</script>