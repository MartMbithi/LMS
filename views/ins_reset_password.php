<?php
session_start();
include('../config/config.php');
if (isset($_POST['Reset'])) {
    //prevent posting blank value for first name
    $error = 0;
    if (isset($_POST['i_email']) && !empty($_POST['i_email'])) {
        $i_email = mysqli_real_escape_string($mysqli, trim($_POST['i_email']));
    } else {
        $error = 1;
        $err = "Enter Your Email";
    }
    if (!filter_var($_POST['i_email'], FILTER_VALIDATE_EMAIL)) {
        $err = 'Invalid Email';
    }
    $checkEmail = mysqli_query($mysqli, "SELECT `i_email` FROM `lms_instructor` WHERE `i_email` = '" . $_POST['i_email'] . "'") or exit(mysqli_error($mysqli));
    if (mysqli_num_rows($checkEmail) > 0) {

        $n = date('y');
        $new_password = bin2hex(random_bytes($n));
        $query = "UPDATE lms_instructor SET  i_pwd =? WHERE i_email =?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $new_password, $a_email);
        $stmt->execute();

        if ($stmt) {
            $_SESSION['i_email'] = $i_email;
            $success = "Confim Your Password" && header("refresh:1; url=ins_confirm_password.php");
        } else {
            $err = "Password reset failed";
        }
    } else  // user does not exist
    {
        $err = "Email Does Not Exist";
    }
}
/* Persist System Settings  */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/head.php')
?>

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
            <div class="card card-success">
                <div class="card-body">
                    <p class="login-box-msg">Reset Password</p>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="email" required name="i_email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" name="Reset" class="btn btn-primary btn-block">Reset Password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="ins_login.php">I Remembered My Password</a>
                    </p>

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