<?php
session_start();
include('../config/config.php'); //get configuration file
if (isset($_POST['login'])) {
    $a_email = $_POST['a_email'];
    $a_pwd = sha1(md5($_POST['a_pwd'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT a_email ,a_pwd , a_id FROM lms_admin WHERE a_email=? AND a_pwd=? "); //sql to log in user
    $stmt->bind_param('ss', $a_email, $a_pwd); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($a_email, $a_pwd, $a_id);
    $rs = $stmt->fetch();
    $_SESSION['a_id'] = $a_id;
    if ($rs) { //if its sucessfull
        header("location:pages_admin_dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}

require_once('../partials/head.php');
?>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(../public/uploads/sys_logo/images/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../public/uploads/sys_logo/images/big/3.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="../public/uploads/sys_logo/logo-text.png" alt="logo">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center">Enter your email address and password to access admin panel.</p>
                        <form method="post" class="mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" required="required" name="a_email" id="uname" type="email" placeholder="Enter Your Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" required="required" name="a_pwd" id="pwd" type="password" placeholder="Enter Your Password">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" name="login" class="btn btn-block btn-outline-dark">Sign In</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    <!--ADMIN ACCOUNT'S IS SYSTEM GENERATED NO NEED TO SIGN UP.
                                    Don't have an account? <a href="pages_admin_signup.php" class="text-danger">Sign Up</a>-->
                                    Forgot Password? <a href="pages_reset_pwd.php" class="text-danger">Recover</a><br>
                                    Take Me <a href="index.php" class="text-danger">Home</a> Safe
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>