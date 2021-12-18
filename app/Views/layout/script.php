<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<!-- sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- DataTable -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>

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
