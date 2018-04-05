<?php
session_start();
$_SESSION['page_name'] = "GeneNet.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>GeneNet</h2>
    </header>
    <p class="text-justify">
        <code>GeneNet</code> is a linear shrinkage estimator for a covariance matrix followed by a Gaussian graphical
        model (GGM) selection based on the partial correlation obtained from the shrinkage estimator. With a multiple
        testing procedure using the local false discovery rate, the GGM selection controls the false discovery rate
        under a pre-determined level $\alpha$.
    </p>
    <p class="text-justify" id="detail-intro">
        One of the most commonly used linear shrinkage estimators \(S^{*}\) for the covariance matrix \(\Sigma\) is
        $$S^{*} = \lambda^{*}T + (1 - \lambda^{*})S$$
        where
        \( S = (s_{ij})_{1 \leq i,j \leq p}\)
        is the sample covariance matrix,
        \( T = diag(s_{11}, s_{22}, ..., s_{pp}) \)
        is the shrinkage target matrix, and
        $\lambda^{*}=\sum_{i\neq j}\hat{Var}(s_{ij})/(\sum_{i\neq j}s_{ij}^{2})$
        is the optimal shrinkage intensity. With this estimator \(S^{*}\), the matrix of the partial correlations
        $P = (\hat{\rho}^{ij})_{1\leq i, j\leq p}$
        is defined as
        $\hat{\rho}^{ij} = -\hat{\omega}_{ij}/ \sqrt{\hat{\omega}_{ii}\hat{\omega}_{jj}}$,
        where
        $\hat{\Omega} = (\hat{\omega}_{ij})_{1\leq i, j\leq p} = (S^{*})^{-1}$.
        To identify the significant edges, the distribution of the partial correlations is supposed to be as the mixture
        $$f(\rho) = \eta_{0}f_{0}(\rho, \nu) + (1-\eta_{0})f_{1}(\rho)$$
        where $f_0$ is the null distribution, $f_1$ is the alternative distribution corresponding to the true edges,
        and $η_0$ is the unknown mixing parameter. <code>GeneNet</code> identifies significant edges that have the
        local false positive rate
        $$fdr(\rho) = \frac{\eta_{0}f_{0}(\rho, \hat{\nu})}{\hat{f}(\rho)}$$
        smaller than the pre-determined level $\alpha$, where
        $f_0(\rho, \upsilon) = |\rho|Be(\rho^2; 0.5, (\upsilon - 1)/2)$, $Be(x;a,b)$
        is the density of the Beta distribution and $\upsilon$ is the reciprocal variance of the null $\rho$.
    </p>
    <?php include "methods-button.php";?>
    <p>
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\alpha$ level (false positive rate) to control the sparsity of network $(0 < \alpha < 1)$.
            <b>A larger $\alpha$ will give you more estimated edges, but with lower confidence</b>. If you don't know how to choose
            a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php" ?>