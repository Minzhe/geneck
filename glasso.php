<?php
session_start();
$_SESSION['page_name'] = "glasso.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>GLASSO</h2>
        <span class="byline">Graphical Lasso</span>
    </header>
    <p class="text-justify">
        The graphical lasso (<code>GLASSO</code>) method estimates a sparse inverse covariance matrix $\Omega$ by maximizing
        the $ℓ_1$ penalized log-likelihood
        $$l(\Omega) = log \left | \Omega \right | - tr(S\Omega) - \lambda \left \| \Omega \right \|_{1}$$
        where $S$ is the sample covariance matrix, $tr(A)$ is the trace of $A$ and $∥A∥_1$ is the $ℓ_1$ norm of $A$ for
        $A \in \mathbb{R}^{p\times p}$.
    </p>
    <p class="text-justify" id="detail-intro">
        To be specific, let $W$ be the estimate of the  covariance matrix $\Sigma$ and consider partitioning $W$ and $S$
        $$W = \binom{W_{11}\quad w_{12}}{w_{12}^{T}\quad w_{22}}, \quad S = \binom{S_{11}\quad s_{12}}{s_{12}^{T}\quad s_{22}},\quad \Omega = \binom{\Omega_{11}\quad \omega_{12}}{\omega_{12}^{T}\quad \omega_{22}} \quad (1)$$
        The solution $\hat{\Omega}$ of $(1)$ is equivalent to the inverse of $W$ whose partitioned entity $w_{12}$
        satisfies $w_{12}$ = $W_{11} \beta^{*}$ , where $\beta^{*}$ is the solution  of the lasso problem
        $$\underset{\beta}{min} \frac{1}{2} \left\| W_{11}^{1/2}\beta - W_{11}^{-1/2}s_{12}\right\| _{2}^{2} + \lambda \left\| \beta \right\|_{1}.$$

        Based on the above property, the graphical lasso sets the diagonal elements $w_{ii} = s_{ii} + \rho$ and obtains
        the off-diagonal elements of $W$ by repeatedly applying the following two steps:<br/>

        &nbsp&nbsp&nbsp&nbsp 1. Permuting the columns and rows to locate the target elements at the position of $w_{12}$.<br/>
        &nbsp&nbsp&nbsp&nbsp 2. Finding the solution $w_{12} = W_{11}\beta^*$ by solving the lasso problem.

        until convergence occurs. After finding $W$, the estimate $\hat{\Omega}$ is obtained from the relationship
        $\omega_{12} = -\hat{\beta}\hat{\omega}_{22}$ and $\hat{\omega}_{22} = 1/(\omega_{22} - \omega^T_{22}\hat{\beta})$,
        where $\hat{\beta} = W^{-1}_{11}w_{12}$.
    </p>
    <?php include "methods-button.php";?>
    <p class="text-justify">
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\lambda$ value $(\lambda > 0)$ to control the sparsity of the network. <b>The larger the $\lambda$ is, the more
                sparse the constructed network</b>. If you don't know how to choose a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php" ?>
