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

    //hide detailed introduction
    $(document).ready(function () {
        $("#detail-intro").hide();
        $("#detail-hide").hide();
        $("#detail-show").click(function(){
            $("#detail-show").hide();
            $("#detail-hide").show();
            $("#detail-intro").slideToggle();
        });
        $("#detail-hide").click(function(){
            $("#detail-hide").hide();
            $("#detail-show").show();
            $("#detail-intro").slideToggle();
        });
    });
</script>
