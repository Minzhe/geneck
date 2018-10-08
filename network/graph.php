<?php
require_once '../util.php';
require_once 'common.php';

$jobid = "";
if (isset($_GET['jobid'])) {
    $jobid = util::clean($_GET['jobid']);
}

read_config($jobid);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/svg.css">
    </head>
    <body>
        <!--[if lt IE 9]>
        <div class="unsupported-browser">
            This website does not fully support your browser.  Please get a
            better browser (Firefox or <a href="https://www.google.com/chrome/">Chrome</a>, or if you
            must use Internet Explorer, make it version 9 or greater).
        </div>
        <![endif]-->
        <div id="split-container">
            <div id="graph-container">
                <div id="graph"></div>
            </div>
            <div id="docs-container">
                <a id="docs-close" href="#">&times;</a>
                <div id="docs" class="docs"></div>
            </div>
        </div>
        <script src="jquery/jquery-1.10.2.min.js"></script>
        <script src="jquery/jquery.browser.min.js"></script>
        <script src="d3/d3.v3.min.js"></script>
        <script src="colorbrewer.js"></script>
        <script src="lib/geometry.js"></script>
        <script>
            var config = <?php echo json_encode($config); ?>;
        </script>
        <script src="script.js"></script>
    </body>
</html>
