<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
    <title>GeNeck</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet'
          type='text/css'>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
    <script type="text/javascript">
        function timedRefresh(timeoutPeriod) {
            setTimeout("location.reload(true);", timeoutPeriod)
        }
    </script>
</head>
<body class="left-sidebar">

<!-- retrieve data from mysql -->
<?php
/******************  Function  ***********************/
function parseMethod($method) {
    if ($method == 1) {
        return 'GeneNet';
    } elseif ($method == 2) {
        return 'Neighborhood selection';
    } elseif ($method == 3) {
        return 'GLASSO';
    } elseif ($method == 4) {
        return 'GLASSO-SF';
    } elseif ($method == 5) {
        return 'PCA-CMI';
    } elseif ($method == 6) {
        return 'CMI2NI';
    } elseif ($method == 7) {
        return 'SPACE';
    } elseif ($method == 8) {
        return 'EGLASSO';
    } elseif ($method == 9) {
        return 'ESPACE';
    } elseif ($method == 10) {
        return 'ENA';
    } else {
        return Null;
    }
}

function parseParam($method) {
    if (in_array($method, array(1, 10))) {
        return 'FDR: ';
    } elseif (in_array($method, array(2, 4, 7, 8, 9))) {
        return 'Alpha: ';
    } elseif (in_array($method, array(3, 5, 6))) {
        return 'Lambda: ';
    } else {
        return Null;
    }
}

function parseParam_2($method) {
    if ($method == 8 | $method == 9) {
        return 'Lambda: ';
    } else {
        return Null;
    }
}

/******************  main  ***********************/
include "../../dbincloc/geneck.inc";

// open database connection
$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn -> connect_error) {
    die('Unable to connect to database: ' . $db_conn -> connect_error);
}

if (isset($_GET['jobid'])) {
    $jobid = mysqli_real_escape_string($db_conn, $_GET['jobid']);
}

$status = 0;

if (!empty($jobid)) {
    if ($stmt = $db_conn -> prepare("SELECT Status, Method, Param, Param_2, HubGenes FROM Jobs WHERE JobID = ?;")) {
        $stmt -> bind_param("s", $jobid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($status, $method, $param, $param_2, $hub_genes);
        $stmt -> fetch();
    }

    if ($stmt -> num_rows > 0) {
        if ($status == 2 || $status == 3) {
            echo "<script>location.href='result.php?jobid=${jobid}'</script>";
            exit();
        } else {
            echo "<body onload='JavaScript:timedRefresh(5000)'>";
        }
    }
}

?>

<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>

<!-- Main -->
<div id="page">
    <!-- Main -->
    <div id="main" class="container">
        <div class="row">
            <div class="3u">
                <?php include "methods-bar.php"; ?>
            </div>
            <div class="9u skel-cell-important">
                <section>
                    <span class="byline"><strong>Your job has been submitted!</strong></span>
                    <p> The job takes about several minutes to finish. <br/>
                        This page will automatically refresh every 5 seconds.
                        Once your job is done, the results will be shown on this page.</p>
                </section>
                <div class="text-bg">
                    <table class="para-table">
                        <!-- waiting -->
                        <tr>
                            <td><strong>GeNeck is running ... </strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%">
                                <p>Methods: <strong><?php echo parseMethod($method);?></strong></p>
                            </td>
                            <td width="30%">
                                <p><?php echo parseParam($method)?><strong><?php echo $param;?></strong></p>
                            </td>
                            <td width="30%">
                                <p><?php echo parseParam_2($method)?><strong><?php echo $param_2;?></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p>Hub genes: <strong><?php if (isset($hub_genes)) {echo $hub_genes;} else {echo 'Not set.';}?></strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td><br/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><img src="images/waiting.svg" style="display: block; margin: 0 auto"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Main -->

</div>
<!-- /Main -->
<!-- Featured -->
<!-- /Featured -->

<!-- Footer -->
<!-- /Footer -->

<!-- Copyright -->
<?php include "footer.php"; ?>
</body>
</html>
