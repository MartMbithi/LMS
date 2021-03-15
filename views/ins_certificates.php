<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Enter Student Certificate */
if (isset($_POST['add_cert'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['en_id']) && !empty($_POST['en_id'])) {
        $en_id = mysqli_real_escape_string($mysqli, trim($_POST['en_id']));
    } else {
        $error = 1;
        $err = "Enrollment ID Cannont  Be Empty";
    }
    if (isset($_POST['s_id']) && !empty($_POST['s_id'])) {
        $s_id = mysqli_real_escape_string($mysqli, trim($_POST['s_id']));
    } else {
        $error = 1;
        $err = "Student ID Cannot Be Empty";
    }
    if (isset($_POST['i_id']) && !empty($_POST['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_POST['i_id']));
    } else {
        $error = 1;
        $err = "Instructor ID Cannot Be Empty";
    }
    if (isset($_POST['en_date']) && !empty($_POST['en_date'])) {
        $en_date = mysqli_real_escape_string($mysqli, trim($_POST['en_date']));
    } else {
        $error = 1;
        $err = "Enrolled Date Cannot Be Empty";
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
    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Instructor Name Cannot Be Empty";
    }

    if (!$error) {
        $query = "INSERT INTO lms_certs (en_id, s_id, i_id, en_date, s_name, s_regno, s_unit_code, s_unit_name, i_name) VALUES (?,?,?,?,?,?,?,?,?) ";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssss', $en_id, $s_id, $i_id, $en_date, $s_name, $s_regno, $s_unit_code, $s_unit_name, $i_name);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=ins_generate_certificates.php");
        } else {
            $info = "Please Try Again Or Try Later";
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Certificates</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Certificates</li>
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
                                <a href="ins_generate_certificates.php" class="btn btn-outline-warning">Generate Certificates</a>
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
                                                            Add Certificate
                                                        </a>
                                                        <!-- Grade Modal -->
                                                        <div class="modal fade" id="grade-<?php echo $enrollment->en_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Add Certficate For <?php echo $enrollment->s_name . " " . $enrollment->s_admno; ?> </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4" style="display:none">
                                                                                    <input type="text" name="en_id" value="<?php echo $enrollment->en_id; ?>" required class="form-control">
                                                                                    <input type="text" name="s_id" value="<?php echo $enrollment->s_id; ?>" required class="form-control">
                                                                                    <input type="text" name="i_id" value="<?php echo $enrollment->i_id; ?>" required class="form-control">
                                                                                    <input type="text" name="en_date" value="<?php echo date('d M Y g:ia', strtotime($enrollment->en_date)); ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>Registration Number</label>
                                                                                    <input type="text" name="s_regno" required value="<?php echo $enrollment->s_regno; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>Name</label>
                                                                                    <input type="text" name="s_name" value="<?php echo $enrollment->s_name; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label>Instructor Name</label>
                                                                                    <input type="text" name="i_name" value="<?php echo $enrollment->i_name; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Code</label>
                                                                                    <input type="text" name="s_unit_code" value="<?php echo $enrollment->s_unit_code; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Name</label>
                                                                                    <input type="text" name="s_unit_name" required value="<?php echo $enrollment->s_unit_name; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="add_cert" class="btn btn-outline-warning">Add Cert</button>
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