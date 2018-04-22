###                       ns.R                       ###
### ================================================ ###
# This R script is function to use neighborhood selection to constrcut gene network.

setwd(paste(Sys.getenv("remoter_path"), "geneck/", sep = ""))
suppressMessages(library(CDLasso))

network.ns <- function(expr.data, alpha) {
    if (alpha <= 0) {
        stop('Input error: parameter alpha for ns should be larger than 1.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    est_res <- matrix(0, p, p)
    for (k in 1:p) {
        rsp <- expr.mat[, k]
        prd <- t(expr.mat[, -k])
        lam <- sqrt(sum(rsp ^ 2)) * qnorm(alpha / (2 * p ^ 2), lower.tail = F)
        out <- l2.reg(prd, rsp, lambda = lam)
        est_res[k, -k] <- out$estimate
    }
    
    est_edge <- which(abs(est_res) > 0 & abs(t(est_res)) > 0, arr.ind = TRUE)
    est_edge <- est_edge[est_edge[, 1] < est_edge[, 2], ]
    if (length(est_edge) == 2) est_edge <- matrix(est_edge, 1, 2)
    
    est_edge <- as.data.frame(est_edge)
    colnames(est_edge) <- c("node1", "node2")
    est_edge[,1] <- gene.index[est_edge[,1]]
    est_edge[,2] <- gene.index[est_edge[,2]]
    
    return(est_edge)
}

  