<?php
session_start();
$_SESSION['page_name'] = "espace.php";
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
<?php include "methods-form.php"; ?>
