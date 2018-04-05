###                         ena.R                          ###
### ====================================================== ###
# This R script is function to use ena to constrcut gene network.

suppressMessages(library(corpcor))
suppressMessages(library(CDLasso))
suppressMessages(library(glasso))
source("lib/glasso_SF.R")
source("lib/PCA_CMI.R")
source("lib/CMI2NI.R")
suppressMessages(library(space))
source("lib/BayesianGLasso.R")

network.ena <- function(expr.data, n.perm, sig.quant, if.bayes) {
    if (sig.quant <= 0 | sig.quant >= 1) {
        stop('Input error: parameter sig.quant for ena should be between 0 and 1.')
    }
    p <- ncol(expr.data)
    n <- nrow(expr.data)
    gene.index <- colnames(expr.data)
    expr.mat <- scale(as.matrix(expr.data), center = TRUE, scale = FALSE)
    
    est_edge <- list()
    
    ### ns
    est_res.ns <- matrix(0, p, p)
    alpha <- 0.2
    for (k in 1:p) {
        rsp <- expr.mat[, k]
        prd <- t(expr.mat[, -k])
        lam <- sqrt(sum(rsp ^ 2)) * qnorm(alpha / (2 * p ^ 2), lower.tail = F)
        out <- l2.reg(prd, rsp, lambda = lam)
        est_res.ns[k, -k] <- out$estimate
    }
    est_edge[[1]] <- (abs(est_res.ns) + t(abs(est_res.ns))) / 2
    
    ### glasso
    S <- t(expr.mat) %*% expr.mat / n
    out <- glasso(S, rho = 0.6)
    est_edge[[2]] <- abs(out$wi)
    
    ### glasso-sf
    out <- glasso_sf(expr.mat, alpha = 0.3)
    est_edge[[3]] <- abs(out$wi)
    
    ### pcacmi
    out <- pca_cmi(t(expr.mat), 0.03)
    est_edge[[4]] <- abs(out$Gval)
    
    ### space
    out <- space.joint(expr.mat, lam1 = 1 * n, iter = 5)
    est_edge[[5]] <- abs(out$ParCor)
    
    ### BayesianGLasso
    if (if.bayes == 1) {
        a <- 10^(-2); b <- 10^(-6); iter <- 2000; burn <- 1000
        out <- blockGLasso_s(expr.mat, iterations = iter, burnIn = burn, lambdaPriora = a, lambdaPriorb = b, verbose = FALSE)
        est_edge[[6]] <- abs(out)
    } else if (if.bayes != 0) {
        stop('Input error: parameter if.bayes for ena should be 0 or 1.')
    }
    
    ### ena
    for (i in 1:length(est_edge)) {
        est_edge[[i]][lower.tri(est_edge[[i]], diag = TRUE)] <- 1
        est_edge[[i]][upper.tri(est_edge[[i]], diag = FALSE)] <- rank(-est_edge[[i]][upper.tri(est_edge[[i]], diag = FALSE)])
        est_edge[[i]] <- log10(1 / est_edge[[i]])
    }
    est_edge.ena <- Reduce("+", est_edge)
    
    ### permutate
    perm.v <- c()
    for (i in 1:n.perm) {
        est_edge.perm <- perm.edge(edge.list = est_edge)
        perm.v <- c(perm.v, est_edge.perm[upper.tri(est_edge.perm, diag = FALSE)])
    }
    sig.level <- quantile(perm.v, probs = sig.quant)
    
    ### true edge
    est_edge.sig <- which(est_edge.ena > sig.level & est_edge.ena < 0, TRUE)
    est_edge.sig <- as.data.frame(est_edge.sig)
    colnames(est_edge.sig) <- c("node1", "node2")
    est_edge.sig[,1] <- gene.index[est_edge.sig[,1]]
    est_edge.sig[,2] <- gene.index[est_edge.sig[,2]]
    
    return(est_edge.sig)
}


##############  function  ################
perm.edge <- function(edge.list) {
    for (i in 1:length(edge.list)) {
        edge.list[[i]][upper.tri(edge.list[[i]], diag = FALSE)] <- sample(edge.list[[i]][upper.tri(edge.list[[i]], diag = FALSE)])
    }
    edge.sum <- Reduce("+", edge.list)
    return(edge.sum)
}