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
        <?php require_once('../partials/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Intergrated LMS Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-book-open"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Courses</span>
                                    <span class="info-box-number">
                                        <?php echo $courses; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-book-reader"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Units</span>
                                    <span class="info-box-number"><?php echo $course_categories; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-tie"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Instructors</span>
                                    <span class="info-box-number"><?php echo $instructors; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-graduate"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Students</span>
                                    <span class="info-box-number"><?php echo $std; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-check"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Students Enrollments</span>
                                    <span class="info-box-number"><?php echo $s_enroll; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Instructors Allocations</span>
                                    <span class="info-box-number"><?php echo $ins_all; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Billings</span>
                                    <span class="info-box-number"><?php echo $bills; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Allocations Reports Recarp</h5>
                                </div>
                                <div class="card-body">
                                    <table id="dash-2" class="table table-striped table-bordered display " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Course</th>
                                                <th>Instructor Number</th>
                                                <th>Instructor Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ret = "SELECT  * FROM  lms_units_assaigns ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row->c_code; ?></td>
                                                    <td><?php echo $row->c_name; ?></td>
                                                    <td><?php echo $row->c_category; ?></td>
                                                    <td><?php echo $row->i_number; ?></td>
                                                    <td><?php echo $row->i_name; ?></td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Enrollement Reports Recarp</h5>
                                </div>
                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Instructor Name</th>
                                                <th>Student Name</th>
                                                <th>Enroll date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT  * FROM  lms_enrollments";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row->s_unit_code; ?></td>
                                                    <td><?php echo $row->s_unit_name; ?></td>
                                                    <td><?php echo $row->i_name; ?></td>
                                                    <td><?php echo $row->s_name; ?></td>
                                                    <td><?php echo date("d M Y", strtotime($row->en_date)); ?></td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
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