<?php
session_start();
require_once('../config/config.php'); //get configuration file

if (isset($_POST['Login'])) {
    $a_email = $_POST['a_email'];
    $a_pwd = sha1(md5($_POST['a_pwd'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT a_email ,a_pwd , a_id FROM lms_admin WHERE a_email=? AND a_pwd=? "); //sql to log in user
    $stmt->bind_param('ss', $a_email, $a_pwd); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($a_email, $a_pwd, $a_id); //bind result
    $rs = $stmt->fetch();
    $_SESSION['a_id'] = $a_id;
    if ($rs) {
        header("location:dashboard.php");
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
                            <input type="email" required name="a_email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" required name="a_pwd" class="form-control" placeholder="Password">
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
                                <button type="submit" name="Login" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="reset_password.php">I forgot my password</a>
                    </p>
                    <!--  <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <?php require_once('../partials/scripts.php'); ?>

    </body>

    </html>
<?php } ?>