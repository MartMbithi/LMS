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

/* Update Course */
if (isset($_POST['update_course_cat'])) {
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
    if (isset($_POST['cc_id']) && !empty($_POST['cc_id'])) {
        $cc_id = mysqli_real_escape_string($mysqli, trim($_POST['cc_id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    $cc_dpic = $_FILES["cc_dpic"]["name"];
    move_uploaded_file($_FILES["cc_dpic"]["tmp_name"], "../public/sys_data/uploads/courses/" . $_FILES["cc_dpic"]["name"]);

    if (!$error) {
        $query = "UPDATE lms_course_categories SET cc_name =?, cc_code =?, cc_dept_head =?, cc_desc =?, cc_dpic =? WHERE cc_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssss', $cc_name, $cc_code, $cc_dept_head, $cc_desc, $cc_dpic, $cc_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=courses.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Course */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_course_categories WHERE cc_id=?";
    $stmt = $conn->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=courses.php");
    } else {
        $info = "Please Try Again Or Try Later";
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
                            <h1 class="m-0 text-dark">Intergrated LMS - Courses</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Courses</li>
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
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#import-modal">Import Courses Records </button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">Add Course</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Import  Modal -->
                            <div class="modal fade" id="import-modal">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                Allowed file types: XLS, XLSX. Please, <a href="public/templates/sample_births.xlsx">Download</a> The Sample File.
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form -->
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Select File</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input required name="file" type="file" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="upload" class="btn btn-primary">Upload File</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Import  Modal -->

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
                                                    <div class=" col-md-6">
                                                        <label>Course Name</label>
                                                        <input type="text" name="cc_name" required class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Course Code</label>
                                                        <input type="text" value="<?php echo $a; ?>-<?php echo $b; ?>" name="cc_code" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputFile">Course Logo</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input required name="cc_dpic" accept=".png, .jpg" type="file" class="custom-file-input" id="exampleInputFile">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Course Dept. Head Instructor</label>
                                                        <div class="form-group">

                                                            <select name="cc_dept_head" class="form-control select2bs4" style="width: 100%;">
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_instructor";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($instructor = $res->fetch_object()) {
                                                                ?>
                                                                    <option selected><?php echo $instructor->i_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Couse Description</label>
                                                        <textarea type="text" name="cc_desc" class="form-control" id="editor"></textarea>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="text-right">
                                                    <button type="submit" name="add_course_cat" class="btn btn-outline-primary">Add Course</button>
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
                                <table id="dash-2" class="table table-striped table-bordered display " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Dept Head</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT  * FROM  lms_course_categories";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($courses = $res->fetch_object()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $courses->cc_code; ?></td>

                                                <td><?php echo $courses->cc_name; ?></td>
                                                <td><?php echo $courses->cc_dept_head; ?></td>
                                                <td>
                                                    <a class="badge badge-success" href="pages_admin_view_single_course_cat.php?cc_id=<?php echo $courses->cc_id; ?>">
                                                        <i class="fas fa-eye"></i><i class="fas fa-archive"></i> View
                                                    </a>

                                                    <a class="badge badge-warning" data-toggle="modal" href="#update-<?php echo $courses->cc_id; ?>">
                                                        <i class="fas fa-edit"></i><i class="fas fa-archive"></i> Edit
                                                    </a>
                                                    <!-- Update Modal -->
                                                    <div class="modal fade" id="update-<?php echo $courses->cc_id; ?>">
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Update <?php echo $courses->cc_name; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form -->
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class=" col-md-6">
                                                                                <label>Course Name</label>
                                                                                <input type="text" name="cc_name" value="<?php echo $courses->cc_name; ?>" required class="form-control">
                                                                                <input type="hidden" name="cc_id" value="<?php echo $courses->cc_id; ?>" required class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label>Course Code</label>
                                                                                <input type="text" value="<?php echo $courses->cc_code; ?>" name="cc_code" required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="exampleInputFile">Course Logo</label>
                                                                                <div class="input-group">
                                                                                    <div class="custom-file">
                                                                                        <input required name="cc_dpic" type="file" class="custom-file-input" id="exampleInputFile">
                                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label>Course Dept. Head Instructor</label>
                                                                                <div class="form-group">
                                                                                    <input required type="text" name="cc_dept_head" class="form-control" value="<?php echo $courses->cc_dept_head; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label>Couse Description</label>
                                                                                <textarea type="text" name="cc_desc" rows='20' class="form-control" id="editor"><?php echo $courses->cc_desc; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="update_course_cat" class="btn btn-outline-primary">Update Course</button>
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

                                                    <a class="badge badge-danger" data-toggle="modal" href="#delete-<?php echo $courses->cc_id; ?>">
                                                        <i class="fas fa-eye"></i><i class="fas fa-archive"></i> Delete
                                                    </a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete-<?php echo $courses->cc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete <?php echo $courses->cc_code; ?> - <?php echo $courses->cc_name; ?> Record ?</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="courses.php?delete=<?php echo $courses->cc_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Delete Modal -->
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