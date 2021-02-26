<?php
include("admin/dist/inc/config.php");
//load configuration file

//get all courses
$c_id = $_GET['c_id'];
$ret = "SELECT  * FROM  lms_course WHERE c_id = ? ";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $c_id);
$stmt->execute(); //ok
$res = $stmt->get_result();
//$cnt=1;
while ($row = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include("inc/head.php"); ?>

    <body>

        <!-- Header -->
        <?php include("inc/header.php"); ?>
        <!-- /Header -->

        <!-- Hero-area -->
        <div class="hero-area section">

            <!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay" style="background-image:url(./img/blog-post-background.jpg)"></div>
            <!-- /Backgound Image -->

            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <ul class="hero-area-tree">
                            <li><a href="index.php">Home</a></li>
                            <li><a href=""><?php echo $row->c_category; ?></a></li>
                            <li><?php echo $row->c_name; ?></li>
                        </ul>
                        <h1 class="white-text"><?php echo $row->c_name; ?></h1>

                    </div>
                </div>
            </div>

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

                        <!-- blog post -->
                        <div class="blog-post">
                            <?php echo $row->c_desc; ?>

                        </div>
                        <!-- /blog post -->



                        <!-- blog comments -->
                        <div class="blog-comments">
                            <h3>Posted Revision Questions</h3>
                            <?php
                            //get questions
                            $c_id = $_GET['c_id'];
                            $ret = "SELECT  * FROM  lms_questions WHERE c_id = ? ";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->bind_param('i', $c_id);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            //$cnt=1;
                            while ($row = $res->fetch_object()) {
                            ?>
                                <!-- single comment -->
                                <div class="media">
                                    <div class="media-left">
                                        <img src="./img/avatar.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $row->c_name; ?></h4>
                                        <?php echo $row->q_details; ?>
                                    </div>

                                    <!-- /single comment -->

                                <?php } ?>
                                </div>

                        </div>
                        <!-- /main blog -->


                    </div>
                    <!-- row -->

                </div>
                <!-- container -->

            </div>
            <!-- /Blog -->

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
<?php } ?>