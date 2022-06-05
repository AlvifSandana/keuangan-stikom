<script>
    // DataTable
    $('.tbl-global').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn mb-1 btn-sm btn-secondary',
                text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"> Export PDF</i>',
                title: 'Sistem Keuangan STIKOM - Tabel Laporan Global'
            },
            {
                extend: 'csv',
                className: 'btn mb-1 btn-sm btn-secondary',
                text: '<i class="fas fa-file-csv fa-1x"> Export CSV</i>',
                title: 'Sistem Keuangan STIKOM - Tabel Laporan Global'
            },
            {
                extend: 'excel',
                className: 'btn mb-1 btn-sm btn-secondary',
                text: '<i class="fas fa-file-excel" aria-hidden="true"> Export EXCEL</i>',
                title: 'Sistem Keuangan STIKOM - Tabel Laporan Global'
            },
        ]
    });
</script>