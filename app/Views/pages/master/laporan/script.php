<script>
    function generateLaporanPemasukan(){
        var tgl_mulai = $("#waktu_mulai_income").val();
        var tgl_akhir = $("#waktu_akhir_income").val();
        console.log([tgl_mulai, tgl_akhir])
        if (tgl_mulai == '' || tgl_akhir == '') {
            showSWAL('error', 'Mohon masukkan waktu dengan benar!');
        } else {
            window.open(`<?= base_url()?>/master-laporan/pemasukan/${tgl_mulai}/${tgl_akhir}`)
        }
    }

    function generateLaporanPengeluaran(){
        var tgl_mulai = $("#waktu_mulai_outcome").val();
        var tgl_akhir = $("#waktu_akhir_outcome").val();
        if (tgl_mulai == '' || tgl_akhir == '') {
            showSWAL('error', 'Mohon masukkan waktu dengan benar!');
        } else {
            window.open(`<?= base_url()?>/master-laporan/pengeluaran/${tgl_mulai}/${tgl_akhir}`)
        }
    }

    function generateLaporanTagihanByNIM(){
        try {
            // get nim from input
            var nim = $('#tagihan_nim').val();
			var url = '<?php echo base_url(); ?>/laporan/generate_laporan_tagihan/' + nim;
            window.location.href = url;
        } catch (error) {
            ShowSWAL('error', error);
        }
    }

    function generateLaporanPembayaranByNIM(){
        try {
            // get nim from input
            var nim = $('#pembayaran_nim').val();
			var url = '<?php echo base_url(); ?>/laporan/generate_laporan_pembayaran/' + nim;
            window.location.href = url;
        } catch (error) {
            ShowSWAL('error', error);
        }
    }

    function generateLaporanRekamPembayaranByNIM(){
        try {
            // get nim from input
            var nim = $('#rekam_pembayaran_nim').val();
			var url = '<?php echo base_url(); ?>/laporan/generate_laporan_rekam_pembayaran/' + nim;
            window.location.href = url;
        } catch (error) {
            ShowSWAL('error', error);
        }
    }
</script>
