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
                        <li style="cursor:pointer" id="genemethod3" class="method-active"><a href="glasso.php">GLASSO</a></li>
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
                        <h2>GLASSO</h2>
                        <span class="byline">Graphical Lasso</span>
                    </header>
                    <p class="text-justify">
                        The graphical lasso (<code>GLASSO</code>) method estimates a sparse inverse covariance matrix $\Omega$ by maximizing
                        the $ℓ_1$ penalized log-likelihood
                        $$l(\Omega) = log \left | \Omega \right | - tr(S\Omega) - \lambda \left \| \Omega \right \|_{1}$$
                        where $S$ is the sample covariance matrix, $tr(A)$ is the trace of $A$ and $∥A∥_1$ is the $ℓ_1$ norm of $A$ for
                        $A \in \mathbb{R}^{p\times p}$.
                    </p>
                    <p class="text-justify" id="detail-intro">
                        To be specific, let $W$ be the estimate of the  covariance matrix $\Sigma$ and consider partitioning $W$ and $S$
                        $$W = \binom{W_{11}\quad w_{12}}{w_{12}^{T}\quad w_{22}}, \quad S = \binom{S_{11}\quad s_{12}}{s_{12}^{T}\quad s_{22}},\quad \Omega = \binom{\Omega_{11}\quad \omega_{12}}{\omega_{12}^{T}\quad \omega_{22}} \quad (1)$$
                        The solution $\hat{\Omega}$ of $(1)$ is equivalent to the inverse of $W$ whose partitioned entity $w_{12}$
                        satisfies $w_{12}$ = $W_{11} \beta^{*}$ , where $\beta^{*}$ is the solution  of the lasso problem
                        $$\underset{\beta}{min} \frac{1}{2} \left\| W_{11}^{1/2}\beta - W_{11}^{-1/2}s_{12}\right\| _{2}^{2} + \lambda \left\| \beta \right\|_{1}.$$

                        Based on the above property, the graphical lasso sets the diagonal elements $w_{ii} = s_{ii} + \rho$ and obtains
                        the off-diagonal elements of $W$ by repeatedly applying the following two steps:<br/>

                        &nbsp&nbsp&nbsp&nbsp 1. Permuting the columns and rows to locate the target elements at the position of $w_{12}$.<br/>
                        &nbsp&nbsp&nbsp&nbsp 2. Finding the solution $w_{12} = W_{11}\beta^*$ by solving the lasso problem.

                        until convergence occurs. After finding $W$, the estimate $\hat{\Omega}$ is obtained from the relationship
                        $\omega_{12} = -\hat{\beta}\hat{\omega}_{22}$ and $\hat{\omega}_{22} = 1/(\omega_{22} - \omega^T_{22}\hat{\beta})$,
                        where $\hat{\beta} = W^{-1}_{11}w_{12}$.<br/>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Friedman, Jerome, Trevor Hastie, and Robert Tibshirani. "Sparse inverse covariance estimation with the graphical lasso." <i>Biostatistics</i> 9.3 (2008): 432-441.
                    </p>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p class="text-justify">
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\lambda$ value $(\lambda > 0)$ to control the sparsity of the network. <b>The larger the $\lambda$ is, the more
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
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param" value=0.300 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="3" style="display: none;" type="text"/></td>
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

