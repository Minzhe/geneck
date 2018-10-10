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
                        <li style="cursor:pointer" id="genemethod6"><a href="cmi2ni.php">CMI2NI</a></li>
                        <li style="cursor:pointer" id="genemethod7" class="method-active"><a href="space.php">SPACE</a></li>
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
                        <h2>SPACE</h2>
                        <span class="byline">Extended Sparse PArtial Correlation Estimation method</span>
                    </header>
                    <p class="text-justify">
                        Spare partial correlation estimation (<code>SPACE</code>) is a joint sparse regression problem, which resolves
                        a symmetrically constrained and $ℓ_1$-regularizated regression problem under high-dimensional settings.
                    </p>
                    <div class="text-justify" id="detail-intro">
                        <p>
                            In the Gaussian graphical models, the conditional dependencies among p variables can be represented by a
                            graph $G = (V,E)$, where $V={1,2,...,p}$ is a set of nodes representing $p$ variables and
                            $E = \{(i,j) | \omega_{ij} \ne 0, 1 \leq i \ne j \leq p\}$ is a set of edges corresponding to the nonzero
                            off-diagonal elements of $\Omega$.
                        </p>
                        <p>
                            <code>SPACE</code> considers linear models such that for $i=1,2,...,p$,
                            $$X_{i} = \sum_{j\neq i}\beta_{ij}X_{j} + \epsilon_{i}$$
                            where $\epsilon_{i}$ is an n-dimensional random vector from the multivariate normal distribution
                            with mean $0$ and covariance matrix $1 / \omega_{ii}I_n$ is an identity matrix with size of $n×n$.
                            Under normality, the regression coefficients $\beta_{ij}$ can be replaced with the partial correlations
                            $\rho^{ij}$ by the relationship
                            $$\beta_{ij} = - \frac{\omega_{ij}}{\omega_{ij}} = p^{ij}\sqrt{\frac{\omega_{jj}}{\omega_{ii}}}$$
                            where
                            $p^{ij} = corr (X_{i}, X_{j} | X_{k}, k \neq i, j) = -\omega_{ij} /\sqrt{\omega_{ii}\omega_{jj}}$
                            is a partial correlation between $X_i$ and $X_j$. <code>SPACE</code> method solves the
                            following $ℓ_1$-regularized problem:
                            $$\underset{p}{min}\frac{1}{2}\sum_{i=1}^{p}\left \{ w_{i}\sum_{k=1}^{n} (X_{i}^{k} - \sum_{j\neq i}p^{ij}\sqrt{\frac{\omega_{ij}}{\omega_{ii}}}X_{j}^{k})^{2} \right \} + \lambda \sum_{1\leq i\le j \leq p}|p^{ij}|$$
                            where $w_i$ is a nonnegative weight for the $i$-th squared error loss.<br/>
                            <br/><strong>Reference:</strong><br/>
                            1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                            2. Peng, Jie, Pei Wang, Nengfeng Zhou, and Ji Zhu. "Partial correlation estimation by joint sparse regression models." <i>Journal of the American Statistical Association</i> 104.486 (2009): 735-746.
                        </p>
                    </div>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p class="text-justify">
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\alpha$ value $(\alpha > 0)$ to control the sparsity of network. <b>Larger the $\alpha$ is, more
                                sparse is the constructed network</b>. If you don't know how to choose a value, use the default one.
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
                                    <input type="number" min=0.01 step=0.01 class="inputbox" name="param" value=0.6 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="7" style="display: none;" type="text"/></td>
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
