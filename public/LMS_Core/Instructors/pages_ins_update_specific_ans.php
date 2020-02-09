<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $i_id = $_SESSION['i_id'];

  //update answers of a certain unit.
  if(isset($_POST['update_Answ']))
  {
      $an_id = $_GET['an_id'];
      $ans_details = $_POST['ans_details'];

      //sql to insert captured values
      $query="UPDATE  lms_answers SET  ans_details = ? WHERE an_id =?";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('si', $ans_details, $an_id);
      $stmt->execute();

      if($stmt)
      {
                $success = "Answer Updated";
                
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
                            $an_id = $_GET['an_id'];
                            $ret="SELECT  * FROM  lms_answers WHERE an_id = ?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$an_id);
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
                                    <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Answers</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_ins_manage_ans.php">Manage</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href=""><?php echo $row->c_name;?></a>
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
                                <h4 class="card-title">Update <?php echo $row->c_name;?> Answers</h4>
                                <!--Add Student-->
                                <form method ="post" enctype="multipart/form-data">
                                   
                                    <div class="row">
                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Ans Code</label>
                                                <?php 
                                                    $length = 4;    
                                                    $a_code =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                ?>
                                            <input type="text" name="an_code" readonly value="ANS-<?php echo $a_code;?>"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Unit Name</label>
                                            <input type="text" name="c_name" value="<?php echo $row->c_name;?>" readonly  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>    

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Unit Code</label>
                                            <input type="text" readonly name="c_code" value="<?php echo $row->c_code;?>"  required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row"> 
                                        
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">Questions</label>
                                            <textarea type="text" name="q_details"  class="form-control" id="editor1" readonly aria-describedby="emailHelp"><?php echo $row->q_details;?></textarea>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row"> 
                                        
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">Answers</label>
                                            <textarea type="text" name="ans_details"  class="form-control" id="editor2" aria-describedby="emailHelp"><?php echo $row->ans_details;?></textarea>
                                        </div>

                                    </div>

                                   <hr>

                                    <button type="submit" name="update_Answ" class="btn btn-outline-primary">Update Answers</button>
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
    <script type="text/javascript">
        CKEDITOR.replace('editor2')
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