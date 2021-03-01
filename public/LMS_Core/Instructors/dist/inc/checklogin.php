<?php
function check_login()
{
if(strlen($_SESSION['i_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="pages_ins_index.php";
		$_SESSION["i_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
