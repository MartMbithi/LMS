<!--Server side code to handle  password reset-->
<?php
	session_start();
	include('dist/inc/config.php');
		if(isset($_POST['reset_pwd']))
		{
      $email=$_POST['email'];
      $token=$_POST['token'];
      //$a_email=$_POST['a_email'];
      //$a_number = $_POST['a_number'];
      //$a_pwd=sha1(md5($_POST['a_pwd']));//double encrypt to increase security
      //sql to insert captured values
      $query="INSERT INTO lms_pwdresets (email, token) values(?,?)";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('ss', $email,$token);
      $stmt->execute();

            if($stmt)
            {
                      $success = "Check Your Mail Inbox For Password Reset Instruction ";
                      
                      //echo "<script>toastr.success('Have Fun')</script>";
            }
            else {
              $err = "Please Try Again Or Try Later";
            }
			
			
		}
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Learning Management System - The Ultimate Multipurpose E learning Platform</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="dist/js/swal.js"></script>

        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function ()
                            {
                                swal("Success","<?php echo $success;?>","success");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function ()
                            {
                                swal("Failed","<?php echo $err;?>","error");
                            },
                                100);
                </script>

        <?php } ?>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/big/3.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/big/icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Reset Password</h2>
                        <p class="text-center">Enter your email address and password reset instructions will be sent to your email.</p>
                        <form method = "post" class="mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" name="email" id="uname" type="email"
                                            placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group" style="display:none">
                                        <label class="text-dark" for="uname">Reset Token</label>
                                        <?php 
                                            $length = 10;    
                                            $reset_token =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        ?>
                                        <input class="form-control" name="token" value="<?php echo $reset_token;?>" id="uname" type="text"
                                            placeholder="enter your email">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 text-center">
                                    <button type="submit" name="reset_pwd" class="btn btn-block btn-outline-dark">Reset Password</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Remembered Password? <a href="pages_admin_index.php" class="text-danger">Login</a><br>
                                    Take Me  <a href="../" class="text-danger">Home</a> Safe
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>