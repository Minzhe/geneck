###                       espace.R                          ###
### ======================================================== ###
# This R script is function to use espace to constrcut gene network.

suppressMessages(library(espace))

nrm <- function(x) return(sum(x ^ 2))

network.espace <- function(expr.data, hub.index, alpha, lambda) {
    if (alpha <= 0 | lambda <= 0) {
        stop('Input error: parameter alpha & lambda for eglasso should be larger than 0.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    niter_in = 5000
    niter_out = 5
    tol = 1e-6
    
    out <- espace(expr.mat, hub.index, alpha = alpha, lambda = lambda * n, maxit_in = niter_in, maxit_out = niter_out, tol = tol)
    est_edge <- which(abs(out$rho) > 0, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
    
    gic_val <- sum(log(apply(out$residual, 2, nrm))) + log(log(n)) * log(p) / n * nrow(est_edge) * 2
}

