<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Add Student */
if (isset($_POST['add_std'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;


    if (isset($_POST['s_regno']) && !empty($_POST['s_regno'])) {
        $s_regno = mysqli_real_escape_string($mysqli, trim($_POST['s_regno']));
    } else {
        $error = 1;
        $err = "Admo Number Cannot Be Empty";
    }

    if (isset($_POST['s_name']) && !empty($_POST['s_name'])) {
        $s_name = mysqli_real_escape_string($mysqli, trim($_POST['s_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }

    if (isset($_POST['s_email']) && !empty($_POST['s_email'])) {
        $s_email = mysqli_real_escape_string($mysqli, trim($_POST['s_email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }

    if (isset($_POST['s_phoneno']) && !empty($_POST['s_phoneno'])) {
        $s_phoneno = mysqli_real_escape_string($mysqli, trim($_POST['s_phoneno']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }

    if (isset($_POST['s_dob']) && !empty($_POST['s_dob'])) {
        $s_dob = mysqli_real_escape_string($mysqli, trim($_POST['s_dob']));
    } else {
        $error = 1;
        $err = "DOB Cannot Be Empty";
    }

    if (isset($_POST['s_gender']) && !empty($_POST['s_gender'])) {
        $s_gender = mysqli_real_escape_string($mysqli, trim($_POST['s_gender']));
    } else {
        $error = 1;
        $err = "Gender Cannot Be Empty";
    }

    if (isset($_POST['s_acc_stats']) && !empty($_POST['s_acc_stats'])) {
        $s_acc_stats = mysqli_real_escape_string($mysqli, trim($_POST['s_acc_stats']));
    } else {
        $error = 1;
        $err = "Account Status Cannot Be Empty";
    }

    if (isset($_POST['s_course']) && !empty($_POST['s_course'])) {
        $s_course = mysqli_real_escape_string($mysqli, trim($_POST['s_course']));
    } else {
        $error = 1;
        $err = "Student Course  Cannot Be Empty";
    }


    if (isset($_POST['s_pwd']) && !empty($_POST['s_pwd'])) {
        $s_pwd = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['s_pwd']))));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }

    $s_dpic = $_FILES["s_dpic"]["name"];
    move_uploaded_file($_FILES["s_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["s_dpic"]["name"]);

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_student WHERE  s_regno = '$s_regno'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($s_regno == $row['s_regno']) {
                $err =  "A Student  With $s_regno Already Exists";
            }
        } else {
            $query = "INSERT INTO lms_student (s_regno, s_course, s_name, s_email, s_pwd, s_phoneno, s_dob, s_gender, s_acc_stats, s_dpic) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssssssss', $s_regno, $s_course, $s_name, $s_email, $s_pwd, $s_phoneno, $s_dob, $s_gender, $s_acc_stats, $s_dpic);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=students.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Student */
if (isset($_POST['add_std'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['s_id']) && !empty($_POST['s_id'])) {
        $s_id = mysqli_real_escape_string($mysqli, trim($_POST['s_id']));
    } else {
        $error = 1;
        $err = "Student ID Cannot Be Empty";
    }

    if (isset($_POST['s_regno']) && !empty($_POST['s_regno'])) {
        $s_regno = mysqli_real_escape_string($mysqli, trim($_POST['s_regno']));
    } else {
        $error = 1;
        $err = "Admo Number Cannot Be Empty";
    }

    if (isset($_POST['s_name']) && !empty($_POST['s_name'])) {
        $s_name = mysqli_real_escape_string($mysqli, trim($_POST['s_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }

    if (isset($_POST['s_email']) && !empty($_POST['s_email'])) {
        $s_email = mysqli_real_escape_string($mysqli, trim($_POST['s_email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }

    if (isset($_POST['s_phoneno']) && !empty($_POST['s_phoneno'])) {
        $s_phoneno = mysqli_real_escape_string($mysqli, trim($_POST['s_phoneno']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }

    if (isset($_POST['s_dob']) && !empty($_POST['s_dob'])) {
        $s_dob = mysqli_real_escape_string($mysqli, trim($_POST['s_dob']));
    } else {
        $error = 1;
        $err = "DOB Cannot Be Empty";
    }

    if (isset($_POST['s_gender']) && !empty($_POST['s_gender'])) {
        $s_gender = mysqli_real_escape_string($mysqli, trim($_POST['s_gender']));
    } else {
        $error = 1;
        $err = "Gender Cannot Be Empty";
    }

    if (isset($_POST['s_acc_stats']) && !empty($_POST['s_acc_stats'])) {
        $s_acc_stats = mysqli_real_escape_string($mysqli, trim($_POST['s_acc_stats']));
    } else {
        $error = 1;
        $err = "Account Status Cannot Be Empty";
    }

    if (isset($_POST['s_course']) && !empty($_POST['s_course'])) {
        $s_course = mysqli_real_escape_string($mysqli, trim($_POST['s_course']));
    } else {
        $error = 1;
        $err = "Student Course  Cannot Be Empty";
    }


    $s_dpic = $_FILES["s_dpic"]["name"];
    move_uploaded_file($_FILES["s_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["s_dpic"]["name"]);

    if (!$error) {

        $query = "UPDATE lms_student SET s_regno =?, s_course =?, s_name =?, s_email =?,  s_phoneno =?, s_dob =?, s_gender =?, s_acc_stats =?, s_dpic =? WHERE s_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssssssss', $s_regno, $s_course, $s_name, $s_email, $s_phoneno, $s_dob, $s_gender, $s_acc_stats, $s_dpic, $s_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=students.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}



/* Delete student  */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $adn = "DELETE FROM lms_student WHERE s_id = '$id'";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=instructors.php");
    } else {
        $err = "Try Again Later";
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
                            <h1 class="m-0 text-dark">Intergrated LMS - Students</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Students</li>
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
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#import-modal">Import Studentrs Records </button>
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#add-modal">Add Instructor</button>
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
                                                Allowed file types: XLS, XLSX. Please, <a href="../public/sys_data/uploads/xls/Courses_Template.xlsx">Download</a> The Sample File.
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
                                                    <button type="submit" name="upload" class="btn btn-outline-warning">Upload File</button>
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
                                            <th>Name</th>
                                            <th>RegNo</th>
                                            <th>Contact</th>
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
                                        while ($students = $res->fetch_object()) {

                                        ?>

                                            <tr>
                                                <td><?php echo $students->s_name; ?></td>
                                                <td><?php echo $students->s_regno; ?></td>
                                                <td><?php echo $students->s_phone_no; ?></td>
                                                <td><?php echo date('d M Y', strtotime($students->s_dob)); ?></td>
                                                <td><?php echo $students->s_gender;?></td>
                                                <td>
                                                    <a class="badge badge-warning" href="view_student.php?view=<?php echo $students->s_id; ?>">
                                                        <i class="fas fa-external-link-alt"></i>
                                                        View
                                                    </a>

                                                    <a class="badge badge-warning" data-toggle="modal" href="#update-<?php echo $students->s_id; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Update
                                                    </a>
                                                    <!-- Update Modal -->
                                                    <div class="modal fade" id="update-<?php echo $students->s_id; ?>">
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Update <?php echo $students->s_name; ?> Details</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form -->
                                                                    
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Update Modal -->

                                                    <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $students->s_id; ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete-<?php echo $students->s_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete <?php echo $students->s_name; ?> Details</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                    <a href="students.php?delete=<?php echo $students->s_id;?>" class="text-center btn btn-outline-warning"> Delete </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Delete Modal -->
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