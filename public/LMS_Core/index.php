<?php
include("admin/dist/inc/config.php");
//load configuration file
?>
<!DOCTYPE html>
<html lang="en">
<?php include("inc/head.php"); ?>

<body>

	<!-- Header -->
	<?php include("inc/header.php"); ?>
	<!-- /Header -->

	<!-- Home -->
	<div id="home" class="hero-area">

		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(./img/1.jpg)"></div>
		<!-- /Backgound Image -->

		<div class="home-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h1 class="white-text">Learning Management System</h1>
						<p class="lead white-text">A creation of a convenient and detailed learning environment and alternative ways of learning by providing tools and support to users</p>
						<a class="main-button icon-button" href="#courses">Get Started!</a>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /Home -->

	<!-- About -->
	<div id="about" class="section">

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">

				<div class="section-header">
					<h2>Welcome to Learning Management System</h2>
					<p class="lead">Empowering users to utilize technology to boost their knowledge</p>
				</div>

				<div class="col-md-6">


					<!-- feature -->
					<div class="feature">
						<i class="feature-icon fa fa-user-plus"></i>
						<div class="feature-content">
							<h4>Automated student registration </h4>
							<p>LMS allows the instution managing the system to automatically register their new and continuing students.</p>
						</div>
					</div>
					<!-- /feature -->

					<!-- feature -->
					<div class="feature">
						<i class="feature-icon fa fa-money"></i>
						<div class="feature-content">
							<h4>Billings</h4>
							<p>For any student to access any study materials he/she is billed automaically by the LMS. </p>
						</div>
					</div>
					<!-- /feature -->

					<!-- feature -->
					<div class="feature">
						<i class="feature-icon fa fa-cogs"></i>
						<div class="feature-content">
							<h4>Student progress monitoring</h4>
							<p>LMS allows instructors to monitor the progress of their enrolled students.</p>
						</div>
					</div>
					<!-- /feature -->


				</div>

				<div class="col-md-6">
					<!-- feature -->
					<div class="feature">
						<i class="feature-icon fa fa-user"></i>
						<div class="feature-content">
							<h4>Student result compilation</h4>
							<p>After a successfull enrollment, students undertakes a course and later on they take exams and assessments which are graded automatically.</p>
						</div>
					</div>
					<!-- /feature -->

					<!-- feature -->
					<div class="feature">
						<i class="feature-icon fa fa-envelope"></i>
						<div class="feature-content">
							<h4>Email plugin</h4>
							<p>LMS has an in-built emailing feature which allows fast, secure and confidential communications between an instructor and a student.</p>
						</div>
					</div>
					<!-- /feature -->

				</div>



			</div>
			<!-- row -->

		</div>
		<!-- container -->
	</div>
	<!-- /About -->

	<!-- Courses -->
	<div id="courses" class="section">

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">
				<div class="section-header text-center">
					<h2>Explore Top Course Categories</h2>
				</div>
			</div>
			<!-- /row -->

			<!-- courses -->
			<div id="courses-wrapper">

				<!-- row -->
				<div class="row">
					<?php
					//get all courses
					$ret = "SELECT  * FROM  lms_course_categories ";
					$stmt = $mysqli->prepare($ret);
					//$stmt->bind_param('i',$c_id);
					$stmt->execute(); //ok
					$res = $stmt->get_result();
					$cnt = 1;
					while ($row = $res->fetch_object()) {
					?>
						<!-- single course -->
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="course">
								<a href="pages_courses.php?cc_id=<?php echo $row->cc_id; ?>" class="course-img">
									<img src="admin/assets/images/course_cat/<?php echo $row->cc_dpic; ?>" alt="">
									<i class="course-link-icon fa fa-link"></i>
								</a>
								<a class="course-title" href="#"><?php echo $row->cc_name; ?></a>
								<div class="course-details">
									<span class="course-category"></span>
									<span class="course-price course-free"></span>
								</div>
							</div>
						</div>
						<!-- /single course -->
					<?php } ?>

				</div>
				<!-- /row -->

			</div>
			<!-- /courses -->



		</div>
		<!-- container -->

	</div>
	<!-- /Courses -->

	<!-- Contact CTA -->
	<div id="contact-cta" class="section">

		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(./img/cta2-background.jpg)"></div>
		<!-- Backgound Image -->

		<!-- container -->
		<div class="container">

			<!-- row -->
			<div class="row">

				<div class="col-md-8 col-md-offset-2 text-center">
					<h2 class="white-text">Contact Us</h2>
					<p class="lead white-text">Keep in touch with us </p>
					<a class="main-button icon-button" href="pages_contact.php">Contact Us Now</a>
				</div>

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->

	</div>
	<!-- /Contact CTA -->

	<!-- Footer -->
	<?php include("inc/footer.php"); ?>
	<!-- /Footer -->

	<!-- preloader -->
	<div id='preloader'>
		<div class='preloader'></div>
	</div>
	<!-- /preloader -->


	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</body>

</html>