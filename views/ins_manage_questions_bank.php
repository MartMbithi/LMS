<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Update Questions */
if (isset($_POST['update_question_bank'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;


    if (isset($_POST['q_details']) && !empty($_POST['q_details'])) {
        $q_details = $_POST['q_details'];
    } else {
        $error = 1;
        $err = "Question Description Cannot Be Empty";
    }

    if (isset($_POST['q_code']) && !empty($_POST['q_code'])) {
        $q_code = $_POST['q_code'];
    } else {
        $error = 1;
        $err = "Question Code Cannot Be Empty";
    }

    if (isset($_POST['q_id']) && !empty($_POST['q_id'])) {
        $q_id = mysqli_real_escape_string($mysqli, trim($_POST['q_id']));
    } else {
        $error = 1;
        $err = "Question ID Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE lms_questions  SET q_details =?, q_code =? WHERE q_id = '$q_id' ";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $q_details, $q_code);
        $stmt->execute();
        if ($stmt) {
            $success = "Added" && header("refresh:1; url=ins_manage_questions_bank.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Delete Questions Bank */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_questions WHERE q_id= '$id' ";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=ins_manage_questions_bank.php");
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Test Questions Bank</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
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
                        <div class="container">
                            <div class="text-right text-dark">
                                <a class="btn btn-warning" href="ins_questions_bank.php">Add Questions Bank</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Question Bank Code</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Manage Question Bank</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  *  FROM  lms_questions  WHERE i_id = '$id'  ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($questions = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $questions->q_code; ?></td>
                                                    <td><?php echo $questions->c_code; ?></td>
                                                    <td><?php echo $questions->c_name; ?></td>
                                                    <td>
                                                        <a class="badge badge-warning" href="ins_view_bank.php?view=<?php echo $questions->q_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            View Bank
                                                        </a>
                                                        <a class="badge badge-warning" data-toggle="modal" href="#edit-<?php echo $questions->q_id; ?>">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Update Bank
                                                        </a>
                                                        <!-- Update -->
                                                        <div class="modal fade" id="edit-<?php echo $questions->q_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Question Bank <?php echo $questions->q_id; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">

                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Questions Bank Code</label>
                                                                                    <!-- Hidden Values -->
                                                                                    <input type="hidden" name="q_id" value="<?php echo $questions->q_id; ?>" readonly required class="form-control">
                                                                                    <input type="text" name="q_code" value="<?php echo $questions->q_code; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Questions</label>
                                                                                    <textarea type="text" name="q_details" class="form-control" id="editor-<?php echo $questions->q_id; ?>"><?php echo $questions->q_details; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_question_bank" class="btn btn-outline-warning">Update Questions.</button>
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

                                                        <a class="badge badge-warning" data-toggle="modal" href="#delete-<?php echo $questions->q_id; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                            Delete Bank
                                                        </a>
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $questions->q_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete <?php echo $questions->q_code; ?> Bank ?</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="manage_questions_bank.php?delete=<?php echo $questions->q_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->
                                                    </td>
                                                </tr>
                                                <!-- CK Editor -->

                                                <script>
                                                    CKEDITOR.replace('editor-<?php echo $questions->q_id; ?>');
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