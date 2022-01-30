<script>
    $('.custom-select').select2({
        width: 'resolve'
    });

    // enable and disable select file bukti transaksi
    $('input[type="checkbox"]').click(function() {
        if ($(this).is(":checked")) {
            $('#fbp').prop('disabled', false);
        } else if ($(this).is(":not(:checked)")) {
            $('#fbp').prop('disabled', true);
        }
    });

    // show upload filename
    $('#fbp').on('change', function() {
        var filename = $(this).val();
        $(this).next('.custom-file-label').html(filename);
    });
</script>