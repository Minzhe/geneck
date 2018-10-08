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
                        <li style="cursor:pointer" id="genemethod2" class="method-active"><a href="ns.php">Neighborhood Selection</a></li>
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
                        <h2>Neighborhood Selection</h2>
                    </header>
                    <p class="text-justify">
                        Neighborhood selection (<code>NS</code>) separately solves the lasso problem and identifies edges with
                        nonzero estimated regression coefficients for each node with tuning parameter $λ_i(\alpha)$.
                        The <code>NS</code> method is asymptotically consistent in identifying the neighborhood of each node when the neighborhood
                        stability condition is satisfied.
                    </p>
                    <p class="text-justify" id="detail-intro">
                        To be specific, for each node $i \in V = \{1,2,...,p\}$, <code>NS</code> solves the following lasso problem
                        $$\hat{\beta}^{i,\lambda} = \underset{\beta \in \mathbb{R}^p: \beta_i = 0}{argmin} \frac{1}{2}\left \|X_i - X\beta\right \|^2_2 + \lambda\left \|\beta\right \|_1,$$
                        where
                        $\left \| x \right \|_{2}^{2} = \sum_{i=1}^{p}x_{i}^{2}$ and
                        $\left \| x \right \|_{1} = \sum_{i=1}^{p}\left | x_{i} \right |$ for $x \in \mathbb{R}^p$.
                        With the estimate
                        $\hat{\beta}^{i,\lambda}$,
                        <code>NS</code> identifies the neighborhood of the node $i$ as
                        $N_i(\lambda) = \{ k | \hat{\beta}_{k}^{i,\lambda} \neq 0 \}$,
                        which defines an edge set
                        $E_{i}^{\lambda} = \left \{ \left ( i, j\right ) | j \in N_{i}\left ( \lambda\right )\right \}$.
                        <!--Since <code>NS</code> separately solves $p$ lasso problems, contradictory edges may occur when we define the total edge set
                        $E^\lambda = \cup^p_{i=1} E^\lambda_i$, i.e.,
                        $\hat{\beta}^{i,\lambda}_k \ne 0$.
                        To avoid these contradictory edges, NS suggests two types of edge sets
                        $E^{\lambda, \land}$ and $E^{\lambda, \lor}$
                        defined as follows:
                        $$E^{\lambda, \land} = \{ \left( i, j \right) | i \in N_{j} \left( \lambda \right) \quad and \quad j \in N_{i} \left( \lambda \right) \}$$
                        $$E^{\lambda, \lor} = \{ \left( i, j \right) | i \in N_{j} \left( \lambda \right) \quad or \quad j \in N_{i} \left( \lambda \right) \}$$-->
                        <!--Meinshausen and Bühlmann mentioned these two edge sets have only small differences in their experience and the
                        differences vanish asymptotically. -->
                        Choice of the tuning parameter $λ_i(\alpha)$ for the $i$th node is given by
                        $$\lambda(\alpha) = \left \| X_{i} \right \|_{2}\tilde{\Phi}^{-1}(\frac{\alpha}{2p^{2}})$$
                        where $\tilde{\phi} = 1 - \phi$ and $\phi$ is the distribution function of the standard normal distribution.
                        With this choice of $\lambda_i(\alpha)$ for $i=1,2,...,p$, the probability of falsely identifying edges in the
                        network is bounded by the level $\alpha$. We implement <code>NS</code> with R package <code>CDLasso</code> provided
                        by the authors.<br/>
                        <!--Note that we estimate the edge set with $E^{\lambda, \land}$ and solve the lasso problems using the R package CDLasso.-->
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Meinshausen, Nicolai, and Peter Bühlmann. "High-dimensional graphs and variable selection with the lasso." <i>The annals of statistics</i> 34, no. 3 (2006): 1436-1462.
                    </p>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p>
                        <br/><strong>Note:</strong><br/>
                        <i>
                            Change the $\alpha$ level to control the false positive rate $(\alpha > 0)$.
                            <b>A larger $\alpha$ will give you more estimated edges, but with lower confidence</b>. If you don't know how to choose
                            a value, use the default one.
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
                                    <input type="number" min=0.001 max=0.999 step=0.001 class="inputbox" name="param" value=0.200 required>
                                    <img src="images/icon-question.png" title="0.001 ~ 0.999"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="2" style="display: none;" type="text"/></td>
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


