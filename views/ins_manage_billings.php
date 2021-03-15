<?php
session_start();
include('../config/config.php');
include('../config/checklogin.php');
instructor();
require_once('../config/codeGen.php');

/* Add Study Materials Price */
if (isset($_POST['add_payment'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['ls_id']) && !empty($_POST['ls_id'])) {
        $ls_id = mysqli_real_escape_string($mysqli, trim($_POST['ls_id']));
    } else {
        $error = 1;
        $err = "Study Material Cannot Be Empty";
    }

    if (isset($_POST['sm_price']) && !empty($_POST['sm_price'])) {
        $sm_price = mysqli_real_escape_string($mysqli, trim($_POST['sm_price']));
    } else {
        $error = 1;
        $err = "Study Material Price Cannot Be Empty";
    }

    if (!$error) {
        $updateQry = "UPDATE lms_study_material SET sm_price =? WHERE ls_id = '$ls_id' ";
        $updatestmt = $mysqli->prepare($updateQry);
        $updatestmt->bind_param('s', $sm_price);
        $updatestmt->execute();
        if ($updatestmt) {
            $success = "Added" && header("refresh:1; url=ins_billings.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/* Pay For A Specific Reading Material */
if (isset($_POST['update_payment'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['psm_id']) && !empty($_POST['psm_id'])) {
        $psm_id = mysqli_real_escape_string($mysqli, trim($_POST['psm_id']));
    } else {
        $error = 1;
        $err = "Study Material ID Cannot Be Empty";
    }


    if (isset($_POST['p_method']) && !empty($_POST['p_method'])) {
        $p_method  = mysqli_real_escape_string($mysqli, trim($_POST['p_method']));
    } else {
        $error = 1;
        $err = "Payment Method Cannot Be Empty";
    }

    if (isset($_POST['p_code']) && !empty($_POST['p_code'])) {
        $p_code  = mysqli_real_escape_string($mysqli, trim($_POST['p_code']));
    } else {
        $error = 1;
        $err = "Payment Code Cannot Be Empty";
    }

    if (isset($_POST['p_amt']) && !empty($_POST['p_amt'])) {
        $p_amt  = mysqli_real_escape_string($mysqli, trim($_POST['p_amt']));
    } else {
        $error = 1;
        $err = "Payment Amount Cannot Be Empty";
    }

    if (!$error) {
        $query = "UPDATE  lms_paid_study_materials SET p_method =?, p_code =?, p_amt =? WHERE psm_id = ?";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ssss', $p_method, $p_code, $p_amt, $psm_id);
        $stmt->execute();
        if ($stmt) {
            $success = "Updated" && header("refresh:1; url=ins_manage_billings.php");
        } else {
            $info = "Please Try Again Or Try Later";
        }
    }
}

/*Delete Payment  */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = "DELETE FROM lms_paid_study_materials WHERE psm_id= '$id' ";
    $stmt = $mysqli->prepare($adn);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = "Deleted" && header("refresh:1; url=ins_manage_billings.php");
    } else {
        $info = "Please Try Again Or Try Later";
    }
}

/* Persist System Settings  */
$ret = "SELECT * FROM `lms_sys_setttings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/head.php'); ?>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <?php require_once('../partials/ins_navbar.php'); ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once('../partials/ins_sidebar.php'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?php echo $sys->sys_name; ?> - Payment Records</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="ins_sdashboard.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="ins_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Billings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="text-right text-dark">
                                <a class="btn btn-warning" href="ins_billings.php">Add Study Materials Payments</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="dash-1" class="table table-striped table-bordered display no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Paid Unit</th>
                                                <th>Payment Code</th>
                                                <th>Amount Paid</th>
                                                <th>Date Paid</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $id = $_SESSION['i_id'];
                                            $ret = "SELECT  * FROM  lms_paid_study_materials WHERE i_id = '$id' ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($payments = $res->fetch_object()) {
                                                $mysqlDateTime = $payments->p_date_paid; ?>
                                                <tr>
                                                    <td><?php echo $payments->c_name; ?></td>
                                                    <td><?php echo $payments->p_code; ?></td>
                                                    <td>Ksh <?php echo $payments->p_amt; ?></td>
                                                    <td><?php echo date("d M Y g:ia", strtotime($mysqlDateTime)); ?></td>
                                                    <td>

                                                        <a class='badge badge-warning' href='ins_view_payment.php?view=<?php echo $payments->psm_id; ?>'>
                                                            <i class='fas fa-external-link-alt'></i>
                                                            View Payment
                                                        </a>

                                                        <a class='badge badge-warning' data-toggle='modal' href='#update-<?php echo $payments->psm_id; ?>'>
                                                            <i class='fas fa-pencil-alt'></i>
                                                            Update Payment
                                                        </a>
                                                        <a class='badge badge-warning' data-toggle='modal' href='#delete-<?php echo $payments->psm_id; ?>'>
                                                            <i class='fas fa-trash-alt'></i>
                                                            Delete Payment
                                                        </a>


                                                        <!-- Udpate Payment Materials Modal -->
                                                        <div class="modal fade" id="update-<?php echo $payments->psm_id; ?>">
                                                            <div class="modal-dialog  modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-center">
                                                                        <h4 class="modal-title">Update Payment</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form -->
                                                                        <form method="post" enctype="multipart/form-data">

                                                                            <div class="row">
                                                                                <div class="form-group col-md-6" style="display:none">
                                                                                    <label for="exampleInputEmail1">Unit Name</label>
                                                                                    <input type="text" name="c_name" value="<?php echo $payments->c_name; ?>" readonly required class="form-control">
                                                                                    <!-- Hidden Values -->
                                                                                    <input type="hidden" name="psm_id" value="<?php echo $payments->psm_id; ?>" readonly required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Amount To Pay</label>
                                                                                    <input type="text" name="p_amt" value="<?php echo $payments->p_amt; ?>" required class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="exampleInputEmail1">Payment Method</label>
                                                                                    <select name="p_method" class="form-control select2bs4" style="width: 100%;">
                                                                                        <option><?php echo $payments->p_method; ?></option>
                                                                                        <option>Mpesa</option>
                                                                                        <option>Airtel Money</option>
                                                                                        <option>Bank Deposit</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group col-md-12">
                                                                                    <label for="exampleInputEmail1">Payment Code | Refrence Number <small class="text-warning">Enter 10 Digit Code if paid using Mpesa Or AirtelMoney And Slip Number If Paid Using Bank</small></label>
                                                                                    <input type="text" name="p_code" value="<?php echo $payments->p_code; ?>" required class="form-control">
                                                                                </div>
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <button type="submit" name="update_payment" class="btn btn-outline-warning">Update Payments</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal -->

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="delete-<?php echo $payments->psm_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center text-danger">
                                                                        <h4>Delete Payment Record ?</h4>
                                                                        <br>
                                                                        <button type="button" class="text-center btn btn-outline-warning" data-dismiss="modal">No</button>
                                                                        <a href="ins_manage_billings.php?delete=<?php echo $payments->psm_id; ?>" class="text-center btn btn-outline-warning"> Delete </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Delete Modal -->

                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>

                                        </tbody>
                                    </table>
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
<?php
} ?>