# glasso-SF by Liu and Ihler

glasso_sf <- function(X, alpha, niter = 5) {
    library(glasso)
    
    n = nrow(X)
    p = ncol(X)
    
    S = t(X) %*% X / n
    
    eps = 1
    bt = 2 * alpha / eps
    
    lam_mat = matrix(2 * alpha, p, p)
    for (iter in 1:niter) {
        out = glasso(S, rho = lam_mat)
        # diag(out$wi) = 0
        th_m = apply(abs(out$wi), 2, sum)
        th_m = th_m - abs(diag(out$wi))
        # Update weights of tuning parameter
        for (i in 1:(p - 1))
            for (j in (i + 1):p)
                lam_mat[i, j] <- lam_mat[j, i] <- alpha * (1 / (th_m[i] + eps) + 1 / (th_m[j] + eps))
        # diag(lam_mat) <- 2*alpha
    }
    
    return(out)
}
