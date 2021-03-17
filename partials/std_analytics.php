<?php
$id = $_SESSION['s_id'];

/* Student Enrollments */
$result = "SELECT COUNT(*) FROM lms_enrollments WHERE s_id = '$id'";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($students_enrollments);
$stmt->fetch();
$stmt->close();

/* Completed Units */
$result = "SELECT count(*) FROM lms_certs WHERE s_id = ' $id' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($complete_courses);
$stmt->fetch();
$stmt->close();


/* Paid Billings */
$result = "SELECT SUM(p_amt) FROM lms_paid_study_materials WHERE s_id = '$id'";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($paid_bills);
$stmt->fetch();
$stmt->close();
