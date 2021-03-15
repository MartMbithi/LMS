<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Add Enrollment */
if (isset($_POST['enroll_student'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['cc_id']) && !empty($_POST['cc_id'])) {
        $cc_id = mysqli_real_escape_string($mysqli, trim($_POST['cc_id']));
    } else {
        $error = 1;
        $err = "Course ID Cannot Be Empty";
    }

    if (isset($_POST['c_id']) && !empty($_POST['c_id'])) {
        $c_id = mysqli_real_escape_string($mysqli, trim($_POST['c_id']));
    } else {
        $error = 1;
        $err = "Unit ID Cannot Be Empty";
    }
    if (isset($_POST['s_unit_code']) && !empty($_POST['s_unit_code'])) {
        $s_unit_code = mysqli_real_escape_string($mysqli, trim($_POST['s_unit_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
    }
    if (isset($_POST['s_unit_name']) && !empty($_POST['s_unit_name'])) {
        $s_unit_name = mysqli_real_escape_string($mysqli, trim($_POST['s_unit_name']));
    } else {
        $error = 1;
        $err = "Unit Name Cannot Be Empty";
    }

    if (isset($_POST['i_id']) && !empty($_POST['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_POST['i_id']));
    } else {
        $error = 1;
        $err = "Instructor Id Cannot Be Empty";
    }

    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Instructor Name Cannot Be Empty";
    }

    if (isset($_POST['s_name']) && !empty($_POST['s_name'])) {
        $s_name = mysqli_real_escape_string($mysqli, trim($_POST['s_name']));
    } else {
        $error = 1;
        $err = "Student Name Cannot Be Empty";
    }

    if (isset($_POST['s_id']) && !empty($_POST['s_id'])) {
        $s_id = mysqli_real_escape_string($mysqli, trim($_POST['s_id']));
    } else {
        $error = 1;
        $err = "Student Id Cannot Be Empty";
    }

    if (isset($_POST['s_regno']) && !empty($_POST['s_regno'])) {
        $s_regno = mysqli_real_escape_string($mysqli, trim($_POST['s_regno']));
    } else {
        $error = 1;
        $err = "Student Registration Number Cannot Be Empty";
    }

    if (isset($_POST['s_course']) && !empty($_POST['s_course'])) {
        $s_course = mysqli_real_escape_string($mysqli, trim($_POST['s_course']));
    } else {
        $error = 1;
        $err = "Course Cannot Be Empty";
    }

    if (!$error) {
        $sql = "SELECT * FROM  lms_enrollments WHERE  s_regno ='$s_regno' AND s_unit_code = '$s_unit_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (($s_regno == $row['s_regno']) && ($s_unit_code == $row['s_unit_code'])) {
                $err =  "$s_name Already Enrolled To $s_unit_name ";
            }
        } else {

            $query = "INSERT INTO lms_enrollments (s_id, s_name, s_regno, s_unit_code, s_unit_name, i_name, cc_id, c_id, i_id, s_course) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssssssss', $s_id, $s_name, $s_regno, $s_unit_code, $s_unit_name, $i_name, $cc_id, $c_id, $i_id, $s_course);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=ins_unit_enrollments.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}


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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Students Enrollments</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Enrollments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="text-right text-dark">
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#add-modal">Add Student Enrollment</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Add   Modal -->
                                <div class="modal fade" id="add-modal">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Fill All Given Fields</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form -->
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Unit Code</label>
                                                            <select name="s_unit_code" style="width: 100%;" onchange="GetAllocatedUnitDetails(this.value)" id="Allocated_Unit_Code" required class="form-control select2bs4">
                                                                <option>Select Unit Code</option>
                                                                <?php
                                                                $id = $_SESSION['i_id'];
                                                                $ret = "SELECT  * FROM  lms_units_assaigns WHERE i_id = '$id' ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($allocated = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $allocated->c_code; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Unit Name</label>
                                                            <input type="text" id="Allocated_Unit_Name" name="s_unit_name" required class="form-control">
                                                            <input type="hidden" name="i_name" id="Allocated_Ins_Name" required class="form-control">
                                                            <input type="hidden" name="cc_id" id="Allocated_Course_ID" required class="form-control">
                                                            <input type="hidden" name="c_id" id="Allocated_Unit_ID" required class="form-control">
                                                            <input type="hidden" name="i_id" id="Allocated_Ins_ID" required class="form-control">
                                                            <input type="hidden" name="s_course" id="Allocated_Course_Name" required class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Student Admission Number</label>
                                                            <select name="s_regno" style="width: 100%;" onchange="GetStudentDetails(this.value)" id="Std_Admn" required class="form-control select2bs4">
                                                                <option>Select Admission Number</option>
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_student";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($std = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $std->s_regno; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Student Name</label>
                                                            <input type="text" name="s_name" id="Std_Name" required class="form-control">
                                                            <input type="hidden" name="s_id" id="Std_Id" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button type="submit" name="enroll_student" class="btn btn-outline-warning">Enroll Student </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Add  Modal -->

                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Std Name</th>
                                                <th>Std RegNo</th>
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
                                            <?php
                                            } ?>
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
<?php
} ?>