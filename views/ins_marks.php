<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Enter Marks */
if (isset($_POST['enter_marks'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['s_id']) && !empty($_POST['s_id'])) {
        $s_id = mysqli_real_escape_string($mysqli, trim($_POST['s_id']));
    } else {
        $error = 1;
        $err = "Student ID Cannont  Be Empty";
    }
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
    if (isset($_POST['i_id']) && !empty($_POST['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_POST['i_id']));
    } else {
        $error = 1;
        $err = "Instructor ID Cannot Be Empty";
    }
    if (isset($_POST['rs_code']) && !empty($_POST['rs_code'])) {
        $rs_code = mysqli_real_escape_string($mysqli, trim($_POST['rs_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
    }
    if (isset($_POST['s_name']) && !empty($_POST['s_name'])) {
        $s_name = mysqli_real_escape_string($mysqli, trim($_POST['s_name']));
    } else {
        $error = 1;
        $err = "Student Name Cannot Be Empty";
    }
    if (isset($_POST['s_regno']) && !empty($_POST['s_regno'])) {
        $s_regno = mysqli_real_escape_string($mysqli, trim($_POST['s_regno']));
    } else {
        $error = 1;
        $err = "Registration Number Cannot Be Empty";
    }
    if (isset($_POST['s_unit_code']) && !empty($_POST['s_unit_code'])) {
        $s_unit_code = mysqli_real_escape_string($mysqli, trim($_POST['s_unit_code']));
    } else {
        $error = 1;
        $err = "Unit Code Cannot Be Empty";
    }
    if (isset($_POST['s_unit_name']) && !empty($_POST['s_unit_name'])) {
        $s_unit_name = mysqli_real_escape_string($mysqli, trim($_POST['s_unit_name']));
    } else {
        $error = 1;
        $err = "Unit Name Cannot Be Empty";
    }
    if (isset($_POST['c_cat1_marks']) && !empty($_POST['c_cat1_marks'])) {
        $c_cat1_marks = mysqli_real_escape_string($mysqli, trim($_POST['c_cat1_marks']));
    } else {
        $error = 1;
        $err = "Cat One Marks Cannot Be Empty";
    }
    if (isset($_POST['c_cat2_marks']) && !empty($_POST['c_cat2_marks'])) {
        $c_cat2_marks = mysqli_real_escape_string($mysqli, trim($_POST['c_cat2_marks']));
    } else {
        $error = 1;
        $err = "Cat Two Marks Cannot Be Empty";
    }
    if (isset($_POST['c_eos_marks']) && !empty($_POST['c_eos_marks'])) {
        $c_eos_marks = mysqli_real_escape_string($mysqli, trim($_POST['c_eos_marks']));
    } else {
        $error = 1;
        $err = "End Of Semester Marks Cannot Be Empty";
    }
    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Instructor Name Cannot Be Empty";
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_results WHERE  rs_code='$rs_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($rs_code == $row['rs_code']) {
                $err =  "A Marks Entry  With $rs_code Exists";
            }
        } else {
            $query = "INSERT INTO lms_results (s_id, cc_id, c_id, i_id, rs_code, s_name, s_regno, s_unit_code, s_unit_name, c_cat1_marks, c_cat2_marks,  c_eos_marks, i_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssssssssssss', $s_id, $cc_id, $c_id, $i_id, $rs_code, $s_name, $s_regno, $s_unit_code, $s_unit_name, $c_cat1_marks, $c_cat2_marks, $c_eos_marks, $i_name);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=ins_marks.php");
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
                                    <li class="breadcrumb-item active">Marks Entry</li>
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
                                <a href="ins_manage_marks_entries.php" class="btn btn-outline-warning">Manage Marks Entries</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-2" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Admission Number</th>
                                                <th>Student Name</th>
                                                <th>Enroll date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  * FROM  lms_enrollments WHERE i_id = '$id'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($enrollment = $res->fetch_object()) {
                                                $mysqlDateTime = $enrollment->en_date; ?>
                                                <tr>
                                                    <td><?php echo $enrollment->s_unit_code; ?></td>
                                                    <td><?php echo $enrollment->s_unit_name; ?></td>
                                                    <td><?php echo $enrollment->s_regno; ?></td>
                                                    <td><?php echo $enrollment->s_name; ?></td>
                                                    <td><?php echo date("d M Y g:ia", strtotime($mysqlDateTime)); ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" data-toggle="modal" href="#grade-<?php echo $enrollment->en_id; ?>">
                                                            <i class="fas fa-check"></i>
                                                            Grade Unit
                                                        </a>
                                                        <!-- Grade Modal -->
                                                        <div class="modal fade" id="grade-<?php echo $enrollment->en_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Enter Marks For <?php echo $enrollment->s_name; ?> </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4" style="display:none">
                                                                                    <label>Results Code</label>
                                                                                    <input type="text" name="rs_code" value="<?php echo $a . $b; ?>" required class="form-control">
                                                                                    <input type="text" name="s_id" value="<?php echo $enrollment->s_id; ?>" required class="form-control">
                                                                                    <input type="text" name="cc_id" value="<?php echo $enrollment->cc_id; ?>" required class="form-control">
                                                                                    <input type="text" name="c_id" value="<?php echo $enrollment->c_id; ?>" required class="form-control">
                                                                                    <input type="text" name="i_id" value="<?php echo $enrollment->i_id; ?>" required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label>Registration Number</label>
                                                                                    <input type="text" name="s_regno" readonly required value="<?php echo $enrollment->s_regno; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>Name</label>
                                                                                    <input type="text" name="s_name" readonly value="<?php echo $enrollment->s_name; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>Instructor Name</label>
                                                                                    <input type="text" name="i_name" readonly value="<?php echo $enrollment->i_name; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Code</label>
                                                                                    <input type="text" name="s_unit_code" readonly value="<?php echo $enrollment->s_unit_code; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Name</label>
                                                                                    <input type="text" name="s_unit_name" readonly required value="<?php echo $enrollment->s_unit_name; ?>" class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label>CAT 1 Marks</label>
                                                                                    <input type="text" name="c_cat1_marks" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>CAT 2 Marks</label>
                                                                                    <input type="text" name="c_cat2_marks" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>End Of Semester Exam Marks</label>
                                                                                    <input type="text" name="c_eos_marks" class="form-control">
                                                                                </div>

                                                                            </div>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="enter_marks" class="btn btn-outline-warning">Add Marks</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Grade Modal -->
                                                    </td>
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