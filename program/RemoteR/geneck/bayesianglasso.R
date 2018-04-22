###                       bayesianglasso.R                       ###
### ============================================================ ###
# This R script is function to use bayesianglasso to constrcut gene network.

setwd(paste(Sys.getenv("remoter_path"), "geneck/", sep = ""))
source("lib/BayesianGLasso.R")

network.bayesianglasso <- function(expr.data, prob) {
    if (prob <= 0 | prob >= 1) {
        stop('Input error: probability for BayesianGLasso should bewteen 0 and 1.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    a <- 10^(-2); b <- 10^(-6); iter <- 2000; burn <- 1000
    out <- blockGLasso_s(expr.mat, iterations = iter, burnIn = burn, lambdaPriora = a, lambdaPriorb = b, verbose = FALSE)
    est_edge <- which(abs(out) > prob, T)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}
