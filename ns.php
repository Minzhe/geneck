<?php
session_start();
$_SESSION['page_name']="ns.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>Neighborhood Selection</h2>
    </header>
    <p class="text-justify">
        Neighborhood selection (<code>NS</code>) separately solves the lasso problem and identifies edges with
        nonzero estimated regression coefficients for each node with tuning parameter $λ_i(\alpha)$.
        The <code>NS</code> method is asymptotically consistent in identifying the neighborhood of each node when the neighborhood
        stability condition is satisfied.
    </p>
    <p class="text-justify" id="detail-intro">
        To be specific, for each node $i \in V = \{1,2,...,p\}$, <code>NS</code> solves the following lasso problem
        $$\hat{\beta}^{i,\lambda} = \underset{\beta \in \mathbb{R}^p: \beta_i = 0}{argmin} \frac{1}{2}\left \|X_i - X\beta\right \|^2_2 + \lambda\left \|\beta\right \|_1,$$
        where
        $\left \| x \right \|_{2}^{2} = \sum_{i=1}^{p}x_{i}^{2}$ and
        $\left \| x \right \|_{1} = \sum_{i=1}^{p}\left | x_{i} \right |$ for $x \in \mathbb{R}^p$.
        With the estimate
        $\hat{\beta}^{i,\lambda}$,
        <code>NS</code> identifies the neighborhood of the node $i$ as
        $N_i(\lambda) = \{ k | \hat{\beta}_{k}^{i,\lambda} \neq 0 \}$,
        which defines an edge set
        $E_{i}^{\lambda} = \left \{ \left ( i, j\right ) | j \in N_{i}\left ( \lambda\right )\right \}$.
        <!--Since <code>NS</code> separately solves $p$ lasso problems, contradictory edges may occur when we define the total edge set
        $E^\lambda = \cup^p_{i=1} E^\lambda_i$, i.e.,
        $\hat{\beta}^{i,\lambda}_k \ne 0$.
        To avoid these contradictory edges, NS suggests two types of edge sets
        $E^{\lambda, \land}$ and $E^{\lambda, \lor}$
        defined as follows:
        $$E^{\lambda, \land} = \{ \left( i, j \right) | i \in N_{j} \left( \lambda \right) \quad and \quad j \in N_{i} \left( \lambda \right) \}$$
        $$E^{\lambda, \lor} = \{ \left( i, j \right) | i \in N_{j} \left( \lambda \right) \quad or \quad j \in N_{i} \left( \lambda \right) \}$$-->
        <!--Meinshausen and Bühlmann mentioned these two edge sets have only small differences in their experience and the
        differences vanish asymptotically. -->
        Choice of the tuning parameter $λ_i(\alpha)$ for the $i$th node is given by
        $$\lambda(\alpha) = \left \| X_{i} \right \|_{2}\tilde{\Phi}^{-1}(\frac{\alpha}{2p^{2}})$$
        where $\tilde{\phi} = 1 - \phi$ and $\phi$ is the distribution function of the standard normal distribution.
        With this choice of $\lambda_i(\alpha)$ for $i=1,2,...,p$, the probability of falsely identifying edges in the
        network is bounded by the level $\alpha$. We implement <code>NS</code> with R package <code>CDLasso</code> provided
        by the authors.
        <!--Note that we estimate the edge set with $E^{\lambda, \land}$ and solve the lasso problems using the R package CDLasso.-->
    </p>
    <?php include "methods-button.php";?>
    <p>
        <br/><strong>Note:</strong><br/>
        <i>
            Change the $\alpha$ level to control the false positive rate $(\alpha > 0)$.
            <b>A larger $\alpha$ will give you more estimated edges, but with lower confidence</b>. If you don't know how to choose
            a value, use the default one.
        </i>
    </p>
</section>
<?php include "methods-form.php"?>

