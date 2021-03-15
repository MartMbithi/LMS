<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

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
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Teaching Allocations</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Teaching Allocations</li>
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
                                                <th>Instructor Name</th>
                                                <th>Instructor Number</th>
                                                <th>Allocated Unit Code</th>
                                                <th>Allocated Unit Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  * FROM  lms_units_assaigns WHERE i_id = '$id' ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($allocations = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $allocations->i_name; ?></td>
                                                    <td><?php echo $allocations->i_number; ?></td>
                                                    <td><?php echo $allocations->c_code; ?></td>
                                                    <td><?php echo $allocations->c_name; ?></td>
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