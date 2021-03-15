<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Add Units */
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

/* Update Unit */
if (isset($_POST['update_unit'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;


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

    if (isset($_POST['c_desc']) && !empty($_POST['c_desc'])) {
        $c_desc = mysqli_real_escape_string($mysqli, trim($_POST['c_desc']));
    } else {
        $error = 1;
        $err = "Description Cannot Be Empty";
    }

    if (!$error) {

        $query = "UPDATE lms_course SET c_name =?, c_code =?, c_desc =? WHERE c_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssss', $c_name, $c_code, $c_desc, $c_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Updated" && header("refresh:1; url=units.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Delete UNit */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_course WHERE c_id= '$id' ";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=units.php");
    } else {
        $info = "Please Try Again Or Try Later";
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Units</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
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
                        <div class="container">
                            <div class="text-right text-dark">
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#add-modal">Add Unit</button>
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
                                                            <label>Course Code</label>
                                                            <select name="c_category" style="width: 100%;" onchange="GetCourseDetails(this.value)" id="Course_Code" required class="form-control select2bs4">
                                                                <option>Select Course Code</option>
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_course_categories ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($courses = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $courses->cc_code; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Course Name</label>
                                                            <input type="text" id="Course_Name" required class="form-control">
                                                            <input type="hidden" name="cc_id" id="Course_Id" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Unit Name</label>
                                                            <input type="text" name="c_name" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Unit Code</label>
                                                            <input type="text" name="c_code" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Unit Description</label>
                                                            <textarea type="text" name="c_desc" class="form-control" id="editor"></textarea>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_unit" class="btn btn-outline-warning">Add Unit</button>
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
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT  * FROM  lms_course ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($units = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $units->c_code; ?></td>
                                                    <td><?php echo $units->c_name; ?></td>
                                                    <td><?php echo $units->c_category; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="view_unit.php?view=<?php echo $units->c_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            View
                                                        </a>

                                                        <a class="badge badge-warning" data-toggle="modal" href="#update-<?php echo $units->c_id; ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Update
                                                        </a>
                                                        <!-- Update Modal -->
                                                        <div class="modal fade" id="update-<?php echo $units->c_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Update <?php echo $units->c_name; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Name</label>
                                                                                    <input type="text" name="c_name" required value="<?php echo $units->c_name; ?>" class="form-control">
                                                                                    <input type="hidden" name="c_id" value="<?php echo $units->c_id; ?>" required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label>Unit Code</label>
                                                                                    <input type="text" name="c_code" value="<?php echo $units->c_code; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label>Unit Description</label>
                                                                                    <textarea type="text" name="c_desc" class="form-control" id="<?php echo $units->c_id; ?>"><?php echo $units->c_desc; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_unit" class="btn btn-outline-warning">Update Unit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Update Modal -->

                                                        <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $units->c_id; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $units->c_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $units->c_code; ?> - <?php echo $units->c_name; ?> ?</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="units.php?delete=<?php echo $units->c_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete Modal -->
                                                    </td>
                                                    <!-- CK Editors -->
                                                    <script>
                                                        CKEDITOR.replace('<?php echo $units->c_id; ?>');
                                                    </script>
                                                    <!-- End Editors -->
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