<?php
session_start();
include('dist/inc/config.php');
include('dist/inc/checklogin.php');
check_login();
$s_id = $_SESSION['s_id'];

//post discussion
if (isset($_POST['post_ans'])) {
    $f_id = $_GET['f_id'];
    $i_id = $_GET['i_id'];
    $c_id = $_GET['c_id'];
    $s_unit_name = $_GET['s_unit_name'];
    $s_unit_code = $_GET['s_unit_code'];
    $f_no  = $_GET['f_no'];
    $s_id = $_SESSION['s_id'];
    $f_ans = $_POST['f_ans'];
    $f_topic = $_POST['f_topic'];
    $s_name = $_POST['s_name'];

    //sql to insert captured values
    $query = "INSERT  INTO lms_forum_discussions  (f_id, i_id, c_id, s_unit_name, s_unit_code, f_no, s_id, f_ans, f_topic, s_name) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssssss', $f_id, $i_id, $c_id, $s_unit_name, $s_unit_name, $f_no, $s_id, $f_ans, $f_topic, $s_name);
    $stmt->execute();

    if ($stmt) {
        $success = "Your Answer Posted";

        //echo "<script>toastr.success('Have Fun')</script>";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<!--Head-->
<?php include("dist/inc/head.php"); ?>
<!-- ./Head -->

<body onload=display_ct();>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("dist/inc/header.php"); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("dist/inc/sidebar.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <?php
                        include("dist/inc/time_API.php");
                        $f_id = $_GET['f_id'];
                        $ret = "SELECT  * FROM lms_forum  WHERE f_id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $f_id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {

                        ?>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="pages_std_dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="pages_std_manage_forum.php">Forum</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Give Discussion</a>
                                        </li>

                                    </ol>
                                </nav>
                            </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected id="ct"></option>

                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 col-md-6">
                        <div class="card-header">
                            <?php echo $row->s_unit_code; ?> <?php echo $row->s_unit_name; ?>
                        </div>
                        <hr>

                        <table class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Discussion Questions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $row->f_topic; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Posted Answers</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $f_id = $_GET['f_id'];
                                $ret = "SELECT  * FROM lms_forum_discussions  WHERE f_id=?";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->bind_param('i', $f_id);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                //$cnt=1;
                                while ($row = $res->fetch_object()) {

                                ?>
                                    <tr>
                                        <td><?php echo $row->f_ans; ?>
                                            <hr>Ansered By: <?php echo $row->s_name; ?>
                                        </td>

                                    </tr>

                                <?php } ?>
                            </tbody>

                        </table>
                        <form method="post" enctype="multipart/form-data">


                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1">Your Answer</label>
                                    <textarea type="text" name="f_ans" required class="form-control" id="forum_discussion" aria-describedby="emailHelp"></textarea>
                                </div>
                                <?php
                                $s_id = $_SESSION['s_id'];
                                $ret = "SELECT  * FROM lms_student  WHERE s_id=?";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->bind_param('i', $s_id);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                //$cnt=1;
                                while ($row = $res->fetch_object()) {

                                ?>
                                    <div class="form-group col-md-12" style="display:none">
                                        <label for="exampleInputEmail1">Student Name</label>
                                        <textarea type="text" name="s_name" required class="form-control" id="forum_discussion1" aria-describedby="emailHelp"><?php echo $row->s_name; ?></textarea>
                                    </div>
                                <?php } ?>
                                <?php
                                $f_id = $_GET['f_id'];
                                $ret = "SELECT  * FROM lms_forum  WHERE f_id=?";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->bind_param('i', $f_id);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                //$cnt=1;
                                while ($row = $res->fetch_object()) {

                                ?>
                                    <div class="form-group col-md-12" style="display:none">
                                        <label for="exampleInputEmail1">Topic</label>
                                        <textarea type="text" name="f_topic" required class="form-control" id="forum_discussion" aria-describedby="emailHelp"><?php echo $row->f_topic; ?></textarea>
                                    </div>
                                <?php } ?>

                            </div>

                            <hr>

                            <button type="submit" name="post_ans" class="btn btn-outline-primary">Post</button>
                        </form>

                        <!-- Card -->
                    </div>
                <?php } ?>
                </div>
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include("dist/inc/footer.php"); ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('forum_discussion')
    </script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>