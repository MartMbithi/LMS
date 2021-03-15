<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');
/* Persist System Settings  */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/head.php');
?>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <?php require_once('../partials/ins_navbar.php'); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once('../partials/ins_sidebar.php'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Reports</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Enrollments Reports</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body">
                                    <table id="reports" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Std RegNo</th>
                                                <th>Std Name</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Course</th>
                                                <th>Instructor</th>
                                                <th>Date Enrolled</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  * FROM  lms_enrollments WHERE i_id = '$id' ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($enrollments = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $enrollments->s_regno; ?></td>
                                                    <td><?php echo $enrollments->s_name; ?></td>
                                                    <td><?php echo $enrollments->s_unit_code; ?></td>
                                                    <td><?php echo $enrollments->s_unit_name; ?></td>
                                                    <td><?php echo $enrollments->s_course; ?></td>
                                                    <td><?php echo $enrollments->i_name; ?></td>
                                                    <td><?php echo date('d M Y', strtotime($enrollments->en_date)); ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Main Footer -->
            <?php require_once('../partials/footer.php'); ?>
        </div>
        <!-- ./wrapper -->

        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>

    </body>

    </html>
<?php } ?>