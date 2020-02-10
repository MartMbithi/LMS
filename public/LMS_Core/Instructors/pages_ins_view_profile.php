<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $i_id=$_SESSION['i_id'];
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
                            $i_id = $_SESSION['i_id'];
                            $ret="SELECT  * FROM  lms_instructor  WHERE i_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$i_id);
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $d_time;?> <?php echo $row->i_name;?></h3>
                        <?php }?>
                        <!--Get Details of single student-->
                        <?php
                            $i_id = $_SESSION['i_id'];
                            $ret="SELECT  * FROM lms_instructor  WHERE i_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$i_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                              
                        ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>                                    </li>
                                    
                                    <li class="breadcrumb-item"><a href="">Profile</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href=""><?php echo $row->i_name;?></a>
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
                    <div class="col-lg-6 col-md-6">
                            <!-- Card -->
                            <div class="card">
                                <img class="card-img-top img-fluid" src="../admin/assets/images/users/<?php echo $row->i_dpic;?>"
                                    alt="Card image cap">
                            </div>
                            <!-- Card -->
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="card-header">
                            <?php echo $row->i_name;?>'s Details
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name      : <?php echo $row->i_name;?></li>
                            <li class="list-group-item">Reg No    : <?php echo $row->i_number;?></li>
                            <li class="list-group-item">Email     : <?php echo $row->i_email;?></li>
                            <li class="list-group-item">Phone No  : <?php echo $row->i_phone;?></li>
                            <li class="list-group-item">Bio       : <?php echo $row->i_bio;?></li>
                           
                        </ul>
                            
                            <!-- Card -->
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="card-header">
                            <?php echo $row->i_name;?>'s Units Assaigned.
                        </div>
                        <hr>
                        
                        <table id="default_order" class="table table-striped table-bordered display no-wrap" 
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unit Code</th>
                                    <th>Unit Name</th>
                                    <th>Course</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //unit assaignment details
                                $i_id = $_SESSION['i_id'];
                                $ret="SELECT  * FROM  lms_units_assaigns WHERE i_id =?";
                                $stmt= $mysqli->prepare($ret) ;
                                $stmt->bind_param('i',$i_id);
                                $stmt->execute() ;//ok
                                $res=$stmt->get_result();
                                $cnt=1;
                                while($row=$res->fetch_object())
                                {
                                    //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                    
                            ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $row->c_code;?></td>
                                    <td><?php echo $row->c_name;?></td>
                                    <td><?php echo $row->c_category;?></td>
                                    
                                </tr>

                                <?php $cnt = $cnt +1; }?>    

                            </tbody>
                        </table>
                            
                            <!-- Card -->
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