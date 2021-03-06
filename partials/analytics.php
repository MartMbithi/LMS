<?php
//code for summing up number of registrered students
$result = "SELECT count(*) FROM lms_student";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($std);
$stmt->fetch();
$stmt->close();

//code for summing up number of registrered Instructors
$result = "SELECT count(*) FROM lms_instructor";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($instructors);
$stmt->fetch();
$stmt->close();

//code for summing up number of registrered Course Categories
$result = "SELECT count(*) FROM lms_course_categories";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($course_categories);
$stmt->fetch();
$stmt->close();

//code for summing up number of registrered Course Categories
$result = "SELECT count(*) FROM lms_course";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($courses);
$stmt->fetch();
$stmt->close();

//code for summing up number of student enrollments
$result = "SELECT count(*) FROM lms_enrollments";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($s_enroll);
$stmt->fetch();
$stmt->close();


/* Payments */
 $result = "SELECT SUM(p_amt) FROM  lms_paid_study_materials ";
 $stmt = $mysqli->prepare($result);
 $stmt->execute();
 $stmt->bind_result($bills);
 $stmt->fetch();
 $stmt->close();

 /* Assigns */
 $result = "SELECT COUNT(*) FROM  lms_units_assaigns ";
 $stmt = $mysqli->prepare($result);
 $stmt->execute();
 $stmt->bind_result($ins_all);
 $stmt->fetch();
 $stmt->close();

