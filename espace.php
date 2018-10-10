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
                        <li style="cursor:pointer" id="genemethod9" class="method-active"><a href="espace.php">ESPACE</a></li>
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
                        <h2>ESPACE</h2>
                        <span class="byline">Extended sparse partial correlation estimation</span>
                    </header>
                    <p class="text-justify">
                        To incorporate information about hub nodes, <code>ESPACE</code> extends the <code>SPACE</code> model by using an
                        additional tuning parameter $\alpha$ on edges connected to the given hub nodes. $\lambda$ is the lasso penalty term.
                        $\alpha$ reflect the hub gene information by reducing the penalty on edges connected to hub nodes. To be specific,
                        let $H$ be the set of hub nodes that were previously identified. The <code>ESPACE</code> method we propose solves
                        $$\underset{p}{min}\frac{1}{2}\sum_{i=1}^{p}\left \{ w_{i}\sum_{k=1}^{n} (X_{i}^{k} - \sum_{j\neq i}p^{ij}\sqrt{\frac{\omega_{ij}}{\omega_{ii}}}X_{j}^{k})^{2} \right \} + \alpha\lambda \sum_{i < j, \left \{ i\in H\right \}\cup \left \{ j\in H\right \}}|p^{ij}| + \lambda \sum_{i < j, i,j\in H^{c}}|p^{ij}|,$$
                        where $\lambda \geq 0$, $0 \leq \alpha \leq 1$. $w_i$ is weighted for the squared error loss.
                    </p>
                    <p>
                        <br/><strong>Reference:</strong><br/>
                        1. Donghyeon Yu, Johan Lim, Xinlei Wang, Faming Liang, and Guanghua Xiao. "Enhanced construction of gene regulatory networks using hub gene information." <i>BMC bioinformatics</i> 18.1 (2017): 186.<br/>
                    </p>
                    <p class="text-justify">
                        <br/><strong>Note:</strong><br/>
                        <i>
                            1. Change the $\lambda$ value $(\lambda \geq 0)$ to control the sparsity of the network. <b>A larger $\lambda$ will give you
                                a more sparse network</b>. If you don't know how to choose a value, use the default one.<br/>
                        </i>
                        <i>
                            2. Change the $\alpha$ value $(0 \leq \alpha \leq 1)$ to control the penalty on hub genes. <b>A smaller $\alpha$
                                will give less penalty on edges connected to hub genes</b>. If you don't
                            know how to choose a value, use the default one.<br/>
                        </i>
                        <i>
                            3. The hub gene input should be gene names separated by a comma, e.g. "Gene13,Gene52,Gene199". All the gene names
                            must be contained in column names of the expression data.
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
                                    <input type="number" min=0 max=1 step=0.001 class="inputbox" name="param" value=0.8 required>
                                    <img src="images/icon-question.png" title="0 ~ 1"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-right-align"><p>Lambda:</p></td>
                                <td>
                                    <input type="number" min=0.001 step=0.001 class="inputbox" name="param_2" value=0.6 required>
                                    <img src="images/icon-question.png" title="> 0"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-right-align"><p>Hub genes:</p></td>
                                <td>
                                    <input type="text" title="E.g. Gene13,Gene52,Gene199" class="inputbox" name="hubgenes" value="Gene13,Gene52,Gene199" required>
                                    <img src="images/icon-question.png" title="Gene names must be contained in column names of the expression data"/>
                                </td>
                            </tr>
                            <?php include "form-verifycode.php"; ?>
                            
                            <!-- *************** user information **************** -->
                            <?php include "form-userinfo.php"; ?>

                            <!-- *************** submit **************** -->
                            <tr>
                                <td><label for="method"></label><input id="method" name="method" value="9" style="display: none;" type="text"/></td>
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
