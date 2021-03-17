<?php
session_start();
unset($_SESSION['s_id']);
session_destroy();
header("Location: std_login.php");
exit;
