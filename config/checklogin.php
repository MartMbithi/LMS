<?php
function admin()
{
	if (strlen($_SESSION['a_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "pages_admin_index.php";
		$_SESSION["a_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

function instructor()
{
	if (strlen($_SESSION['i_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "pages_instructor_index.php";
		$_SESSION["a_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

function student()
{
	if (strlen($_SESSION['s_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "pages_student_index.php";
		$_SESSION["s_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}