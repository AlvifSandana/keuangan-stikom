<script>
    // DataTable
    $('.tbl-temp-transaksi').DataTable();

    // select2
    $('#formula').select2({
        width: 'resolve',
    });

    // show upload filename
    $('#file_va').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });

    // get detail of master formula
    function getDetailSelectedMasterFormula(id_mformula){
        try {
            $.ajax({
                url: ''
            });
        } catch (err) {
            
        }
    }
</script>