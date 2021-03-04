<?php
session_start();
include('dist/inc/config.php');
include('dist/inc/checklogin.php');
check_login();
$s_id = $_SESSION['s_id'];
/*egister a new instructor

  if(isset($_POST['lms_instructor']))
  {
      $i_number = $_POST['i_number'];
      $i_name = $_POST['i_name'];
      $i_email = $_POST['i_email'];
      $i_pwd = sha1(md5($_POST['i_pwd']));//Double encryption
      
      //Upload students profile picture
      $i_dpic = $_FILES["i_dpic"]["name"];
          move_uploaded_file($_FILES["i_dpic"]["tmp_name"],"../student/assets/images/users/".$_FILES["i_dpic"]["name"]);//move uploaded image
      
      //sql to insert captured values
      $query="INSERT INTO lms_instructor (i_number, i_name, i_email, i_pwd, i_dpic) VALUES (?,?,?,?,?)";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('sssss', $i_number, $i_name, $i_email, $i_pwd, $i_dpic);
      $stmt->execute();

      if($stmt)
      {
                $success = "Instructor Account Added";
                
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
                        <?php
                        include("dist/inc/time_API.php");
                        //Student certificates
                        $cert_id = $_GET['cert_id'];
                        $ret = "SELECT  * FROM  lms_certs WHERE cert_id = ?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $cert_id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        $cnt = 1;
                        while ($row = $res->fetch_object()) {
                            $mysqlDateTime = $row->date_generated; //trim timestamp to DD/MM/YYYY formart

                        ?>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="pages_std_dashboard.php">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Certificates</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="pages_std_manage_certificates.php">Manage</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="">Print</a>
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
            <!--Inline Css for certificate-->
            <style>
                #certificate {
                    background: linear-gradient(#91EAE4 50%, rgba(255, 255, 255, 0) 0) 0 0, radial-gradient(circle closest-side, #91EAE4 50%, rgba(255, 255, 255, 0) 0) 0 0, radial-gradient(circle closest-side, #91EAE4 0%, rgba(255, 255, 255, 0) 0) 55px 0 #FFF;
                    background-size: 10.5in 8in;
                    background-repeat: repeat-x;
                }

                body {
                    margin: 0;
                }

                @media print {
                    table {
                        background: linear-gradient(#667db6 50%, rgba(255, 255, 255, 0) 0) 0 0, radial-gradient(circle closest-side, #c8be75 50%, rgba(255, 255, 255, 0) 0) 0 0, radial-gradient(circle closest-side, #c8be75 0%, rgba(255, 255, 255, 0) 0) 55px 0 #FFF;
                        background-size: 10.5in 8in;
                        background-repeat: repeat-x;
                        -webkit-print-color-adjust: exact;
                    }
                }

                @page {
                    margin-top: 0.5cm;
                    margin-bottom: 2cm;
                    margin-left: 2cm;
                    margin-right: 2cm;
                }
            </style>
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">


                    <div class="col-lg-12">
                        <div class="card">
                            <div id="Print_Certificate" class="certificate-container col-md-12" style="background:#f9f9f9">
                                <table id="certificate" class="col-md-12" style="width: 11in;margin: 0 auto;text-align: center;padding: 10px;border-style: groove;border-width: 20px;outline: 5px dotted #000;height: 8.5in;outline-offset: -26px;outline-style: double;border-color: #667db6;">
                                    <tr>
                                        <td>
                                            <h1 style="font-size: 0.6in; margin: 0; color: #000;">Certificate of Completion</h1>
                                            <h3 style="margin: 0;font-size: 0.25in;color: black;text-transform: uppercase;font-family: sans-serif;"> Is hereby granted to : </h3>
                                            <p style="font-size: 0.3in;text-transform: uppercase;color: #494000;"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 style="color: #fff; font-size: 0.4in;margin: 10px 0 0 0; font-family: sans-serif;text-transform: uppercase;"><?php echo $row->s_name; ?></h2>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 style="margin:0; font-size: 0.16in;font-family: sans-serif;color: #000;">For Completing <?php echo $row->s_unit_name; ?>.</h4>
                                            <h5 style="margin: 5px 0 40px; font-size: 0.16in;font-family: sans-serif;color: #000;"><?php echo $row->s_unit_code; ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/logo-icon.png" alt="" style="max-width:100%;"><img src="assets/images/logo-text.png" alt="" style="max-width:100%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 style="margin: 10px 0 20px; font-family: sans-serif;font-size: 0.12in;"></h6>
                                            <em>Generated : <?php echo date("d M Y- h:m:s", strtotime($mysqlDateTime)); ?> </em>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <button id="print" onclick='printContent("Print_Certificate");' class="btn btn-outline-success"><i class="fas fa-print"></i>Print Certificate</button>
                    </div>


                </div>

                <!-- *************************************************************** -->
            </div>
        <?php } ?>
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