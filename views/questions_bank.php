<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');
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
                            <h1 class="m-0 text-dark">Intergrated LMS - Test Questions Bank</h1>
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
                                            <th>Manage Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = "SELECT  *  FROM  lms_units_assaigns  ";
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
                                                    <a class="badge badge-warning" data-toggle="modal" href="#<?php echo $units->ua_id; ?>">
                                                        <i class="fas fa-external-link-alt"></i>
                                                        Create Question Bank
                                                    </a>
                                                    <!-- Add Question Bank Modal -->
                                                    <div class="modal fade" id="<?php echo $units->ua_id; ?>">
                                                        <div class="modal-dialog  modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Create Questions Bank For <?php echo $units->c_name; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form -->
                                                                    <form method="post" enctype="multipart/form-data">

                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="exampleInputEmail1">Unit Name</label>
                                                                                <input type="text" name="c_name" value="<?php echo $units->c_name; ?>" readonly required class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-6">
                                                                                <label for="exampleInputEmail1">Unit Code</label>
                                                                                <input type="text" name="c_code" readonly value="<?php echo $units->c_code; ?>" required class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-6" style="display:none">
                                                                                <label for="exampleInputEmail1">Questions Code</label>
                                                                                <input type="text" name="q_code" readonly value="<?php echo $a; ?>-<?php echo $b; ?>" required class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label for="exampleInputEmail1">Questions</label>
                                                                                <textarea type="text" name="q_details" class="form-control" id="<?php echo $units->ua_id; ?>" a></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="add_quiz" class="btn btn-outline-warning">Add Questions.</button>
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
                                                    CKEDITOR.replace('<?php echo $units->ua_id; ?>');
                                                </script>
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