<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();

/* Update Profile */
if (isset($_POST['update_profile'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_SESSION['a_id']) && !empty($_SESSION['a_id'])) {
        $a_id = mysqli_real_escape_string($mysqli, trim($_SESSION['a_id']));
    } else {
        $error = 1;
        $err = "Sessio ID Cannot Be Empty";
    }
    if (isset($_POST['a_name']) && !empty($_POST['a_name'])) {
        $a_name = mysqli_real_escape_string($mysqli, trim($_POST['a_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['a_uname']) && !empty($_POST['a_uname'])) {
        $a_uname = mysqli_real_escape_string($mysqli, trim($_POST['a_uname']));
    } else {
        $error = 1;
        $err = "Username Cannot Be Empty";
    }
    if (isset($_POST['a_email']) && !empty($_POST['a_email'])) {
        $a_email = mysqli_real_escape_string($mysqli, trim($_POST['a_email']));
    } else {
        $error = 1;
        $err = "Email Cannot Be Empty";
    }

    $a_dpic = $_FILES["a_dpic"]["name"];
    move_uploaded_file($_FILES["a_dpic"]["tmp_name"], "../public/sys_data/uploads/users/" . $_FILES["a_dpic"]["name"]);

    if (!$error) {
        $query = "UPDATE lms_admin SET a_name=?, a_uname=?, a_email=?,  a_dpic=? WHERE a_id= '$a_id' ";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssss', $a_name, $a_uname, $a_email, $a_dpic);
        $stmt->execute();
        if ($stmt) {
            $success = "Updated" && header("refresh:1; url=profile.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Change Password */
if (isset($_POST['update_password'])) {
    //Change Password
    $error = 0;
    if (isset($_SESSION['a_id']) && !empty($_SESSION['a_id'])) {
        $a_id = mysqli_real_escape_string($mysqli, trim((($_SESSION['a_id']))));
    } else {
        $error = 1;
        $err = "Session ID Cannot Be Empty";
    }
    if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
        $old_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['old_password']))));
    } else {
        $error = 1;
        $err = "Old Password Cannot Be Empty";
    }
    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = "New Password Cannot Be Empty";
    }
    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirmation Password Cannot Be Empty";
    }

    if (!$error) {
        $sql = "SELECT * FROM  lms_admin  WHERE a_id = '$a_id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['a_pwd']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $query = "UPDATE lms_admin SET a_pwd =? WHERE a_id ='$a_id' ";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('s', $new_password);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changes" && header("refresh:1; url=profile.php");
                } else {
                    $err = "Please Try Again Or Try Later";
                }
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
            <?php
            require_once('../partials/sidebar.php');
            $a_id = $_SESSION['a_id'];
            $ret = "SELECT  * FROM  lms_admin  WHERE a_id= '$a_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($loggedIn = $res->fetch_object()) {
            ?>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Profile</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Profile</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

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
                                                if ($loggedIn->a_dpic == '') {
                                                    $dpic = 'Default_user.webp';
                                                } else {
                                                    $dpic = $loggedIn->a_dpic;
                                                } ?>
                                                <img class="img-fluid img-rectangle" src="../public/sys_data/uploads/users/<?php echo $dpic; ?>" alt="Passport">
                                            </div>
                                            <h3 class="profile-username text-center"><?php echo $loggedIn->a_uname; ?></h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>Name</b> <a class="float-right"><?php echo $loggedIn->a_name; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Email</b> <a class="float-right"><?php echo $loggedIn->a_email; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-warning card-outline">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#edit-profile" data-toggle="tab">Update Profile </a></li>
                                                <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Change Password</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="edit-profile">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1"> Name</label>
                                                                <input type="text" name="a_name" value="<?php echo $loggedIn->a_name; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Username</label>
                                                                <input type="text" name="a_uname" value="<?php echo $loggedIn->a_uname; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Email Address</label>
                                                                <input type="email" name="a_email" value="<?php echo $loggedIn->a_email; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputFile">Administrator Passport</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input required name="a_dpic" type="file" class="custom-file-input" id="exampleInputFile">
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="text-right">
                                                            <button type="submit" name="update_profile" class="btn btn-outline-warning">Update Profile</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="change-password">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputEmail1"> Old Password</label>
                                                                <input type="password" name="old_password" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputEmail1">New Password</label>
                                                                <input type="password" name="new_password" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputEmail1">Confirm New Password</label>
                                                                <input type="password" name="confirm_password" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="text-right">
                                                            <button type="submit" name="update_password" class="btn btn-outline-warning">Update Password</button>
                                                        </div>
                                                    </form>
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
<?php
} ?>