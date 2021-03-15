<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../partials/analytics.php');
/* Persist System Settings  */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/head.php');
?>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <?php require_once('../partials/navbar.php'); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php
            require_once('../partials/sidebar.php');
            $view = $_GET['view'];
            $ret = "SELECT  * FROM  lms_instructor WHERE i_id = '$view' ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($ins = $res->fetch_object()) {
            ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - Instructor Profile</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="instructors.php">Instructors</a></li>
                                        <li class="breadcrumb-item active"><?php echo $ins->i_name; ?></li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">

                                    <!-- Course Details -->
                                    <div class="card card-warning card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <?php
                                                if ($ins->i_dpic == '') {
                                                    $dpic = 'default_user.webp';
                                                } else {
                                                    $dpic = $ins->i_dpic;
                                                }
                                                ?>
                                                <img class="img-fluid img-rectangle" src="../public/sys_data/uploads/users/<?php echo $dpic; ?>" alt="Image">

                                            </div>

                                            <h3 class="profile-username text-center"><?php echo $ins->i_number; ?></h3>

                                            <p class="text-muted text-center"><?php echo $ins->i_name; ?></p>

                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>Contacts: </b> <a class="float-right"><?php echo $ins->i_phone; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Email: </b> <a class="float-right"><?php echo $ins->i_email; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Allocated Units</b>
                                                    <?php
                                                    /* Units This Guy Teaching */
                                                    $result = "SELECT count(*) FROM lms_units_assaigns WHERE i_id = '$view'";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($units);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                    ?>
                                                    <a class="float-right"><?php echo $units; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-warning card-outline">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#units" data-toggle="tab"><?php echo $ins->i_name; ?> Allocated Units</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="units">
                                                    <table id="dash-1" class="table table-striped table-bordered display " style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Unit Code</th>
                                                                <th>Unit Name</th>
                                                                <th>Course </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ret = "SELECT  * FROM  lms_units_assaigns WHERE i_id = '$view' ";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($allocated = $res->fetch_object()) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $allocated->c_code; ?></td>
                                                                    <td><?php echo $allocated->c_name; ?></td>
                                                                    <td><?php echo $allocated->c_category; ?></td>
                                                                </tr>
                                                            <?php
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!-- Main Footer -->
            <?php require_once('../partials/footer.php');
            } ?>
        </div>
        <!-- ./wrapper -->
        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>

    </body>

    </html>
<?php } ?>