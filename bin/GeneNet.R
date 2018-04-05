###                    GeneNet.R                     ###
### ================================================ ###
# This R script is function to use GeneNet to constrcut gene network.

suppressMessages(library(corpcor))
suppressMessages(library(GeneNet))

network.GeneNet <- function(expr.data, fdr) {
    
    if (fdr <= 0 | fdr >= 1) {
        stop('Input error: false discovery rate for GeneNet should bewteen 0 and 1.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    pcor_est <- pcor.shrink(expr.mat)
    test_pcor <- network.test.edges(pcor_est)
    
    est_res <- test_pcor[test_pcor[, 6] >= (1-fdr), ]
    est_edge <- est_res[, c(2, 3)]
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    file.remove("Rplots.pdf")
    
    return(est_edge)
}

