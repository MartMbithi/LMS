<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $a_id=$_SESSION['a_id'];

  //Update students results
  if(isset($_POST['update_results']))
  {
      
      $c_cat1_marks = $_POST['c_cat1_marks'];
      $c_cat2_marks = $_POST['c_cat2_marks'];
      $c_eos_marks = $_POST['c_eos_marks'];
      $rs_id = $_GET['rs_id'];

      //sql to insert captured values
      $query="UPDATE lms_results SET  c_cat1_marks=?, c_cat2_marks=?,  c_eos_marks=? WHERE rs_id = ?";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('sssi',  $c_cat1_marks, $c_cat2_marks, $c_eos_marks, $rs_id);
      $stmt->execute();

      if($stmt)
      {
                $success = "Marks Updated";
                
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
                            $a_id = $_SESSION['a_id'];
                            $ret="SELECT  * FROM  lms_admin  WHERE a_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$a_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                                // time function to get day zones ie morning, noon, and night.
                                $t = date("H");

                                if ($t < "10")
                                 {
                                    $d_time = "Good Morning";

                                    }

                                     elseif ($t < "15")
                                      {

                                      $d_time =  "Good Afternoon";

                                     } 

                                        elseif ($t < "20")
                                        {

                                        $d_time =  "Good Evening";

                                        } 
                                        else {

                                            $d_time = "Good Night";
                                }
                        ?>
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $d_time;?> <?php echo $row->a_uname;?></h3>
                        <?php }?>
                        <?php
                            //get single marks record
                            $rs_id = $_GET['rs_id'];
                            $ret="SELECT  * FROM  lms_results WHERE rs_id = ?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$rs_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            $cnt=1;
                            while($row=$res->fetch_object())
                            {
                                //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                
                        ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_admin_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Results</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_admin_manage_results.php">Manage</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Update <?php echo $row->s_unit_code;?></a>
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
                                <h4 class="card-title">Update <?php echo $row->s_name;?>'s  Marks</h4>
                                <!--Add Student-->
                                <form method ="post" enctype="multipart/form-data">
                                    <div class="row">


                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Registration Number</label>
                                            <input type="text" name="s_regno" readonly required value="<?php echo $row->s_regno;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="s_name" readonly value="<?php echo $row->s_name;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Instructor Name</label>
                                            <input type="text" name="i_name" readonly value="<?php echo $row->i_name;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Unit Code</label>
                                            <input type="text" name="s_unit_code" readonly value="<?php echo $row->s_unit_code;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Unit Name</label>
                                            <input type="text" name="s_unit_name" readonly required value="<?php echo $row->s_unit_name;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">CAT 1 Marks</label>
                                            <input type="text" name="c_cat1_marks" value="<?php echo $row->c_cat1_marks;?>"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">CAT 2 Marks</label>
                                            <input type="text" name="c_cat2_marks" value="<?php echo $row->c_cat2_marks;?>"  required  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">End Of Semester Exam Marks</label>
                                            <input type="text" name="c_eos_marks" value="<?php echo $row->c_eos_marks;?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                    </div>


                                    <button type="submit" name="update_results" class="btn btn-outline-warning">Update Marks</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            
                <!-- *************************************************************** -->
            </div>
            <?php }?>
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
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor1')
    </script>
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