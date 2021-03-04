<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../public/uploads/sys_logo/favicon.png">
    <title>Learning Management System - The Ultimate Multipurpose E Learning Platform.</title>
    <!-- Custom CSS -->
    <link href="../public/libs/c3/c3.min.css" rel="stylesheet">
    <link href="../public//libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../public/libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../public/css/style.min.css" rel="stylesheet">
    <!--Load Sweet Alert Javascript-->
    <script src="../public/js/swal.js"></script>
    <!-- DataTable plugin CSS -->
    <link href="../public/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!--Inject SWAL-->
    <?php if (isset($success)) { ?>
        <!--This code for injecting an alert-->
        <script>
            setTimeout(function() {
                    swal("Success", "<?php echo $success; ?>", "success");
                },
                100);
        </script>

    <?php } ?>

    <?php if (isset($err)) { ?>
        <!--This code for injecting an alert-->
        <script>
            setTimeout(function() {
                    swal("Failed", "<?php echo $err; ?>", "error");
                },
                100);
        </script>

    <?php } ?>

</head>