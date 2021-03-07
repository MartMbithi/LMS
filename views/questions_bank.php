<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');
/* Add Questions */
if (isset($_POST['add_unit'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['cc_id']) && !empty($_POST['cc_id'])) {
        $cc_id = mysqli_real_escape_string($mysqli, trim($_POST['cc_id']));
    } else {
        $error = 1;
        $err = "Course ID Cannot Be Empty";
    }
    if (isset($_POST['c_code']) && !empty($_POST['c_code'])) {
        $c_code = mysqli_real_escape_string($mysqli, trim($_POST['c_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
    }
    if (isset($_POST['c_name']) && !empty($_POST['c_name'])) {
        $c_name = mysqli_real_escape_string($mysqli, trim($_POST['c_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['c_category']) && !empty($_POST['c_category'])) {
        $c_category = mysqli_real_escape_string($mysqli, trim($_POST['c_category']));
    } else {
        $error = 1;
        $err = "Course Name Cannot Be Empty";
    }

    if (isset($_POST['c_desc']) && !empty($_POST['c_desc'])) {
        $c_desc = mysqli_real_escape_string($mysqli, trim($_POST['c_desc']));
    } else {
        $error = 1;
        $err = "Description Cannot Be Empty";
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_course WHERE  c_code='$c_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($c_code == $row['c_code']) {
                $err =  "A Unit With $c_code Exists";
            }
        } else {
            $query = "INSERT INTO lms_course (cc_id, c_name, c_code, c_category, c_desc) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $cc_id, $c_name, $c_code, $c_category, $c_desc);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=units.php");
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
                            <h1 class="m-0 text-dark">Intergrated LMS - Test Questions Bank</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Exam Engine</a></li>
                                <li class="breadcrumb-item active">Units</li>
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
                                <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Unit Code</th>
                                            <th>Unit Name</th>
                                            <th>Course</th>
                                            <th>Instructor Number</th>
                                            <th>Instructor Name</th>
                                            <th>Manage Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT  *  FROM  lms_units_assaigns  ";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($units = $res->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $units->c_code; ?></td>
                                                <td><?php echo $units->c_name; ?></td>
                                                <td><?php echo $units->c_category; ?></td>
                                                <td><?php echo $units->i_number; ?></td>
                                                <td><?php echo $units->i_name; ?></td>
                                                <td>
                                                    <a class="badge badge-warning" data-toggle="modal" href="#add-<?php echo $units->ua_id; ?>">
                                                        <i class="fas fa-external-link-alt"></i>
                                                        Create Question Bank
                                                    </a>
                                                    <!-- Add Question Bank Modal -->
                                                    <div class="modal fade" id="add-<?php echo $units->ua_id; ?>">
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Create Questions Bank For <?php echo $units->c_name; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form -->
                                                                    <form method="post" enctype="multipart/form-data">

                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="exampleInputEmail1">Unit Name</label>
                                                                                <input type="text" name="c_name" value="<?php echo $units->c_name; ?>" readonly required class="form-control">
                                                                                <!-- Hidden Values -->
                                                                                <input type="hidden" name="c_id" value="<?php echo $units->c_id; ?>" readonly required class="form-control">
                                                                                <input type="hidden" name="cc_id" value="<?php echo $units->cc_id; ?>" readonly required class="form-control">
                                                                                <input type="hidden" name="i_id" value="<?php echo $units->i_id; ?>" readonly required class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="exampleInputEmail1">Unit Code</label>
                                                                                <input type="text" name="c_code" readonly value="<?php echo $units->c_code; ?>" required class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-6" style="display:none">
                                                                                <label for="exampleInputEmail1">Questions Code</label>
                                                                                <input type="text" name="q_code" readonly value="<?php echo $a; ?>-<?php echo $b; ?>" required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label for="exampleInputEmail1">Questions</label>
                                                                                <textarea type="text" name="q_details" class="form-control" id="<?php echo $units->ua_id; ?>"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="add_quiz" class="btn btn-outline-warning">Add Questions.</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                </td>
                                            </tr>
                                            <!-- CK Editor -->

                                            <script>
                                                CKEDITOR.replace('<?php echo $units->ua_id; ?>');
                                            </script>
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