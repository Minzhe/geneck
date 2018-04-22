<?php
session_start();
$_SESSION['page_name'] = "space.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>SPACE</h2>
        <span class="byline">Extended Sparse PArtial Correlation Estimation method</span>
    </header>
    <p class="text-justify">
        Spare partial correlation estimation (<code>SPACE</code>) is a joint sparse regression problem, which resolves
        a symmetrically constrained and $ℓ_1$-regularizated regression problem under high-dimensional settings.
    </p>
    <div class="text-justify" id="detail-intro">
        <p>
            In the Gaussian graphical models, the conditional dependencies among p variables can be represented by a
            graph $G = (V,E)$, where $V={1,2,...,p}$ is a set of nodes representing $p$ variables and
            $E = \{(i,j) | \omega_{ij} \ne 0, 1 \leq i \ne j \leq p\}$ is a set of edges corresponding to the nonzero
            off-diagonal elements of $\Omega$.
        </p>
        <p>
            <code>SPACE</code> considers linear models such that for $i=1,2,...,p$,
            $$X_{i} = \sum_{j\neq i}\beta_{ij}X_{j} + \epsilon_{i}$$
            where $\epsilon_{i}$ is an n-dimensional random vector from the multivariate normal distribution
            with mean $0$ and covariance matrix $1 / \omega_{ii}I_n$ is an identity matrix with size of $n×n$.
            Under normality, the regression coefficients $\beta_{ij}$ can be replaced with the partial correlations
            $\rho^{ij}$ by the relationship
            $$\beta_{ij} = - \frac{\omega_{ij}}{\omega_{ij}} = p^{ij}\sqrt{\frac{\omega_{jj}}{\omega_{ii}}}$$
            where
            $p^{ij} = corr (X_{i}, X_{j} | X_{k}, k \neq i, j) = -\omega_{ij} /\sqrt{\omega_{ii}\omega_{jj}}$
            is a partial correlation between $X_i$ and $X_j$. <code>SPACE</code> method solves the
            following $ℓ_1$-regularized problem:
            $$\underset{p}{min}\frac{1}{2}\sum_{i=1}^{p}\left \{ w_{i}\sum_{k=1}^{n} (X_{i}^{k} - \sum_{j\neq i}p^{ij}\sqrt{\frac{\omega_{ij}}{\omega_{ii}}}X_{j}^{k})^{2} \right \} + \lambda \sum_{1\leq i\le j \leq p}|p^{ij}|$$
            where $w_i$ is a nonnegative weight for the $i$-th squared error loss.
        </p>
    </div>
    <?php include "methods-button.php";?>
    <p class="text-justify">
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\alpha$ value $(\alpha > 0)$ to control the sparsity of network. <b>Larger the $\alpha$ is, more
                sparse is the constructed network</b>. If you don't know how to choose a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php"; ?>