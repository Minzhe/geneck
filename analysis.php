<?php
require_once('util.php');
?>
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
        MathJax.Hub.Config({
            jax: ["input/TeX", "output/HTML-CSS"],
            displayAlign: "center",
            tex2jax: {
                inlineMath: [['$', '$'], ['\\(', '\\)']]
            },
            menuSettings: { zoom: "Click" }
        });
        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);

        $(document).ready(function(){
            // header & banner
            $("#homebanner").hide();
            $("#analysis").addClass("active");

            $('#alert').hide();
            var error, pageindex;
            error= "<?php if(isset($_GET['error'])) echo util::clean($_GET['error']); ?>";
            pageindex="<?php if(isset($_GET['pageindex'])) echo util::clean($_GET['pageindex']); ?>";
            console.log(pageindex);

            // Display error alert
            if(error) {
                if (error === '0') {
                    document.getElementById("alert").innerHTML = "The entered verification code is incorrect.";
                    $('#alert').show();
                }
                if (error === '1') {
                    document.getElementById("alert").innerHTML = "Your uploaded file is invalid. Please click Example to check upload file requirements";
                    $('#alert').show();
                }
                if (error === '2') {
                    document.getElementById("alert").innerHTML = "The input hubgene doesn't exist in the upload file";
                    $('#alert').show();
                }
                if (error === '3') {
                    document.getElementById("alert").innerHTML = "Fail to send email";
                    $('#alert').show();
                }
                if (error === '4') {
                    document.getElementById("alert").innerHTML = "Expression data dimension too big the for BayesianGLASSO";
                    $('#alert').show();
                }
            }

            //load different forms and contents
            if (pageindex === '1') {
                $("#ajaxcontent").load("GeneNet.php");
                $("#genemethod1").addClass("method-active");
            }
            if (pageindex === '2') {
                $("#ajaxcontent").load("ns.php");
                $("#genemethod2").addClass("method-active");
            }
            if (pageindex === '3') {
                $("#ajaxcontent").load("glasso.php");
                $("#genemethod3").addClass("method-active");
            }
            if (pageindex === '4') {
                $("#ajaxcontent").load("glassosf.php");
                $("#genemethod4").addClass("method-active");
            }
            if (pageindex === '5') {
                $("#ajaxcontent").load("pcacmi.php");
                $("#genemethod5").addClass("method-active");
            }
            if (pageindex === '6') {
                $("#ajaxcontent").load("cmi2ni.php");
                $("#genemethod6").addClass("method-active");
            }
            if (pageindex === '7') {
                $("#ajaxcontent").load("space.php");
                $("#genemethod7").addClass("method-active");
            }
            if (pageindex === '8') {
                $("#ajaxcontent").load("eglasso.php");
                $("#genemethod8").addClass("method-active");
            }
            if (pageindex === '9') {
                $("#ajaxcontent").load("espace.php");
                $("#genemethod9").addClass("method-active");
            }
            if (pageindex === '10') {
                $("#ajaxcontent").load("ena.php");
                $("#genemethod10").addClass("method-active");
            }
            if (pageindex === '11') {
                $("#ajaxcontent").load("bayesianglasso.php");
                $("#genemethod11").addClass("method-active");
            }

            //activate side menu item
            $('ul li').click(function(){
                $('li').removeClass("method-active");
                $(this).addClass("method-active");
                // get the string following the ?
                var query = window.location.search.substring(1)
                if(query.length) {
                    // are the new history methods available ?
                    if(window.history != undefined && window.history.pushState != undefined) {
                        // if pushstate exists, add a new state the the history, this changes the url without reloading the page
                        window.history.pushState({}, document.title, window.location.pathname);
                    }
                }
            });

            //load different forms and contents based on selected menu item, and hide error alert
            $(document).on("click",'#genemethod1',function(e){
                e.preventDefault();
                $('#alert').hide();
                $("#ajaxcontent").load("GeneNet.php");
            });
            $("#genemethod2").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("ns.php");
            });
            $("#genemethod3").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("glasso.php");
            });
            $("#genemethod4").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("glassosf.php");
            });
            $("#genemethod5").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("pcacmi.php");
            });
            $("#genemethod6").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("cmi2ni.php");
            });
            $("#genemethod7").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("space.php");
            });
            $("#genemethod8").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("eglasso.php");
            });
            $("#genemethod9").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("espace.php");
            });
            $("#genemethod10").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("ena.php");
            });
            $("#genemethod11").click(function(){
                $('#alert').hide();
                $("#ajaxcontent").load("bayesianglasso.php");
            });

        });
    </script>

