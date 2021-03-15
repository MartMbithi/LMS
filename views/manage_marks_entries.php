<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Update Marks */
if (isset($_POST['update_marks'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['rs_id']) && !empty($_POST['rs_id'])) {
        $rs_id = mysqli_real_escape_string($mysqli, trim($_POST['rs_id']));
    } else {
        $error = 1;
        $err = "Marks Entry ID  Cannont  Be Empty";
    }

    if (isset($_POST['rs_code']) && !empty($_POST['rs_code'])) {
        $rs_code = mysqli_real_escape_string($mysqli, trim($_POST['rs_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
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

    if (!$error) {
        $query = "UPDATE lms_results SET rs_code =?, c_cat1_marks =?, c_cat2_marks =?,  c_eos_marks =? WHERE rs_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sssss', $rs_code, $c_cat1_marks, $c_cat2_marks, $c_eos_marks, $rs_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Updated" && header("refresh:1; url=manage_marks_entries.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Marks */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_results WHERE rs_id= '$id' ";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=manage_marks_entries.php");
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Students Marks Entries</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Marks Entries</a></li>
                                    <li class="breadcrumb-item active">Manage Entries</li>
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
                                <a href="marks.php" class="btn btn-outline-warning">Add Marks Entries</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-2" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Entry Code</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Std Admn</th>
                                                <th>Std Name</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ret = "SELECT  * FROM  lms_results";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($results = $res->fetch_object()) {
                                                $mysqlDateTime = $results->c_date_added; ?>
                                                <tr>
                                                    <td><?php echo $results->rs_code; ?></td>
                                                    <td><?php echo $results->s_unit_code; ?></td>
                                                    <td><?php echo $results->s_unit_name; ?></td>
                                                    <td><?php echo $results->s_regno; ?></td>
                                                    <td><?php echo $results->s_name; ?>
                                                    <td><?php echo date("d M Y", strtotime($mysqlDateTime)); ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="view_marks_entry.php?view=<?php echo $results->rs_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            View
                                                        </a>

                                                        <a class="badge badge-warning" data-toggle="modal" href="#update-<?php echo $results->rs_id; ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Update
                                                        </a>
                                                        <!-- Update Modal -->
                                                        <div class="modal fade" id="update-<?php echo $results->rs_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Update <?php echo $results->s_regno . "  " . $results->s_name; ?> Marks Entry</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label>Entry Code</label>
                                                                                    <input type="text" name="rs_code" value="<?php echo $results->rs_code; ?>" required class="form-control">
                                                                                    <input type="hidden" name="rs_id" value="<?php echo $results->rs_id; ?>" required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label>CAT 1 Marks</label>
                                                                                    <input type="text" name="c_cat1_marks" value="<?php echo $results->c_cat1_marks; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label>CAT 2 Marks</label>
                                                                                    <input type="text" name="c_cat2_marks" value="<?php echo $results->c_cat2_marks; ?>" required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label>End Of Semester Exam Marks</label>
                                                                                    <input type="text" name="c_eos_marks" value="<?php echo $results->c_eos_marks; ?>" class="form-control">
                                                                                </div>

                                                                            </div>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_marks" class="btn btn-outline-warning">Update Marks</button>
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

                                                        <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $results->rs_id; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $results->rs_id; ?>" tabindex="-1" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $results->s_regno . " - " .  $results->s_name; ?> Marks Entry Record ?</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="manage_marks_entries.php?delete=<?php echo $results->rs_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
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