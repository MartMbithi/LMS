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

/* Unit Details */
if (!empty($_POST["Unit_Code"])) {
    $id = $_POST['Unit_Code'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_name']); ?>
<?php
    }
}

if (!empty($_POST["Unit_Name"])) {
    $id = $_POST['Unit_Name'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_id']); ?>
<?php
    }
}

if (!empty($_POST["Unit_Id"])) {
    $id = $_POST['Unit_Id'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['cc_id']); ?>
<?php
    }
}


if (!empty($_POST["Course_Id"])) {
    $id = $_POST['Course_Id'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_course WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_category']); ?>
<?php
    }
}



/* Instructor Details */
if (!empty($_POST["Ins_Number"])) {
    $id = $_POST['Ins_Number'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_instructor WHERE i_number = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_name']); ?>
<?php
    }
}

if (!empty($_POST["Ins_Name"])) {
    $id = $_POST['Ins_Name'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_instructor WHERE i_number = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_id']); ?>
<?php
    }
}

/* Allocation Details */
if (!empty($_POST["Allocated_Unit_Code"])) {
    $id = $_POST['Allocated_Unit_Code'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_name']); ?>
<?php
    }
}

if (!empty($_POST["Allocated_Unit_Name"])) {
    $id = $_POST['Allocated_Unit_Name'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_name']); ?>
<?php
    }
}

if (!empty($_POST["Allocated_Ins_Name"])) {
    $id = $_POST['Allocated_Ins_Name'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['cc_id']); ?>
<?php
    }
}


if (!empty($_POST["Allocated_Course_ID"])) {
    $id = $_POST['Allocated_Course_ID'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_id']); ?>
<?php
    }
}

if (!empty($_POST["Allocated_Unit_ID"])) {
    $id = $_POST['Allocated_Unit_ID'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['i_id']); ?>
<?php
    }
}


if (!empty($_POST["Allocated_Ins_ID"])) {
    $id = $_POST['Allocated_Ins_ID'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_units_assaigns WHERE c_code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['c_category']); ?>
<?php
    }
}


/* Student Details */
if (!empty($_POST["Std_Admn"])) {
    $id = $_POST['Std_Admn'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_student WHERE s_regno = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['s_name']); ?>
<?php
    }
}

if (!empty($_POST["Std_Name"])) {
    $id = $_POST['Std_Name'];
    $stmt = $DB_con->prepare("SELECT * FROM lms_student WHERE s_regno = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['s_id']); ?>
<?php
    }
}