###                       glasso.R                       ###
### ==================================================== ###
# This R script is function to use glasso to constrcut gene network.

suppressMessages(library(glasso))

network.glasso <- function(expr.data, lambda) {
    if (lambda <= 0) {
        stop('Input error: parameter alpha for ns should be larger than 1.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    S <- t(expr.mat) %*% expr.mat / n
    out <- glasso(S, rho = lambda)
    est_edge <- which(abs(out$wi) > 0, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}



