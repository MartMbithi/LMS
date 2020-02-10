<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>LMS- A  Multi Purpose E Learning Platform</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src="admin/dist/js/swal.js"></script>

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>

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