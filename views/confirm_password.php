<?php
session_start();
include('../config/config.php');

if (isset($_POST['ConfirmPassword'])) {
    $error = 0;
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
        $a_email = $_SESSION['a_email'];
        $sql = "SELECT * FROM  lms_admin  WHERE a_email = '$a_email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($new_password != $confirm_password) {
                $err = "Password Does Not Match";
            } else {
                $a_email = $_SESSION['a_email'];
                $new_password  = sha1(md5($_POST['new_password']));
                $query = "UPDATE lms_admin SET  a_pwd =? WHERE a_email =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $a_email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changed" && header("refresh:1; url=login.php");
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

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="">
                    <img src="../public/sys_data/logo/<?php echo $sys->sys_logo; ?>" class="img-fluid" height="50" width="100">
                    <br>
                    <?php echo $sys->sys_name; ?>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body">
                    <?php
                    $a_email  = $_SESSION['a_email'];
                    $ret = "SELECT * FROM  lms_admin  WHERE a_email = '$a_email'";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    while ($row = $res->fetch_object()) {
                    ?>
                        <p class="login-box-msg">
                            <span class="badge badge-success">Token : <?php echo $row->a_pwd; ?></span>
                            <?php echo $row->a_email; ?>
                            <br>
                            Confirm Your Password
                        </p>
                    <?php
                    } ?>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="password" name="new_password" class="form-control" placeholder="New Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-8">
                                <!-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> -->
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" name="ConfirmPassword" class="btn btn-primary btn-block">Change</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <?php require_once('../partials/scripts.php'); ?>
    </body>

    </html>
<?php
} ?>