<?php
session_start();
$_SESSION['page_name'] = "cmi2ni.php";

include "methods-js.php"
?>

<section>
    <header>
        <h2>CMI2NI</h2>
        <span class="byline">Conditional mutual inclusive information-based network inference</span>
    </header>
    <p class="text-justify">
        The conditional mutual inclusive information-based network inference (<code>CMI2NI</code>) method improves
        the <code>PCACMI</code> method by considering the Kullback-Leibler divergences from the joint
        probability density function (PDF) of target variables to the interventional PDFs removing the dependency
        between two variables of interest. Instead of using CMI, <code>CMI2NI</code> uses the conditional mutual inclusive
        information (CMI2) as the measure of dependency between two variables of interest given other variables.
    </p>
    <p class="text-justify" id="detail-intro">
        To be specific, consider three random variables $X$, $Y$ and $Z$. For these three random variables, the CMI2 between
        $X$ and $Y$ given $Z$ is defined as
        $$CMI2(X,Y|Z) = (D_{KL}(P||P_{X->Y}) + D_{KL}(P||P_{Y->X}))/2,$$
        where $D_{KL}(f||g)$ is the Kullback-Leibler divergence from $f$ to $g$, $P$ is the joint PDF of $X$, $Y$ and $Z$,
        and $P_{X \to Y}$ is the interventional probability of $X$, $Y$ and $Z$ for removing the connection from $X$ to $Y$.

        With Gaussian assumption on the observed data, the CMI2 for two random variables $X$ and $Y$
        given m-dimensional vector $Z$ can be expressed as
        $$CMI2(X,Y|Z) = \frac{1}{4}(tr(C^{-1}\Sigma) + tr(\tilde{C}^{-1}\tilde{\Sigma}) + logC_{0} +log\tilde{C}_{0}-2n),$$
        where $\Sigma$ is the covariance matrix of $( X, Y, Z^T )^T$, $\tilde{\Sigma}$
        is the covariance matrix of $( X, Y, Z^T )^T$, Σ XZ is the covariance matrix of $\Sigma_{X,Z}$,
        $( X, Z^T )^T$ is the covariance matrix of $( Y, Z^T )^T, n=m+2$, and $C$, $\tilde{C}$, $C_0$ and $\tilde{C_0}$
        are defined with the elements of $\Sigma, \Sigma_{XZ}, \Sigma_{YZ}, \Sigma^{-1}, \Sigma^{-1}_{XZ}, \Sigma^{-1}_{YZ}$.
        As applied in <code>PCACMI</code>, <code>CMI2NI</code> adopts the path consistency algorithm (PCA) to efficiently calculate the CMI2 estimates.
        All steps of the PCA in <code>CMI2NI</code> are the same as one of <code>PCACMI</code> if we change the CMI to the CMI2. In the PCA steps of
        <code>CMI2NI</code>, two variables are regarded as independent if the corresponding CMI2 estimate is less than a given threshold $\alpha$.
    </p>
    <?php include "methods-button.php";?>
    <p class="text-justify">
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\alpha$ value $(\alpha > 0)$ to control the sparsity of network. <b>The larger the $\alpha$, the more
                sparse the constructed network</b>. If you don't know how to choose a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php" ?>
