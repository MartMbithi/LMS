<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');
/* Add Questions */
if (isset($_POST['add_answers_bank'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['q_id']) && !empty($_POST['q_id'])) {
        $q_id = mysqli_real_escape_string($mysqli, trim($_POST['q_id']));
    } else {
        $error = 1;
        $err = "Question ID Cannot Be Empty";
    }
    if (isset($_POST['an_code']) && !empty($_POST['an_code'])) {
        $an_code = mysqli_real_escape_string($mysqli, trim($_POST['an_code']));
    } else {
        $error = 1;
        $err = "Answer Code Cannot Be Empty";
    }
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

    if (isset($_POST['q_details']) && !empty($_POST['q_details'])) {
        $q_details = $_POST['q_details'];
    } else {
        $error = 1;
        $err = "Question Description Cannot Be Empty";
    }

    if (isset($_POST['ans_details']) && !empty($_POST['ans_details'])) {
        $ans_details = $_POST['ans_details'];
    } else {
        $error = 1;
        $err = "Question Description Cannot Be Empty";
    }

    if (isset($_POST['q_code']) && !empty($_POST['q_code'])) {
        $q_code = mysqli_real_escape_string($mysqli, trim($_POST['q_code']));
    } else {
        $error = 1;
        $err = "Question Code Cannot Be Empty";
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_answers WHERE  an_code='$an_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($an_code == $row['an_code']) {
                $err =  "An Answer Bank With $an_code Exists";
            }
        } else {
            $query = "INSERT INTO lms_answers (q_code, cc_id, c_id, c_code, i_id, q_id, an_code, c_name, q_details, ans_details) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssssssssss', $q_code, $cc_id, $c_id, $c_code, $i_id, $q_id, $an_code, $c_name, $q_details, $ans_details);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=answers_bank.php");
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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Answers Bank</h1>
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
                        <div class="container">
                            <div class="text-right text-dark">
                                <a class="btn btn-warning" href="manage_answers_bank.php">Manage Answers Bank</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Questions Code</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $ret = "SELECT  * FROM  lms_questions  ";
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
                                                        <a class="badge badge-warning" data-toggle="modal" href="#add-<?php echo $questions->q_id; ?>">
                                                            <i class="fas fa-external-link-alt"></i>
                                                            Create Answers Bank
                                                        </a>
                                                        <!-- Add Answer Bank Modal -->
                                                        <div class="modal fade" id="add-<?php echo $questions->q_id; ?>">
                                                            <div class="modal-dialog  modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-center">
                                                                        <h4 class="modal-title ">Create Answers Bank For <?php echo $questions->q_code; ?></h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">
                                                                            <div class="row" style="display:none">
                                                                                <div class="form-group col-md-6" style="display:none">
                                                                                    <label for="exampleInputEmail1">Ans Code</label>
                                                                                    <input type="text" name="an_code" readonly value="<?php echo $a; ?>-<?php echo $b; ?>" required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Unit Name</label>
                                                                                    <input type="text" name="c_name" value="<?php echo $questions->c_name; ?>" readonly required class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Unit Code</label>
                                                                                    <input type="text" name="c_code" value="<?php echo $questions->c_code; ?>" required class="form-control">
                                                                                    <textarea type="text" name="q_details" class="form-control"><?php echo $questions->q_details; ?></textarea>
                                                                                    <input type="text" name="q_code" value="<?php echo $questions->q_code; ?>" readonly required class="form-control">
                                                                                    <input type="text" name="cc_id" value="<?php echo $questions->cc_id; ?>" readonly required class="form-control">
                                                                                    <input type="text" name="c_id" value="<?php echo $questions->c_id; ?>" readonly required class="form-control">
                                                                                    <input type="text" name="i_id" value="<?php echo $questions->i_id; ?>" readonly required class="form-control">
                                                                                    <input type="text" name="q_id" value="<?php echo $questions->q_id; ?>" readonly required class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Questions</label>
                                                                                    <p>
                                                                                        <?php echo $questions->q_details; ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Answers</label>
                                                                                    <textarea type="text" name="ans_details" class="form-control" id="ans-editor-<?php echo $questions->q_id; ?>"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="text-right">
                                                                                <button type="submit" name="add_answers_bank" class="btn btn-outline-warning">Answer Questions</button>
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
                                                    <!-- CK Editor -->
                                                    <script>
                                                        CKEDITOR.replace('ans-editor-<?php echo $questions->q_id; ?>');
                                                    </script>
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