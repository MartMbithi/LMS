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
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="active tab-pane">
                                                        <div class="" id="Print">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- Course Details -->
                                                                        <div class="card card-warning card-outline">
                                                                            <div class="card-body text-center box-profile">
                                                                                <div class="col-sm-12">
                                                                                    <address>
                                                                                        <h1>INTERGRATED LMS</h1>
                                                                                        <h4>CERTIFICATE OF COMPLETION</h4>
                                                                                    </address>
                                                                                    <br>
                                                                                </div>
                                                                                <hr>
                                                                                <h5>
                                                                                    This Is To Certifiy That
                                                                                </h5>
                                                                                <h3>
                                                                                    <i> <?php echo $cert->s_regno . " " . $cert->s_name; ?> </i>
                                                                                </h3>
                                                                                <h5>
                                                                                    Has Completed
                                                                                </h5>
                                                                                <h3>
                                                                                    <i> <?php echo $cert->s_unit_code . " " .  $cert->s_unit_name; ?> </i>
                                                                                </h3>
                                                                                <br><br><br>
                                                                                <p>Scan To Verify</p>
                                                                                <?php
                                                                                require_once('../vendor/autoload.php');
                                                                                $barcode = new \Com\Tecnick\Barcode\Barcode();
                                                                                $targetPath = "../public/sys_data/qr_code/";
                                                                                if (!is_dir($targetPath)) {
                                                                                    mkdir($targetPath, 0777, true);
                                                                                }
                                                                                /* Date Added */
                                                                                $date_added = date("D M Y g:ia", strtotime($mark->c_date_added));
                                                                                $QRcode_Details = " VERIFIED," . " This Is  An Official Transcript For " .  $mark->s_regno . "  " . $mark->s_name;
                                                                                /* Merge All Payment Details */
                                                                                $bobj = $barcode->getBarcodeObj('QRCODE,H', $QRcode_Details, -16, -16, 'black', array(
                                                                                    -2,
                                                                                    -2,
                                                                                    -2,
                                                                                    -2
                                                                                ))->setBackgroundColor('#f0f0f0');

                                                                                $imageData = $bobj->getPngData();
                                                                                $timestamp = time();
                                                                                file_put_contents($targetPath . $timestamp . '.png', $imageData); ?>
                                                                                <img src="<?php echo $targetPath . $timestamp; ?>.png" width="218px" height="218px">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button id="print" onclick="printContent('Print');" type="button" class="btn btn-outline-warning">
                                                            <i class="fas fa-print"></i>
                                                            Print Transcription
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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