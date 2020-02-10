<!--Send A Messange-->
<?php
  //session_start();
  include('admin/dist/inc/config.php');
  //include('dist/inc/checklogin.php');
  //check_login();
  //$a_id=$_SESSION['a_id'];

  //register a course category
  if(isset($_POST['send_messange']))
  {
	  $name = $_POST['name'];
	  $email =$_POST['email'];
	  $subject =$_POST['subject'];
	  $msg = $_POST['msg'];
      //sql to insert captured values
      $query="INSERT INTO lms_messanges (name, email, subject, msg) VALUES (?,?,?,?)";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('ssss', $name, $email, $subject, $msg);
      $stmt->execute();

      if($stmt)
      {
                $success = "Messange Send";
                
                //echo "<script>toastr.success('Have Fun')</script>";
      }
      else {
        $err = "Please Try Again Or Try Later";
      }
      
      
  }
?>
<!DOCTYPE html>
<html lang="en">
	<?php include("inc/head.php");?>
	<body>

		<!-- Header -->
			<?php include("inc/header.php");?>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.php">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Get In Touch</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4>Send A Message</h4>
							<form method = "POST">
								<input class="input" required type="text" name="name" placeholder="Name">
								<input class="input" required type="email" name="email" placeholder="Email">
								<input class="input" required type="text" name="subject" placeholder="Subject">
								<textarea class="input" required name="msg" placeholder="Enter your Message"></textarea>
								<input type="submit" name="send_messange" class="main-button icon-button pull-right" value="Send Message">
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>Contact Information</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i>mail@lms.com</li>
							<li><i class="fa fa-phone"></i>+254740847563</li>
							<li><i class="fa fa-map-marker"></i>127001 LocalHost</li>
						</ul>

						<!-- contact map -->
						<div id="contact-map"></div>
						<!-- /contact map -->

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

		<!-- Footer -->
			<?php include("inc/footer.php");?>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
		<script type="text/javascript" src="js/google-map.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
