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
                        <li style="cursor:pointer" id="genemethod4" class="method-active"><a href="glassosf.php">GLASSO-SF</a></li>
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
                        <h2>GLASSO-SF</h2>
                        <span class="byline">GLASSO with reweighted strategy for scale-free network</span>
                    </header>
                    <p class="text-justify">
                        <code>GLASSO-SF</code> is the reweighted $ℓ_1$ regularization method of <code>GLASSO</code> to improve the
                        performance of the estimation  for the scale-free network. <code>GLASSO-SF</code> changes the $ℓ_1$ norm penalty
                        in the existing methods to the power law regularization
                        $$p_{\lambda, \gamma }(\Omega) = \lambda \sum_{i=1}^{p}log(\left\| \omega_{-i}\right\|_{1} + \epsilon_{i} ) + \gamma\sum_{i=1}^{p}\left | \omega_{ii} \right |,$$
                        where $\lambda$ and $\gamma$ are nonnegative tuning parameters,
                        $\omega_{-i} = \{\omega_{ij} | j \ne i\}, \left\| \omega_{-i}\right\|_{1} = \sum_{j\neq i}\left| \omega_{ij}\right|$,
                        and $\epsilon_i$ is a small positive number for $i=1,2,...,p$.
                    </p>
                    <p class="text-justify" id="detail-intro">
                        The following objective function will be optimized
                        $$f(\Omega;X,\lambda, \gamma) = L(X, \Omega) + u_{L} . p_{\lambda,\gamma}(\Omega),$$
                        where $L(X, \Omega)$ denotes the objective function of the existing method without its penalty terms, $u_L = 1$
                        if $L$ is convex and $u_L = -1$ if $L$ is concave for $\Omega$. The choice of $L$ is flexible. For instance,
                        $L(X, \Omega)$ can be the log-likelihood function of $\Omega$ as in the graphical lasso or the squared loss function
                        as in the <code>NS</code> and the <code>SPACE</code>.

                        To obtain the maximizer of $f(\Omega; X, \lambda, \gamma)$, <code>GLASSO-SF</code> employs iteratively reweighted $ℓ_1$
                        regularization procedure based on the minorization-maximization (MM) algorithm, which solve the following problem:
                        $$\Omega^{(k+1)} = \underset{\Omega}{arg max}L(X, \Omega) - \sum_{i=1}^p\sum_{j \ne i}\eta^{(k)}_{ij}|\omega_{ij}|-\gamma\sum_{i=1}^p|\omega_{ii}|,$$
                        where $\Omega^{(k)} = (\omega^{(k)}_{ij})$ is the estimate at the $k$th iteration,
                        ${∥\omega^{(k)}_{-i}∥}_1 = \sum_{l \ne i}|\omega^{(k)}_{il}|,$ and
                        $\eta^{(k)}_{ij} = \lambda(1/({∥\omega^{(k)}_{i}∥}_1 + \epsilon_i) + 1/({∥\omega^{(k)}_{-j}∥}_1 + \epsilon_j))$.<br/>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Liu, Qiang, and Alexander Ihler. "Learning scale free networks by reweighted l1 regularization." <i>In Proceedings of the Fourteenth International Conference on Artificial Intelligence and Statistics</i>, pp. 40-48. 2011.
                    </p>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p class="text-justify">
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\lambda$ value $(\lambda > 0)$ to control the sparsity of network. <b>The larger the $\lambda$, the more
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
                                <td class="table-right-align"><p>Lambda:</p></td>
                                <td>
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param" value=0.2 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="4" style="display: none;" type="text"/></td>
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