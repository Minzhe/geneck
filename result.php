<!DOCTYPE HTML>
<html>
<head>
    <title>GeNeck</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet'
          type='text/css'>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery_3.2.1.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript" src="js/echarts.min.js"></script>
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
<body class="left-sidebar">
<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>
<!-- Main -->

<?php
/******************  Function  ***********************/
require_once('util.php');

/******************  main  ***********************/
include "../../dbincloc/geneck.inc";

$jobid = "";
$message = "";
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

if (!empty($jobid)) {
    if ($stmt = $db_conn->prepare("SELECT Status, Analysis FROM Jobs WHERE JobID = ?;")) {
        $stmt->bind_param("s", $jobid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($status, $method);
        $stmt->fetch();
        $stmt->close();
    }

    if ($method != "") {
        if ($status == 9) {
            $message = "Your job was failed.";
        } elseif ($status == 2 || $status == 0) {
            echo "<script>location.href='waiting.php?jobid=$jobid'</script>";
        } elseif ($status == 1) {
            $message = "Network construction is completed, see the constructed network below and download the network file.";

            if ($stmt2 = $db_conn->prepare("SELECT Param, Param_2, HubGenes FROM GeneckParameters WHERE JobID = ?;")) {
                $stmt2->bind_param("s", $jobid);
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($param, $param_2, $hub_genes);
                $stmt2->fetch();
                $stmt2->close();
            }
        } else {
            $message = "Job ID incorrect.";
        }
    }
} else {
    $message = "Job ID is not found.";
}
$db_conn->close();
?>

<div id="page">
    <!-- Main -->
    <div id="main" class="container">
        <div class="row">

            <div class="3u">
                <?php include "methods-bar.php" ?>
            </div>

            <div class="9u skel-cell-important">
                <section>
                    <header>
                        <h2><?php if ($status == 1) {
                                echo "Result";
                            } else {
                                echo "Error";
                            } ?></h2>
                    </header>
                    <p><?php echo $message; ?></p>
                </section>
                <?php if ($status == 1): ?>
                    <div class="text-bg">
                        <table class="para-table">
                            <!-- summary -->
                            <tr>
                                <td><strong>Summary</strong></td>
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
                                    <p><strong><?php echo util::parseParam($method) ?></strong><?php echo $param; ?></p>
                                </td>
                                <td width="30%">
                                    <p><strong><?php if (util::parseParam_2($method) != null) {
                                                echo util::parseParam_2($method);
                                            } ?></strong><?php if (util::parseParam_2($method) != null) {
                                            echo util::parseParam2_value($method, $param_2);
                                        } ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><?php if (isset($hub_genes)) {
                                            echo "<strong>Hub genes: </strong>" . $hub_genes;
                                        } ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td><a class="button"
                                       href="resultDownload.php?jobid=<?php echo $jobid; ?>">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>

                            <!-- plot -->
                            <tr>
                                <td><strong>Visualization</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">

                                </td>
                            </tr>
                        </table>
                        <iframe src="resultnetwork.php?jobid=<?php echo $jobid; ?>" width="100%"
                                height="600px">
                            Does support iframe.
                        </iframe>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- Main -->
</div>
<!-- /Main -->
<?php include "footer.php"; ?>
</body>
</html>