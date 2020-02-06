
<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $i_id=$_SESSION['i_id'];
  //hold logged in user session.
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
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>
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
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <?php
                                            //code for summing up number of registrered students
                                            $result ="SELECT count(*) FROM lms_student";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->execute();
                                            $stmt->bind_result($std);
                                            $stmt->fetch();
                                            $stmt->close();
                                        ?>
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $std;?></h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Students</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-people"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                        <?php
                                            //code for summing up all assigned units for the registered user
                                            $i_id = $_SESSION['i_id'];
                                            $result ="SELECT count(*) FROM lms_units_assaigns WHERE i_id = ?";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->bind_param('i',$i_id);
                                            $stmt->execute();
                                            $stmt->bind_result($unit_assaigned);
                                            $stmt->fetch();
                                            $stmt->close();
                                        ?>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                            <?php echo $unit_assaigned;?>
                                    </h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Units Assaigned
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="icon icon-user-following"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <?php
                                            //code for summing up students that have enrolled my units
                                            $i_id = $_SESSION['i_id'];
                                            $result ="SELECT count(*) FROM lms_enrollments WHERE i_id =? ";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->bind_param('i',$i_id);
                                            $stmt->execute();
                                            $stmt->bind_result($student_enrolls);
                                            $stmt->fetch();
                                            $stmt->close();
                                        ?>
                                    
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo $student_enrolls;?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">My Student Enrollment</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="grid" class="feather-icon"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                        <?php
                                            $i_id = $_SESSION['i_id'];
                                            $result ="SELECT SUM(p_amt) FROM  lms_paid_study_materials WHERE i_id =? ";
                                            $stmt = $mysqli->prepare($result);
                                            $stmt->bind_param('i',$i_id);
                                            $stmt->execute();
                                            $stmt->bind_result($bills);
                                            $stmt->fetch();
                                            $stmt->close();
                                        ?>
                                    <h2 class="text-dark mb-1 font-weight-medium">Ksh <?php echo $bills;?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Course Materials Payments</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class=" icon-credit-card"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
                
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Sales Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                

                    
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enrollment Details </h4>
                                <div class="table-responsive">
                                    <table id="default_order" class="table table-striped table-bordered display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Instructor Name</th>
                                                <th>Student Name</th>
                                                <th>Enroll date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //Student Enrollment.
                                            $i_id = $_SESSION['i_id'];
                                            $ret="SELECT  * FROM  lms_enrollments WHERE i_id =?";
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->bind_param('i',$i_id);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                                $mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                                
                                        ?>
                                            <tr>
                                                <td><?php echo $row->s_unit_code;?></td>
                                                <td><?php echo $row->s_unit_name;?></td>
                                                <td><?php echo $row->i_name;?></td>
                                                <td><?php echo $row->s_name;?></td>
                                                <td><?php echo date("d M Y", strtotime($mysqlDateTime));?></td>
                                                <td>
                                                    <a class="badge badge-success" 
                                                         href="pages_ins_view_single_enrollment.php?en_id=<?php echo $row->en_id;?>&cc_id=<?php echo $row->cc_id;?>&c_id=<?php echo $row->c_id;?>&i_id=<?php echo $row->i_id;?>&s_id=<?php echo $row->s_id;?>">
                                                         <i class="fas fa-eye"></i> <i class=" fas fa-pallet"></i>
                                                         View Details
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php }?>    

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Student Records </h4>
                                <div class="table-responsive">
                                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>RegNo.</th>
                                                <th>PhoneNo.</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                //registered students details.

                                                $ret="SELECT  * FROM  lms_student";
                                                $stmt= $mysqli->prepare($ret) ;
                                                //$stmt->bind_param('i',$l_id);
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                                    //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                                    
                                            ?>

                                            <tr>
                                                <td><?php echo $row->s_name;?></td>
                                                <td><?php echo $row->s_regno;?></td>
                                                <td><?php echo $row->s_phoneno;?></td>
                                                <td><?php echo $row->s_dob;?></td>
                                                <td><?php echo $row->s_gender;?></td>
                                                <td>
                                                    <a class="badge badge-success" href="pages_ins_view_single_student.php?s_id=<?php echo $row->s_id;?>&s_regno=<?php echo $row->s_regno;?>">
                                                    <i class="fas fa-eye"></i><i class="fas fa-user"></i> View Record
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>     
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