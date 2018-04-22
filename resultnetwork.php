<!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta charset="utf-8">
    <title>GeNeck</title>
    <script type="text/javascript" src="js/echarts.min.js"></script>
    <script src="js/jquery_3.2.1.min.js"></script>
</head>
<body style="height: 100%; margin: 0">
<div id="container" style="height: 100%"></div>
<script type="text/javascript">
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var edgeJson = "";
    myChart.showLoading();

    <?php
    require_once('util.php');
    include "../../dbincloc/geneck.inc";

    $estEdgeJson = "";

    // Open a new connection to the MySQL server
    $db_conn = new mysqli($hostname, $usr, $pwd, $dbname);

    // Output any connection error
    if ($db_conn->connect_error) {
        die('Error : (' . $db_conn->connect_errno . ') ' . $db_conn->connect_error);
    }

    if (isset($_GET['jobid'])) {
        $jobid = util::clean($_GET['jobid']);
    }

    $stmt = $db_conn->prepare("SELECT EstEdge_json FROM GeneckResults WHERE JobID = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $jobid);
        mysqli_stmt_execute($stmt);
        $stmt->bind_result($estEdgeJson);
        $stmt->fetch();

        mysqli_stmt_close($stmt);

    } else {
        trigger_error('Statement failed : ' . mysqli_stmt_error($stmt), E_USER_ERROR);
    }

    $db_conn->close();

    echo "edgeJson = ";
    echo $estEdgeJson;
    ?>

    myChart.hideLoading();
    // customize graph
    coeff = Object.keys(edgeJson.nodes).length / 500;
    option = {
        legend: {
            data: ['gene', 'hub gene']
        },
        series: [{
            type: 'graph',
            layout: 'force',
            animation: false,
            label: {
                normal: {
                    position: 'right',
                    formatter: '{b}'
                }
            },
            draggable: true,
            data: edgeJson.nodes.map(function (node, idx) {
                node.id = idx;
                return node;
            }),
            categories: edgeJson.categories,
            force: {
                // initLayout: 'circular'
                // repulsion: 20,
                edgeLength: 50 / Math.cbrt(coeff),
                repulsion: 20 / Math.cbrt(coeff),
                gravity: 0.2 * Math.sqrt(coeff)
            },
            edges: edgeJson.links
        }]
    };

    myChart.setOption(option);
</script>
</body>
</html>