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
    myChart.showLoading();
    $.get('data/demonetwork.json', function (networkData) {
        myChart.hideLoading();

        var option = {
            legend: {
                data: []
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
                data: networkData.nodes.map(function (node, idx) {
                    node.id = idx;
                    return node;
                }),
                categories: networkData.categories,
                force: {
                    // initLayout: 'circular'
//                    edgeLength: 50,
                    // repulsion: 20,
                    edgeLength: 12,
                    repulsion: 12,
                    gravity: 0.2
                },
                edges: networkData.links
            }]
        };

        myChart.setOption(option);

    });

</script>
</body>
</html>