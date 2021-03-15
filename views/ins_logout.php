<?php
session_start();
unset($_SESSION['i_id']);
session_destroy();
header("Location: ins_login.php");
exit;
