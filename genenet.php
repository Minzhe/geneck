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
                        <li style="cursor:pointer" id="genemethod1" class="method-active"><a href="genenet.php">GeneNet</a></li>
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
            
            <!-- **********************************  method  ************************************* -->
            <div class="9u skel-cell-important">
                <section>
                    <header>
                        <h2>GeneNet</h2>
                    </header>
                    <p class="text-justify">
                        <code>GeneNet</code> is a linear shrinkage estimator for a covariance matrix followed by a Gaussian graphical
                        model (GGM) selection based on the partial correlation obtained from the shrinkage estimator. With a multiple
                        testing procedure using the local false discovery rate, the GGM selection controls the false discovery rate
                        under a pre-determined level $\alpha$.
                    </p>
                    <p class="text-justify" id="detail-intro">
                        One of the most commonly used linear shrinkage estimators \(S^{*}\) for the covariance matrix \(\Sigma\) is
                        $$S^{*} = \lambda^{*}T + (1 - \lambda^{*})S$$
                        where
                        \( S = (s_{ij})_{1 \leq i,j \leq p}\)
                        is the sample covariance matrix,
                        \( T = diag(s_{11}, s_{22}, ..., s_{pp}) \)
                        is the shrinkage target matrix, and
                        $\lambda^{*}=\sum_{i\neq j}\hat{Var}(s_{ij})/(\sum_{i\neq j}s_{ij}^{2})$
                        is the optimal shrinkage intensity. With this estimator \(S^{*}\), the matrix of the partial correlations
                        $P = (\hat{\rho}^{ij})_{1\leq i, j\leq p}$
                        is defined as
                        $\hat{\rho}^{ij} = -\hat{\omega}_{ij}/ \sqrt{\hat{\omega}_{ii}\hat{\omega}_{jj}}$,
                        where
                        $\hat{\Omega} = (\hat{\omega}_{ij})_{1\leq i, j\leq p} = (S^{*})^{-1}$.
                        To identify the significant edges, the distribution of the partial correlations is supposed to be as the mixture
                        $$f(\rho) = \eta_{0}f_{0}(\rho, \nu) + (1-\eta_{0})f_{1}(\rho)$$
                        where $f_0$ is the null distribution, $f_1$ is the alternative distribution corresponding to the true edges,
                        and $η_0$ is the unknown mixing parameter. <code>GeneNet</code> identifies significant edges that have the
                        local false positive rate
                        $$fdr(\rho) = \frac{\eta_{0}f_{0}(\rho, \hat{\nu})}{\hat{f}(\rho)}$$
                        smaller than the pre-determined level $\alpha$, where
                        $f_0(\rho, \upsilon) = |\rho|Be(\rho^2; 0.5, (\upsilon - 1)/2)$, $Be(x;a,b)$
                        is the density of the Beta distribution and $\upsilon$ is the reciprocal variance of the null $\rho$.<br/>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Schäfer, Juliane, and Korbinian Strimmer. "A shrinkage approach to large-scale covariance matrix estimation and implications for functional genomics." <i>Statistical applications in genetics and molecular biology</i> 4.1 (2005): 32.
                    </p>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p>
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\alpha$ level (false positive rate) to control the sparsity of network $(0 < \alpha < 1)$.
                            <b>A larger $\alpha$ will give you more estimated edges, but with lower confidence</b>.
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
                                <td class="table-right-align"><p>False positive rate (alpha):</p></td>
                                <td>
                                    <input type="number" min=0.001 max=0.999 step=0.001 class="inputbox" name="param" value=0.500 required>
                                    <img src="images/icon-question.png" title="0.001 ~ 0.999"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="1" style="display: none;" type="text"/></td>
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