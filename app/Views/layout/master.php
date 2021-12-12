<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Administrasi Keuangan</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="public/plugins/ionicons/ionicons.min.css">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="public/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="public/plugins/sweetalert2/sweetalert2.min.css">
    <!-- datatable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
    <!-- datatable -->
    <link rel="stylesheet" href="public/plugins/datatables/datatables.min.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="public/plugins/animatecss/animate.min.css" />
    <!-- select2 -->
    <link rel="stylesheet" href="public/plugins/select2/css/select2.min.css">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
        }
    </style>
    <?= $this->renderSection('custom-styles') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Wrapper -->
    <div class="wrapper">
        <?= $this->include('layout/navbar') ?>
        <?= $this->include('layout/sidebar') ?>
        <div class="content-wrapper">
            <?= $this->renderSection('content-header') ?>
            <?= $this->renderSection('content-body') ?>
        </div>
        <?= $this->include('layout/footer') ?>
    </div>
    <!-- ./Wrapper -->
    <!-- Script -->
    <?= $this->include('layout/script') ?>
    <?= $this->renderSection('custom-script') ?>
    <!-- ./Script -->
</body>

</html>
