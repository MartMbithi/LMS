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
            $ret = "SELECT  * FROM  lms_course WHERE c_id = '$view' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($unit = $res->fetch_object()) {
                $course_id = $unit->cc_id;
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
                                        <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Unit Details</h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="courses.php">Units</a></li>
                                            <li class="breadcrumb-item active"><?php echo $unit->c_name; ?></li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">

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
                                                    <img class="img-fluid img-rectangle" src="../public/sys_data/uploads/courses/<?php echo $logo; ?>" alt="Course Logo">

                                                </div>

                                                <h3 class="profile-username text-center"><?php echo $unit->c_code; ?></h3>

                                                <p class="text-muted text-center"><?php echo $unit->c_name; ?></p>

                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>H.O.D</b> <a class="float-right"> <?php echo $course->cc_dept_head; ?></a>

                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Course Code</b> <a class="float-right"> <?php echo $course->cc_code; ?></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Course Name </b> <a class="float-right"> <?php echo $course->cc_name; ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card card-warning card-outline">
                                            <div class="card-header p-2">
                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab"><?php echo $unit->c_name; ?> Details</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#allocated_lec" data-toggle="tab">Allocated Lecturer Details</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#enrolled_students" data-toggle="tab">Enrollments </a></li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="details">
                                                        <p class="text-center">
                                                            <?php echo $unit->c_desc; ?>
                                                        </p>
                                                    </div>
                                                    <div class="tab-pane" id="allocated_lec">
                                                        <table id="dash-1" class="table table-striped table-bordered display " style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Instructor Number</th>
                                                                    <th>Instructor Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_units_assaigns WHERE c_id = '$view' ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($lec = $res->fetch_object()) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $lec->i_number; ?></td>
                                                                        <td><?php echo $lec->i_name; ?></td>
                                                                    </tr>
                                                                <?php
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="tab-pane" id="enrolled_students">
                                                        <table id="dash-2" class="table table-striped table-bordered display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Instructor Name</th>
                                                                    <th>Student Name</th>
                                                                    <th>Enroll date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_enrollments WHERE c_id = '$view' ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($enrollments = $res->fetch_object()) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $enrollments->i_name; ?></td>
                                                                        <td><?php echo $enrollments->s_name; ?></td>
                                                                        <td><?php echo date("d M Y", strtotime($enrollments->en_date)); ?></td>
                                                                    </tr>

                                                                <?php } ?>

                                                            </tbody>
                                                        </table>
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
<?php } ?>