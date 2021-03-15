<?php
$i_id = $_SESSION['i_id'];

/* Student Enrollments */
$result = "SELECT COUNT(*) FROM lms_enrollments WHERE i_id = '$i_id'";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($students_enrollments);
$stmt->fetch();
$stmt->close();

/* Allocated Units */
$result = "SELECT COUNT(*) FROM lms_units_assaigns WHERE i_id = '$i_id'";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($allocated_units);
$stmt->fetch();
$stmt->close();


/* Paid Billings */
$result = "SELECT SUM(p_amt) FROM lms_paid_study_materials WHERE i_id = '$i_id'";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($paid_bills);
$stmt->fetch();
$stmt->close();
