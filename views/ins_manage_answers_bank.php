<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Update Answers */
if (isset($_POST['update_ans_bank'])) {
    $error = 0;

    if (isset($_POST['ans_details']) && !empty($_POST['ans_details'])) {
        $ans_details = $_POST['ans_details'];
    } else {
        $error = 1;
        $err = "Question Description Cannot Be Empty";
    }

    /* if (isset($_POST['an_code']) && !empty($_POST['an_code'])) {
        $an_code = mysqli_real_escape_string($mysqli, trim($_POST['an_code']));
    } else {
        $error = 1;
        $err = "Answer Code Cannot Be Empty";
    } */

    if (isset($_POST['an_id']) && !empty($_POST['an_id'])) {
        $an_id = mysqli_real_escape_string($mysqli, trim($_POST['an_id']));
    } else {
        $error = 1;
        $err = "Answer ID Cannot Be Empty";
    }
    if (!$error) {
        $query = "UPDATE lms_answers SET ans_details =? WHERE an_id = '$an_id' ";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('s', $ans_details);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=ins_manage_answers_bank.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Delete Answers Bank */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_answers WHERE an_id= '$id' ";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=ins_manage_answers_bank.php");
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Test Answers Bank</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Exam Engine</a></li>
                                    <li class="breadcrumb-item active">Answers Bank</li>
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
                                <a class="btn btn-warning" href="ins_answers_bank.php">Add Answers Bank</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Answer Bank Code</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Manage Answers Bank</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  *  FROM  lms_answers WHERE i_id = '$id' ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($answers = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $answers->an_code; ?></td>
                                                    <td><?php echo $answers->c_code; ?></td>
                                                    <td><?php echo $answers->c_name; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="ins_view_answers_bank.php?view=<?php echo $answers->an_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            View Bank
                                                        </a>
                                                        <a class="badge badge-warning" data-toggle="modal" href="#edit-<?php echo $answers->an_id; ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Update Bank
                                                        </a>
                                                        <!-- Update -->
                                                        <div class="modal fade" id="edit-<?php echo $answers->an_id; ?>">
                                                            <div class="modal-dialog  modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Answers Bank <?php echo $answers->an_code; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">

                                                                            <div class="row" style="display: none;">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Questions Bank Code</label>
                                                                                    <!-- Hidden Values -->
                                                                                    <input type="hidden" name="an_id" value="<?php echo $answers->an_id; ?>" readonly required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Questions</label>
                                                                                    <p>
                                                                                        <?php echo $answers->q_details; ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Answers</label>
                                                                                    <textarea type="text" name="ans_details" class="form-control" id="editor-<?php echo $answers->an_id; ?>"><?php echo $answers->ans_details; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_ans_bank" class="btn btn-outline-warning">Update Answers</button>
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

                                                        <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $answers->an_id; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete Bank
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $answers->an_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $answers->an_code; ?> Bank ?</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="manage_answers_bank.php?delete=<?php echo $answers->an_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                    </td>
                                                </tr>
                                                <!-- CK Editor -->

                                                <script>
                                                    CKEDITOR.replace('editor-<?php echo $answers->an_id; ?>');
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