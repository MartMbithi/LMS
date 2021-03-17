<?php
session_start();
require_once('../config/config.php'); //get configuration file

if (isset($_POST['login'])) {
    $s_email = $_POST['s_email'];
    $s_pwd = sha1(md5($_POST['s_pwd'])); 
    $stmt = $mysqli->prepare("SELECT s_email ,s_pwd , s_id FROM lms_student WHERE s_email=? AND s_pwd=? "); 
    $stmt->bind_param('ss', $s_email, $s_pwd);
    $stmt->execute(); 
    $stmt->bind_result($s_email, $s_pwd, $s_id); 
    $rs = $stmt->fetch();
    $_SESSION['s_id'] = $s_id; 
    if ($rs) { 
        header("location:std_dashboard.php");
    } else {

        $err = "Access Denied Please Check Your Credentials";
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
                    <p class="login-box-msg">Sign In</p>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="email" required name="s_email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" required name="s_pwd" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="std_reset_password.php">Forgot Password</a>
                    </p>
                    <p class="mb-0">
                        <a href="std_register.php" class="text-center">Register Student  Account</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <?php require_once('../partials/scripts.php'); ?>

    </body>

    </html>
<?php } ?>