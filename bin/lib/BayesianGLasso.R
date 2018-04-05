###                         BayesianGLasso.R                          ###
### ================================================================= ###
# This R script is function modified from blockGLasso function in BayesianGLasso package.

blockGLasso_s <- function(X, iterations = 2000, burnIn = 1000, lambdaPriora = 1, lambdaPriorb = 1 / 10, verbose = TRUE) {
      
      totIter <- iterations + burnIn
      S <- t(X) %*% X
      Sigma <- stats::cov(X)
      n <- nrow(X)
      Omega <- MASS::ginv(Sigma)
      p <- dim(Omega)[1]
      Rho <- matrix(0, nrow = p, ncol = p)
      indMat <- matrix(1:p ^ 2, ncol = p, nrow = p)
      perms <- matrix(NA, nrow = p - 1, ncol = p)
      permInt <- 1:p
      for (i in 1:ncol(perms)) {
            perms[, i] <- permInt[-i]
      }
      # SigmaMatList <- OmegaMatList <- list()
      # lambdas <- rep(NA, totIter)
      tau <- matrix(NA, nrow = p, ncol = p)
      lambdaPosta <- (lambdaPriora + (p * (p + 1) / 2))
      count <- 0
      
      for (iter in 1:totIter) {
            lambdaPostb <- (lambdaPriorb + sum(abs(c(Omega))) / 2)
            lambda <-
                  stats::rgamma(1, shape = lambdaPosta, scale = 1 / lambdaPostb)
            OmegaTemp <- Omega[lower.tri(Omega)]
            rinvgaussFun <- function(x) {
                  x <- ifelse(x < 1e-12, 1e-12, x)
                  return(statmod::rinvgauss(n = 1, mean = x, shape = lambda ^ 2))
            }
            tau[lower.tri(tau)] <- 1 / sapply(sqrt(lambda ^ 2 / (OmegaTemp ^ 2)), rinvgaussFun)
            tau[upper.tri(tau)] <- t(tau)[upper.tri(t(tau))]
            for (i in 1:p) {
                  tauI <- tau[perms[, i], i]
                  Sigma11 <- Sigma[perms[, i], perms[, i]]
                  Sigma12 <- Sigma[perms[, i], i]
                  S21 <- S[i, perms[, i]]
                  Omega11inv <- Sigma11 - Sigma12 %*% t(Sigma12) / Sigma[i,i]
                  Ci <- (S[i, i] + lambda) * Omega11inv + diag(1 / tauI)
                  CiChol <- chol(Ci)
                  mui <- solve(-Ci, S[perms[, i], i])
                  beta <- mui + solve(CiChol, stats::rnorm(p - 1))
                  Omega[perms[, i], i] <- beta
                  Omega[i, perms[, i]] <- beta
                  gamm <- stats::rgamma(n = 1, shape = n / 2 + 1, rate = (S[1,1] + lambda) / 2)
                  Omega[i, i] <- gamm + t(beta) %*% Omega11inv %*% beta
                  OmegaInvTemp <- Omega11inv %*% beta
                  Sigma[perms[, i], perms[, i]] <- Omega11inv + (OmegaInvTemp %*% t(OmegaInvTemp)) / gamm
                  Sigma[perms[, i], i] <- Sigma[i, perms[, i]] <- (-OmegaInvTemp / gamm)
                  Sigma[i, i] <- 1 / gamm
            }
            # if (iter%%100 == 0) {
            #   cat("Total iterations= ", iter, "Iterations since burn in= ",
            #       ifelse(iter - burnIn > 0, iter - burnIn, 0),
            #       "\n")
            # }
            # lambdas[iter] <- lambda
            # SigmaMatList[[iter]] <- Sigma
            # OmegaMatList[[iter]] <- Omega
            if (verbose) {
                  if (floor(iter / (iterations + burnIn) * 100) == count) {
                        print(paste0(count, "% has been done"))
                        count <- count + 10
                  }
            }
            
            if (iter > burnIn) {
                  for (j in 1:p) {
                        for (jj in 1:p) {
                              Rho[j, jj] <- Rho[j, jj] + (-Omega[j, jj] / sqrt(Omega[j, j] * Omega[jj, jj]))
                              
                        }
                  }
            }
      }
      Rho <- Rho / iterations
      
      # list(Sigmas = SigmaMatList, Omegas = OmegaMatList, lambdas = lambdas)
      return (Rho)
      
}
