
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Learning Management System - The Ultimate Multipurpose E Learning Platform.</title>
    <!-- Custom CSS -->
    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> -->
    <!--Load Sweet Alert Javascript-->
    <script src="dist/js/swal.js"></script>
    <!-- DataTable plugin CSS -->
    <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!--Inject SWAL-->
    <?php if(isset($success)) {?>
    <!--This code for injecting an alert-->
            <script>
                        setTimeout(function ()
                        {
                            swal("Success","<?php echo $success;?>","success");
                        },
                            100);
            </script>

    <?php } ?>

    <?php if(isset($err)) {?>
    <!--This code for injecting an alert-->
            <script>
                        setTimeout(function ()
                        {
                            swal("Failed","<?php echo $err;?>","error");
                        },
                            100);
            </script>

    <?php } ?>
    <script type="text/javascript"> 
        function display_c()
        {
            var refresh=1000; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
        }

        function display_ct() 
            {
            var x = new Date()
            document.getElementById('ct').innerHTML = x;
            display_c();
         }
    </script>
    <script>
        function printContent(el)
        {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>

</head>