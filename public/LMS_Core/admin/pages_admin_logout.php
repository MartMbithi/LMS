<?php
    session_start();
    unset($_SESSION['a_id']);
    session_destroy();

    header("Location: pages_admin_index.php");
    exit;
