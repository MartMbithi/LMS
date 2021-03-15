<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
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
                $success = "Added" && header("refresh:1; url=ins_students.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Student */
if (isset($_POST['update_student'])) {
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

    $s_dpic = $_FILES["s_dpic"]["name"];
    move_uploaded_file($_FILES["s_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["s_dpic"]["name"]);

    if (!$error) {

        $query = "UPDATE lms_student SET s_regno =?,  s_name =?, s_email =?,  s_phoneno =?, s_dob =?, s_gender =?, s_acc_stats =?, s_dpic =? WHERE s_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssssssss', $s_regno, $s_name, $s_email, $s_phoneno, $s_dob, $s_gender, $s_acc_stats, $s_dpic, $s_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=ins_students.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}



/* Bulk Import Students */

use MartDevelopersIncAPI\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once('../config/DataSource.php');
$db = new DataSource();
$conn = $db->getConnection();
require_once('../vendor/autoload.php');

if (isset($_POST["upload"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    /* Where Magic Happens */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = '../public/sys_data/uploads/xls/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i++) {


            $s_regno = "";
            if (isset($spreadSheetAry[$i][0])) {
                $s_regno = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }

            $s_name = "";
            if (isset($spreadSheetAry[$i][1])) {
                $s_name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            $s_email = "";
            if (isset($spreadSheetAry[$i][2])) {
                $s_email = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }

            $s_phoneno = "";
            if (isset($spreadSheetAry[$i][3])) {
                $s_phoneno = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }

            $s_dob = "";
            if (isset($spreadSheetAry[$i][4])) {
                $s_dob = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }

            $s_gender = "";
            if (isset($spreadSheetAry[$i][5])) {
                $s_gender = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }

            $s_acc_stats = "";
            if (isset($spreadSheetAry[$i][5])) {
                $s_acc_stats = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }

            $s_course = "";
            if (isset($spreadSheetAry[$i][6])) {
                $s_course = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
            }

            /* Convert Student Password To Bunch Of Jumble Mumble */
            $s_pwd = "";
            if (isset($spreadSheetAry[$i][8])) {
                $s_pwd = sha1(md5(mysqli_real_escape_string($conn, $spreadSheetAry[$i][8])));
            }


            if (!empty($s_email) || !empty($s_regno) || !empty($s_phoneno)) {
                $query = "INSERT INTO lms_student (s_regno, s_course, s_name, s_email, s_pwd, s_phoneno, s_dob, s_gender, s_acc_stats) VALUES (?,?,?,?,?,?,?,?,?)";
                $paramType = "sssssssss";
                $paramArray = array(
                    $s_regno,
                    $s_course,
                    $s_name,
                    $s_email,
                    $s_pwd,
                    $s_phoneno,
                    $s_dob,
                    $s_gender,
                    $s_acc_stats
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $success = "Students Data Imported";
                } else {
                    $err = "Data Import Failed";
                }
            }
        }
    } else {
        $info = "Invalid File Type. Upload Excel File.";
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Students</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
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
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#add-modal">Add Student</button>
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
                                                    Allowed file types: XLS, XLSX. Please, <a href="../public/sys_data/uploads/xls/Students_Template.xlsx">Download</a> The Sample File.
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
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Registration Number</label>
                                                            <input type="text" name="s_regno" value="<?php echo $a . "" . $b; ?>" required class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Full Name</label>
                                                            <input type="text" name="s_name" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Phone Number</label>
                                                            <input type="text" name="s_phoneno" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Date Of Birth</label>
                                                            <input type="text" name="s_dob" class="form-control" placeholder="DD/MM/YYYY">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Course</label>
                                                            <select class="custom-select" id="inputGroupSelect03" name="s_course">
                                                                <option selected>Choose...</option>
                                                                <?php
                                                                $ret = "SELECT  * FROM  lms_course_categories";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($row = $res->fetch_object()) {
                                                                ?>
                                                                    <option><?php echo $row->cc_name; ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Gender</label>
                                                            <select class="custom-select" id="inputGroupSelect03" name="s_gender">
                                                                <option selected>Choose...</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="exampleInputEmail1">Email address</label>
                                                            <input type="email" name="s_email" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="exampleInputEmail1">Password</label>
                                                            <input type="password" name="s_pwd" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="exampleInputFile">Student Passport</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input required name="s_dpic" type="file" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4" style="display:none">
                                                            <label for="exampleInputEmail1">Student Account Status</label>
                                                            <input type="text" name="s_acc_stats" value="Active" class="form-control">
                                                        </div>

                                                    </div>

                                                    <hr>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_std" class="btn btn-outline-warning">Add Student</button>
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
                                                <th>Name</th>
                                                <th>RegNo</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Account Status</th>
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
                                                    <td><?php echo $students->s_email; ?></td>
                                                    <td><?php echo $students->s_phoneno; ?></td>
                                                    <td><?php echo $students->s_acc_stats; ?></td>
                                                    <td><?php echo date('d M Y', strtotime($students->s_dob)); ?></td>
                                                    <td><?php echo $students->s_gender; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="ins_view_student.php?view=<?php echo $students->s_id; ?>">
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
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Registration Number</label>
                                                                                    <input type="text" name="s_regno" value="<?php echo $students->s_regno; ?>" required class="form-control">
                                                                                    <input type="hidden" name="s_id" value="<?php echo $students->s_id; ?>" required class="form-control">

                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Full Name</label>
                                                                                    <input type="text" name="s_name" value="<?php echo $students->s_name; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Phone Number</label>
                                                                                    <input type="text" name="s_phoneno" value="<?php echo $students->s_phoneno; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Date Of Birth</label>
                                                                                    <input type="text" name="s_dob" value="<?php echo date('d M Y', strtotime($students->s_dob)); ?>" class="form-control" placeholder="DD/MM/YYYY">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Gender</label>
                                                                                    <select class="custom-select" id="inputGroupSelect03" name="s_gender">
                                                                                        <option selected><?php echo $students->s_gender; ?></option>
                                                                                        <option value="Male">Male</option>
                                                                                        <option value="Female">Female</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                                    <input type="email" name="s_email" value="<?php echo $students->s_email; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputFile">Student Passport</label>
                                                                                    <div class="input-group">
                                                                                        <div class="custom-file">
                                                                                            <input required name="s_dpic" type="file" class="custom-file-input" id="exampleInputFile">
                                                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Account Status</label>
                                                                                    <select class="custom-select" id="inputGroupSelect03" name="s_acc_stats">
                                                                                        <option selected><?php echo $students->s_acc_stats; ?></option>
                                                                                        <option>Active</option>
                                                                                        <option>Disabled</option>
                                                                                    </select>
                                                                                </div>

                                                                            </div>

                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_student" class="btn btn-outline-warning">Update Student</button>
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