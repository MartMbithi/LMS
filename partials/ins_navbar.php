<?php
$i_id = $_SESSION['i_id'];
$ret = "SELECT  * FROM  lms_instructor  WHERE i_id= '$i_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($ins = $res->fetch_object()) {
?>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="ins_dashboard.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="ins_students.php" class="nav-link">Students</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="ins_unit_enrollments.php" class="nav-link">Enrollments</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="ins_teaching_allocations.php" class="nav-link">Teaching Allocations</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Hello, <?php echo $ins->i_name; ?> </span>
                    <div class="dropdown-divider"></div>
                    <a href="ins_profile.php" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="ins_logout.php" class="dropdown-item">
                        <i class="fas fa-power-off mr-2"></i> Log Out
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>
<?php
} ?>