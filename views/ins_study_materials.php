<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');
/* Add Study Materials */
if (isset($_POST['add_studymaterial'])) {
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

    if (isset($_POST['c_id']) && !empty($_POST['c_id'])) {
        $c_id = mysqli_real_escape_string($mysqli, trim($_POST['c_id']));
    } else {
        $error = 1;
        $err = "Course ID Cannot Be Empty";
    }

    if (isset($_POST['i_id']) && !empty($_POST['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_POST['i_id']));
    } else {
        $error = 1;
        $err = "Instructor ID Cannot Be Empty";
    }

    if (isset($_POST['c_category']) && !empty($_POST['c_category'])) {
        $c_category = $_POST['c_category'];
    } else {
        $error = 1;
        $err = "Course Cannot Be Empty";
    }

    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Instructor NameCannot Be Empty";
    }

    if (isset($_POST['sm_number']) && !empty($_POST['sm_number'])) {
        $sm_number = mysqli_real_escape_string($mysqli, trim($_POST['sm_number']));
    } else {
        $error = 1;
        $err = "Study Material Cannot Be Empty";
    }

    //Upload study materials.
    $sm_materials = $_FILES["sm_materials"]["name"];
    move_uploaded_file($_FILES["sm_materials"]["tmp_name"], "../public/sys_data/uploads/study_materials/" . $_FILES["sm_materials"]["name"]);

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_study_material WHERE  sm_number='$sm_number'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($sm_number == $row['sm_number']) {
                $err =  "A Study Materials With $sm_number Exists";
            }
        } else {
            $query = "INSERT INTO lms_study_material  (c_code, sm_number, c_id, cc_id, c_name, c_category, i_id, i_name, sm_materials) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssssssss', $c_code, $sm_number, $c_id, $cc_id, $c_name, $c_category, $i_id, $i_name, $sm_materials);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=ins_study_materials.php");
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Study Materials</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Study Materials</li>
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
                                <a class="btn btn-warning" href="ins_manage_study_materials.php">Manage Study Materials</a>
                            </div>
                        </div>
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
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  *  FROM  lms_units_assaigns WHERE i_id = '$i_id' ";
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
                                                            <i class="fas fa-file-upload"></i>
                                                            Upload Study Materials
                                                        </a>
                                                        <!-- Upload Study Materials Modal -->
                                                        <div class="modal fade" id="add-<?php echo $units->ua_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Share Study Materials For <?php echo $units->c_name; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">

                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="exampleInputEmail1">Unit Name</label>
                                                                                    <input type="text" name="c_name" value="<?php echo $units->c_name; ?>" readonly required class="form-control">
                                                                                    <!-- Hidden Values -->
                                                                                    <input type="hidden" name="c_id" value="<?php echo $units->c_id; ?>" readonly required class="form-control">
                                                                                    <input type="hidden" name="cc_id" value="<?php echo $units->cc_id; ?>" readonly required class="form-control">
                                                                                    <input type="hidden" name="i_id" value="<?php echo $units->i_id; ?>" readonly required class="form-control">
                                                                                    <input type="hidden" name="i_name" value="<?php echo $units->i_name; ?>" readonly required class="form-control">
                                                                                    <input type="hidden" name="c_category" value="<?php echo $units->c_category; ?>" readonly required class="form-control">

                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="exampleInputEmail1">Unit Code</label>
                                                                                    <input type="text" name="c_code" readonly value="<?php echo $units->c_code; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="exampleInputEmail1">Study Materials Code</label>
                                                                                    <input type="text" name="sm_number" readonly value="<?php echo $a; ?>-<?php echo $b; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputFile">Upload Study Materials Either in A (.pdf, .docx, .pptx) Formart </label>
                                                                                    <div class="input-group">
                                                                                        <div class="custom-file">
                                                                                            <input required name="sm_materials" type="file" class="custom-file-input" id="exampleInputFile">
                                                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="add_studymaterial" class="btn btn-outline-warning">Share Study Materials</button>
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