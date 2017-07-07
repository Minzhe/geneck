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
                                    <td><strong>Summary statistics</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
                                <tr>
                                    <td>
                                        <p>Methods: <strong>GeneNet</strong></p>
                                        <p>FDR: <strong>0.2</strong></p>
                                        <p>Hub genes: <strong>Not specified</strong></p>
                                    </td>
                                    <td>
                                        <p>Nodes: <strong>100</strong></p>
                                        <p>Edges: <strong>122</strong></p>
                                    </td>
                                    <td>
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
                            <iframe src="resultnetwork.php?jobid=<?php echo $_GET['jobid'];?>" width="100%" height="600px">Does not work.</iframe>
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