<?php
session_start();
$_SESSION['page_name'] = "glassosf.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>GLASSO-SF</h2>
        <span class="byline">GLASSO with reweighted strategy for scale-free network</span>
    </header>
    <p class="text-justify">
        <code>GLASSO-SF</code> is the reweighted $ℓ_1$ regularization method of <code>GLASSO</code> to improve the
        performance of the estimation  for the scale-free network. <code>GLASSO-SF</code> changes the $ℓ_1$ norm penalty
        in the existing methods to the power law regularization
        $$p_{\lambda, \gamma }(\Omega) = \lambda \sum_{i=1}^{p}log(\left\| \omega_{-i}\right\|_{1} + \epsilon_{i} ) + \gamma\sum_{i=1}^{p}\left | \omega_{ii} \right |,$$
        where $\lambda$ and $\gamma$ are nonnegative tuning parameters,
        $\omega_{-i} = \{\omega_{ij} | j \ne i\}, \left\| \omega_{-i}\right\|_{1} = \sum_{j\neq i}\left| \omega_{ij}\right|$,
        and $\epsilon_i$ is a small positive number for $i=1,2,...,p$.
    </p>
    <p class="text-justify" id="detail-intro">
        The following objective function will be optimized
        $$f(\Omega;X,\lambda, \gamma) = L(X, \Omega) + u_{L} . p_{\lambda,\gamma}(\Omega),$$
        where $L(X, \Omega)$ denotes the objective function of the existing method without its penalty terms, $u_L = 1$
        if $L$ is convex and $u_L = -1$ if $L$ is concave for $\Omega$. The choice of $L$ is flexible. For instance,
        $L(X, \Omega)$ can be the log-likelihood function of $\Omega$ as in the graphical lasso or the squared loss function
        as in the <code>NS</code> and the <code>SPACE</code>.

        To obtain the maximizer of $f(\Omega; X, \lambda, \gamma)$, <code>GLASSO-SF</code> employs iteratively reweighted $ℓ_1$
        regularization procedure based on the minorization-maximization (MM) algorithm, which solve the following problem:
        $$\Omega^{(k+1)} = \underset{\Omega}{arg max}L(X, \Omega) - \sum_{i=1}^p\sum_{j \ne i}\eta^{(k)}_{ij}|\omega_{ij}|-\gamma\sum_{i=1}^p|\omega_{ii}|,$$
        where $\Omega^{(k)} = (\omega^{(k)}_{ij})$ is the estimate at the $k$th iteration,
        ${∥\omega^{(k)}_{-i}∥}_1 = \sum_{l \ne i}|\omega^{(k)}_{il}|,$ and
        $\eta^{(k)}_{ij} = \lambda(1/({∥\omega^{(k)}_{i}∥}_1 + \epsilon_i) + 1/({∥\omega^{(k)}_{-j}∥}_1 + \epsilon_j))$.
    </p>
    <?php include "methods-button.php";?>
    <p class="text-justify">
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\lambda$ value $(\lambda > 0)$ to control the sparsity of network. <b>The larger the $\lambda$, the more
                sparse the constructed network</b>. If you don't know how to choose a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php" ?>
