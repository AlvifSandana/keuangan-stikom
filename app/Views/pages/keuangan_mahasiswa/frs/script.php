<script>
    // acc FRS (ajax POST)
    function accFRS() {
        Swal.fire({
            text: 'Apakah Anda yakin ingin ACC FRS dari mahasiswa yang bersangkutan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#86DC3D',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ACC'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url();?>/keuangan-mahasiswa/frs/<?= $data_mhs[0]['nim']?>/acc',
                    type: 'POST',
                    data: {status_frs: 1, p_soft: $('#p_soft').val(), p_hard: $('#p_hard').val()},
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000)
                        }
                    },
                    error: function(jqXHR) {
                        showSWAL('error', jqXHR);
                        console.log(jqXHR);
                    }
                });
            }
        });
    }

    // batalkan FRS (ajax POST)
    function batalFRS() {
        Swal.fire({
            text: 'Apakah Anda yakin ingin membatalkan FRS dari mahasiswa yang bersangkutan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url();?>/keuangan-mahasiswa/frs/<?= $data_mhs[0]['nim']?>/batal',
                    type: 'POST',
                    data: {
                        status_frs: 0
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000)
                        }
                    },
                    error: function(jqXHR) {
                        showSWAL('error', jqXHR);
                        console.log(jqXHR);
                    }
                });
            }
        });
    }
</script>