<?php
include('../config/pdoconfig.php');

/* Course ID*/
if (!empty($_POST["Course_Code"])) {
    $id = $_POST['Course_Code'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course_categories WHERE cc_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['cc_id']); ?>
<?php
    }
}

/* Course Name */
if (!empty($_POST["Course_Id"])) {
    $id = $_POST['Course_Id'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course_categories WHERE cc_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['cc_name']); ?>
<?php
    }
}