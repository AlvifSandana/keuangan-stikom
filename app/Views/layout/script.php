<!-- jQuery -->
<script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/assets/js/adminlte.js"></script>
<!-- sweetalert2 -->
<script src="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url(); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTable -->
<script src="<?php echo base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
<!-- sweetalert2 custom -->
<script>
    function showSWAL(type, message) {
        Swal.fire({
            title: type == 'error' || type == 'failed' ? 'Error' : 'Success',
            text: message,
            icon: type == 'error' || type == 'failed' ? 'error' : 'success',
            confirmButtonText: 'OK'
        });
    }
</script>
