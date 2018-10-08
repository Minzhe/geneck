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
                        <li style="cursor:pointer" id="genemethod10" class="method-active"><a href="ena.php">ENA</a></li>
                    </ul>
                </section>
            </div>
            <!-- ****************************************************************************** -->
            
            <!-- **********************************  method  ************************************* -->
            <div class="9u skel-cell-important">
                <section>
                <header>
                    <h2>ENA</h2>
                    <span class="byline">Ensemble-Based Network Aggregation</span>
                </header>
                    <div>
                        <p class="text-justify">
                            <code>ENA</code> is an ensemble-based network aggregation approach to combine networks reconstructed from different methods.
                            The current <code>ENA</code> algorithm integrates <code>NS</code>, <code>GLASSO</code>, <code>GLASSO-SF</code>,
                            <code>PCACMI</code>, <code>SPACE</code> and <code>BayesianGLASSO</code>.
                        </p>
                        <p class="text-justify" id="detail-intro">
                            Suppose $G^k (k = 1,...,M)$ is a set of networks constructed by $M$ different methods. The rank $r^k_{ij}$ of
                            connection strength for edge between gene $i$ and gene $j$ is calculated on each individual network in $G^k$.
                            This operation is performed on all edges in $G^k$ to get the rank of all edges $r^k_{ij} (i, j \in N \ and \ i < j)$
                            in $M$ different methods. Then the predicted rank $\tilde{r}_{ij}$ of a particular edge between gene $i$ and $j$
                            in the aggregated network is calculated by taking the harmonic mean of the inverse of the ranks of the same
                            edge across all network in $G^k$, according to
                            $$\tilde{r}_{ij} = M \ / \sum^M_{i=1}{1 \ / \ r^k_{ij}}$$

                            To derive the confidence level of an edge to be a true positive connection, the original dataset is permutated
                            to obtain a resampled dataset $MD^{p_i}$. Then <code>ENA</code> algorithm is applied to get the estimated graph
                            $G^{p_i}$ on this dataset. This procedure is repeated for $m$ times and null distribution $G^{null}$ is generated
                            by aggregating all estimated edge strength in $m$ permutations. Then the confidence level $\tilde{p}_{ij}$ is
                            derived by calculating the quantile of $\tilde{r}_{ij}$ in $G^{null}$ with Benjamini-Hochberg adjustment to
                            avoid multiple comparison problem.
                            $$\tilde{p}_{ij} = BH adjust(\frac{\# \ of \ \tilde{r}_{ij} < permutated \ r \ value \ in \ G^{null}}{total \ \# \ of \ permutated \ r \ value \ in \ G^{null}})$$
                            <br/>
                            <br/><strong>Reference:</strong><br/>
                            1. Rui Zhong, Jeffrey D. Allen, Guanghua Xiao, and Yang Xie. "Ensemble-based network aggregation improves the accuracy of gene network reconstruction." <i>PloS one</i> 9.11 (2014): e106319.<br/>
                        </p>
                        <p style="text-align: right">
                            <button class="detail-button" id="detail-show">More &#x25BC</button>
                            <button class="detail-button" id="detail-hide">Less &#x25B2</button>
                        </p>
                        <p>
                            <strong>Note:</strong><br/>
                            <i>
                                1. Hub gene input is currently not supported.<br/>
                                2. <code>BayesianGLASSO</code> is time consuming. The user can select whether to include <code>BayesianGLASSO</code>
                                or not (the result won't change too much). <br/>
                                3. If <code>BayesianGLASSO</code> is selected, we require the input expression data to have <b>no more than 50 genes (columns)</b>
                                and <b>no more than 100 observations (rows)</b>. (Otherwise, you won't be able to submit the job!)
                            </i>
                        </p>
                    </div>
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
                                <td class="table-right-align"><p>p-value:</p></td>
                                <td>
                                    <input type="number" min=0.001 max=0.999 step=0.001 class="inputbox" name="param" value=0.05 required>
                                    <img src="images/icon-question.png" title="0.001 ~ 0.999"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-right-align"><p>Include BayesianGLASSO</p></td>
                                <td>
                                    <select name="param_2">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="10" style="display: none;" type="text"/></td>
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