</head>
<body class="left-sidebar">
<!-- Header -->
<!-- Banner -->
<?php include "header.php"; ?>
<!-- Main -->
<div id="page">
    <div id="main" class="container" style="margin-top:0">
        <div class="9u" style="margin-left: 300px;">
            <div class="alert alert-danger" id="alert" hidden></div>
        </div>
        <div class="row">
            <div class="3u">
                <section class="sidebar" id="side-methods">
                    <header>
                        <h2>Network Inference Method</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod1"><a>GeneNet</a></li>
                        <li style="cursor:pointer" id="genemethod2"><a>Neighborhood Selection</a></li>
                        <li style="cursor:pointer" id="genemethod3"><a>GLASSO</a></li>
                        <li style="cursor:pointer" id="genemethod4"><a>GLASSO-SF</a></li>
                        <li style="cursor:pointer" id="genemethod5"><a>PCACMI</a></li>
                        <li style="cursor:pointer" id="genemethod6"><a>CMI2NI</a></li>
                        <li style="cursor:pointer" id="genemethod7"><a>SPACE</a></li>
                        <li style="cursor:pointer" id="genemethod11"><a>BayesianGLASSO</a></li>
                    </ul>
                </section>
                <section class="sidebar" id="methods">
                    <header>
                        <h2>Incorporate Hub Gene</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod8"><a>EGLASSO</a></li>
                        <li style="cursor:pointer" id="genemethod9"><a>ESPACE</a></li>
                    </ul>
                </section>
                <section class="sidebar" id="methods">
                    <header>
                        <h2>Integrative Methods</h2>
                    </header>
                    <ul class="style1 methods">
                        <li style="cursor:pointer" id="genemethod10"><a>ENA</a></li>
                    </ul>
                </section>
            </div>

            <!--load different method contents-->
            <div class="9u skel-cell-important" id="ajaxcontent">
                <section class="intro">
                    <header>
                        <h2>Start analysis</h2>
                        <span class="byline">GeNeCK online analysis guide</span>
                    </header>
                    <p>
                        To start using <code>GeNeCK</code>, prepare your gene expression data, and select your preferred
                        methods to construct the gene network.
                        <a data-target="#myModal-demo" data-toggle="modal" style="cursor: pointer">>>> Demo</a>
                    </p>
                    <div class="modal modal-wide fade in" id="myModal-demo" role="dialog" style="padding-right: 13px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        <b>Example: How to generate gene network</b>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <p><img style="width: auto; height: auto;" src="images/figure.guide.png"/></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ****************** setion 1 ******************** -->
                    <div class="method-active">
                        <table class="para-table">
                            <tr>
                                <td width="70%"><h3>&nbsp&nbsp1. Select an algorithm</h3></td>
                                <td width="30%" style="text-align: right">
                                    <p style="text-align: right">
                                        <button class="detail-button" id="detail-show1"><!--More &#x25BC--></button>
                                        <button class="detail-button" id="detail-hide1"><!--Less &#x25B2--></button>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="detail-intro1">
                        <p><strong>Network Inference Method</strong></p>
                        <p>
                            <code>GeNeCK</code> provides 8 network inference methods that use distinct statistical
                            strategies:
                            1) partial correlation methods (<code>GeneNet</code>, <code>NS</code>, <code>SPACE</code>);
                            2) likelihood methods (<code>GLASSO</code>, <code>GLASSO-SF</code>);
                            3) information theory-based methods (<code>PCACMI</code>, <code>CMI2NI</code>); and
                            4) Bayesian methods (<code>BayesianGLASSO</code>).
                        </p>
                        <p><strong>Incorporate Hub Gene</strong></p>
                        <p>
                            Gene networks usually have scale-free characteristics. In other words, there are usually
                            a few hub genes regulating many others. <code>EGLASSO</code> and <code>ESPACE</code>
                            are two methods that incorporate the prior knowledge of hub genes to enhance network
                            inference. In these extended methods, during the covariance estimation, an additional
                            tuning parameter is introduced to reduce the penalty on edges connected to hub genes.
                        </p>
                        <p><strong>Integrative Method</strong></p>
                        <p>
                            Ensemble-based network aggregation (<code>ENA</code>) is an approach to combine network
                            reconstructed from different methods, which borrows the strength from different strategies
                            and generally yields good results.
                        </p>
                    </div>

                    <!-- ****************** setion 2 ******************** -->
                    <div class="method-active">
                        <table class="para-table">
                            <tr>
                                <td width="70%"><h3>&nbsp&nbsp2. Upload data & set parameters</h3></td>
                                <td width="30%" style="text-align: right">
                                    <p style="text-align: right">
                                        <button class="detail-button" id="detail-show2"><!--More &#x25BC--></button>
                                        <button class="detail-button" id="detail-hide2"><!--Less &#x25B2--></button>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="detail-intro2">
                        <p><strong>Gene expression data</strong></p>
                        <p>
                            Gene expression data (e.g. microarray and RNA-Seq) monitors the transcription
                            activities of different genes in a cell simultaneously, which is the foundation of
                            all statistical algorithms.
                            <a data-target="#myModal-example" data-toggle="modal" style="cursor: pointer">>>>
                                Example</a>
                        </p>
                        <div class="modal modal-wide fade in" id="myModal-example" role="dialog"
                             style="padding-right: 13px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">
                                            <strong style="font-size: 18px">Example of gene expression data</strong>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><img style="width:auto;height:auto;" src="images/example.png"/></p>
                                        <h2 style="font-size: 17px;"><strong>Expression data requirements:</strong></h2>
                                        <ol>
                                            <li>Only CSV file is accepted here, and the maximum size is 12MB.</li>
                                            <li>The first row will be used as gene name. The rest of the row must be
                                                numeric type.
                                            </li>
                                            <li>Each row has to contain the same columns as the first row.</li>
                                            <li>The program will normalize the expression data automatically.</li>
                                        </ol>
                                        <br/>
                                        <strong style="font-size: 17px">Download demo data</strong><br/>
                                        <strong style="font-size: 17px">moderate size:</strong><a
                                            href="data/demo_data.csv"><img style="width: 40px; padding-left: 15px;"
                                                                            src="images/down.png"/></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong style="font-size: 17px">small size:</strong><a
                                            href="data/demo_data_small.csv"><img
                                            style="width: 40px; padding-left: 15px;" src="images/down.png"/></a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><strong>Method parameters</strong></p>
                        <p>
                            <code>GeNeCK</code> offers the flexibility for user to specify the value of parameters for
                            different methods. These parameters usually control the sparsity of the constructed network.
                            Though they may share the same name ($\lambda$ or $\alpha$), they have different and
                            sometimes opposite meanings in the context of different methods. Refer to each method to
                            choose an appropriate value.
                        </p>
                        <p><strong>Hub genes</strong></p>
                        <p>
                            Incorporating prior hub gene information can enhance the network inference, but make sure
                            those hub genes has real biological support. User can change the corresponding parameters in
                            <code>EGLASSO</code> and <code>ESPACE</code> to control the confidence level for hub genes.
                        </p>
                    </div>

                    <!-- ****************** setion 3 ******************** -->
                    <div class="method-active">
                        <table class="para-table">
                            <tr>
                                <td width="70%"><h3>&nbsp&nbsp3. Visualize & download</h3></td>
                                <td width="30%" style="text-align: right">
                                    <p style="text-align: right">
                                        <button class="detail-button" id="detail-show3"><!--More &#x25BC--></button>
                                        <button class="detail-button" id="detail-hide3"><!--Less &#x25B2--></button>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="detail-intro3">
                        <p>
                            After you submit your job, you will be directed to a waiting page.
                            You are free to leave and come back to check the job status at any time.
                            If you provide your e-mail address, the link will also be sent to you.
                            Once the job is done, the constructed network will be displayed on the page.
                            You can also download the result that contains all the estimated edges.
                            Each row represent two connected nodes.
                            <a data-target="#myModal-result" data-toggle="modal" style="cursor: pointer">>>> Example</a>
                        </p>
                    </div>
                    <div class="modal modal-wide fade in" id="myModal-result" role="dialog"
                         style="padding-right: 13px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">
                                        <b>Example: page displaying constructed network</b>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <p><img style="width: auto; height: auto;" src="images/figure.result.png"/></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Main -->
</div>
<!-- Copyright -->
<?php include "footer.php"; ?>
</body>
</html>