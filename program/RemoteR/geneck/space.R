###                       space.R                          ###
### ====================================================== ###
# This R script is function to use space to constrcut gene network.

setwd(paste(Sys.getenv("remoter_path"), "geneck/", sep = ""))
suppressMessages(library(space))

network.space <- function(expr.data, alpha) {
    if (alpha <= 0) {
        stop('Input error: parameter alpha for space should be larger than 0.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    out <- space.joint(expr.mat, lam1 = alpha * n, iter = 5)
    est_edge <- which(abs(out$ParCor) > 0, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
    
    bic_val = sum(log(n / out$sig.fit)) + log(n) / n * nrow(est_edge) * 2
}
