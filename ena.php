<?php
session_start();
$_SESSION['page_name']="ena.php";

include "methods-js.php";
?>

<section>
	<header>
		<h2>ENA</h2>
        <span class="byline">Ensemble-Based Network Aggregation</span>
    </header>
    <div>
        <p class="text-justify">
            <code>ENA</code> is an ensemble-based network aggregation approach to combine networks reconstructed from different methods.
            The current <code>ENA</code> algorithm integrates <code>NS</code>, <code>GLASSO</code>, <code>GLASSO-SF</code>,
            <code>PCACMI</code>, <code>SPACE</code> and <code>BayesianGLASSO</code>.
        </p>
        <p class="text-justify" id="detail-intro">
            Suppose $G^k (k = 1,...,M)$ is a set of networks constructed by $M$ different methods. The rank $r^k_{ij}$ of
            connection strength for edge between gene $i$ and gene $j$ is calculated on each individual network in $G^k$.
            This operation is performed on all edges in $G^k$ to get the rank of all edges $r^k_{ij} (i, j \in N \ and \ i < j)$
            in $M$ different methods. Then the predicted rank $\tilde{r}_{ij}$ of a particular edge between gene $i$ and $j$
            in the aggregated network is calculated by taking the harmonic mean of the inverse of the ranks of the same
            edge across all network in $G^k$, according to
            $$\tilde{r}_{ij} = M \ / \sum^M_{i=1}{1 \ / \ r^k_{ij}}$$

            To derive the confidence level of an edge to be a true positive connection, the original dataset is permutated
            to obtain a resampled dataset $MD^{p_i}$. Then <code>ENA</code> algorithm is applied to get the estimated graph
            $G^{p_i}$ on this dataset. This procedure is repeated for $m$ times and null distribution $G^{null}$ is generated
            by aggregating all estimated edge strength in $m$ permutations. Then the confidence level $\tilde{p}_{ij}$ is
            derived by calculating the quantile of $\tilde{r}_{ij}$ in $G^{null}$.
            $$\tilde{p}_{ij} = \frac{\# \ of \ \tilde{r}_{ij} < permutated \ r \ value \ in \ G^{null}}{total \ \# \ of \ permutated \ r \ value \ in \ G^{null}}$$
        </p>
        <?php include "methods-button.php"?>
        <p>
            <strong>Note:</strong><br/>
            <i>
                1. Hub gene input is currently not supported.<br/>
                2. <code>BayesianGLASSO</code> is time consuming. The user can select whether to include <code>BayesianGLASSO</code>
                or not (the result won't change too much). <br/>
                3. If <code>BayesianGLASSO</code> is selected, we require the input expression data to have <b>no more than 50 genes (columns)</b>
                and <b>no more than 100 observations (rows)</b>. (Otherwise, you won't be able to submit the job!)
            </i>
        </p>
    </div>
</section>
<?php include "methods-form.php"?>
