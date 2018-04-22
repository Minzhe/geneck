###                       eglasso.R                          ###
### ======================================================== ###
# This R script is function to use eglasso to constrcut gene network.

setwd(paste(Sys.getenv("remoter_path"), "geneck/", sep = ""))
suppressMessages(library(glasso))

network.eglasso <- function(expr.data, hub.index, alpha, lambda) {
    if (alpha <= 0 | lambda <= 0) {
        stop('Input error: parameter alpha & lambda for eglasso should be larger than 0.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    S <- t(expr.mat) %*% expr.mat / n
    lam_mat <- matrix(lambda, p, p)
    lam_mat[hub.index, ] <- alpha * lambda
    lam_mat[, hub.index] <- alpha * lambda
    out <- glasso(S, rho = lam_mat)
    
    est_edge <- which(abs(out$wi) > 0, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}

