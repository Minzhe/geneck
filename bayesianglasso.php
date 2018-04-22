<?php
session_start();
$_SESSION['page_name']="bayesianglasso.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>BayesianGLASSO</h2>
        <span class="byline">Bayesian Graphical Lasso</span>
    </header>
    <p class="text-justify">
        Bayesian Graphical Lasso (<code>BayesianGLASSO</code>) is a Bayesian treatment of <code>GLASSO</code> that use a
        double exponential prior and employs a block Gibbs sampler for exploring the posterior distribution.
    </p>
    <div class="text-justify" id="detail-intro">
        The original <code>GLASSO</code> is still maintained. An efficient block Gibbs sampler is developed:<br/>
        <div style="padding-left: 32px">
            <p>
                1. For $i = 1, ..., p$
            </p>
            <p style="padding-left: 32px">
                (a) Partition $\Omega, \hat{\Sigma}, T$ as following:
                $$\Omega = \binom{\Omega_{11}\quad \omega_{12}}{\omega_{12}^{'}\quad \omega_{22}}, \quad S = \binom{S_{11}\quad s_{12}}{s_{12}^{'}\quad s_{22}}, \quad T = \binom{T_{11}\quad \tau_{12}}{\tau_{12}^{'}\quad \tau_{22}}.$$
                (b) Sample $\gamma \sim Ga(n/2+1, (\hat{\sigma}_{22}+\lambda)/2$ and
                $\beta \sim N(-C\hat{\sigma}_{21}, C)$, where
                $C = \{(\hat{\sigma}_{22} + \lambda)\Omega^{-1}_{11} + D^{-1}_{\tau}\}$, $D_{\tau} = diag(\tau_{12})$.<br/>
                (c) Update $\omega_{21} = \beta$, $\omega_{12} = \beta^T$, $\omega_{22} = \gamma + \beta^T\Omega^{-1}_{11}\beta$.
            </p>
            <p>
                2. Sample $\mu_{ij} \sim Inv-Gau(\mu^{'}, \lambda^{'})$,
                where $\mu^{'} = \sqrt{(\lambda^2/\omega^2_{ij})}, \lambda^{'} = \lambda^2$.
                Update $\tau = 1/\mu_{ij}$.<br/>
                3. Sample $\lambda \sim Ga(r + p(p+1)/2, s + ∥\omega∥_1/2)$.<br/>
            </p>
        </div>
        <p>
            In this form of the Bayesian graphical lasso, a single shrinkage parameter $\lambda$ is employed. The
            Bayesian adaptive graphical lasso, on the other hand, allows for different shrinkage parameters $\lambda_{ij}$
            for different entries of the precision matrix $\Omega$. The model (data likelihood, prior, and hyperprior) is
            $$p(y_i|\Omega) = n(y_i|0, \Omega^{-1})$$
            $$p(\Omega|\lambda) \propto \prod_{i \le j}{[\frac{\lambda_{ij}}{2}exp\{-\lambda_{ij}|\omega_{ij}|\}]}\prod^{p}_{i=1}[\frac{\lambda_{ii}}{2}exp\{-\frac{\lambda_{ii}}{2}\omega_{ii}\}]1_{\Omega \in M^+}$$
            $$p(\{\lambda_{ij}\}_{i \le j}|\{\lambda_{ii}\}^{p}_{i=1}) \propto \prod_{i \le j}{\frac{s^r}{\Gamma(r)}\lambda^{r-1}_{ij}exp\{-\lambda_{ij}s_i\}}.$$
            This allow the level of shrinkage to be automatically chosen based on the current value of $\omega_{ij}$.
        </p>
    </div>
    <?php include "methods-button.php";?>
    <p>
        <strong>Note:</strong><br/>
        <i>
            1. <code>BayesianGLASSO</code> is time consuming. We require the input expression data to have <b>no more than 50 genes (columns)</b>
            and <b>no more than 100 observations (rows)</b>. (Otherwise, you won't be able to submit the job!)<br/>
            2. Change the $\alpha$ level to control the sparsity of the network $(0 < \alpha < 1)$.
            A small $\alpha$ will give you more estimated edges, but with lower confidence. If you don't know how to choose
            a value, use the default one.
        </i>

    </p>
</section>
<?php include "methods-form.php"?>
