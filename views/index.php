<?php
include('../config/config.php');
/* Persist System Settings */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="Grayrids">
        <title><?php echo $sys->sys_name . "" . $sys->sys_tagline; ?></title>

        <link rel="shortcut icon" href="img/2.png" type="image/png">

        <link rel="stylesheet" href="../public/css/bootstrap-4.5.0.min.css">
        <link rel="stylesheet" href="../public/css/animate.css">
        <link rel="stylesheet" href="../public/css/LineIcons.2.0.css">
        <link rel="stylesheet" href="../public/css/owl.carousel.2.3.4.min.css">
        <link rel="stylesheet" href="../public/css/owl.theme.css">
        <link rel="stylesheet" href="../public/css/magnific-popup.css">
        <link rel="stylesheet" href="../public/css/nivo-lightbox.css">
        <link rel="stylesheet" href="../public/css/main.css">
        <link rel="stylesheet" href="../public/css/responsive.css">
    </head>

    <body>

        <header class="hero-area">
            <div class="overlay">
                <span></span>
                <span></span>
            </div>
            <div class="navbar-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="index.php">
                                    <img src="../public/sys_data/logo/<?php echo $sys->sys_logo; ?>" alt="Logo">
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul id="nav" class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="page-scroll" href="#home">Home</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="page-scroll" href="std_login.php">Student Portal</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="page-scroll" href="ins_login.php">Instructor Portal</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="page-scroll" href="login.php">Administrator Portal</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div id="home">
                <div class="container">
                    <div class="row space-100">
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <div class="contents">
                                <h2 class="head-title"><?php echo $sys->sys_name; ?><br class="d-none d-xl-block"><?php echo $sys->sys_tagline; ?></h2>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12 p-0">
                            <div class="intro-img">
                                <img src="../public/sys_data/logo/intro.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <a href="#" class="back-to-top">
            <i class="lni lni-chevron-up"></i>
        </a>

        <div id="preloader">
            <div class="loader" id="loader-1"></div>
        </div>


        <script src="../public/js/modernizr-3.7.1.min.js"></script>
        <script src="../public/plugins/jquery/jquery.min.js"></script>
        <script src="../public/js/popper.min.js"></script>
        <script src="../public/js/bootstrap-4.5.0.min.js"></script>
        <script src="../public/js/owl.carousel.2.3.4.min.js"></script>
        <script src="../public/js/nivo-lightbox.js"></script>
        <script src="../public/js/jquery.magnific-popup.min.js"></script>
        <script src="../public/js/form-validator.min.js"></script>
        <script src="../public/js/contact-form-script.js"></script>
        <script src="../public/js/main.js"></script>
    </body>

    </html>
<?php } ?>