###                       glassosf.R                       ###
### ====================================================== ###
# This R script is function to use glassosf to constrcut gene network.

suppressMessages(library(glasso))
source('lib/glasso_SF.R')

network.glassosf <- function(expr.data, alpha) {
    if (alpha <= 0) {
        stop('Input error: parameter alpha for glassosf should be larger than 0.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    out <- glasso_sf(expr.mat, alpha)
    est_edge <- which(abs(out$wi) > 0, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}

