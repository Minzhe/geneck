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
                        <li style="cursor:pointer" id="genemethod7"><a href="space.php">SPACE</a></li>
                        <li style="cursor:pointer" id="genemethod11" class="method-active"><a href="bayesianglasso.php">BayesianGLASSO</a></li>
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
                        <h2>BayesianGLASSO</h2>
                        <span class="byline">Bayesian Graphical Lasso</span>
                    </header>
                    <p class="text-justify">
                        Bayesian Graphical Lasso (<code>BayesianGLASSO</code>) is a Bayesian treatment of <code>GLASSO</code> that use a
                        double exponential prior and employs a block Gibbs sampler for exploring the posterior distribution.
                    </p>
                    <div class="text-justify" id="detail-intro">
                        The original <code>GLASSO</code> is still maintained. An efficient block Gibbs sampler is developed:<br/>
                        <div style="padding-left: 32px">
                            <p>
                                1. For $i = 1, ..., p$
                            </p>
                            <p style="padding-left: 32px">
                                (a) Partition $\Omega, \hat{\Sigma}, T$ as following:
                                $$\Omega = \binom{\Omega_{11}\quad \omega_{12}}{\omega_{12}^{'}\quad \omega_{22}}, \quad S = \binom{S_{11}\quad s_{12}}{s_{12}^{'}\quad s_{22}}, \quad T = \binom{T_{11}\quad \tau_{12}}{\tau_{12}^{'}\quad \tau_{22}}.$$
                                (b) Sample $\gamma \sim Ga(n/2+1, (\hat{\sigma}_{22}+\lambda)/2$ and
                                $\beta \sim N(-C\hat{\sigma}_{21}, C)$, where
                                $C = \{(\hat{\sigma}_{22} + \lambda)\Omega^{-1}_{11} + D^{-1}_{\tau}\}$, $D_{\tau} = diag(\tau_{12})$.<br/>
                                (c) Update $\omega_{21} = \beta$, $\omega_{12} = \beta^T$, $\omega_{22} = \gamma + \beta^T\Omega^{-1}_{11}\beta$.
                            </p>
                            <p>
                                2. Sample $\mu_{ij} \sim Inv-Gau(\mu^{'}, \lambda^{'})$,
                                where $\mu^{'} = \sqrt{(\lambda^2/\omega^2_{ij})}, \lambda^{'} = \lambda^2$.
                                Update $\tau = 1/\mu_{ij}$.<br/>
                                3. Sample $\lambda \sim Ga(r + p(p+1)/2, s + ∥\omega∥_1/2)$.<br/>
                            </p>
                        </div>
                        <p>
                            In this form of the Bayesian graphical lasso, a single shrinkage parameter $\lambda$ is employed. The
                            Bayesian adaptive graphical lasso, on the other hand, allows for different shrinkage parameters $\lambda_{ij}$
                            for different entries of the precision matrix $\Omega$. The model (data likelihood, prior, and hyperprior) is
                            $$p(y_i|\Omega) = n(y_i|0, \Omega^{-1})$$
                            $$p(\Omega|\lambda) \propto \prod_{i \le j}{[\frac{\lambda_{ij}}{2}exp\{-\lambda_{ij}|\omega_{ij}|\}]}\prod^{p}_{i=1}[\frac{\lambda_{ii}}{2}exp\{-\frac{\lambda_{ii}}{2}\omega_{ii}\}]1_{\Omega \in M^+}$$
                            $$p(\{\lambda_{ij}\}_{i \le j}|\{\lambda_{ii}\}^{p}_{i=1}) \propto \prod_{i \le j}{\frac{s^r}{\Gamma(r)}\lambda^{r-1}_{ij}exp\{-\lambda_{ij}s_i\}}.$$
                            This allow the level of shrinkage to be automatically chosen based on the current value of $\omega_{ij}$.
                        </p>
                        <p>
                            <br/><strong>Reference:</strong><br/>
                            1. Wang, Hao. "Bayesian graphical lasso models and efficient posterior computation." <i>Bayesian Analysis</i> 7.4 (2012): 867-886.
                        </p>
                    </div>
                    <p style="text-align: right">
                        <button class="detail-button" id="detail-show">More &#x25BC</button>
                        <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                    </p>
                    <p>
                        <strong>Note:</strong><br/>
                        <i>
                            1. <code>BayesianGLASSO</code> is time consuming. We require the input expression data to have <b>no more than 50 genes (columns)</b>
                            and <b>no more than 100 observations (rows)</b>. (Otherwise, you won't be able to submit the job!)<br/>
                            2. Change the $\alpha$ level to control the sparsity of the network $(0 < \alpha < 1)$.
                            A small $\alpha$ will give you more estimated edges, but with lower confidence. If you don't know how to choose
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
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param" value=0.1 required>
                                    <img src="images/icon-question.png" title="0.001 ~ 0.999"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="11" style="display: none;" type="text"/></td>
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
