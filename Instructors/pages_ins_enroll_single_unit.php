<?php
session_start();
include('dist/inc/config.php');
include('dist/inc/checklogin.php');
check_login();
$i_id = $_SESSION['i_id'];

//Enroll Student

if (isset($_POST['enroll_Student'])) {
    $s_id = $_GET['s_id'];
    $s_name = $_POST['s_name'];
    $s_regno = $_POST['s_regno'];
    $s_unit_code = $_POST['s_unit_code'];
    $s_unit_name = $_POST['s_unit_name'];
    $i_name = (($_POST['i_name']));
    $cc_id = $_POST['cc_id'];
    $c_id = $_POST['c_id'];
    $i_id = $_SESSION['i_id'];
    $s_course = $_POST['s_course'];

    //sql to insert captured values
    $query = "INSERT INTO lms_enrollments (s_id, s_name, s_regno, s_unit_code, s_unit_name, i_name, cc_id, c_id, i_id, s_course) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssssss', $s_id, $s_name, $s_regno, $s_unit_code, $s_unit_name, $i_name, $cc_id, $c_id, $i_id, $s_course);
    $stmt->execute();

    if ($stmt) {
        $success = "Student Enrolled";

        //echo "<script>toastr.success('Have Fun')</script>";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<!--Head-->
<?php include("dist/inc/head.php"); ?>
<!-- ./Head -->

<body onload=display_ct();>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("dist/inc/header.php"); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("dist/inc/sidebar.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <?php
                        //load my time AI
                        include("dist/inc/time_API.php");
                        $s_id = $_GET['s_id'];
                        $ret = "SELECT  * FROM  lms_student  WHERE s_id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $s_id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {
                        ?>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Enrollments</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="pages_ins_add_enrollment.php">Add</a>
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
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enroll <?php echo $row->s_name; ?></h4>
                                <!--Add Student-->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Name</label>
                                            <input type="text" readonly name="s_name" value="<?php echo $row->s_name; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Registration Number</label>
                                            <input type="text" readonly name="s_regno" value="<?php echo $row->s_regno; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Code</label>
                                            <select name="s_unit_code" onChange="getUnit(this.value);" id="code" class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                                <option>Select Unit Code </option>
                                                <?php
                                                //get all attributes of a certain unit given the students course.
                                                $s_course = $_GET['s_course'];
                                                $i_id = $_SESSION['i_id'];
                                                $ret = "SELECT  * FROM  lms_units_assaigns WHERE c_category = ? AND i_id = ? ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->bind_param('si', $s_course, $i_id);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                $cnt = 1;
                                                while ($row = $res->fetch_object()) {
                                                    //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart

                                                ?>
                                                    <option value="<?php echo $row->c_code; ?>"> <?php echo $row->c_code; ?></option>

                                                <?php } ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Name</label>
                                            <input type="text" name="s_unit_name" readonly id="unit_name" class="form-control" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Instructor Name</label>
                                            <input type="text" name="i_name" readonly id="unit_instructor_name" class="form-control" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Course ID</label>
                                            <input type="text" name="cc_id" readonly id="course_id" class="form-control" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Unit ID</label>
                                            <input type="text" name="c_id" readonly id="unit_id" class="form-control" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Instructor Id</label>
                                            <input type="text" name="i_id" readonly id="unit_instructor_id" class="form-control" aria-describedby="emailHelp">
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">Course</label>
                                            <input type="text" name="s_course" readonly id="course_name" class="form-control" aria-describedby="emailHelp">
                                        </div>


                                    </div>

                                    <hr>

                                    <button type="submit" name="enroll_Student" class="btn btn-outline-primary">Enroll Student.</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>

                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include("dist/inc/footer.php"); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>