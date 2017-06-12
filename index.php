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
        <script type="text/javascript" src="js/echarts.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="homepage">

	<!-- Header -->
	<!-- Banner -->
	<?php include "header.php"; ?>

	<!-- Main -->
		<div id="page">

			<!-- Extra -->
			<!-- /Extra -->
				
			<!-- Main -->
			<div id="main" class="container">
				<div class="row">
					<div class="8u">
						<section>
							<header>
								<h2>Welcome to GeNeck!</h2>
								<span class="byline">An online tool kit to construct gene regulatory network</span>
							</header>
                            <div class="text-bg">
                                <p><strong>Gene Regulatory Network (GRN)</strong></p>
                                <p>A gene regulatory network (GRN) describes interactions and regulatory relationship among genes. It provides a systematic understanding of molecular mechanism underlying biological process.</p>
                                <p><strong>Hub Gene</strong></p>
                                <p>A typical GRN approximate a scale free network topology with a few highly connected nodes (hub genes) and many poorly connected nodes. These hub genes are master regulator in gene network, and control network stability. They usually have essential function in biological system.</p>
                                <p><strong>Network Construction with GeNeck</strong></p>
                                <p>GeNeck (Gene Network Construction Kit) is a comprehensive online tool kit that integrate multiple existing algorithms currently used for network constructions from <strong>gene co-expression data</strong> along with newly proposed enhanced methods that can incorporate our prior knowledge about <strong>hub genes</strong> for network rectification. </p>
                                <label for="modal-1"><a class="button">View DEMO</a></label>
                                <input class="modal-state" id="modal-1" type="checkbox">
                                <!-- Modal -->
                                <div class="modal">
                                    <label class="modal-bg" for="modal-1"></label>
                                    <div class="modal-content">
                                        <p>xxxxxxxxxxxxxxxxxxxxxx</p>
                                        <script type="text/javascript" src="js/network.js"></script>
                                    </div>
                                </div>
                            </div>
						</section>
					</div>

					<div class="4u" id="featured">
                        <div class="index-right">
                            <h3>News</h3>
                            <ul><li><p>07/01/17 GeNeck 1.0 release!.</p></li></ul>
                        </div>
                        <hr/>
                        <div class="index-right">
                            <h3>Citations</h3>
                            <ul><li><p>Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, Guanghua Xiao. Enhanced Construction of Gene Regulatory Networks using Hub Gene Information.</p></li></ul>
                        </div>
                        <hr/>
                        <div class="index-right">
                            <h3>Getting Started</h3>
                            <p>GeNeck is very simple to use. It takes three steps to construct gene network with GeNeck:</p>
                            <ol>
                                <li>Upload data</li>
                                <li>Select algorithm</li>
                                <li>Download and visualize</li>
                            </ol>
                            <p><a>>> Get started</a></p>
                        </div>
                        <hr/>
                        <div class="index-right">
                            <h3>More Details</h3>
                            <p>To use GeNeck, you don't need sophisticated knowledge about gene network and algorithms. If you are interested in the detail theory, you can refer to our papers listed above. You can also go to the <a>download</a> page for other algorithms we incorporated in GeNeck.</p>
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