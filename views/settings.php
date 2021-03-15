<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
admin();
require_once('../config/codeGen.php');

/* Update Default System Settings */
if (isset($_POST['update_sys_details'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['cc_name']) && !empty($_POST['cc_name'])) {
        $cc_name = mysqli_real_escape_string($mysqli, trim($_POST['cc_name']));
    } else {
        $error = 1;
        $err = "Name Cannot Be Empty";
    }
    if (isset($_POST['cc_code']) && !empty($_POST['cc_code'])) {
        $cc_code = mysqli_real_escape_string($mysqli, trim($_POST['cc_code']));
    } else {
        $error = 1;
        $err = "Code Cannot Be Empty";
    }
    if (isset($_POST['cc_dept_head']) && !empty($_POST['cc_dept_head'])) {
        $cc_dept_head = mysqli_real_escape_string($mysqli, trim($_POST['cc_dept_head']));
    } else {
        $error = 1;
        $err = "Course HOD Cannot Be Empty";
    }
    if (isset($_POST['cc_desc']) && !empty($_POST['cc_desc'])) {
        $cc_desc = mysqli_real_escape_string($mysqli, trim($_POST['cc_desc']));
    } else {
        $error = 1;
        $err = "Description Cannot Be Empty";
    }

    $cc_dpic = $_FILES["cc_dpic"]["name"];
    move_uploaded_file($_FILES["cc_dpic"]["tmp_name"], "../public/sys_data/uploads/courses/" . $_FILES["cc_dpic"]["name"]);

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  lms_course_categories WHERE  cc_code='$cc_code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($cc_code == $row['cc_code']) {
                $err =  "A Course With $cc_code Exists";
            }
        } else {
            $query = "INSERT INTO lms_course_categories (cc_name, cc_code, cc_dept_head, cc_desc, cc_dpic) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $cc_name, $cc_code, $cc_dept_head, $cc_desc, $cc_dpic);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=courses.php");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

require_once('../partials/head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../partials/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Intergrated LMS - System Settings</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <!-- ./row -->
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                        <div class="card card-warning card-tabs">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab">LMS Company Profile</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab">LMS Company Logo</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab">LMS Company Privacy Policy & License</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class=" col-md-12">
                                                                    <label>LMS Company Name</label>
                                                                    <input type="text" name="sys_name" value="<?php echo $sys->sys_name; ?>" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label>LMS Company Tagline</label>
                                                                    <textarea type="text" name="sys_tagline" class="form-control" id="editor"><?php echo $sys->sys_tagline; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="text-right">
                                                                <button type="submit" name="update_company_profile" class="btn btn-outline-warning">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel">
                                                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                                    </div>
                                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel">
                                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        <?php require_once('../partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <?php require_once('../partials/scripts.php'); ?>

</body>

</html>