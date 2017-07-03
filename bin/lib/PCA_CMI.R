

# PCA-CMI (converted from the MATLAB code by Xiujun Zhang)

# ---------------------------PAC-CMI------------------------------
#  This is a R code for PCA-CMI
#  inferring gene regulatory networks from gene expression data by path consitency algorithm
#  based on conditional mutual information.
#
# Input:
#   'dat' is expression of variable,in which row is varible and column is the sample;
#   'lamda' is the parameter decide the dependence;
#   'order0' is the parameter to end the program when order=order0;
#
# Output:
#   'G' is the 0-1 network or graph after pc algorith
#   'Gval' is the network with strenthness of dependence;
#   'order' is the order of the pc algorithm, here is equal to order0;
#
#  If nargin==2,the algorithm will be terminated untill there is no higher order networks.
#
#  Source download: http://csb.shu.edu.cn/grn
#  Version Data: July 2011.
#


# compute conditional mutual information of x and y
cmi <- function(v1, v2, nargin = 2, vcs = NULL) {
      if (nargin == 2) {
            c1 = var(v1)
            c2 = var(v2)
            c3 = det(cov(t(rbind(v1, v2))))
            cmiv = 0.5 * log(c1 * c2 / c3)
      } else if (nargin == 3) {
            c1 = det(cov(t(rbind(v1, vcs))))
            
            c2 = det(cov(t(rbind(v2, vcs))))
            
            if (is.null(dim(vcs))) {
                  c3 = var(vcs)
            } else {
                  c3 = det(cov(t(vcs)))
            }
            c4 = det(cov(t(rbind(
                  v1, v2, vcs
            ))))
            
            cmiv = 0.5 * log((c1 * c2) / (c3 * c4))
            
      }
      
      #if(nargin==2)
      #cat('\n values: ',c1,c2,c3,cmiv,sep=' ')
      #if(nargin==3)
      #cat('\n values: ',c1,c2,c3,c4,cmiv,sep=' ')
      
      if (cmiv == Inf) {
            cmiv = 0
      }
      return(cmiv)
}

# edgereduce is pca_cmi
#function [G,Gval,t]=edgereduce(G,Gval,order,data,t,lamda)
edgereduce <- function(G, Gval, order, dat, t, lambda, nargin = 2) {
      if (order == 0) {
            for (i in 1:(nrow(G) - 1)) {
                  for (j in (i + 1):nrow(G)) {
                        if (G[i, j] != 0) {
                              cmiv = cmi(dat[i,], dat[j,])
                              Gval[i, j] = cmiv
                              Gval[j, i] = cmiv
                              
                              if (cmiv < lambda) {
                                    G[i, j] = 0
                                    G[j, i] = 0
                              }
                        }
                  }
            }
            t = t + 1
            
      } else {
            for (i in 1:(nrow(G) - 1)) {
                  for (j in (i + 1):nrow(G)) {
                        if (G[i, j] != 0) {
                              adj = numeric()
                              
                              for (k in 1:nrow(G)) {
                                    if (G[i, k] != 0 && G[j, k] != 0) {
                                          adj = c(adj, k)
                                    }
                              }
                              if (length(adj) >= order) {
                                    if (length(adj) == 1) {
                                          combntnslist = adj
                                          combntnsrow = 1
                                    } else {
                                          combntnslist = t(combn(adj, order))
                                          combntnsrow = nrow(combntnslist)
                                    }
                                    cmiv = 0
                                    v1 = dat[i,]
                                    v2 = dat[j,]
                                    
                                    if (combntnsrow == 1) {
                                          vcs = dat[combntnslist,]
                                          cmiv = cmi(v1, v2, 3, vcs)
                                    } else {
                                          for (k in 1:combntnsrow) {
                                                vcs = dat[combntnslist[k,],]
                                                
                                                a = cmi(v1,
                                                        v2,
                                                        3,
                                                        vcs)
                                                
                                                cmiv = max(cmiv, a)
                                                
                                          }
                                    }
                                    Gval[i, j] = cmiv
                                    Gval[j, i] = cmiv
                                    
                                    if (cmiv < lambda) {
                                          G[i, j] = 0
                                          G[j, i] = 0
                                    }
                                    t = t + 1
                              }
                        }
                  }
            }
      }
      return(list(G = G, Gval = Gval, t = t))
}

pca_cmi <- function(dat, lambda, order0 = 0, nargin = 2) {
    # function [G,Gval,order]=pca_cmi(data,lamda,order0)
    library(Matrix)
    
    n_gene = nrow (dat)
    G = matrix(1, n_gene, n_gene)
    G = t(as.matrix(tril(G, -1)))
    
    G = G + t(G)
    Gval = G
    order = -1
    t = 0
    
    while (t == 0) {
        order = order + 1
        
        if (nargin == 3) {
            if (order > order0) {
                G = t(as.matrix(tril(G, -1)))
                
                Gval = t(as.matrix(tril(G, -1)))
                
                order = order - 1
                # The value of order is the last order of pc algorith
                return(list(
                    G = G,
                    Gval = Gval,
                    order = order
                ))
            }
        }
        
        res = edgereduce(G, Gval, order, dat, t, lambda)
        
        G = res$G
        Gval = res$Gval
        t = res$t
        
        if (t == 0) {
            cat('\n No edge is reduce! Algorithm  finished!')
            break
        } else {
            t = 0
        }
    }
    
    G = as.matrix(t(tril(G, -1)))
    
    Gval = as.matrix(t(tril(Gval, -1)))
    
    order = order - 1
    # The value of order is the last order of pc algorith
    return(list(G = G,
                Gval = Gval,
                order = order))
}
