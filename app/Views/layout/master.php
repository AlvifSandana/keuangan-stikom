<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Administrasi Keuangan</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/ionicons/ionicons.min.css">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.min.css">
    <!-- datatable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
    <!-- datatable -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables/jquery.dataTables.min.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/animatecss/animate.min.css" />
    <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/select2/css/select2.min.css">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
        }

        #overlay {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            /* Black background with opacity */
            z-index: 2;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
        }

        #ovtext {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 50px;
            font-weight: bold;
            color: #DD4814;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
    </style>
    <?= $this->renderSection('custom-styles') ?>
    <script>
        function on() {
            document.getElementById("overlay").style.display = "block";
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="overlay" onclick="off()" style="display: <?= session('user_level') === 'demo' ? 'block' : 'none' ?>;">
        <div id="ovtext">=== FOR DEMO PURPOSE ===</div>
    </div>
    <!-- Wrapper -->
    <div class="wrapper">
        <?= $this->include('layout/navbar') ?>
        <?php if (session('user_level') === 'admin') { ?>
            <?= $this->include('layout/sidebar_admin') ?>
        <?php } else if (session('user_level') === 'demo') { ?>
            <?= $this->include('layout/sidebar_demo') ?>
        <?php } else if (session('user_level') === 'read') { ?>
            <?= $this->include('layout/sidebar_read') ?>
        <?php } else if (session('user_level') === 'readwrite') { ?>
            <?= $this->include('layout/sidebar_readwrite') ?>
        <?php } ?>
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