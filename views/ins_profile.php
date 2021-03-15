<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();

/* Update Instructor */
if (isset($_POST['update_ins'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_SESSION['i_id']) && !empty($_SESSION['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim($_SESSION['i_id']));
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
            $success = "Updated" && header("refresh:1; url=ins_profile.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Change Password */
if (isset($_POST['update_password'])) {
    //Change Password
    $error = 0;
    if (isset($_SESSION['i_id']) && !empty($_SESSION['i_id'])) {
        $i_id = mysqli_real_escape_string($mysqli, trim((($_SESSION['i_id']))));
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
        $sql = "SELECT * FROM  lms_instructor  WHERE i_id = '$i_id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['i_pwd']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $query = "UPDATE lms_instructor SET i_pwd =? WHERE i_id ='$i_id' ";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('s', $new_password);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changes" && header("refresh:1; url=ins_profile.php");
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
            <?php require_once('../partials/ins_navbar.php'); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php
            require_once('../partials/ins_sidebar.php');
            $i_id = $_SESSION['i_id'];
            $ret = "SELECT  * FROM  lms_instructor  WHERE i_id= '$i_id'";
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
                                        <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
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
                                                if ($loggedIn->i_dpic == '') {
                                                    $dpic = 'Default_user.webp';
                                                } else {
                                                    $dpic = $loggedIn->i_dpic;
                                                } ?>
                                                <img class="img-fluid img-rectangle" src="../public/sys_data/uploads/users/<?php echo $dpic; ?>" alt="Passport">
                                            </div>
                                            <h3 class="profile-username text-center"><?php echo $loggedIn->i_number; ?></h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>Name: </b> <a class="float-right"><?php echo $loggedIn->i_name; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Email: </b> <a class="float-right"><?php echo $loggedIn->i_email; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Contact: </b> <a class="float-right"><?php echo $loggedIn->i_email; ?></a>
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
                                                                <label for="exampleInputEmail1">Instructor Number</label>
                                                                <input type="text" name="i_number" value="<?php echo $loggedIn->i_number ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                <input type="hidden" name="i_id" value="<?php echo $loggedIn->i_id ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Instructor Full Name</label>
                                                                <input type="text" name="i_name" value="<?php echo $loggedIn->i_name; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Email Address</label>
                                                                <input type="email" name="i_email" value="<?php echo $loggedIn->i_email; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Phone Number</label>
                                                                <input type="text" name="i_phone" value="<?php echo $loggedIn->i_phone; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                                                            <button type="submit" name="update_ins" class="btn btn-outline-warning">Update Profile</button>
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