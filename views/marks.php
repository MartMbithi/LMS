<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');
/* Add Course */
if (isset($_POST['add_course_cat'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['cc_name']) && !empty($_POST['cc_name'])) {
        $cc_name = mysqli_real_escape_string($mysqli, trim($_POST['cc_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['cc_code']) && !empty($_POST['cc_code'])) {
        $cc_code = mysqli_real_escape_string($mysqli, trim($_POST['cc_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
    }
    if (isset($_POST['cc_dept_head']) && !empty($_POST['cc_dept_head'])) {
        $cc_dept_head = mysqli_real_escape_string($mysqli, trim($_POST['cc_dept_head']));
    } else {
        $error = 1;
        $err = "Course HOD Cannot Be Empty";
    }
    if (isset($_POST['cc_desc']) && !empty($_POST['cc_desc'])) {
        $cc_desc = mysqli_real_escape_string($mysqli, trim($_POST['cc_desc']));
    } else {
        $error = 1;
        $err = "Description Cannot Be Empty";
    }

    $cc_dpic = $_FILES["cc_dpic"]["name"];
    move_uploaded_file($_FILES["cc_dpic"]["tmp_name"], "../public/sys_data/uploads/courses/" . $_FILES["cc_dpic"]["name"]);

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_course_categories WHERE  cc_code='$cc_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($cc_code == $row['cc_code']) {
                $err =  "A Course With $cc_code Exists";
            }
        } else {
            $query = "INSERT INTO lms_course_categories (cc_name, cc_code, cc_dept_head, cc_desc, cc_dpic) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $cc_name, $cc_code, $cc_dept_head, $cc_desc, $cc_dpic);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=courses.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

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
                            <h1 class="m-0 text-dark">Intergrated LMS - Students Enrollments</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
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
                                        $ret = "SELECT  * FROM  lms_enrollments";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($enrollment = $res->fetch_object()) {
                                            $mysqlDateTime = $row->en_date;

                                        ?>
                                            <tr>
                                                <td><?php echo $enrollment->s_unit_code; ?></td>
                                                <td><?php echo $enrollment->s_unit_name; ?></td>
                                                <td><?php echo $enrollment->s_regno; ?></td>
                                                <td><?php echo $enrollment->s_name; ?></td>
                                                <td><?php echo date("d M Y g:ia", strtotime($mysqlDateTime)); ?></td>
                                                <td>
                                                    <a class="badge badge-warning" href="#grade-<?php echo $enrollment->en_id; ?>">
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
                                                                            <button type="submit" name="add_results" class="btn btn-outline-warning">Add Marks</button>
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