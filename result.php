<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>GeNeck</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
        <script type="text/javascript" src="js/echarts.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="left-sidebar">
    <?php
    /******************  Function  ***********************/
    function parseMethod($method) {
        if ($method == 1) {
            return 'GeneNet';
        } elseif ($method == 2) {
            return 'Neighborhood selection';
        } elseif ($method == 3) {
            return 'glasso';
        } elseif ($method == 4) {
            return 'glassosf';
        } elseif ($method == 5) {
            return 'pcacmi';
        } elseif ($method == 6) {
            return 'cmi2ni';
        } elseif ($method == 7) {
            return 'space';
        } elseif ($method == 8) {
            return 'eglasso';
        } elseif ($method == 9) {
            return 'espace';
        } else {
            return Null;
        }
    }

    function parseParam($method) {
        if ($method == 1) {
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

    if (!empty($jobid)) {
        if ($stmt = $db_conn -> prepare("SELECT Method, Param, Param_2, HubGenes FROM Jobs WHERE JobID = ?;")) {
            $stmt -> bind_param("s", $jobid);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($method, $param, $param_2, $hub_genes);
            $stmt -> fetch();
        }
    }
    ?>
	<!-- Header -->
	<!-- Banner -->
	<?php include "header.php";?>

	<!-- Main -->
		<div id="page">
				
			<!-- Main -->
			<div id="main" class="container">
				<div class="row">

                    <div class="3u">
                        <?php include "methods-bar.php"?>
                    </div>
				
					<div class="9u skel-cell-important">
						<section>
							<header>
								<h2>Result</h2>
							</header>
							<p>Network construction is completed, see the following summary statistics and download the network file.</p>
						</section>

                        <div class="text-bg">
                            <table class="para-table">
                                <!-- summary -->
                                <tr>
                                    <td><strong>Summary</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
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
                                <tr><td><a class="button">download</a></td></tr>
                                <tr><td><br/></td></tr>

                                <!-- plot -->
                                <tr>
                                    <td><strong>Visualization</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
                                <tr>
                                    <td colspan="3">

                                    </td>
                                </tr>
                            </table>
                            <iframe src="resultnetwork.php?jobid=<?php echo $_GET['jobid'];?>" width="100%" height="600px">Does support iframe.</iframe>
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