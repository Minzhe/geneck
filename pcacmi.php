<?php
session_start();
$_SESSION['page_name'] = "pcacmi.php";

include "methods-js.php";
?>

<section>
    <header>
        <h2>PCACMI</h2>
        <span class="byline">Path consistency algorithm based on conditional mutual information</span>
    </header>
    <p class="text-justify">
        Mutual information (MI) is a widely used measure of dependency between variables in
        information theory.
        <!--MI even measures non-linear dependency between variables and can be considered as a
        generalization of the correlation. Several mutual information (MI) based methods have been developed such as
        <code>ARACNE</code>, <code>CLR</code>, and <code>minet</code>. However, similar to the correlation, MI only measures pairwise dependency
        between two variables. Thus, it usually identifies many undirected interactions between variables. -->
        <code>PCACMI</code> adapts adopt the path consistency algorithm (PCA) to identify dependent pairs of variables
        for reconstruction of the gene regulatory networks based on the conditional mutual information (CMI).
    </p>
    <p class="text-justify" id="detail-intro">
        To be specific, let $H(X)$ and $H(X,Y)$ be the entropy of a random variable $X$ and the joint
        entropy of random variables $X$ and $Y$, respectively. For two random variables $X$ and $Y$, $H(X)$ and $H(X,Y)$
        can be expressed as
        $$H(X) = E(-logf_{x}(X)), \quad H(X, Y) = E (-logf_{xy}(X, Y)),$$
        where $f_X(x)$ is the marginal probability density function (PDF) of $X$ and $f_XY(x, y)$ is the joint PDF of $X$
        and $Y$. With these notations, MI is defined as
        $$I(X, Y) = E(-log\frac{f_{XY}(X, Y)}{f_{X}(X)f_{Y}(Y)})\\\quad\quad\quad\quad = H(X) + H(Y) - H(X, Y).$$
        It is known that MI measures dependency between two variables that contain both directed dependency and
        indirected dependency through other variables. While MI can not distinguish directed and indirected dependency,
        CMI can measure directed dependency between two variables by conditioning on other variables. CMI for $X$ and $Y$
        given Z is defined as
        $$I(X,Y|Z) = H(X,Z) + H(Y,Z) - H(Z) - H(X,Y,Z).$$

        To estimate the entropies, Gaussian kernal density estimator is considered. MI and CMI are defined as
        $$\hat{I}(X,Y) = \frac{1}{2}log\frac{|C(X)||C(Y)|}{|C(X,Y)|},$$
        $$\hat{I}(X,Y|Z) = \frac{1}{2}log\frac{|C(X,Z)||C(Y,Z)|}{|C(Z)||C(X,Y,Z)|},$$
        where $|A|$ is the determinant of matrix $A$, $C(X)$, $C(Y)$ and $C(Z)$ are the variances of $X$, $Y$ and $Z$, respectively,
        and $C(X,Z)$, $C(Y,Z)$ and $C(X,Y,Z)$ are the covariance matrices of $(X,Z)$, $(Y,Z)$ and $(X,Y,Z)$, respectively.

        The <code>PCACMI</code> method
        sets $L = 0$ and calculates with $L$-order CMI, which is equivalent to MI if $L = 0$. Then <code>PCACMI</code>
        removes the pairs of variables such that the maximal CMI of two variables given $L+1$ adjacent variables is less
        than a given threshold $\alpha$, where $\alpha$ determines whether two variables are independent or not and adjacent
        variables denote variables connected to the two target variables in <code>PCACMI</code> at the previous step.
        <code>PCACMI</code> repeats the above steps until there is no higher order.
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
<?php include "methods-form.php"; ?>
