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
                        <section class="sidebar">
                            <header>
                                <h2>Basic Methods</h2>
                            </header>
                            <ul class="style1 methods">
                                <li><a href="GeneNet.php">GeneNet</a></li>
                                <li><a href="ns.php">Neighborhood Selection</a></li>
                                <li><a href="glasso.php">GLASSO</a></li>
                                <li><a href="glassosf.php">GLASSO-SF</a></li>
                                <li><a href="pcacmi.php">PCACMI</a></li>
                                <li><a href="cmi2ni.php">CMI2NI</a></li>
                                <li><a href="space.php">SPACE</a></li>
                            </ul>
                        </section>
                        <section class="sidebar">
                            <header>
                                <h2>Extended Methods</h2>
                            </header>
                            <ul class="style1 methods">
                                <li><a href="eglasso.php">EGLASSO</a></li>
                                <li><a href="espace.php">ESPACE</a></li>
                            </ul>
                        </section>
                    </div>
				
					<div class="9u skel-cell-important">
						<section>
							<header>
								<h2>GeneNet</h2>
							</header>
                            <div>
                                <p>Aliquam erat volutpat. Vestibulum dui sem, pulvinar sed, imperdiet nec, iaculis nec, leo.</p>
                            </div>
                        </section>
                        <div class="text-bg">
                            <table class="para-table">
                                <!-- parameters -->
                                <tr>
                                    <td><strong>Data & parameters</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
                                <tr>
                                    <td class="table-right-align"><p>Gene co-expression data:</p></td>
                                    <td>
                                        <label>
                                            <input name="expression_data" type="file">
                                        </label>
                                    </td>
                                    <td><label class="demo-button"><a>example</a></label></td>
                                </tr>
                                <tr>
                                    <td class="table-right-align"><p>False discover rate (FDR):</p></td>
                                    <td><input type="text" placeholder="Default: 0.2" class="inputbox" name="fdr"></td>
                                </tr>
                                <tr><td><br/></td></tr>

                                <!-- user information -->
                                <tr>
                                    <td><strong>User information (optional)</strong></td>
                                </tr>
                                <tr><td colspan="3"><hr/></td></tr>
                                <tr>
                                    <td class="table-right-align"><p>Name:</p></td>
                                    <td colspan="2"><input type="text" placeholder="E.g. QBRC" class="inputbox fullwidth" name="name"></td>
                                </tr>
                                <tr>
                                    <td class="table-right-align"><p>Organization:</p></td>
                                    <td colspan="2"><input type="text" placeholder="E.g. UT Southwestern" class="inputbox fullwidth" name="organization"></td>
                                </tr>
                                <tr>
                                    <td class="table-right-align"><p>Email:</p></td>
                                    <td colspan="2"><input type="text" placeholder="E.g. QBRC@UTSouthwestern.edu" class="inputbox fullwidth" name="email"></td>
                                </tr>
                                <tr><td><br/></td></tr>
                                <tr>
                                    <td></td>
                                    <td><a class="button">submit</a></td>
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