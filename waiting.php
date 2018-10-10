<!-- retrieve data from mysql -->
<?php
/******************  Function  ***********************/
require_once('util.php');

/******************  main  ***********************/
include "../../dbincloc/geneck.inc";

$jobid = "";
$status = 0;
$method = "";
$param = "";
$param_2 = "";
$hub_genes = "";

// open database connection
$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn->connect_error) {
    die('Unable to connect to database: ' . $db_conn->connect_error);
}

if (isset($_GET['jobid'])) {
    $jobid = util::clean($_GET["jobid"]);
}

$message = "";

if (!empty($jobid)) {
    if ($stmt = $db_conn->prepare("SELECT Status, Analysis FROM Jobs WHERE JobID = ?;")) {
        $stmt->bind_param("s", $jobid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($status, $method);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    echo "<script>location.href='error.php'</script>";
}
?>

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
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery_3.2.1.min.js"></script>
    <script src="js/bootstrap_3.3.7.min.js"></script>
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
        $(document).ready(function() {
            // header & banner
            $("#homebanner").hide();
            $("#analysis").addClass("active");
            <?php echo "$(\"#genemethod${method}\").addClass(\"method-active\");"; ?>
        });
    </script>
</head>
<body>
<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>
<?php
if ($method != "") {
    if ($status == 1 || $status == 9) {
        echo "<script>location.href='result.php?jobid=$jobid'</script>";
    } else {
        if ($stmt2 = $db_conn->prepare("SELECT Param, Param_2, HubGenes FROM GeneckParameters WHERE JobID = ?;")) {
            $stmt2->bind_param("s", $jobid);
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->bind_result($param, $param_2, $hub_genes);
            $stmt2->fetch();
            $stmt2->close();
        }

        if ($method == 10) {
            if ($param_2 == 0) {
                $param_2 = 'No';
            } elseif ($param_2 == 1) {
                $param_2 = 'Yes';
            }
        }
        echo "<body onload='timedRefresh(5000)'>";
    }
} else {
    echo "<script>location.href='error.php'</script>";
}
?>
<!-- Main -->
<div id="page">
    <div id="main" class="container" style="margin-top:0">
        <div class="9u" style="margin-left: 300px;">
            <div class="alert alert-danger" id="alert" hidden></div>
        </div>
        <div class="row">
            <!-- **********************************  side bar  ************************************* -->
            <div class="3u">
                <section class="sidebar" id="side-methods">
                    <header>
                        <h2>Network Inference Method</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod1"><a href="genenet.php">GeneNet</a></li>
                        <li style="cursor:pointer" id="genemethod2"><a href="ns.php">Neighborhood Selection</a></li>
                        <li style="cursor:pointer" id="genemethod3"><a href="glasso.php">GLASSO</a></li>
                        <li style="cursor:pointer" id="genemethod4"><a href="glassosf.php">GLASSO-SF</a></li>
                        <li style="cursor:pointer" id="genemethod5"><a href="pcacmi.php">PCACMI</a></li>
                        <li style="cursor:pointer" id="genemethod6"><a href="cmi2ni.php">CMI2NI</a></li>
                        <li style="cursor:pointer" id="genemethod7"><a href="space.php">SPACE</a></li>
                        <li style="cursor:pointer" id="genemethod11"><a href="bayesianglasso.php">BayesianGLASSO</a></li>
                    </ul>
                </section>
                <section class="sidebar" id="methods">
                    <header>
                        <h2>Incorporate Hub Gene</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod8"><a href="eglasso.php">EGLASSO</a></li>
                        <li style="cursor:pointer" id="genemethod9"><a href="espace.php">ESPACE</a></li>
                    </ul>
                </section>
                <section class="sidebar" id="methods">
                    <header>
                        <h2>Integrative Methods</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod10"><a href="ena.php">ENA</a></li>
                    </ul>
                </section>
            </div>
            <!-- ****************************************************************************** -->

            <div class="9u skel-cell-important">
                <section>
                    <header>
                    <h2 class="byline">Your job has been submitted!</h2>
                    </header>
                    <p>
                        The job takes about several minutes to finish.
                        If you select BayesianGLASSO, it will take much longer.<br/>
                        This page will automatically refresh every 5 seconds.
                        Once your job is done, the results will be shown on this page.<br/>
                    </p><br/>
                    <p>
                        Record the following link, so you can go back and check your job status:<br/>
                        <?php echo "<a href=\"http://lce.biohpc.swmed.edu/geneck/waiting.php?jobid=" . $jobid . "\">http://lce.biohpc.swmed.edu/geneck/waiting.php?jobid=" .$jobid . "</a>"; ?>
                    </p>
                </section>

                <!-- ***************************  param table  ****************************** -->
                <div class="text-bg">
                    <table class="para-table">
                        <!-- waiting -->
                        <tr>
                            <td><strong>GeNeCK is running ... </strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%">
                                <p><strong>Methods: </strong><?php echo util::parseMethod($method); ?></p>
                            </td>
                            <td width="30%">
                                <p><strong><?php echo util::parseParam($method); ?></strong><?php echo $param; ?></p>
                            </td>
                            <td width="30%">
                                <p>
                                    <strong>
                                    <?php 
                                    if (util::parseParam_2($method) != null) {
                                        echo util::parseParam_2($method);
                                    } 
                                    ?>
                                    </strong>
                                    <?php 
                                    if (util::parseParam_2($method) != null) {
                                        echo util::parseParam2_value($method, $param_2);
                                    } 
                                    ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p>
                                <?php 
                                if ($hub_genes != "") {
                                    echo "<strong>Hub genes: </strong>" . $hub_genes;
                                } 
                                ?>
                                </p>
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
                <!-- ***************************************************************** -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
