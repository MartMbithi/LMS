<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../partials/analytics.php');
/* Persist System Settings  */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/head.php'); ?>

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
                                    <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Certificate</h1>
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
                                                                                        <h4 class="cert_header">CERTIFICATE OF COMPLETION</h4>
                                                                                        <br>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <h1>
                                                                                        <img src="../public/sys_data/logo/<?php echo $sys->sys_logo; ?>" height="100" width="300" alt="">
                                                                                    </h1>
                                                                                    <h1><?php echo $sys->sys_name; ?></h1>
                                                                                    <br><br><br>
                                                                                    <h2>
                                                                                        This Is To Certifiy That
                                                                                    </h2>
                                                                                    <h3 class="cert_holder text-bold">
                                                                                        <i> <?php echo $cert->s_name; ?> </i>
                                                                                    </h3>
                                                                                    <h2>
                                                                                        Admission Number
                                                                                    </h2>
                                                                                    <h3 class="cert_holder text-bold">
                                                                                        <i> <?php echo $cert->s_regno; ?> </i>
                                                                                    </h3>
                                                                                    <h2>
                                                                                        Has Completed
                                                                                    </h2>
                                                                                    <h3 class="cert_holder text-bold">
                                                                                        <i> <?php echo $cert->s_unit_code . " " .  $cert->s_unit_name; ?> </i>
                                                                                    </h3>
                                                                                    <h2>
                                                                                        Enrolled On
                                                                                    </h2>
                                                                                    <h3 class="cert_holder text-bold">
                                                                                        <i> <?php echo date('d M Y', strtotime($cert->en_date)); ?> </i>
                                                                                    </h3>
                                                                                    <br><br><br><br><br><br>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p class="cert_instructor_signature">
                                                                                                <u><?php echo $cert->i_name; ?></u>
                                                                                            </p>
                                                                                            <h4><?php echo $sys->sys_name; ?> Instructor </h4>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p class="cert_instructor_signature">
                                                                                                <u><?php echo date('d M Y', strtotime($cert->date_generated)); ?></u>
                                                                                            </p>
                                                                                            <h4>Date Generated </h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br><br><br>
                                                                                    <p>To Verify This Certificate, Scan Below QR Code</p>
                                                                                    <?php
                                                                                    require_once('../vendor/autoload.php');
                                                                                    $barcode = new \Com\Tecnick\Barcode\Barcode();
                                                                                    $targetPath = "../public/sys_data/qr_code/";
                                                                                    if (!is_dir($targetPath)) {
                                                                                        mkdir($targetPath, 0777, true);
                                                                                    }
                                                                                    /* Date Added */
                                                                                    $date_added = date("D M Y g:ia", strtotime($cert->date_generated));
                                                                                    $QRcode_Details = " VERIFIED," . "
                                                                                This Is  An Original Certificate Awarded To " .  $cert->s_regno . "  " . $cert->s_name
                                                                                        . " " . " For Completing $cert->s_unit_code $cert->s_unit_name Course.";
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
                                                                                    <img src="<?php echo $targetPath . $timestamp; ?>.png" width="150px" height="150px">
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
                                                                Print Certificate
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
<?php
} ?>