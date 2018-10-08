<!DOCTYPE HTML>
<html>
<head>
    <title>GeNeck</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery_3.2.1.min.js"></script>
    <script src="js/bootstrap_3.3.7.min.js"></script>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style-desktop.css"/>
    </noscript>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie/v8.css"/><![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie/v9.css"/><![endif]-->
    <script>
        $(document).ready(function () {
            // header & banner
            $("#homebanner").hide();
            $("#contact").addClass("active");
        });
    </script>
</head>
<body class="no-sidebar">
<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>
<!-- Main -->
<div id="page">
    <div id="main" class="container">
        <header>
            <h2>Contact Us</h2>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-5 col-sd-5">
                <a href="https://www.google.com/maps/place/32%C2%B048%2743.6%22N+96%C2%B050%2732.2%22W/@32.8141399,-96.8524702,15z/data=!4m5!3m4!1s0x0:0x0!8m2!3d32.8121004!4d-96.8422829">
                    <img src="images/map.png" style="height:330px">
                    <div class="centered">View the location in Google Maps</div>
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-sd-2">&nbsp;</div>
            <div class="col-md-5 col-lg-5 col-sd-5">
                <h3 style="font-size:28px">Contact Information</h3>
                <hr class="style2">
                <div style="font-size:15px">
                    Department of Clinical Sciences<br>
                    UTSouthwestern Medical Center<br>
                    5323 Harry Hines Blvd.<br>
                    Dallas, TX 75390-9077<br>
                </div>
                <br>
                <div>
                    Email: <a href="mailto:zenroute.mzhang@gmail.com">zenroute.mzhang@gmail.com</a><br><br>
                    LinkedIN: <a href="https://www.linkedin.com/in/minzhe/" target="_blank">Minzhe Zhang's LinkedIn</a>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>