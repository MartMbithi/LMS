<?php
session_start();
require_once('../config/config.php');
require_once('../config/codeGen.php');

if (isset($_POST['Register'])) {
    $error = 0;

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

    if (isset($_POST['i_pwd']) && !empty($_POST['i_pwd'])) {
        $i_pwd = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['i_pwd']))));
    } else {
        $error = 1;
        $err = "Password Cannot Be Empty";
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_instructor WHERE  i_phone='$i_phone' || i_email = '$i_email'   ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($i_phone == $row['i_phone']) {
                $err =  "An Instructor Account  With This Phone Number $i_phone Already Exists";
            } else {
                $err =  "An Instructor Account  With $i_email Already Exists";
            }
        } else {
            $query = "INSERT INTO lms_instructor (i_number, i_name, i_phone, i_email, i_pwd) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $i_number, $i_name, $i_phone, $i_email, $i_pwd);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=ins_login.php");
            } else {
                $info = "Please Try Again Or Try Later";
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
                    <p class="login-box-msg">Sign Up</p>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" required name="i_name" class="form-control" placeholder="Full Names">
                            <input type="hidden" required name="i_number" value="<?php echo $a . "" . $b; ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" required name="i_phone" class="form-control" placeholder="Phone Number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" required name="i_email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" required name="i_pwd" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" name="Register" class="btn btn-primary btn-block">Sign Up</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="ins_reset_password.php">Forgot Password</a>
                    </p>
                    <p class="mb-0">
                        <a href="ins_register.php" class="text-center">Sign In</a>
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