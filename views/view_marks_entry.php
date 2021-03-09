<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../partials/analytics.php');
require_once('../partials/head.php');
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
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
        $ret = "SELECT  * FROM  lms_results WHERE rs_id = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($mark = $res->fetch_object()) {
            $course_id = $mark->cc_id;
            $unit = $mark->c_id;
            /* Course Details */
            $ret = "SELECT  * FROM  lms_course_categories  WHERE cc_id = '$course_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($course = $res->fetch_object()) {
                /* Unit Details */
                $ret = "SELECT  * FROM  lms_course  WHERE c_id = '$unit' ";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                while ($unit = $res->fetch_object()) {

                    /* Perform Grading */
                    $cat1 = $mark->c_cat1_marks;
                    $cat2 = $mark->c_cat2_marks;
                    $sem_end = $mark->c_eos_marks;

                    //Get The Avg Marks
                    $convertedCat1 = ($cat1 / 30) * 20;
                    $convertedCat2 = ($cat2 / 30) * 10;
                    $total_avg = ($convertedCat1 + $convertedCat2 + $sem_end);

                    //Get The Grade
                    if ($total_avg >= '70') {
                        $grade = 'A';
                    } elseif ($total_avg >= '60') {
                        $grade = 'B';
                    } elseif ($total_avg >= '50') {
                        $grade = 'C';
                    } elseif ($total_avg >= '40') {
                        $grade = 'D';
                    } else {
                        $grade = 'E';
                    }
        ?>
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1 class="m-0 text-dark">Intergrated LMS - Transcripts</h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="billings.php">Marks Entries</a></li>
                                            <li class="breadcrumb-item active">Generate Transcript</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>

                        <!-- Main content -->
                        <section class="content">
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
                                                                        <div class="card-header p-2">
                                                                            <h3 class="text-center">
                                                                                PARTIAL TRANSCRIPT
                                                                            </h3>
                                                                        </div>
                                                                        <div class="card-body box-profile">
                                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                                <li class="list-group-item">
                                                                                    <b>Names : </b> <a class="float-right"> <?php echo $mark->s_name; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Reg No : </b> <a class="float-right"> <?php echo $mark->s_regno; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Course: </b> <a class="float-right"> <?php echo $course->cc_name; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Enrolled Unit: </b> <a class="float-right"> <?php echo $unit->c_name; ?></a>
                                                                                </li>
                                                                                <!-- Load Qr Code Here To Confirm Transcription -->
                                                                                <li class="list-group-item">
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
                                                                                    <div class="text-center">
                                                                                        <b>Scan To Verify Transcript </b>
                                                                                        <br>
                                                                                        <a class="text-center">
                                                                                            <img src="<?php echo $targetPath . $timestamp; ?>.png" width="218px" height="218px">
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                                <table class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>CAT 1 Marks</th>
                                                                                            <th>CAT 2 Marks</th>
                                                                                            <th>Final Exam</th>
                                                                                            <th>Average Marks</th>
                                                                                            <th>Grade</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><?php echo $mark->c_cat1_marks; ?></td>
                                                                                            <td><?php echo $mark->c_cat2_marks; ?></td>
                                                                                            <td><?php echo $mark->c_eos_marks; ?></td>
                                                                                            <td><?php echo $total_avg; ?></td>
                                                                                            <td><?php echo $grade; ?></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </ul>
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
                        </section>
                    </div>
                    <!-- Main Footer -->
        <?php require_once('../partials/footer.php');
                }
            }
        } ?>
    </div>
    <!-- ./wrapper -->
    <!-- Scripts -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>