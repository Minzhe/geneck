<!DOCTYPE HTML>
<html>
<head>
    <title>GeNeck</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery_3.2.1.min.js"></script>
    <script src="js/bootstrap_3.3.7.min.js"></script>
    <script type="text/javascript" src="js/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <!--        <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'></script>-->
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript" src="js/latexit.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-desktop.css" />
    </noscript>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie/v8.css"/><![endif]-->
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie/v9.css"/><![endif]-->
    <script>
        $(document).ready(function(){
            // header & banner
            $("#homebanner").hide();
            $("#analysis").addClass("active");
        });
    </script>
    <?php include "methods-js.php"; ?>
</head>
<body class="left-sidebar">
<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>
<!-- Main -->
<div id="page">
    <div id="main" class="container" style="margin-top:0">
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
                        <li style="cursor:pointer" id="genemethod6" class="method-active"><a href="cmi2ni.php">CMI2NI</a></li>
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
            
            <!-- **********************************  method  ************************************* -->
            <div class="9u skel-cell-important">
                <section>
                    <header>
                        <h2>CMI2NI</h2>
                        <span class="byline">Conditional mutual inclusive information-based network inference</span>
                    </header>
                    <p class="text-justify">
                        The conditional mutual inclusive information-based network inference (<code>CMI2NI</code>) method improves
                        the <code>PCACMI</code> method by considering the Kullback-Leibler divergences from the joint
                        probability density function (PDF) of target variables to the interventional PDFs removing the dependency
                        between two variables of interest. Instead of using CMI, <code>CMI2NI</code> uses the conditional mutual inclusive
                        information (CMI2) as the measure of dependency between two variables of interest given other variables.
                    </p>
                    <p class="text-justify" id="detail-intro">
                        To be specific, consider three random variables $X$, $Y$ and $Z$. For these three random variables, the CMI2 between
                        $X$ and $Y$ given $Z$ is defined as
                        $$CMI2(X,Y|Z) = (D_{KL}(P||P_{X->Y}) + D_{KL}(P||P_{Y->X}))/2,$$
                        where $D_{KL}(f||g)$ is the Kullback-Leibler divergence from $f$ to $g$, $P$ is the joint PDF of $X$, $Y$ and $Z$,
                        and $P_{X \to Y}$ is the interventional probability of $X$, $Y$ and $Z$ for removing the connection from $X$ to $Y$.

                        With Gaussian assumption on the observed data, the CMI2 for two random variables $X$ and $Y$
                        given m-dimensional vector $Z$ can be expressed as
                        $$CMI2(X,Y|Z) = \frac{1}{4}(tr(C^{-1}\Sigma) + tr(\tilde{C}^{-1}\tilde{\Sigma}) + logC_{0} +log\tilde{C}_{0}-2n),$$
                        where $\Sigma$ is the covariance matrix of $( X, Y, Z^T )^T$, $\tilde{\Sigma}$
                        is the covariance matrix of $( X, Y, Z^T )^T$, Σ XZ is the covariance matrix of $\Sigma_{X,Z}$,
                        $( X, Z^T )^T$ is the covariance matrix of $( Y, Z^T )^T, n=m+2$, and $C$, $\tilde{C}$, $C_0$ and $\tilde{C_0}$
                        are defined with the elements of $\Sigma, \Sigma_{XZ}, \Sigma_{YZ}, \Sigma^{-1}, \Sigma^{-1}_{XZ}, \Sigma^{-1}_{YZ}$.
                        As applied in <code>PCACMI</code>, <code>CMI2NI</code> adopts the path consistency algorithm (PCA) to efficiently calculate the CMI2 estimates.
                        All steps of the PCA in <code>CMI2NI</code> are the same as one of <code>PCACMI</code> if we change the CMI to the CMI2. In the PCA steps of
                        <code>CMI2NI</code>, two variables are regarded as independent if the corresponding CMI2 estimate is less than a given threshold $\alpha$.<br/>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Zhang, Xiujun, Juan Zhao, Jin-Kao Hao, Xing-Ming Zhao, and Luonan Chen. "Conditional mutual inclusive information enables accurate quantification of associations in gene regulatory networks." <i>Nucleic acids research</i> 43.5 (2014): e31-e31.
                    </p>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p class="text-justify">
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\alpha$ value $(\alpha > 0)$ to control the sparsity of network. <b>The larger the $\alpha$, the more
                                sparse the constructed network</b>. If you don't know how to choose a value, use the default one.
                        </i>
                    </p>
                </section>

                <!-- **********************************  form  ************************************* -->
                <form id="myform" action="submitjob.php" enctype="multipart/form-data" method="POST">
                    <!-- ****************  alert  **************** -->
                    <?php include "form-alert.php"; ?>

                    <!-- ****************  parameter table  **************** -->
                    <div class="text-bg">
                        <table class="para-table">
                            <!-- **********  parameters  ************* -->
                            <?php include "form-data.php"; ?>
                            <tr>
                                <td class="table-right-align"><p>Alpha:</p></td>
                                <td>
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param" value=0.04 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="6" style="display: none;" type="text"/></td>
                                <td><label for="submitjob"><a class="button" id="submit">submit</a></label></td>
                                <td><input type="submit" id="submitjob" style="display: none"></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
