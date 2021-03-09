<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        require_once('../partials/sidebar.php');
        $view = $_GET['view'];
        $ret = "SELECT  * FROM  lms_certs WHERE cert_id = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($cert = $res->fetch_object()) {
        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Intergrated LMS - Certificate</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="certificates.php">Certificates</a></li>
                                    <li class="breadcrumb-item active">Generate</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="container-fluid">
                               
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Main Footer -->
        <?php require_once('../partials/footer.php');
        } ?>
    </div>
    <!-- ./wrapper -->
    <!-- Scripts -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>