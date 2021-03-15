<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Add Instructor */
if (isset($_POST['add_ins'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['i_number']) && !empty($_POST['i_number'])) {
        $i_number = mysqli_real_escape_string($mysqli, trim($_POST['i_number']));
    } else {
        $error = 1;
        $err = "Number Cannot Be Empty";
    }

    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }

    if (isset($_POST['i_email']) && !empty($_POST['i_email'])) {
        $i_email = mysqli_real_escape_string($mysqli, trim($_POST['i_email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }

    if (isset($_POST['i_phone']) && !empty($_POST['i_phone'])) {
        $i_phone = mysqli_real_escape_string($mysqli, trim($_POST['i_phone']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }

    if (isset($_POST['i_pwd']) && !empty($_POST['i_pwd'])) {
        $i_pwd = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['i_pwd']))));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }

    $i_dpic = $_FILES["i_dpic"]["name"];
    move_uploaded_file($_FILES["i_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["i_dpic"]["name"]); //move uploaded image

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_instructor WHERE  i_number='$i_number'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($i_number == $row['i_number']) {
                $err =  "An INstructor  With $i_number Already Exists";
            }
        } else {
            $query = "INSERT INTO lms_instructor (i_number, i_name, i_phone, i_email, i_pwd, i_dpic) VALUES (?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssss', $i_number, $i_name, $i_phone, $i_email, $i_pwd, $i_dpic);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=instructors.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

/* Update Instructor */
if (isset($_POST['update_ins'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['i_id']) && !empty($_POST['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_POST['i_id']));
    } else {
        $error = 1;
        $err = "Instructor ID Cannot Be Empty";
    }

    if (isset($_POST['i_number']) && !empty($_POST['i_number'])) {
        $i_number = mysqli_real_escape_string($mysqli, trim($_POST['i_number']));
    } else {
        $error = 1;
        $err = "Number Cannot Be Empty";
    }

    if (isset($_POST['i_name']) && !empty($_POST['i_name'])) {
        $i_name = mysqli_real_escape_string($mysqli, trim($_POST['i_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }

    if (isset($_POST['i_email']) && !empty($_POST['i_email'])) {
        $i_email = mysqli_real_escape_string($mysqli, trim($_POST['i_email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }

    if (isset($_POST['i_phone']) && !empty($_POST['i_phone'])) {
        $i_phone = mysqli_real_escape_string($mysqli, trim($_POST['i_phone']));
    } else {
        $error = 1;
        $err = "Phone Cannot Be Empty";
    }



    $i_dpic = $_FILES["i_dpic"]["name"];
    move_uploaded_file($_FILES["i_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["i_dpic"]["name"]); //move uploaded image

    if (!$error) {

        $query = "UPDATE lms_instructor SET i_number =?, i_name =?, i_phone =?, i_email =?, i_dpic =? WHERE i_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssssss', $i_number, $i_name, $i_phone, $i_email, $i_dpic, $i_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Updated" && header("refresh:1; url=instructors.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Delete Instructor */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $adn = "DELETE FROM lms_instructor WHERE i_id = '$id'";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=instructors.php");
    } else {
        $err = "Try Again Later";
    }
}


/* Bulk Import Instructors */

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


            $i_number = "";
            if (isset($spreadSheetAry[$i][0])) {
                $i_number = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }

            $i_name = "";
            if (isset($spreadSheetAry[$i][1])) {
                $i_name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            $i_email = "";
            if (isset($spreadSheetAry[$i][2])) {
                $i_email = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }

            $i_phone = "";
            if (isset($spreadSheetAry[$i][3])) {
                $i_phone = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }

            $i_pwd = "";
            if (isset($spreadSheetAry[$i][4])) {
                $i_pwd = sha1(md5(mysqli_real_escape_string($conn, $spreadSheetAry[$i][4])));
            }


            if (!empty($i_email) || !empty($i_number) || !empty($i_name)) {
                $query = "INSERT INTO lms_instructor (i_number, i_name, i_phone, i_email, i_pwd) VALUES (?,?,?,?,?)";
                $paramType = "sssss";
                $paramArray = array(
                    $i_number,
                    $i_name,
                    $i_phone,
                    $i_email,
                    $i_pwd
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $success = "Instructors Data Imported";
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Instructors</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Instructors</li>
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
                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#import-modal">Import Instructors Records </button>
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
                                                    Allowed file types: XLS, XLSX. Please, <a href="../public/sys_data/uploads/xls/Instructors_Template.xlsx">Download</a> The Sample File.
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
                                                            <label for="exampleInputEmail1">Instructor Number</label>
                                                            <input type="text" name="i_number" value="<?php echo $a . " " . $b; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Instructor Full Name</label>
                                                            <input type="text" name="i_name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Email Address</label>
                                                            <input type="email" name="i_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Phone Number</label>
                                                            <input type="text" name="i_phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Password</label>
                                                            <input type="password" name="i_pwd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputFile">Instructor Passport</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input required name="i_dpic" accept=".png, .jpg" type="file" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_ins" class="btn btn-outline-warning">Add Instructor</button>
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
                                                <th>Number</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT  * FROM  lms_instructor";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($ins = $res->fetch_object()) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $ins->i_name; ?></td>
                                                    <td><?php echo $ins->i_number; ?></td>
                                                    <td><?php echo $ins->i_phone; ?></td>
                                                    <td><?php echo $ins->i_email; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="view_instructor.php?view=<?php echo $ins->i_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            View
                                                        </a>

                                                        <a class="badge badge-warning" data-toggle="modal" href="#update-<?php echo $ins->i_id; ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Update
                                                        </a>
                                                        <!-- Update Modal -->
                                                        <div class="modal fade" id="update-<?php echo $ins->i_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Update <?php echo $ins->i_name; ?> Details</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Instructor Number</label>
                                                                                    <input type="text" name="i_number" value="<?php echo $ins->i_number ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                                    <input type="hidden" name="i_id" value="<?php echo $ins->i_id ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Instructor Full Name</label>
                                                                                    <input type="text" name="i_name" value="<?php echo $ins->i_name; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Email Address</label>
                                                                                    <input type="email" name="i_email" value="<?php echo $ins->i_email; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Phone Number</label>
                                                                                    <input type="text" name="i_phone" value="<?php echo $ins->i_phone; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputFile">Instructor Passport</label>
                                                                                    <div class="input-group">
                                                                                        <div class="custom-file">
                                                                                            <input required name="i_dpic" accept=".png, .jpg" type="file" class="custom-file-input" id="exampleInputFile">
                                                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_ins" class="btn btn-outline-primary">Update Instructor</button>
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

                                                        <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $ins->i_id; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $ins->i_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $ins->i_name; ?> Details</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="instructors.php?delete=<?php echo $ins->i_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
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
<?php
} ?>