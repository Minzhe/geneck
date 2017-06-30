###                    master.R                     ###
### =============================================== ###
# This R script is a pipline to construct gene network

suppressMessages(library(argparse))

#############  1. Parse comandline argument  #################
parser <- ArgumentParser(description = "This pipline is to construct gene network using gene co-expression data and specified hub gene information.")
parser$add_argument("jobID", type = "character", help = "jobID which will be used to find .")
parser$add_argument("method", type = "integer", help = "method to use to construct the gene network, should be integer [1,9].")
parser$add_argument("param", type = "double", help = "parameter for method")
parser$add_argument("-b", "--hub", type = "character", help = "list of hub genes separated by comma, [gene1,gene2,...], only necessary when method is 8 or 9.")
parser$add_argument("-p", "--param_2", type = "double", help = "additional parameter if the method is 8 or 9.")

args <- parser$parse_args()
jobID <- args$jobID
method <- args$method
param <- args$param
hub <- args$hub
param_2 <- args$param_2

### concat input expression data
expr.file <- paste("../data/expr.", jobID, ".csv", sep = "")

### concat output edge data
est_edge.csv <- paste("../data/est_edge.", jobID, ".csv", sep = "")

### check methods
if (!(method %in% 1:9)) {
    stop('Parse method error, method should be in integer 1 to 9.')
}
print(c(jobID, method, param, hub, param_2, getwd()))

### read input data
expr.data <- read.csv(file = expr.file, header = TRUE)


#############  2. Parse methods & construct network #################
if (method == 1) {
    source("GeneNet.R")
    print(dim(expr.data))
    est_edge <- network.GeneNet(expr.data = expr.data, fdr = param)
    print(dim(est_edge))
}



#############  3. Write output  #################
write.csv(est_edge, file = est_edge.csv, row.names = FALSE)

