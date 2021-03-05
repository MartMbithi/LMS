<?php
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
admin();
require_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body onload=display_ct();>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php require_once("../partials/header.php"); ?>

        <?php require_once("../partials/sidebar.php"); ?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <?php require_once('../partials/time.php'); ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_admin_dashboard.php">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected id="ct"></option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">

                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $std; ?></h2>

                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Students</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-people"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>

                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                        <?php echo $instructors; ?>
                                    </h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Instructors
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-user-following"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">

                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $course_categories; ?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Courses</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="grid" class="feather-icon"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo $courses; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Units</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">

                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $s_enroll; ?></h2>

                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Student Enrollments</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-user-follow "></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>

                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                        <?php echo $questions; ?>
                                    </h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Test Quizzes
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-note"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo $study_materials; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Study Materials</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon  icon-docs "></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">Ksh <?php echo $bills; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Fee</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class=" icon-credit-card"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enrollment Details </h4>
                                <div class="table-responsive">
                                    <table id="default_order" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Instructor Name</th>
                                                <th>Student Name</th>
                                                <th>Enroll date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Student Enrollment.
                                            $ret = "SELECT  * FROM  lms_enrollments";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                                $mysqlDateTime = $row->en_date; //trim timestamp to DD/MM/YYYY formart

                                            ?>
                                                <tr>
                                                    <td><?php echo $row->s_unit_code; ?></td>
                                                    <td><?php echo $row->s_unit_name; ?></td>
                                                    <td><?php echo $row->i_name; ?></td>
                                                    <td><?php echo $row->s_name; ?></td>
                                                    <td><?php echo date("d M Y", strtotime($mysqlDateTime)); ?></td>
                                                    <td>
                                                        <a class="badge badge-success" href="pages_admin_view_single_enrollment.php?en_id=<?php echo $row->en_id; ?>&cc_id=<?php echo $row->cc_id; ?>&c_id=<?php echo $row->c_id; ?>&i_id=<?php echo $row->i_id; ?>&s_id=<?php echo $row->s_id; ?>">
                                                            <i class="fas fa-eye"></i> <i class=" fas fa-pallet"></i>
                                                            View Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Student Records </h4>
                                <div class="table-responsive">
                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>RegNo.</th>
                                                <th>PhoneNo.</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT  * FROM  lms_student";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            while ($row = $res->fetch_object()) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $row->s_name; ?></td>
                                                    <td><?php echo $row->s_regno; ?></td>
                                                    <td><?php echo $row->s_phoneno; ?></td>
                                                    <td><?php echo $row->s_dob; ?></td>
                                                    <td><?php echo $row->s_gender; ?></td>
                                                    <td>
                                                        <a class="badge badge-success" href="pages_admin_view_single_student.php?s_id=<?php echo $row->s_id; ?>&s_regno=<?php echo $row->s_regno; ?>">
                                                            <i class="fas fa-eye"></i><i class="fas fa-user"></i> View Record
                                                        </a>
                                                    </td>
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

            <?php require_once("../partials/footer.php"); ?>

        </div>

    </div>
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>