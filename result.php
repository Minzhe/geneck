<!DOCTYPE HTML>
<!--
	Ex Machina by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>GeNeck</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    include "cleandata.php";

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

    $message = "";
    $status = 0;

    if (!empty($jobid)) {
        if ($stmt = $db_conn -> prepare("SELECT Status, Method, Param, Param_2, HubGenes FROM Jobs WHERE JobID = ?;")) {
            $stmt -> bind_param("s", $jobid);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($status, $method, $param, $param_2, $hub_genes);
            $stmt -> fetch();

            if ($stmt -> num_rows > 0) {
                if ($status == 3) {
                    $message = "Your job was failed.";
                } elseif ($status == 2) {
                    $message = "Network construction is completed, see the constructed network below and download the network file.";
                } elseif ($status == 1 || $status == 0) {
                    echo "<script>location.href='waiting.php?jobid=${jobid}'</script>";
                }
            } else {
                $message = "Job ID not found.";
            }

        } else {
            $message = "GeNeCK has problem connecting to databse.";
        }
    } else {
        $message = "Job ID incorrect.";
    }
    $db_conn->close();


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
								<h2><?php if ($status == 2) {echo "Result";} else {echo "Error";}?></h2>
							</header>
							<p><?php echo $message; ?></p>
						</section>
                        <?php if ($status == 2): ?>
                        <div class="text-bg">
                            <table class="para-table">
                                <!-- summary -->
                                <tr>
                                    <td><strong>Summary</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
                                <tr>
                                    <td width="40%">
                                        <p><strong>Methods: </strong><?php echo parseMethod($method);?></p>
                                    </td>
                                    <td width="30%">
                                        <p><strong><?php echo parseParam($method)?></strong><?php echo $param;?></p>
                                    </td>
                                    <td width="30%">
                                        <p><strong><?php if(parseParam_2($method)!=null){ echo parseParam_2($method);}?></strong><?php if(parseParam_2($method)!=null){echo parseParam2_value($method, $param_2);}?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p><?php if (isset($hub_genes)) {echo "<strong>Hub genes: </strong>" . $hub_genes;}?></p>
                                    </td>
                                </tr>
                                <tr><td><a class="button" href="resultDownload.php?jobid=<?php echo $_GET['jobid'];?>">Download</a></td></tr>
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
                        <?php endif;?>
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