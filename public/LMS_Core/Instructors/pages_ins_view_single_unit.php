<?php
session_start();
include('dist/inc/config.php');
include('dist/inc/checklogin.php');
check_login();
$i_id = $_SESSION['i_id'];
/*
  //register a new student
  if(isset($_POST['add_student']))
  {
      $s_regno = $_POST['s_regno'];
      $s_name = $_POST['s_name'];
      $s_email = $_POST['s_email'];
      $s_pwd = sha1(md5($_POST['s_pwd']));//Double encryption
      $s_phoneno = $_POST['s_phoneno'];
      $s_dob = $_POST['s_dob'];
      $s_gender = $_POST['s_gender'];
      $s_acc_stats = $_POST['s_acc_stats'];
      
      //Upload students profile picture
      $s_dpic = $_FILES["s_dpic"]["name"];
          move_uploaded_file($_FILES["s_dpic"]["tmp_name"],"../student/assets/images/users/".$_FILES["s_dpic"]["name"]);//move uploaded image
      
      //sql to insert captured values
      $query="INSERT INTO lms_student (s_regno, s_name, s_email, s_pwd, s_phoneno, s_dob, s_gender, s_acc_stats, s_dpic) VALUES (?,?,?,?,?,?,?,?,?)";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('sssssssss', $s_regno, $s_name, $s_email, $s_pwd, $s_phoneno, $s_dob, $s_gender, $s_acc_stats, $s_dpic);
      $stmt->execute();

      if($stmt)
      {
                $success = "Student Account Added";
                
                //echo "<script>toastr.success('Have Fun')</script>";
      }
      else {
        $err = "Please Try Again Or Try Later";
      }
      
      
  }
  */
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
                        <?php include("dist/inc/time_API.php"); ?>
                        <!--Get Details of unit given a course-->
                        <?php
                        $c_id = $_GET['c_id'];
                        $ret = "SELECT  * FROM lms_course  WHERE c_id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $c_id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {

                        ?>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="pages_ins_view_units.php">Units</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="pages_ins_view_units.php">View</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href=""><?php echo $row->c_category; ?></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href=""><?php echo $row->c_name; ?></a>
                                        </li>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        <?php } ?>
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
                    <div class="col-lg-6 col-md-6">
                        <!-- Card -->
                        <div class="card">
                            <?php
                            $cc_id = $_GET['cc_id'];
                            $ret = "SELECT  * FROM lms_course_categories  WHERE cc_id=?";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->bind_param('i', $cc_id);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            //$cnt=1;
                            while ($row = $res->fetch_object()) {

                            ?>
                                <img class="card-img-top img-fluid" src="assets/images/course_cat/<?php echo $row->cc_dpic; ?>" alt="Card image cap">
                            <?php } ?>
                        </div>
                        <!-- Card -->
                    </div>
                    <?php
                    $c_id = $_GET['c_id'];
                    $ret = "SELECT  * FROM lms_course  WHERE c_id=?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param('i', $c_id);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    //$cnt=1;
                    while ($row = $res->fetch_object()) {

                    ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="card-header">
                                <?php echo $row->c_name; ?>'s Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Unit Name : <?php echo $row->c_name; ?></li>
                                <li class="list-group-item">Unit Code : <?php echo $row->c_code; ?></li>
                                <li class="list-group-item">Course Name : <?php echo $row->c_category; ?></li>
                            </ul>

                            <!-- Card -->
                        </div>

                        <div class="col-lg-12 col-md-6">
                            <div class="card-header">
                                <?php echo $row->c_name; ?>'s Description
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $row->c_desc; ?></li>

                            </ul>

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