<section class="sidebar" id="side-methods">
    <header>
        <h2>Network Inference Method</h2>
    </header>
    <ul class="style1 methods">
        <li style="cursor:pointer" id="genemethod1" <?php if ($method == 1) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=1">GeneNet</a></li>
        <li style="cursor:pointer" id="genemethod2" <?php if ($method == 2) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=2">Neighborhood Selection</a></li>
        <li style="cursor:pointer" id="genemethod3" <?php if ($method == 3) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=3">GLASSO</a></li>
        <li style="cursor:pointer" id="genemethod4" <?php if ($method == 4) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=4">GLASSO-SF</a></li>
        <li style="cursor:pointer" id="genemethod5" <?php if ($method == 5) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=5">PCACMI</a></li>
        <li style="cursor:pointer" id="genemethod6" <?php if ($method == 6) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=6">CMI2NI</a></li>
        <li style="cursor:pointer" id="genemethod7" <?php if ($method == 7) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=7">SPACE</a></li>
        <li style="cursor:pointer" id="genemethod11" <?php if ($method == 11) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=11">BayesianGLASSO</a></li>
    </ul>
</section>
<section class="sidebar" id="methods">
    <header>
        <h2>Incorporates Hub Genes</h2>
    </header>
    <ul class="style1 methods">
        <li style="cursor:pointer" id="genemethod8" <?php if ($method == 8) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=8">EGLASSO</a></li>
        <li style="cursor:pointer" id="genemethod9" <?php if ($method == 9) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=9">ESPACE</a></li>
    </ul>
</section>
<section class="sidebar" id="methods">
    <header>
        <h2>Integrative Method</h2>
    </header>
    <ul class="style1 methods">
        <li style="cursor:pointer" id="genemethod10" <?php if ($method == 10) echo "class=\"method-active\"";?>><a href="analysis.php?pageindex=10">ENA</a></li>
    </ul>
</section>
