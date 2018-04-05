###                       pcacmi.R                         ###
### ====================================================== ###
# This R script is function to use pcacmi to constrcut gene network.

source("lib/PCA_CMI.R")

network.pcacmi <- function(expr.data, lambda) {
    if (lambda <= 0) {
        stop('Input error: parameter alpha for pcacmi should be larger than 0.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    out <- pca_cmi(t(expr.mat), lambda)
    est_edge <- which(out$G == 1, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}

