<?php
$a_id = $_SESSION['a_id'];
$ret = "SELECT  * FROM  lms_admin  WHERE a_id=?";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $a_id);
$stmt->execute(); //ok
$res = $stmt->get_result();
//$cnt=1;
while ($row = $res->fetch_object()) {
    // time function to get day zones ie morning, noon, and night.
    $t = date("H");

    if ($t < "10") {
        $d_time = "Good Morning";
    } elseif ($t < "15") {

        $d_time =  "Good Afternoon";
    } elseif ($t < "20") {

        $d_time =  "Good Evening";
    } else {

        $d_time = "Good Night";
    }
?>
    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $d_time; ?> <?php echo $row->a_uname; ?></h3>
<?php } ?>