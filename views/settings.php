<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Update Default Company Settings */
if (isset($_POST['update_company_profile'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['sys_id']) && !empty($_POST['sys_id'])) {
        $sys_id = mysqli_real_escape_string($mysqli, trim($_POST['sys_id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }
    if (isset($_POST['sys_name']) && !empty($_POST['sys_name'])) {
        $sys_name = mysqli_real_escape_string($mysqli, trim($_POST['sys_name']));
    } else {
        $error = 1;
        $err = "Sys Name Cannot Be Empty";
    }
    if (isset($_POST['sys_tagline']) && !empty($_POST['sys_tagline'])) {
        $sys_tagline = $_POST['sys_tagline'];
    } else {
        $error = 1;
        $err = "System Tagline Cannot Be Empty";
    }


    /*  $cc_dpic = $_FILES["cc_dpic"]["name"];
    move_uploaded_file($_FILES["cc_dpic"]["tmp_name"], "../public/sys_data/uploads/courses/" . $_FILES["cc_dpic"]["name"]); */

    if (!$error) {
        $query = "UPDATE lms_sys_setttings  SET sys_name = ?, sys_tagline =? WHERE sys_id =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $sys_name, $sys_tagline, $sys_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Details Updated" && header("refresh:1; url=settings.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Update Default System Settings */
if (isset($_POST['update_company_logo'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['sys_id']) && !empty($_POST['sys_id'])) {
        $sys_id = mysqli_real_escape_string($mysqli, trim($_POST['sys_id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }

    $sys_logo = $_FILES["sys_logo"]["name"];
    move_uploaded_file($_FILES["sys_logo"]["tmp_name"], "../public/sys_data/logo/" . $_FILES["sys_logo"]["name"]);

    if (!$error) {
        $query = "UPDATE lms_sys_setttings  SET sys_logo = ? WHERE sys_id =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $sys_logo, $sys_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Details Updated" && header("refresh:1; url=settings.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}


/* Privacy Policy And Licenseses */
if (isset($_POST['update_company_pp'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['sys_id']) && !empty($_POST['sys_id'])) {
        $sys_id = mysqli_real_escape_string($mysqli, trim($_POST['sys_id']));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }
    if (isset($_POST['sys_license']) && !empty($_POST['sys_license'])) {
        $sys_license = $_POST['sys_license'];
    } else {
        $error = 1;
        $err = "Sys License Cannot Be Empty";
    }
    if (isset($_POST['sys_privacy_policy']) && !empty($_POST['sys_privacy_policy'])) {
        $sys_privacy_policy = $_POST['sys_privacy_policy'];
    } else {
        $error = 1;
        $err = "System Privacy Policy Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE lms_sys_setttings  SET sys_license = ?, sys_privacy_policy =? WHERE sys_id =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $sys_license, $sys_privacy_policy, $sys_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Details Updated" && header("refresh:1; url=settings.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

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
            <?php require_once('../partials/sidebar.php'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name;?> - System Settings</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <!-- ./row -->
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-lg-12">
                                            <div class="card card-warning card-tabs">
                                                <div class="card-header p-0 pt-1">
                                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab">LMS Company Profile</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab">LMS Company Logo</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab">LMS Company Privacy Policy & License</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class=" col-md-12">
                                                                        <label>LMS Company Name</label>
                                                                        <input type="text" name="sys_name" value="<?php echo $sys->sys_name; ?>" required class="form-control">
                                                                        <input type="hidden" name="sys_id" value="<?php echo $sys->sys_id; ?>" required class="form-control">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>LMS Company Tagline</label>
                                                                        <textarea type="text" name="sys_tagline" class="form-control" ><?php echo $sys->sys_tagline; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="text-right">
                                                                    <button type="submit" name="update_company_profile" class="btn btn-outline-warning">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel">
                                                            <form method="post" enctype="multipart/form-data" role="form">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="exampleInputFile">Select File</label>
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input required name="sys_logo" type="file" class="custom-file-input" id="exampleInputFile">
                                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="sys_id" value="<?php echo $sys->sys_id; ?>" required class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="text-right">
                                                                    <button type="submit" name="update_company_logo" class="btn btn-outline-warning">Upload File</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>LMS System License</label>
                                                                        <textarea type="text" name="sys_license" readonly class="form-control" id="editor1"><?php echo $sys->sys_license; ?></textarea>
                                                                        <input type="hidden" name="sys_id" value="<?php echo $sys->sys_id; ?>" required class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>LMS System Privacy Policy</label>
                                                                        <textarea type="text" name="sys_privacy_policy" class="form-control" id="editor2"><?php echo $sys->sys_privacy_policy; ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="text-right">
                                                                    <button type="submit" name="update_company_pp" class="btn btn-outline-warning">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card -->
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
            <?php require_once('../partials/footer.php'); ?>
        </div>
        <!-- ./wrapper -->

        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>

    </body>
    </html>
<?php } ?>