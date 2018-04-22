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
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
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
            $("#banner").hide();
            $("#index").addClass("active");
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
            <h2>Welcome to GeNeCK!</h2>
            <span class="byline">An online tool kit to construct gene regulatory networks</span>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="8u">
                <section>
                    <div class="subtitle text-bg">
                        <!--                                <h2>Gene Regulatory Network (GRN)</h2>-->
                        <!--                                <p style="text-align: justify;">A gene regulatory network (GRN) describes interactions and regulatory relationship among genes. It provides a systematic understanding of molecular mechanism underlying biological process.</p>-->
                        <!--                                <h2>Hub Gene</h2>-->
                        <!--                                <p style="text-align: justify;">A typical GRN approximate a scale free network topology with a few highly connected nodes (hub genes) and many poorly connected nodes. These hub genes are master regulator in gene network, and control network stability. They usually have essential function in biological system.</p>-->
                        <h2>Network Construction with GeNeCK</h2>
                        <p style="text-align: justify;">
                            <b>GeNeCK</b> (Gene Network Construction Kit) is a comprehensive online tool kit that
                            integrate
                            various statistical methods to construct gene networks based on gene expression
                            data and optional hub gene information.
                        </p>
                        <p>
                            >>> Go to <a href="analysis.php">analysis</a> page to get started!
                        </p>
                        <iframe src="demonetwork.php" width="100%" height="490">Does not support iframe.</iframe>
                    </div>
                </section>
            </div>
            <div class="4u" id="featured">
                <div class="index-right">
                    <h3>News</h3>
                    <p style="text-align: justify; font-size: 14px;">03/01/18 GeNeCK paper was submitted to ... !</p>
                    <p style="text-align: justify; font-size: 14px;">07/01/17 GeNeCK 1.0 release!</p>
                </div>
                <hr/>
                <div class="index-right">
                    <h3>Citations</h3>
                    <p style="text-align: justify; color: #014b7c;">GeNeCK: a web server for gene network construction
                        and visualization.</p>
                    <p style="text-align: justify; font-size: 13px;">Minzhe Zhang, Qiwei Li, Donghyeon Yu, Yang Xie, &
                        Xiao Guanghua. [<a>bioRxir</a>]</p>
                    <p style="text-align: justify; color: #014b7c;">Enhanced construction of gene regulatory networks
                        using hub gene information.</p>
                    <p style="text-align: justify; font-size: 13px;">Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang,
                        and Guanghua Xiao. <i>BMC bioinformatics</i>, 18.1(2017), 186. [<a target="_blank"
                                                                                           href="https://bmcbioinformatics.biomedcentral.com/articles/10.1186/s12859-017-1576-1">link</a>]
                    </p>
                </div>
                <hr/>
                <div class="index-right">
                    <h3>Getting Started</h3>
                    <p style="text-align: justify;">Three quick steps to start using <b>GeNeCK</b> for gene network
                        construction:</p>
                    <ol>
                        <li>Select an algorithm</li>
                        <li>Upload data</li>
                        <li>Download and visualize</li>
                    </ol>
                    <a class="button" data-target="#myModal" data-toggle="modal" type="button">Demo</a>
                </div>
            </div>
            <div class="modal modal-wide fade in" id="myModal" role="dialog" style="padding-right: 13px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                <b>Example: How to generate gene network</b>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p><img style="width: auto; height: auto;" src="images/figure.guide.png"/></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main -->
</div>
<!-- Copyright -->
<?php include "footer.php"; ?>
</body>
</html>
