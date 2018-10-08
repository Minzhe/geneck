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
                        <li style="cursor:pointer" id="genemethod5" class="method-active"><a href="pcacmi.php">PCACMI</a></li>
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
                        <h2>PCACMI</h2>
                        <span class="byline">Path consistency algorithm based on conditional mutual information</span>
                    </header>
                    <p class="text-justify">
                        Mutual information (MI) is a widely used measure of dependency between variables in
                        information theory.
                        <!--MI even measures non-linear dependency between variables and can be considered as a
                        generalization of the correlation. Several mutual information (MI) based methods have been developed such as
                        <code>ARACNE</code>, <code>CLR</code>, and <code>minet</code>. However, similar to the correlation, MI only measures pairwise dependency
                        between two variables. Thus, it usually identifies many undirected interactions between variables. -->
                        <code>PCACMI</code> adapts adopt the path consistency algorithm (PCA) to identify dependent pairs of variables
                        for reconstruction of the gene regulatory networks based on the conditional mutual information (CMI).
                    </p>
                    <p class="text-justify" id="detail-intro">
                        To be specific, let $H(X)$ and $H(X,Y)$ be the entropy of a random variable $X$ and the joint
                        entropy of random variables $X$ and $Y$, respectively. For two random variables $X$ and $Y$, $H(X)$ and $H(X,Y)$
                        can be expressed as
                        $$H(X) = E(-logf_{x}(X)), \quad H(X, Y) = E (-logf_{xy}(X, Y)),$$
                        where $f_X(x)$ is the marginal probability density function (PDF) of $X$ and $f_XY(x, y)$ is the joint PDF of $X$
                        and $Y$. With these notations, MI is defined as
                        $$I(X, Y) = E(-log\frac{f_{XY}(X, Y)}{f_{X}(X)f_{Y}(Y)})\\\quad\quad\quad\quad = H(X) + H(Y) - H(X, Y).$$
                        It is known that MI measures dependency between two variables that contain both directed dependency and
                        indirected dependency through other variables. While MI can not distinguish directed and indirected dependency,
                        CMI can measure directed dependency between two variables by conditioning on other variables. CMI for $X$ and $Y$
                        given Z is defined as
                        $$I(X,Y|Z) = H(X,Z) + H(Y,Z) - H(Z) - H(X,Y,Z).$$

                        To estimate the entropies, Gaussian kernal density estimator is considered. MI and CMI are defined as
                        $$\hat{I}(X,Y) = \frac{1}{2}log\frac{|C(X)||C(Y)|}{|C(X,Y)|},$$
                        $$\hat{I}(X,Y|Z) = \frac{1}{2}log\frac{|C(X,Z)||C(Y,Z)|}{|C(Z)||C(X,Y,Z)|},$$
                        where $|A|$ is the determinant of matrix $A$, $C(X)$, $C(Y)$ and $C(Z)$ are the variances of $X$, $Y$ and $Z$, respectively,
                        and $C(X,Z)$, $C(Y,Z)$ and $C(X,Y,Z)$ are the covariance matrices of $(X,Z)$, $(Y,Z)$ and $(X,Y,Z)$, respectively.

                        The <code>PCACMI</code> method
                        sets $L = 0$ and calculates with $L$-order CMI, which is equivalent to MI if $L = 0$. Then <code>PCACMI</code>
                        removes the pairs of variables such that the maximal CMI of two variables given $L+1$ adjacent variables is less
                        than a given threshold $\alpha$, where $\alpha$ determines whether two variables are independent or not and adjacent
                        variables denote variables connected to the two target variables in <code>PCACMI</code> at the previous step.
                        <code>PCACMI</code> repeats the above steps until there is no higher order.<br/>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                        2. Zhang, Xiujun, Xing-Ming Zhao, Kun He, Le Lu, Yongwei Cao, Jingdong Liu, Jin-Kao Hao, Zhi-Ping Liu, and Luonan Chen. "Inferring gene regulatory networks from gene expression data by path consistency algorithm based on conditional mutual information." <i>Bioinformatics</i> 28.1 (2011): 98-104.
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
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param" value=0.03 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="5" style="display: none;" type="text"/></td>
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