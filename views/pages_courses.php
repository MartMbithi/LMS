<?php
require_once("../config/config.php");
require_once("../partials/landing_head.php");
?>

<body>
    <!-- Header -->
    <?php require_once("../partials/landing_header.php"); ?>

    <div class="hero-area section">
        <?php
        //get all courses
        $cc_id = $_GET['cc_id'];
        $ret = "SELECT  * FROM  lms_course_categories WHERE cc_id = ? ";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $cc_id);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {
        ?>
            <!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay" style="background-image:url(../public/uploads/sys_data/course_cat/<?php echo $row->cc_dpic; ?>)"></div>
            <!-- /Backgound Image -->

            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <ul class="hero-area-tree">
                            <li><a href="index.php">Home</a></li>
                            <li><?php echo $row->cc_name; ?></li>
                        </ul>
                        <h1 class="white-text"><?php echo $row->cc_name; ?> Courses</h1>

                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-12">

                    <!-- row -->
                    <div class="row">
                        <?php
                        //get all courses
                        $cc_id = $_GET['cc_id'];
                        $ret = "SELECT  * FROM  lms_course WHERE cc_id = ? ";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $cc_id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {
                        ?>
                            <!-- single blog -->
                            <div class="col-md-4">
                                <div class="single-blog">
                                    <div class="blog-img">
                                        <a href="pages_course_details.php?c_id=<?php echo $row->c_id; ?>">
                                            <img src="../public/uploads/sys_logo/images/course02.jpg" alt="">
                                        </a>
                                    </div>
                                    <h4><a href="pages_course_details.php?c_id=<?php echo $row->c_id; ?>"><?php echo $row->c_name; ?></a></h4>
                                </div>
                            </div>
                            <!-- /single blog -->

                        <?php } ?>

                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /Blog -->

        <!-- Footer -->
        <?php require_once("../partials/landing_scripts.php"); ?>
        <!-- /Footer -->

        <!-- preloader -->
        <div id='preloader'>
            <div class='preloader'></div>
        </div>
        <!-- /preloader -->
    </div>

    <!-- Scripts -->
    <?php require_once('../partials/landing_scripts.php'); ?>

</body>

</html>