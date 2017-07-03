

# CMI2NI (converted from the MATLAB code by Xiujun Zhang)

# ---------------------------PAC-CMI------------------------------
# This is matlab code for netwrk inference method CMI2NI.
# Input:
# 'data' is expression of variable,in which row is varible and column is the sample;
# 'lamda' is the parameter decide the dependence;
# 'order0' is the parameter to end the program when order=order0;
# If nargin==2,the algorithm will be terminated untill there is no change
# in network toplogy.
# Output:
# 'G' is the 0-1 network or graph after pc algorithm;
# 'Gval' is the network with strenthness of dependence;
# 'order' is the order of the pc algorithm, here is equal to order0;
# Example:
#
# Author: Xiujun Zhang.
# Version: Sept.2014.
#

# cas function
# x and y are 1*m dimensional vector; z is n1*m dimensional.
cas <- function(x, y, z) {
      # x=rand(10,1)';y=rand(10,1)';z=rand(10,2)';
      if (is.null(dim(z))) {
            n1 = 1
      } else {
            n1 = nrow(z)
      }
      n = n1 + 2
      
      
      Cov = as.matrix(var(x))
      
      Covm = cov(t(rbind(x, y, z)))
      
      Covm1 = cov(t(rbind(x, z)))
      
      
      InvCov = solve(Cov)
      
      InvCovm = solve(Covm)
      
      InvCovm1 = solve(Covm1)
      
      
      C11 = InvCovm1[1, 1]
      
      C12 = 0
      
      C13 = InvCovm1[1, 2:(1 + n1)]
      
      C23 = InvCovm[2, 3:(2 + n1)] - InvCovm[1, 2] * (1 / (InvCovm[1, 1] - InvCovm1[1, 1] +
                                                                 InvCov[1, 1])) *
            (InvCovm[1, 3:(2 + n1)] - InvCovm1[1, 2:(1 + n1)])
      
      C22 = InvCovm[2, 2] - InvCovm[1, 2] ^ 2 * (1 / (InvCovm[1, 1] - InvCovm1[1, 1] +
                                                            InvCov[1, 1]))
      
      C33 = InvCovm[3:(2 + n1), 3:(2 + n1)] - (1 / (InvCovm[1, 1] - InvCovm1[1, 1] +
                                                          InvCov[1, 1])) *
            ((InvCovm[1, 3:(2 + n1)] - InvCovm1[1, 2:(1 + n1)]) %o% (InvCovm[1, 3:(2 +
                                                                                         n1)] - InvCovm1[1, 2:(1 + n1)]))
      
      InvC = rbind(c(C11, C12, C13), c(C12, C22, C23), cbind(C13, C23, C33))
      
      #%C = inv(InvC);
      
      C0 = Cov[1, 1] * (InvCovm[1, 1] - InvCovm1[1, 1] + InvCov[1, 1])
      
      CS = 0.5 * (sum(diag(InvC %*% Covm)) + log(C0) - n)
      
      
      return(CS)
}

# Conditional mutul inclusive information (CMI2)
MI2 <- function(x, y, z) {
      r_dmi = (cas(x, y, z) + cas(y, x, z)) / 2
      
      return(r_dmi)
}


########

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
            c4 = det(cov(t(rbind(v1, v2, vcs))))
            
            cmiv = 0.5 * log((c1 * c2) / (c3 * c4))
            
      }
      
      #if(nargin==2)
      #cat('\n values: ',c1,c2,c3,cmiv,sep=' ')
      #if(nargin==3)
      #cat('\n values: ',c1,c2,c3,c4,cmiv,sep=' ')
      
      if (cmiv == Inf) {
            cmiv = 1e10
            
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
                              cmiv = cmi(dat[i, ], dat[j, ])
                              
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
                                    
                                    v1 = dat[i, ]
                                    
                                    v2 = dat[j, ]
                                    
                                    if (combntnsrow == 1) {
                                          vcs = dat[combntnslist, ]
                                          #cat('\n ',adj,'adj',combntnsrow,k,i,j,' list ', combntnslist,' dim ', nrow(vcs), ncol(vcs),sep=' ')
                                          cmiv = MI2(v1, v2, vcs)
                                    } else {
                                          for (k in 1:combntnsrow) {
                                                vcs = dat[combntnslist[k, ], ]
                                                
                                                #cat('\n ',adj,'adj',combntnsrow,k,i,j,' list ', combntnslist[k,],' dim ', nrow(vcs), ncol(vcs),sep=' ')
                                                a = MI2(v1, v2, vcs)
                                                
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

cmi2ni <- function(dat, lambda, order0 = 0, nargin = 2) {
      #function [G,Gval,order]=pca_cmi(data,lamda,order0)
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
      return(list(
            G = G,
            Gval = Gval,
            order = order
      ))
}
