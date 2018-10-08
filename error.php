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
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet'
          type='text/css'>
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
            $("#analysis").addClass("active");
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
            <h2>Oops, something is wrong!</h2>
            <span class="byline"></span>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!
                    </h1>
                    <h2>
                        404 Not Found
                    </h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!
                    </div>
                    <br>
                    <div class="error-actions">
                        <a href="analysis.php" class="btn btn-primary btn">
                            Resend the job 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main -->
</div>
<!-- /Main -->
<!-- Copyright -->
<?php include "footer.php"; ?>
</body>
</html>