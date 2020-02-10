<!doctype html>
<html lang="en">
    @include('partial.head')
<body>

    <!--================Header Menu Area =================-->
        @include('partial.nav')
    <!--================Header Menu Area =================-->


    <!--================Hero Banner Area Start =================-->
    <section class="hero-banner d-flex align-items-center">
        <div class="container text-center">
            <h2>Learning Management System Features</h2>
            <nav aria-label="breadcrumb" class="banner-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Features</li>
                </ol>
            </nav>
        </div>
    </section>
    <!--================Hero Banner Area End =================-->

    <!--================Service  Area =================-->
    <section class="service-area area-padding">
        <div class="container">
            <div class="row">
                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-pencil-alt"></i>
                        </div>
                        <div class="service-content">
                            <h5>Unique Design</h5>
                            <p>This application is crafted with unique designs that it can run on any platforms ie(Smartphones, Tables and Laptops), Its unique design makes it responsive and lightweight.</p>
                        </div>
                    </div>
                </div>

                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-image"></i>
                        </div>
                        <div class="service-content">
                            <h5>Email Intergration</h5>
                            <p>Learning Management System uses gmail as its primary mailing service provider. It has direct intergration where a Instructor can log in directly to their personal or
                             corporate mail, send and receive any mails without affecting or dropping sessions in the LMS application.</p>
                        </div>
                    </div>
                </div>


                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-headphone-alt"></i>
                        </div>
                        <div class="service-content">
                            <h5>In Build Forum</h5>
                            <p>Many Learning Management Systems have their forum module developed separate from the main application but with this application its fully shipped with 
                            its inbuild light-weight forum that emulates the 'MyBB' or StackOverflow Forums but with less functionalities compared to them. </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-user"></i>
                        </div>
                        <div class="service-content">
                            <h5>Student and Instructors Account Registration</h5>
                            <p>LMS allows registration of  new and continuing students according to their course of study, also allows instructors to create their accounts inorder to manage their students.</p>
                        </div>
                    </div>
                </div>

                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-money "></i>
                        </div>
                        <div class="service-content">
                            <h5>Finance And Billings</h5>
                            <p>Learning Management System has a finance and billing module which takes care of billing of students for paid resources and past papers.</p>
                        </div>
                    </div>
                </div>


                <!-- Single service -->
                <div class="col-md-6 col-lg-4">
                    <div class="single-service">
                        <div class="service-icon">
                            <i class="ti-pulse "></i>
                        </div>
                        <div class="service-content">
                            <h5>Results | Progress Monitoring</h5>
                            <p>Learning Management System its shipped with a student results compilation feature which computes the marks of the student and gets the average, and grade then
                             generates certificates.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Service Area end =================-->

 <!-- ================ start footer Area ================= -->
    @include('partial.footer')
<!-- ================ End footer Area ================= -->






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/theme.js"></script>
</body>
</html>