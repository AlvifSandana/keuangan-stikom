<script>
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
