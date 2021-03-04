<?php
include('dist/inc/pdoconfig.php');
if (!empty($_POST["selected_code_unit"])) {
    //get the name of selected unit
    $id = $_POST['selected_code_unit'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_course WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_name']); ?>
<?php
    }
}

if (!empty($_POST["unitCourse"])) {
    //get the name of the course that the selected unit belongs to.
    $id = $_POST['unitCourse'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_course WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_category']); ?>
<?php
    }
}


if (!empty($_POST["courseId"])) {
    //get the ID of the course in which the selected unit code belongs to
    $id = $_POST['courseId'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_course WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['cc_id']); ?>
<?php
    }
}

if (!empty($_POST["unitId"])) {
    //get the ID of the course in which the selected unit code belongs to
    $id = $_POST['unitId'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_course WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_id']); ?>
<?php
    }
}

if (!empty($_POST["instructorName"])) {
    //get instructor name with a given course code
    $id = $_POST['instructorName'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_units_assaigns WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_name']); ?>
<?php
    }
}

if (!empty($_POST["instructorId"])) {
    //get instructor id with a given course code
    $id = $_POST['instructorId'];
    $stmt = $DB_con->prepare("SELECT * FROM  lms_units_assaigns WHERE c_code = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_id']); ?>
<?php
    }
}
