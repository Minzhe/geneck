
# library - corpcor, glasso, CDLasso, space

library(corpcor)
library(GeneNet)

# pcor.shrink
# network.test.edges

expr_data <- read.table(file = "Example_data_n115_p231.txt", header = T)
#rownames(expr_data) = paste0("n",1:nrow(expr_data))
#colnames(expr_data) = paste0("Gene",1:ncol(expr_data))
#write.table(expr_data,file="Example_data_n115_p231.txt",row.names=T,col.names=T,quote=F,sep='\t')
hub_indx = c(52,  74, 107, 185, 188, 189, 190, 199)
p = 231
n = 115


gene_indx <- 1:p
X <- as.matrix(expr_data)
X <- scale(X, center = T, scale = F)

n <- dim(X)[1]

tic = Sys.time()
pcor_est = pcor.shrink(X)
test_pcor = network.test.edges(pcor_est)
toc = Sys.time()
comp_time = as.numeric(toc - tic, units = 'secs')

est_res = test_pcor[test_pcor[, 6] >= 0.8, ]
est_edge = as.matrix(est_res[, c(2, 3)])
  
