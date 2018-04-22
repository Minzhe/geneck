<?php
session_start();
$_SESSION['page_name'] = "eglasso.php";
?>
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
</script>
<section>
    <header>
        <h2>EGLASSO</h2>
        <span class="byline">Extended graphical lasso</span>
    </header>
    <p class="text-justify">
        <code>EGLASSO</code> is an adapted version of <code>GLASSO</code> for incorporating the hub gene information. The
        <code>EGLASSO</code> maximizes
        $$log|\Omega| -tr(S\Omega) -\alpha\lambda \sum_{ i < j, \left \{ i\in H\right \}\cup \left \{ j\in H\right \}}|\omega_{ij}| - \lambda\sum_{i < j, i,j\in H^{c}}|\omega^{ij}| ,$$
        where $\lambda \geq 0$ and $0 \leq \alpha \leq 1$ are two tuning parameters, $S$ is the sample covariance matrix,
        $tr(A)$ is the trace of $A$ and $H$ is the set of hub nodes that were previously identified.
    </p>
    <p class="text-justify">
        <br/><strong>Note:</strong><br/>
        <i>
            1. Change the $\lambda$ value $(\lambda > 0)$ to control the sparsity of network. <b>A larger $\lambda$ will give you
                more a sparse network</b>. If you don't know how to choose a value, use the default one.<br/>
        </i>
        <i>
            2. Change the $\alpha$ value $(0 \leq \alpha \leq 1)$ to control the penalty on hub genes. <b>A smaller $\alpha$
                will give less penalty on edges connected to hub genes</b>. If you don't know how to choose a value, use the default one.<br/>
        </i>
        <i>
            3. The hub gene input should be gene names separated by a comma, e.g. "Gene13,Gene52,Gene199". All the gene names
            must be contained in column names of the expression data.
        </i>
    </p>
</section>
<?php include "methods-form.php"; ?>
