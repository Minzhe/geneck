<!DOCTYPE HTML>
<html>
<head>
    <title>GeNeck</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery_3.2.1.min.js"></script>
    <script src="js/bootstrap_3.3.7.min.js"></script>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
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
            $("#homebanner").hide();
            $("#download").addClass("active");
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
            <h2>Algorithms for gene network construction</h2>
            <span class="byline"></span>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="12u">
                <section class="text-bg">
                    <!-- entry 1-->
                    <div class="item-entry">
                        <!--								<img src="images/R.logo.png"/>-->
                        <a href="data/espace_0.1.tar.gz" class="button" target="_blank">Download</a>
                        <div>
                            <h2>ESPACE</h2>
                            <span
                                style="text-align: justify;">Extended Sparse PArtial Correlation Estimation method</span>
                            <p style="text-align: justify;">ESPACE is an R package to construct gene regulatory networks
                                using hub gene information.</p>
                            <span style="text-align: justify;">Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.</span>
                        </div>
                    </div>
                    <!-- entry 2-->
                    <div class="item-entry">
                        <a href="http://journals.plos.org/plosone/article?id=10.1371/journal.pone.0106319"
                           class="button" target="_blank">Visit web</a>
                        <!--                                <img src="images/R.logo.png"/>-->
                        <div>
                            <h2>ENA</h2>
                            <span style="text-align: justify;">Ensemble-Based Network Aggregation</span>
                            <p style="text-align: justify;">ENA is an ensemble-based network aggregation method that can
                                aggregate networks produced by various reconstruction methods into a single network that
                                is more accurate than the network inferred by any individual method.</p>
                            <span style="text-align: justify;">Rui Zhong, Jeffrey D. Allen, Guanghua Xiao, and Yang Xie. "Ensemble-based network aggregation improves the accuracy of gene network reconstruction." <i>PloS one</i> 9.11 (2014): e106319.</span>
                            <!--                                    <a href="http://journals.plos.org/plosone/article?id=10.1371/journal.pone.0106319" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 3-->
                    <div class="item-entry">
                        <a href="http://strimmerlab.org/software/genenet/" class="button" target="_blank">Visit web</a>
                        <!--								<img src="images/R.logo.png"/>-->
                        <div>
                            <h2>GeneNet</h2>
                            <p style="text-align: justify;">GeneNet is an R package for learning high-dimensional
                                dependency networks from genomic data (e.g. gene association networks). The current
                                version of GeneNet also allows users to assign putative directions to edges in the
                                network.</p>
                            <span style="text-align: justify;">Schäfer, Juliane, and Korbinian Strimmer. "A shrinkage approach to large-scale covariance matrix estimation and implications for functional genomics." <i>Statistical applications in genetics and molecular biology</i> 4.1 (2005): 32.</span>
                            <!--									<a href="http://strimmerlab.org/software/genenet/" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 4-->
                    <div class="item-entry">
                        <a href="https://www.rdocumentation.org/packages/CDLasso/versions/1.1" class="button"
                           target="_blank">Visit web</a>
                        <!--								<img src="images/R.logo.png"/>-->
                        <div>
                            <h2>CDLasso</h2>
                            <span style="text-align: justify;">Coordinate Descent Algorithms for Lasso Penalized L1, L2, and Logistic Regression</span>
                            <p style="text-align: justify;">Coordinate Descent Algorithms for Lasso Penalized
                                Regression.</p>
                            <span style="text-align: justify;">Wu, Tong Tong, and Kenneth Lange. "Coordinate descent algorithms for lasso penalized regression." <i>The Annals of Applied Statistics</i> (2008): 224-244.</span>
                            <!--                                    <a href="https://www.rdocumentation.org/packages/CDLasso/versions/1.1" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 5-->
                    <div class="item-entry">
                        <a href="http://statweb.stanford.edu/~tibs/glasso/" class="button" target="_blank">Visit web</a>
                        <!--								<img src="images/R.logo.png"/>-->
                        <!--								<img src="images/matlab.logo.gif">-->
                        <div>
                            <h2>GLASSO</h2>
                            <span style="text-align: justify;">Graphical Lasso</span>
                            <p style="text-align: justify;">Graphical lasso estimates a sparse inverse covariance matrix
                                using a lasso (L1) penalty. It can be used for estimating a sparse undirected
                                graph. </p>
                            <span style="text-align: justify;">Friedman, Jerome, Trevor Hastie, and Robert Tibshirani. "Sparse inverse covariance estimation with the graphical lasso." <i>Biostatistics</i> 9.3 (2008): 432-441.</span>
                            <!--                                    <a href="http://statweb.stanford.edu/~tibs/glasso/" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 6-->
                    <div class="item-entry">
                        <a href="https://sites.google.com/site/xiujunzhangcsb/software/pca-cmi" class="button"
                           target="_blank">Visit web</a>
                        <!--								<img src="images/matlab.logo.gif"/>-->
                        <div>
                            <h2>PCA-CMI</h2>
                            <span style="text-align: justify;">Path Consistency Algorithm based on Conditional Mutual Information</span>
                            <p style="text-align: justify;">PCA-CMI is a MATLAB program for inferring gene regulatory
                                networks from gene expression data. It is a novel method based on a path consistency
                                algorithm and conditional mutual information, which considers the non-linear dependence
                                and topological structure of GRNs. In this algorithm, the (conditional) dependence
                                between a pair of genes is represented by the CMI between them. With the general
                                hypothesis of Gaussian distribution underlying gene expression data, CMI between a pair
                                of genes is computed by a concise formula involving the covariance matrices of the
                                related gene expression profiles.</p>
                            <span style="text-align: justify;">Zhang, Xiujun, Xing-Ming Zhao, Kun He, Le Lu, Yongwei Cao, Jingdong Liu, Jin-Kao Hao, Zhi-Ping Liu, and Luonan Chen. "Inferring gene regulatory networks from gene expression data by path consistency algorithm based on conditional mutual information." <i>Bioinformatics</i> 28.1 (2011): 98-104.</span>
                            <!--									<a href="https://sites.google.com/site/xiujunzhangcsb/software/pca-cmi" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 7-->
                    <div class="item-entry">
                        <a href="https://sites.google.com/site/xiujunzhangcsb/software/cmi2ni" class="button"
                           target="_blank">Visit web</a>
                        <!--								<img src="images/matlab.logo.gif"/>-->
                        <div>
                            <h2>CMI2NI</h2>
                            <span style="text-align: justify;">Conditional mutual inclusive information-based network inference</span>
                            <p style="text-align: justify;">CMI2NI is a software for inferring gene regulatory networks
                                from gene expression data. It is a novel method using a new proposed concept of
                                Conditional Mutual Inclusive Information (CMI2) which can accurately measure direct
                                dependences between genes. Given the small sample sizes of gene expression data, CMI2NI
                                can not only infer the correct topology of the regulation networks but also accurately
                                quantify the dependence or regulation strength between genes. CMI2NI provides a useful
                                tool to infer gene regulatory networks.</p>
                            <span style="text-align: justify;">Zhang, Xiujun, Juan Zhao, Jin-Kao Hao, Xing-Ming Zhao, and Luonan Chen. "Conditional mutual inclusive information enables accurate quantification of associations in gene regulatory networks." <i>Nucleic acids research</i> 43.5 (2014): e31-e31.</span>
                            <!--									<a href="https://sites.google.com/site/xiujunzhangcsb/software/cmi2ni" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 8-->
                    <div class="item-entry">
                        <a href="https://cran.r-project.org/web/packages/space/index.html" class="button"
                           target="_blank">Visit web</a>
                        <!--								<img src="images/R.logo.png"/>-->
                        <div>
                            <h2>SPACE</h2>
                            <span style="text-align: justify;">Space PArtial Correlation Estimation</span>
                            <p style="text-align: justify;">Partial correlation estimation with joint sparse regression
                                model.</p>
                            <span style="text-align: justify;">Peng, Jie, Pei Wang, Nengfeng Zhou, and Ji Zhu. "Partial correlation estimation by joint sparse regression models." <i>Journal of the American Statistical Association</i> 104.486 (2009): 735-746.</span>
                            <!--									<a href="https://cran.r-project.org/web/packages/space/index.html" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                    <!-- entry 9-->
                    <div class="item-entry">
                        <a href="https://cran.r-project.org/web/packages/BayesianGLasso/index.html" class="button"
                           target="_blank">Visit web</a>
                        <!--								<img src="images/R.logo.png"/>-->
                        <div>
                            <h2>BayesianGLASSO</h2>
                            <span style="text-align: justify;">Bayesian Graphical Lasso</span>
                            <p style="text-align: justify;">Implements a data-augmented block Gibbs sampler for
                                simulating the posterior distribution of concentration matrices for specifying the
                                topology and parameterization of a Gaussian Graphical Model (GGM). This sampler was
                                originally proposed in Wang (2012).</p>
                            <span style="text-align: justify;">Wang, Hao. "Bayesian graphical lasso models and efficient posterior computation." <i>Bayesian Analysis</i> 7.4 (2012): 867-886.</span>
                            <!--									<a href="https://cran.r-project.org/web/packages/space/index.html" class="button" target="_blank">Visit site</a>-->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Main -->
</div>
<!-- /Main -->
<!-- Copyright -->
<?php include "footer.php"; ?>
</body>
</html>