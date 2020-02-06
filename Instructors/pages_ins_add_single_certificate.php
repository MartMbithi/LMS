<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $i_id = $_SESSION['i_id'];

  //Enroll Student

  if(isset($_POST['add_cert']))
  {
      $en_id = $_GET['en_id'];
      $s_id = $_GET['s_id'];
      $i_id = $_GET['i_id'];
      $en_date = $_GET['en_date'];
      $s_name = $_POST['s_name'];
      $s_regno = $_POST['s_regno'];
      $s_unit_code = $_POST['s_unit_code'];
      $s_unit_name = $_POST['s_unit_name'];
      $i_name = (($_POST['i_name']));
      

      //sql to insert captured values
      $query="INSERT INTO lms_certs (en_id, s_id, i_id, en_date, s_name, s_regno, s_unit_code, s_unit_name, i_name) VALUES (?,?,?,?,?,?,?,?,?) ";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('sssssssss', $en_id, $s_id, $i_id, $en_date, $s_name, $s_regno, $s_unit_code, $s_unit_name, $i_name);
      $stmt->execute();

      if($stmt)
      {
                $success = "Details Saved";
                
                //echo "<script>toastr.success('Have Fun')</script>";
      }
      else {
        $err = "Please Try Again Or Try Later";
      }
      
      
  }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<!--Head-->
<?php include("dist/inc/head.php");?>
<!-- ./Head -->

<body onload=display_ct();>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
            <?php include("dist/inc/header.php");?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
            <?php include("dist/inc/sidebar.php");?>
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
                            $en_id = $_GET['en_id'];
                            $ret="SELECT  * FROM  lms_enrollments  WHERE en_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$en_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                                ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_admin_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_admin_add_certificate.php">Certificates</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_admin_add_certificate.php">Add</a>
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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row->s_name;?> Enrollment Details</h4>
                                <!--Add Student-->
                                <form method ="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Name</label>
                                            <input type="text" readonly name="s_name" value="<?php echo $row->s_name;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                          
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Registration Number</label>
                                            <input type="text" readonly name="s_regno" value="<?php echo $row->s_regno;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Code</label>
                                            <input type="text" readonly name="s_unit_code" value="<?php echo $row->s_unit_code;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                          
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Name</label>
                                            <input type="text" readonly name="s_unit_name" value="<?php echo $row->s_unit_name;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Instructor Name</label>
                                            <input type="text" readonly name="i_name" value="<?php echo $row->i_name;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                    </div>
                                   
                                   <hr>

                                    <button type="submit" name="add_cert" class="btn btn-outline-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                            <?php }?>
                </div>
            
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
                 <?php include("dist/inc/footer.php");?>
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