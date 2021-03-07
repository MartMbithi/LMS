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
        $ret = "SELECT  * FROM  lms_paid_study_materials WHERE psm_id = '$view' ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($payment = $res->fetch_object()) {
            $course_id = $payment->cc_id;
            /* Course Details */
            $ret = "SELECT  * FROM  lms_course_categories  WHERE cc_id = '$course_id' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($course = $res->fetch_object()) {
        ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Intergrated LMS - Payments</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="billings.php">Billings</a></li>
                                        <li class="breadcrumb-item active">View Payment</li>
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
                                    <div class="card card-warning card-outline">
                                        <div class="card-header p-2">
                                            <h3 class="text-center">
                                                <?php echo $course->cc_name; ?> Study Materials Payment Record
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane">
                                                    <div class="" id="Print">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <!-- Course Details -->
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-body box-profile">
                                                                            <div class="text-center">
                                                                                <?php
                                                                                if ($course->cc_dpic == '') {
                                                                                    $logo = 'Default.png';
                                                                                } else {
                                                                                    $logo = $course->cc_dpic;
                                                                                }
                                                                                ?>
                                                                                <img class="img-fluid  img-rectangle" src="../public/sys_data/uploads/courses/<?php echo $logo; ?>" alt="Course Logo">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!-- Course Details -->
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-body box-profile">
                                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                                <li class="list-group-item">
                                                                                    <b>Course Code</b> <a class="float-right"> <?php echo $course->cc_code; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Course Name </b> <a class="float-right"> <?php echo $course->cc_name; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Unit Code </b> <a class="float-right"> <?php echo $payment->c_code; ?></a>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <b>Unit Name </b> <a class="float-right"> <?php echo $payment->c_name; ?></a>
                                                                                </li>
                                                                                <!-- Load Qr Code Here To Confirm Payment -->
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h2 class="text-center">
                                                                <u>Payment Details </u>
                                                            </h2>
                                                            <table class="table table-striped table-bordered display no-wrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Payment Means</th>
                                                                        <th>Payment Code</th>
                                                                        <th>Amount Paid</th>
                                                                        <th>Date Paid</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $ret = "SELECT  * FROM  lms_paid_study_materials ";
                                                                    $stmt = $mysqli->prepare($ret);
                                                                    $stmt->execute(); //ok
                                                                    $res = $stmt->get_result();
                                                                    while ($payments = $res->fetch_object()) {
                                                                        $mysqlDateTime = $payments->p_date_paid;
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $payments->p_method; ?></td>
                                                                            <td><?php echo $payments->p_code; ?></td>
                                                                            <td>Ksh <?php echo $payments->p_amt; ?></td>
                                                                            <td><?php echo date("d M Y g:ia", strtotime($mysqlDateTime)); ?></td>
                                                                        </tr>
                                                                    <?php } ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button id="print" onclick="printContent('Print');" type="button" class="btn btn-outline-warning">
                                                            <i class="fas fa-print"></i>
                                                            Print
                                                        </button>
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
            }
        } ?>
    </div>
    <!-- ./wrapper -->
    <!-- Scripts -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>