<script>
    // DataTable
    $('.tbl-temp-transaksi').DataTable();

    // show upload filename
    $('#file_va').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    })
</script>