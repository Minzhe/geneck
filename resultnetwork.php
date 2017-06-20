<!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <script type="text/javascript" src="js/echarts.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body style="height: 100%; margin: 0">
<div id="container" style="height: 100%"></div>
<script type="text/javascript">
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    myChart.showLoading();
    $.get('data/webkit-dep.json', function (webkitDep) {
        myChart.hideLoading();

        option = {
            legend: {
                data: ['HTMLElement', 'WebGL', 'SVG', 'CSS', 'Other']
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
                data: webkitDep.nodes.map(function (node, idx) {
                    node.id = idx;
                    return node;
                }),
                categories: webkitDep.categories,
                force: {
                    // initLayout: 'circular'
                    // repulsion: 20,
                    edgeLength: 5,
                    repulsion: 20,
                    gravity: 0.2
                },
                edges: webkitDep.links
            }]
        };

        myChart.setOption(option);
    });
</script>
</body>
</html>