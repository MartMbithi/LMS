<?php
    session_start();
    unset($_SESSION['i_id']);
    session_destroy();

    header("Location: pages_ins_index.php");
    exit;
?>