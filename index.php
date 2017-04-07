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
							<p><strong>Gene Regulatory Network (GRN)</strong></p>
							<p>A gene regulatory network (GRN) describes interactions and regulatory relationship among genes. It provides a systematic understanding of molecular mechanism underlying biological process.</p>
							<p><strong>Hub Gene</strong></p>
							<p>A typical GRN approximate a scale free network topology with a few highly connected nodes (hub genes) and many poorly connected nodes. These hub genes are master regulator in gene network, and control network stability. They usually have essential function in biological system.</p>
							<p><strong>Network Construction with GENECK</strong></p>
							<p>GENECK (Gene Network Construction Kit) is a comprehensive online tool kit that integrate multiple existing algorithms currently used for network constructions from <strong>gene co-expression data</strong> along with newly proposed enhanced methods that can incorporate our prior knowledge about <strong>hub genes</strong> for network rectification. </p>
							<a href="#" class="button">More Details</a>
						</section>
					</div>

					<div class="4u" id="featured">
						<section>
							<div class="box">
								<a href="#" class="image left"><img src="images/microarray.png" alt=""></a>
								<h3>Step 1</h3>
								<p>Upload gene co-expression data.</p>
								<label for="modal-1"><a class="button">More</a></label>
							</div>
							<input class="modal-state" id="modal-1" type="checkbox">
							<!-- Modal -->
							<div class="modal">
								<label class="modal-bg" for="modal-1"></label>
								<div class="modal-content">
									<p>xxxxxxxxxxxxxxxxxxxxxx</p>
								</div>
							</div>
						</section>
						<section>
							<div class="box">
								<a href="#" class="image left"><img src="images/math.jpg" alt=""></a>
								<h3>Step 2</h3>
								<p>Select mathematical model to construct gene network.</p>
								<label for="modal-2"><a class="button">More</a></label>
							</div>
							<input class="modal-state" id="modal-2" type="checkbox">
							<!-- Modal -->
							<div class="modal">
								<label class="modal-bg" for="modal-2"></label>
								<div class="modal-content">
									<p>xxxxxxxxxxxxxxxxxxxxxx</p>
								</div>
							</div>
						</section>
						<section>
							<div class="box">
								<a href="#" class="image left"><img src="images/network.jpeg" width="160" height="160" alt=""></a>
								<h3>Step 3</h3>
								<p>Download and visualize network.</p>
								<label for="modal-3" ><a class="button">More</a></label>
							</div>
						</section>
						<input class="modal-state" id="modal-3" type="checkbox">
						<!-- Modal -->
						<div class="modal">
							<label class="modal-bg" for="modal-3"></label>
							<div class="modal-content">
								<p>xxxxxxxxxxxxxxxxxxxxxx</p>
							</div>
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