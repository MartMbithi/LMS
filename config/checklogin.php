<?php
function admin()
{
	if (strlen($_SESSION['a_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "login.php";
		$_SESSION["a_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

function instructor()
{
	if (strlen($_SESSION['i_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "ins_login.php";
		$_SESSION["a_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

function student()
{
	if (strlen($_SESSION['s_id']) == 0) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "std_login.php";
		$_SESSION["s_id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}