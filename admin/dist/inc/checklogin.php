<?php
function check_login()
{
if(strlen($_SESSION['a_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="pages_admin_index.php";
		$_SESSION["a_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
